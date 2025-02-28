<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserCtcHistory;
use App\Models\UserMonthlySalary;
use App\Models\UserMonthlySalaryComponentsLog;

class GenerateSalaryService
{
    protected $taxSlabRateService;
    protected $employeeAttendanceService;

    public function __construct(TaxSlabRuleService $taxSlabRateService, EmployeeAttendanceService $employeeAttendanceService)
    {
        $this->taxSlabRateService = $taxSlabRateService;
        $this->employeeAttendanceService = $employeeAttendanceService;
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function generateSalaryByEmployeeDetails($request)
    {
        $date = Carbon::create($request['year'], $request['month'], 1);
        $employeeDetails = User::find($request['user_id']);
        $checkExistingMonthDetails = $this->checkExistingMonthDetails($request);
        if (isset($checkExistingMonthDetails) && !empty($checkExistingMonthDetails)) {
            $data['getEmployeeMonthlySalary']['others'] = $checkExistingMonthDetails->toArray();
            $data['getEmployeeMonthlySalary']['monthlyCtc'] = $checkExistingMonthDetails->monthly_ctc;
            $data['getEmployeeMonthlySalary']['components'] = $checkExistingMonthDetails->userMonthlySalaryComponentLog->toArray();
            $data['employeeSalary'] = $employeeDetails;
            $data['status'] = true;
            $data['mail'] = $checkExistingMonthDetails->mail_send;
            return $data;
        }
        if (!isset($checkExistingMonthDetails)) {
            $userCTCDetails = UserCtcHistory::where('user_id', $request['user_id'])
                ->whereDate('effective_date', '<=', date($request['year'] . '-' . $request['month'] . '-01'))
                ->orderBy('id', 'DESC')
                ->limit(1)
                ->first();
            if ($userCTCDetails) {
                $ctcValue = $userCTCDetails->ctc_value;
                $salaryComponents = $userCTCDetails->userCtcComponentHistory;
                $applicableTaxRates = $this->taxSlabRateService->getActiveTaxSlab($employeeDetails->company_id);
                $totalDayPresent = $this->employeeAttendanceService->getTotalWorkingDaysByUserId($request['year'], $request['month'], $employeeDetails->id)->first();
                $totalWorking = $date->daysInMonth;
                $working = round($totalWorking - $totalDayPresent->total_present, 2);
                $lossOfPay = round((($totalDayPresent->late_count / $employeeDetails->details->officeShift->total_late_count) * $employeeDetails->details->officeShift->total_leave_deduction) + $working, 2);
                $getEmployeeMonthlySalary = $this->getEmployeeMonthlySalary($ctcValue, $salaryComponents, $applicableTaxRates, $totalWorking, $lossOfPay);
                $getEmployeeCtcComponents = $this->getEmployeeCtcComponents($ctcValue, $salaryComponents, $applicableTaxRates);
                $userMonthlySalary = $this->createUserMonthlySalary($getEmployeeMonthlySalary, $request);
                return ['status' => true, 'getEmployeeMonthlySalary' => $getEmployeeMonthlySalary, 'getEmployeeCtcComponents' => $getEmployeeCtcComponents, 'employeeSalary' => $employeeDetails, 'mail' => $userMonthlySalary->mail_send];
            } else {
                return ['status' => false];
            }
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $ctc
     * @param [type] $salaryComponents
     * @param [type] $applicableTaxRates
     * @param [type] $totalWorking
     * @param [type] $lossOfPay
     * @return void
     */
    public function getEmployeeMonthlySalary($ctc, $salaryComponents, $applicableTaxRates, $totalWorking, $lossOfPay)
    {
        $monthlyCtc = bcdiv($ctc, 12, 2);
        $totalLossOfPayAmount = 0;
        // Reduce for the loss of pays days if provided
        if ($lossOfPay > 0) {
            $oneDayCalculation = bcdiv($monthlyCtc, $totalWorking, 2);
            $totalLossOfPayAmount = bcmul($oneDayCalculation, $lossOfPay, 2);
            $monthlyCtc = bcsub($monthlyCtc, $totalLossOfPayAmount, 2);
        }

        $allComponentsWithValues = [];
        $otherValues = [];

        $componentsSumValue = 0;
        $specialAllowanceId = 0;
        $monthlyEarnings = 0;
        $monthlyDeductions = 0;
        foreach ($salaryComponents as $component) {
            $monthly = 0;
            // Convert component name in lowercase
            $componentName = $component->salaryComponent->name;
            $componentNameInLowerCase = strtolower($componentName);

            //check if component is special
            if (str_contains($componentNameInLowerCase, 'special')) {
                $specialAllowanceId = $component->salary_component_id;
            }

            if ($component->value_type == 'fixed') {
                $monthly = $component->value;
            }
            //check if component is basic
            if (str_contains($componentNameInLowerCase, 'basic') && $component->value_type == 'percentage') {
                $monthly = (bcdiv(bcmul($monthlyCtc, $component->value, 2), 100, 2));
            }

            if (isset($component->parent_component) && !empty($component->parent_component) && $component->value_type == 'percentage') {
                $parentMonthlyValue = $allComponentsWithValues[$component->parent_component]['monthly'];
                $monthly = bcdiv(bcmul($parentMonthlyValue, $component->value, 2), 100, 2);
            }
            $salaryComponentId = $component->salary_component_id;
            $componentDetails = [];
            $componentDetails['name'] = $componentName;
            $componentDetails['monthly'] = $monthly;
            $componentDetails['type'] = $component->earning_or_deduction;
            $componentDetails['component_id'] = $salaryComponentId;
            $allComponentsWithValues[$salaryComponentId] = $componentDetails;
            $componentsSumValue = bcadd($componentsSumValue, $monthly, 2);

            // Calculate sum of all earnings & deductions
            if ($component->earning_or_deduction == 'earning') {
                $monthlyEarnings = bcadd($monthlyEarnings, $monthly, 2);
            }
            if ($component->earning_or_deduction == 'deduction') {
                $monthlyDeductions = bcadd($monthlyDeductions, $monthly, 2);
            }
        }

        $monthlyAllowanceValue = bcsub($monthlyCtc, $componentsSumValue, 2);
        // Calculate tax as per the applicable rates for employee
        $yearlyTaxValue = $this->calculateTaxOnSalary($ctc, $applicableTaxRates);

        $monthlyTaxValue = '';
        if ($yearlyTaxValue > 0) {
            $monthlyTaxValue = bcdiv($yearlyTaxValue, 12, 2);
            // Reduce tax amount from remaining salary value
            $monthlyAllowanceValue = bcsub($monthlyAllowanceValue, $monthlyTaxValue);
            // Add tax value in deductions
            $monthlyDeductions = bcadd($monthlyDeductions, $monthlyTaxValue, 2);
        }

        // If employee salary is deducte due to leave, add LOP in monthly deductions
        if ($totalLossOfPayAmount > 0) {
            $monthlyDeductions = bcadd($monthlyDeductions, $totalLossOfPayAmount, 2);
        }

        // Adding special allowance value earning part
        $monthlyEarnings = bcadd($monthlyEarnings, $monthlyAllowanceValue, 2);

        if ($specialAllowanceId > 0) {
            $allComponentsWithValues[$specialAllowanceId]['monthly'] = $monthlyAllowanceValue;
        }

        $otherValues['monthly_earnings'] = $monthlyEarnings;
        $otherValues['monthly_deductions'] = $monthlyDeductions;
        $otherValues['monthlyTaxValue'] = $monthlyTaxValue;
        $otherValues['totalLossOfPayAmount'] = $totalLossOfPayAmount;
        $otherValues['total_working_days'] = $totalWorking;
        $otherValues['loss_of_pay_days'] = $lossOfPay;
        $otherValues['salary_calculated_for_days'] = $totalWorking - $lossOfPay;

        return [
            'components' => $allComponentsWithValues,
            'others' => $otherValues,
            'monthlyCtc' => bcdiv($ctc, 12, 2)
        ];
    }

    /**
     * Undocumented function
     * For Salary Tax Rate Calculation
     * @param [type] $ctc
     * @param [type] $taxRates
     * @return void
     */
    public function calculateTaxOnSalary($ctc, $taxRates)
    {
        $totalTaxes = 0;
        $lastIncomeHigherRange = 0;

        foreach ($taxRates as $rate) {
            $taxableAmount = 0;
            $tax = 0;

            if (($ctc > $rate->income_range_start) && ($ctc < $rate->income_range_end) && ($lastIncomeHigherRange < $ctc)) {
                $taxableAmount = bcsub($ctc, $rate->income_range_start, 2);
                $tax = bcdiv(bcmul($taxableAmount, $rate->tax_rate, 2), 100, 2);
                $lastIncomeHigherRange = $rate->income_range_end;
            } else if (($ctc > $rate->income_range_start) && ($ctc >= $rate->income_range_end) && ($lastIncomeHigherRange < $ctc)) {
                $taxableAmount = bcsub($rate->income_range_end, $rate->income_range_start, 2);
                $tax = bcdiv(bcmul($taxableAmount, $rate->tax_rate, 2), 100, 2);
                $lastIncomeHigherRange = $rate->income_range_end;
            }
            $totalTaxes = bcadd($totalTaxes, $tax, 2);
        }
        return $totalTaxes;
    }

    /**
     * For Salary Yearly Calculation
     *
     * @param [type] $ctc
     * @param [type] $salaryComponents
     * @param [type] $applicableTaxRates
     * @return void
     */
    public function getEmployeeCtcComponents($ctc, $salaryComponents, $applicableTaxRates)
    {
        $allComponentsWithValues = [];
        $otherValues = [];

        $componentsSumValue = 0;
        $specialAllowanceId = 0;
        $yearlyEarnings = 0;
        $yearlyDeductions = 0;
        foreach ($salaryComponents as $component) {
            $yearly = 0;
            // Convert component name in lowercase
            $componentName = $component->salaryComponent->name;
            $componentNameInLowerCase = strtolower($componentName);

            //check if component is special
            if (str_contains($componentNameInLowerCase, 'special')) {
                $specialAllowanceId = $component->salary_component_id;
            }

            if ($component->value_type == 'fixed') {
                $yearly = bcmul($component->value, 12, 2);
            }
            //check if component is basic
            if (str_contains($componentNameInLowerCase, 'basic') && $component->value_type == 'percentage') {
                $yearly = bcdiv(bcmul($ctc, $component->value, 2), 100, 2);
            }

            if (isset($component->parent_component) && !empty($component->parent_component) && $component->value_type == 'percentage') {
                $parentYearlyValue = $allComponentsWithValues[$component->parent_component]['yearly'];
                $yearly = bcdiv(bcmul($parentYearlyValue, $component->value, 2), 100, 2);
            }

            $salaryComponentId = $component->salary_component_id;
            $componentDetails = [];
            $componentDetails['name'] = $componentName;
            $componentDetails['yearly'] = $yearly;
            $componentDetails['type'] = $component->earning_or_deduction;
            $allComponentsWithValues[$salaryComponentId] = $componentDetails;
            $componentsSumValue += $yearly;

            // Calculate sum of all earnings & deductions
            if ($component->earning_or_deduction == 'earning') {
                $yearlyEarnings += $yearly;
            }
            if ($component->earning_or_deduction == 'deduction') {
                $yearlyDeductions += $yearly;
            }
        }

        // After breakdown of ctc in assigned components add remaining amount in special allowance
        $yearlyAllowanceValue = bcsub($ctc, $componentsSumValue, 2);

        // Calculate tax as per the applicable rates for employee
        $yearlyTaxValue = $this->calculateTaxOnSalary($ctc, $applicableTaxRates);
        if ($yearlyTaxValue > 0) {
            // Reduce tax amount from ctc before showing in allowance
            $yearlyAllowanceValue = bcsub($yearlyAllowanceValue, $yearlyTaxValue, 2);

            // Add tax value in salary total deductions
            $yearlyDeductions = bcadd($yearlyDeductions, $yearlyTaxValue, 2);
        }

        // Adding special allowance value earning part
        $yearlyEarnings += $yearlyAllowanceValue;

        if ($specialAllowanceId > 0) {
            $allComponentsWithValues[$specialAllowanceId]['yearly'] = $yearlyAllowanceValue;
        }

        $otherValues['yearly_earnings'] = $yearlyEarnings;
        $otherValues['yearly_deductions'] = $yearlyDeductions;
        $otherValues['yearlyTaxValue'] = $yearlyTaxValue;
        return [
            'components' => $allComponentsWithValues,
            'others' => $otherValues,
            'yearlyCtc' => $ctc
        ];
    }

    /**
     * Undocumented function
     *
     * @param [type] $getEmployeeMonthlySalary
     * @param [type] $request
     * @return void
     */
    public function createUserMonthlySalary($getEmployeeMonthlySalary, $request)
    {
        $getEmployeeMonthlySalary['others']['user_id'] = $request['user_id'];
        $getEmployeeMonthlySalary['others']['month'] = $request['month'];
        $getEmployeeMonthlySalary['others']['year'] = $request['year'];
        $getEmployeeMonthlySalary['others']['monthly_ctc'] = $getEmployeeMonthlySalary['monthlyCtc'];
        $userMonthlySalary = UserMonthlySalary::create($getEmployeeMonthlySalary['others']);
        foreach ($getEmployeeMonthlySalary['components'] as $item) {
            $item['monthly_salary_id'] = $userMonthlySalary->id;
            UserMonthlySalaryComponentsLog::create($item);
        }
        return $userMonthlySalary;
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function checkExistingMonthDetails($request)
    {
        return UserMonthlySalary::where('user_id', $request['user_id'])->where('year', $request['year'])->where('month', $request['month'])->first();
    }
}

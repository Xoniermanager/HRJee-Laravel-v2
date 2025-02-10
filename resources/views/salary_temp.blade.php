<style>
    .container-fluid {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    h2 {
        font-size: 1.5em;
        color: #333;
        margin-bottom: 10px;
    }

    .card {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        text-align: left;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 12px;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #f4f4f9;
        font-weight: bold;
    }

    .row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .col-md-6 {
        flex: 1 1 48%;
        padding: 10px;
    }

    .w-25 {
        width: 25%;
    }

    .w-50 {
        width: 50%;
    }

    hr.dashed {
        border: 0;
        border-top: 1px dashed #ddd;
        margin: 20px 0;
    }

    /* To make both Gross Salary and Deductions Calculation appear in one row */
    .salary-section {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .salary-section .col-md-6 {
        flex: 1;
    }
</style>
@php
$employeeMonthlySalary = $data['getEmployeeMonthlySalary'];
$employeeCtcComponents = $data['getEmployeeCtcComponents'];
$employeeSalary = $data['employeeSalary'];
@endphp
<div class="container-fluid">
    <div class="card">
        <h2><b>Monthly Salary Statement</b></h2>
        <table>
            <tr>
                <th class="w-25"> Name:</th>
                <td> {{ $employeeSalary->name }}</td>
                <th class="w-25"> Monthly CTC:</th>
                <td> {{ bcdiv($employeeSalary->advanceDetails->ctc_value, 12, 2) }}</td>
            </tr>
            <tr>
                <th class="w-25"> Total Working Days in Month:</th>
                <td> {{ $employeeMonthlySalary['others']['total_working_days'] }}</td>
                <th class="w-25"> Total Loss Of Pay Days: </th>
                <td> {{ $employeeMonthlySalary['others']['loss_of_pay_days'] }}</td>
            </tr>
            <tr>
                <th class="w-25"> Salary Calculated For Days: </th>
                <td> {{ $employeeMonthlySalary['others']['salary_calculated_for_days'] }}</td>
                <th class="w-25"></th>
                <td></td>
            </tr>
        </table>

        <div class="salary-section">
            <div class="col-md-6">
                <div class="card">
                    <h3><b>Gross Salary Calculation</b></h3>
                    <table>
                        <thead>
                            <tr>
                                <th class="w-50">Earnings</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employeeMonthlySalary['components'] as $employeeSalaryComponentsWithValue)
                            @if($employeeSalaryComponentsWithValue['type'] == 'earning')
                            <tr>
                                <td>{{ $employeeSalaryComponentsWithValue['name'] }}</td>
                                <td>{{ $employeeSalaryComponentsWithValue['monthly'] }}</td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>{{ $employeeMonthlySalary['others']['monthly_earnings'] }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <h3><b>Deductions Calculation</b></h3>
                    <table>
                        <thead>
                            <tr>
                                <th class="w-50">Deductions</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employeeMonthlySalary['components'] as $employeeSalaryComponentsWithValue)
                            @if($employeeSalaryComponentsWithValue['type'] == 'deduction')
                            <tr>
                                <td>{{ $employeeSalaryComponentsWithValue['name'] }}</td>
                                <td>{{ $employeeSalaryComponentsWithValue['monthly'] }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @if($employeeMonthlySalary['others']['monthlyTaxValue'])
                            <tr>
                                <td>TDS</td>
                                <td>{{ $employeeMonthlySalary['others']['monthlyTaxValue'] }}</td>
                            </tr>
                            @endif
                            @if($employeeMonthlySalary['others']['totalLossOfPayAmount'] > 0)
                            <tr>
                                <td>LOP</td>
                                <td>{{ $employeeMonthlySalary['others']['totalLossOfPayAmount'] }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>{{ $employeeMonthlySalary['others']['monthly_deductions'] }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Total In-Hand Salary -->
    <div class="card">
        <h3><b>Total In-Hand Salary (Monthly)</b></h3>
        <table>
            <tr>
                <td><strong>Total In-Hand Salary</strong></td>
                <td><strong>{{ $employeeMonthlySalary['others']['monthly_earnings'] }}</strong></td>
            </tr>
        </table>
        <p><strong>Total In-Hand Salary in Words (Monthly): </strong> {{
            numberToWords($employeeMonthlySalary['others']['monthly_earnings']) }}</p>
    </div>

    <div class="card">
        <h2><b>Yearly CTC Components Breakdown</b></h2>
        <table>
            <tr>
                <th class="w-25"> Name:</th>
                <td> {{ $employeeSalary->name }}</td>
                <th class="w-25">CTC:</th>
                <td> {{ $employeeSalary->advanceDetails->ctc_value }}</td>
            </tr>
        </table>

        <div class="salary-section">
            <div class="col-md-6">
                <div class="card">
                    <h3><b>Gross Salary Calculation</b></h3>
                    <table>
                        <thead>
                            <tr>
                                <th class="w-50">Earnings</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employeeCtcComponents['components'] as $employeeCtcComponent)
                            @if($employeeCtcComponent['type'] == 'earning')
                            <tr>
                                <td>{{ $employeeCtcComponent['name'] }}</td>
                                <td>{{ $employeeCtcComponent['yearly'] }}</td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>{{ $employeeCtcComponents['others']['yearly_earnings'] }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <h3><b>Deductions Calculation</b></h3>
                    <table>
                        <thead>
                            <tr>
                                <th class="w-50">Deductions</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employeeCtcComponents['components'] as $employeeCtcComponent)
                            @if($employeeCtcComponent['type'] == 'deduction')
                            <tr>
                                <td>{{ $employeeCtcComponent['name'] }}</td>
                                <td>{{ $employeeCtcComponent['yearly'] }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @if($employeeCtcComponents['others']['yearlyTaxValue'])
                            <tr>
                                <td>TDS</td>
                                <td>{{ $employeeCtcComponents['others']['yearlyTaxValue'] }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>{{ $employeeCtcComponents['others']['yearly_deductions'] }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Yearly Total In-Hand Salary -->
    <div class="card">
        <h3><b>Total In-Hand Salary (Yearly)</b></h3>
        <table>
            <tr>
                <td><strong>Total In-Hand Salary</strong></td>
                <td><strong>{{ $employeeCtcComponents['others']['yearly_earnings'] }}</strong></td>
            </tr>
        </table>
        <p><strong>Total In-Hand Salary in Words (Yearly): </strong> {{
            numberToWords($employeeCtcComponents['others']['yearly_earnings']) }}</p>
    </div>
</div>

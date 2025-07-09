<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\SalaryComponentService;
use App\Http\Requests\SalaryComponentStoreRequest;
use App\Http\Requests\SalaryComponentUpdateRequest;
use App\Models\DemoSalaryComponent;

class SalaryComponentController extends Controller
{
    private $salaryComponentService;

    public function __construct(SalaryComponentService $salaryComponentService)
    {
        $this->salaryComponentService = $salaryComponentService;
    }
    public function index()
    {
        $allSalaryComponent = $this->salaryComponentService->getAllSalaryComponentByCompanyId(Auth()->user()->company_id)->paginate(10);
        return view('company.salary_component.index', compact('allSalaryComponent'));
    }
    public function add()
    {
        $basicDetails = $this->salaryComponentService->getBasicPayDetails(Auth()->user()->company_id);
        return view('company.salary_component.add', compact('basicDetails'));
    }
    public function store(SalaryComponentStoreRequest $request)
    {
        try {
            $data = $request->all();
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            if ($this->salaryComponentService->create($data)) {
                return redirect(route('salary.component.index'))->with(['success' => 'Salary Component Added Succussfully']);
            }
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($salaryComponentId)
    {
        $salaryComponentDetails = $this->salaryComponentService->getDetailsBySalaryComponentId($salaryComponentId);
        $basicDetails = $this->salaryComponentService->getBasicPayDetails(Auth()->user()->company_id);
        return view('company.salary_component.edit', compact('salaryComponentDetails', 'basicDetails'));
    }

    public function update(SalaryComponentUpdateRequest $request, $salaryComponentId)
    {
        try {
            $data = $request->except(['_token', 'id']);
            if ($this->salaryComponentService->updateDetails($data, $salaryComponentId)) {
                return redirect(route('salary.component.index'))->with(['success' => 'Salary Component Updated Succussfully']);
            }
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function serachSalaryComponentFilterList(Request $request)
    {
        $searchedItems = $this->salaryComponentService->serachSalaryComponentFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.salary_component.list", [
                    'allSalaryComponent' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function demo()
    {
        // Load saved components
        $storedComponents = DemoSalaryComponent::where('user_id', Auth()->user()->id)->get();

        // Split by type
        $earnings = $storedComponents->where('type', 'earning');
        $deductions = $storedComponents->where('type', 'deduction');

        // Defaults if empty
        if ($earnings->isEmpty()) {
            $earnings = collect([
                (object) ['name' => 'Basic', 'value' => 0, 'selected' => true],
                (object) ['name' => 'HRA', 'value' => 0, 'selected' => true],
            ]);
        }
        if ($deductions->isEmpty()) {
            $deductions = collect([
                (object) ['name' => 'PF', 'value' => 0, 'selected' => true],
                (object) ['name' => 'ESI', 'value' => 0, 'selected' => true],
            ]);
        }

        $totalEarnings = $earnings->sum('value');
        $totalDeductions = $deductions->sum('value');

        $earningComponents = config('services.earnings');
        $deductionComponents = config('services.deductions');

        return view('salary-design', compact(
            'earnings',
            'deductions',
            'storedComponents',
            'totalEarnings',
            'totalDeductions',
            'earningComponents',
            'deductionComponents'
        ));
    }
    public function storeDemo(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        // save earnings
        if ($request->earnings) {
            foreach ($request->earnings as $item) {
                if (!empty($item['id'])) {
                    // Update existing
                    DemoSalaryComponent::where('id', $item['id'])
                        ->where('user_id', $user->id)
                        ->update([
                            'value' => $item['value'],
                            'selected' => isset($item['selected']) ? 1 : 0
                        ]);
                } else if (isset($item['selected'])) {
                    // New dynamic component: create only if selected
                    DemoSalaryComponent::create([
                        'user_id' => $user->id,
                        'type' => 'earning',
                        'name' => $item['name'],
                        'value' => $item['value'],
                        'selected' => 1
                    ]);
                } else {
                    // Default component with no id (first time): create and mark selected=1
                    DemoSalaryComponent::create([
                        'user_id' => $user->id,
                        'type' => 'earning',
                        'name' => $item['name'],
                        'value' => $item['value'],
                        'selected' => 1
                    ]);
                }
            }
        }

        // save deductions
        if ($request->deductions) {
            foreach ($request->deductions as $item) {
                if (!empty($item['id'])) {
                    // Update existing
                    DemoSalaryComponent::where('id', $item['id'])
                        ->where('user_id', $user->id)
                        ->update([
                            'value' => $item['value'],
                            'selected' => isset($item['selected']) ? 1 : 0
                        ]);
                } else if (isset($item['selected'])) {
                    // New dynamic component: create only if selected
                    DemoSalaryComponent::create([
                        'user_id' => $user->id,
                        'type' => 'deduction',
                        'name' => $item['name'],
                        'value' => $item['value'],
                        'selected' => 1
                    ]);
                } else {
                    // Default component with no id (first time): create and mark selected=1
                    DemoSalaryComponent::create([
                        'user_id' => $user->id,
                        'type' => 'deduction',
                        'name' => $item['name'],
                        'value' => $item['value'],
                        'selected' => 1
                    ]);
                }
            }
        }

        return back()->with('success', 'Salary components saved successfully!');
    }

    public function destroy($id)
    {
        $component = DemoSalaryComponent::findOrFail($id);
        $component->delete();

        return response()->json(['success' => true, 'message' => 'Component deleted successfully.']);
    }

}

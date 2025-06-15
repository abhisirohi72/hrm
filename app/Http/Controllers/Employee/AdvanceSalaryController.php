<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\AdvanceSalary;

class AdvanceSalaryController extends Controller
{
    public function index()
    {
        $main_title= "Employee-Advance-Salary";

        $title =    "Employee Advance Salary";

        $advances = AdvanceSalary::with('employee')->get();
        return view('advances.view', compact('advances', 'main_title', 'title'));
    }

    public function create()
    {
        $main_title= "Add-Employee-Advance-Salary";

        $title =    "Add Employee Advance Salary";
        $employees = Employee::all();
        return view('advances.add', compact('employees', 'main_title', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|date_format:Y-m',
            'amount' => 'required|numeric|min:1',
        ]);

        $exists = AdvanceSalary::where('employee_id', $request->employee_id)
            ->where('month', $request->month)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Advance salary already requested for this month.');
        }

        AdvanceSalary::create([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'amount' => $request->amount,
            'status' => 'pending',
            'note' => $request->note
        ]);

        return back()->with('success', 'Advance salary requested.');
    }

    public function approve($id)
    {
        $advance = AdvanceSalary::findOrFail($id);
        $advance->status = 'approved';
        $advance->save();

        return back()->with('success', 'Advance approved.');
    }

    public function reject($id)
    {
        $advance = AdvanceSalary::findOrFail($id);
        $advance->status = 'rejected';
        $advance->save();

        return back()->with('success', 'Advance rejected.');
    }
}

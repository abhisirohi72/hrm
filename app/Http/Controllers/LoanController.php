<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Employee;

class LoanController extends Controller
{
    public function index()
    {
        $main_title= "Employee-Loans";

        $title =    "Employee Loans";

        $loans = Loan::with('employee')->get();
        
        return view('loans.index', [
            "loans"         =>  $loans,
            "main_title"    =>  $main_title,
            "title"         =>  $title
        ]);
    }

    public function create()
    {
        $main_title= "Add-Loan";

        $title =    "Add Loans";

        $employees = Employee::all();
        
        return view('loans.create', [
            "employees"     =>  $employees,
            "main_title"    =>  $main_title,
            "title"         =>  $title
        ]);
    }

    public function editLoan($edit_id, Request $request)
    {
        $main_title= "Add-Loan";

        $title =    "Add Loans";

        $employees = Employee::all();

        $details = Loan::where("id", $edit_id)->first();
        
        return view('loans.create', [
            "employees"     =>  $employees,
            "main_title"    =>  $main_title,
            "title"         =>  $title,
            "details"       =>  $details,
            "edit_id"       =>  $edit_id
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required|numeric',
            'term_months' => 'required|integer|min:1',
        ]);

        $interest=0;
        $main_amnt= $request->amount;
        if($request->filled('interest')){
            $main_amnt = $main_amnt+(($main_amnt*$request->interest)/100);
        }
        $emi = $main_amnt / $request->term_months;
        if(isset($request->edit_id) && ($request->edit_id!="")){
            $update = Loan::where("id", $request->edit_id)->update([
                'employee_id' => $request->employee_id,
                'amount' => $main_amnt,
                'term_months' => $request->term_months,
                'monthly_emi' => round($emi, 2),
                'status' => 'pending',
                'interest'  =>  $request->interest
            ]);
            if ($update) {
                return back()->with('success', 'Updated Successfully!!!');
            }else {
                return back()->with('error', 'There is some issue in updating!!!');
            }
        }else{
            $insert= Loan::create([
                'employee_id' => $request->employee_id,
                'amount' => $main_amnt,
                'term_months' => $request->term_months,
                'monthly_emi' => round($emi, 2),
                'status' => 'pending',
                'interest'  =>  $request->interest
            ]);
            if ($insert) {
                return back()->with('success', 'Inserted Successfully!!!');
            }else {
                return back()->with('error', 'There is some issue in inserting!!!');
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUsHome;

class ContactUsController extends Controller
{
    public function viewContactUs(Request $request){
        $main_title= "Admin-Contact-Us-View";

        $title =    "Contact Us View";

        $details= ContactUsHome::all();

        return view('admin.contact_us.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addSalary(Request $request){
        $main_title= "Admin-Add-Salary";

        $title =    "Add Salary Account";

        return view('admin.salary.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editSalary($edit_id, Request $request){
        $main_title= "Admin-Edit-Salary";

        $title =    "Edit Salary Account";

        $details = SalaryAccount::where("id", $edit_id)->first();

        return view('admin.salary.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
        ]);
    }

    public function saveSalary(Request $request){
        return $this->addUpdateSalary($request, "add");
    }

    public function addUpdateSalary($request, $cond){
        $request->validate([
            'account_holder_name' => 'required|string|max:255',
            'account_number'      => 'required|string|max:20',
            'ifsc_code'           => 'required|string|max:11',
            'branch_name'         => 'required|string|max:255',
            'branch_address'      => 'required|string|max:255',
            'edit_id'             => 'nullable|integer|exists:salary_accounts,id',
        ]);

        if($request->input("edit_id")==""){
            $insert= SalaryAccount::create([
                "account_holder_name" =>  $request->input("account_holder_name"),
                "bank_name"           =>  $request->input("bank_name"),
                "account_number"      =>  $request->input("account_number"),
                "account_type"        =>  $request->input("account_type"),
                "ifsc_code"           =>  $request->input("ifsc_code"),
                "branch_name"         =>  $request->input("branch_name"),
                "branch_address"      =>  $request->input("branch_address"),
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            
            $update= SalaryAccount::where("id", $request->input("edit_id"))->update([
                "account_holder_name" =>  $request->input("account_holder_name"),
                "bank_name"           =>  $request->input("bank_name"),
                "account_number"      =>  $request->input("account_number"),
                "account_type"        =>  $request->input("account_type"),
                "ifsc_code"           =>  $request->input("ifsc_code"),
                "branch_name"         =>  $request->input("branch_name"),
                "branch_address"      =>  $request->input("branch_address"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteSalary($del_id, Request $request){
        $delete  = SalaryAccount::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

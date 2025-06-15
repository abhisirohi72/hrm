<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    public function viewEmp(Request $request){
        $main_title= "Admin-Employee";

        $title =    "Employee";

        $details= Employee::with(['departments','branches'])->get();

        return view('admin.emp.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addEmp(Request $request){
        $main_title= "Admin-Add-Employee";

        $title =    "Add Employee";

        $departments = Department::all();
        $branches = Branch::all();

        return view('admin.emp.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'departments'   =>  $departments,
            'branches'      =>  $branches
        ]);
    }

    public function editEmp($edit_id, Request $request){
        $main_title= "Admin-Edit-Employee";

        $title =    "Edit Employee";

        $departments = Department::all();
        
        $branches = Branch::all();

        $details = Employee::where("id", $edit_id)->first();

        return view('admin.emp.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
            'departments'   =>  $departments,
            'branches'      =>  $branches
        ]);
    }

    public function saveEmp(Request $request){
        return $this->addUpdateEmp($request, "add");
    }

    public function addUpdateEmp($request, $cond){
        $request->validate([
            // "name"      =>  "required|unique:departments,name,".$request->input('edit_id'),
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "full_name" =>  "required",
            "email"     =>  "required|unique:employees,email,".$request->input('edit_id'),
            "mobile"    =>  "required",
            "dob"       =>  "required",
            "address"   =>  "required",
            "dept_id"   =>  "required",
            "branch_id" =>  "required",
            "status"    =>  "required",
        ]);

        $directory = "emp/images";
        Storage::disk('public')->makeDirectory($directory);

        if($request->input("edit_id")==""){
            $filename="";
            if($request->file("image")->isValid()){
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $filename, 'public');
            }
            
            $insert= Employee::create([
                "image"         =>  $filename,
                "full_name"     =>  $request->input("full_name"),
                "email"         =>  $request->input("email"),
                "mobile"        =>  $request->input("mobile"),
                "dob"           =>  $request->input("dob"),
                "address"       =>  $request->input("address"),
                "dept_id"       =>  $request->input("dept_id"),   
                "branch_id"     =>  $request->input("branch_id"),
                "joinning_date" =>  $request->input("joinning_date"),
                "salary"        =>  $request->input("salary"),
                "status"        =>  $request->input("status"),
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            $filename  = $request->input("old_image");
            // echo $request->file("image")->isValid(); exit;
            if($request->file("image")->isValid()){
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $filename, 'public');
                    // echo "<pre>";
                    // print_r($path);
            }
            // exit;
            $update= Employee::where("id", $request->input("edit_id"))->update([
                "image"         =>  $filename,
                "full_name"     =>  $request->input("full_name"),
                "email"         =>  $request->input("email"),
                "mobile"        =>  $request->input("mobile"),
                "dob"           =>  $request->input("dob"),
                "address"       =>  $request->input("address"),
                "dept_id"       =>  $request->input("dept_id"),   
                "branch_id"     =>  $request->input("branch_id"),
                "joinning_date" =>  $request->input("joinning_date"),
                "salary"        =>  $request->input("salary"),
                "status"        =>  $request->input("status"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteEmp($del_id, Request $request){
        $delete  = Employee::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }

    public function viewEmpIcard($emp_id, Request $request){
        $details = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();

        return response()->json([
            'details'=> $details
        ]);
    }

    public function viewJoinningLetter($emp_id, Request $request){
        $employee = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();
        $company_name = "Your Company Name";
        $hr_name = "HR Manager";

        $html = view('admin.emp.joining_letter', [
            'employee'      =>  $employee,
            'company_name'  =>  $company_name,
            'hr_name'       =>  $hr_name
        ])->render();
        
        return response()->json(['html' => $html]);
    }

    public function viewOfferLetter($emp_id, Request $request){
        $employee = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();
        $company_name = "Your Company Name";
        $hr_name = "HR Manager";

        $html = view('admin.emp.offer_letter', [
            'employee'      =>  $employee,
            'company_name'  =>  $company_name,
            'hr_name'       =>  $hr_name
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function downloadOfferLetter($emp_id, Request $request){
        $employee = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();
        $company_name = "Your Company Name";
        $hr_name = "HR Manager";

        $pdf = Pdf::loadView('admin.emp.d_offer_letter', [
            'employee'      =>  $employee,
            'company_name'  =>  $company_name,
            'hr_name'       =>  $hr_name
        ]);

        return $pdf->download("Offer_Letter_{$employee->employee_code}.pdf");
    }

    public function downloadJoinningLetter($emp_id, Request $request){
        $employee = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();
        $company_name = "Your Company Name";
        $hr_name = "HR Manager";

        $pdf = Pdf::loadView('admin.emp.d_joinning_letter', [
            'employee'      =>  $employee,
            'company_name'  =>  $company_name,
            'hr_name'       =>  $hr_name
        ]);

        return $pdf->download("Joinning_letter_{$employee->employee_code}.pdf");
    }

    public function downloadIcard($emp_id, Request $request){
        $employee = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();
        $company_name = "Your Company Name";
        $hr_name = "HR Manager";

        $pdf = Pdf::loadView('admin.emp.icard', [
            'employee'      =>  $employee,
            'company_name'  =>  $company_name,
            'hr_name'       =>  $hr_name
        ]);

        return $pdf->download("Icard_{$employee->employee_code}.pdf");
    }
}

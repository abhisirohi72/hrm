<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Target;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    public function viewTarget(Request $request){
        $main_title= "Admin-Target-View";

        $title =    "Target View";

        $details= Target::with('employee')->get();
        // echo "<pre>";
        // print_r($details);
        // echo "</pre>";

        return view('admin.target.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addTarget(Request $request){
        $main_title= "Admin-Add-Target";

        $title =    "Add Target";
        
        $employees = Employee::where("status", "1")->get();

        return view('admin.target.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'employees'     =>  $employees,
        ]);
    }

    public function editTarget($edit_id, Request $request){
        $main_title= "Admin-Edit-Target";

        $title =    "Edit Target";

        $details = Target::where("id", $edit_id)->first();
        // echo "<pre>";
        // print_r($details);
        // echo "</pre>";
        // exit;
        if(!$details){
            return redirect()->back()->with('error', 'Target not found!');
        }

        $employees = Employee::where("status", "1")->get();

        return view('admin.target.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
            'employees'     =>  $employees,
        ]);
    }

    public function saveTarget(Request $request){
        return $this->addUpdateTarget($request, "add");
    }

    public function addUpdateTarget($request, $cond){
        $request->validate([
            'employee_id' => 'required',
            'target_name' => 'required|string|max:255',
            'target_start_date' => 'required|date',
            'target_type' => 'required|in:0,1',
            'edit_id' => 'nullable|integer|exists:targets,id',
        ]);

        if($request->input("edit_id")==""){
            $insert= Target::create([
                "employee_id" =>  $request->input("employee_id"),
                "target_name" =>  $request->input("target_name"),
                "target_start_date" =>  $request->input("target_start_date"),
                "target_end_date" =>  $request->input("target_end_date"),
                "target_type" =>  $request->input("target_type"),
                "target_amount" =>  $request->input("target_amount"),
                "target_achieved" =>  $request->input("target_achieved"),
            ]); 

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            
            $update= Target::where("id", $request->input("edit_id"))->update([
                "employee_id" =>  $request->input("employee_id"),
                "target_name" =>  $request->input("target_name"),
                "target_start_date" =>  $request->input("target_start_date"),
                "target_end_date" =>  $request->input("target_end_date"),
                "target_type" =>  $request->input("target_type"),
                "target_amount" =>  $request->input("target_amount"),
                "target_achieved" =>  $request->input("target_achieved"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteTarget($del_id, Request $request){
        $delete  = Target::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

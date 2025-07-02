<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Sop;
use Illuminate\Http\Request;

class SopController extends Controller
{
    public function viewSop(Request $request){
        $main_title= "Admin-SOP-View";

        $title =    "SOP View";

        $details= Sop::with('departments')->get();
        // echo "<pre>";
        // print_r($details);
        // echo "</pre>";

        $departments= Department::where("status", "1")->get();

        return view('admin.sop.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details,
            'departments'   =>  $departments
        ]);
    }

    public function addSop(Request $request){
        $main_title= "Admin-Add-SOP";

        $title =    "Add SOP";

        $departments = Department::where("status", "1")->get();

        return view('admin.sop.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'departments'   =>  $departments,
        ]);
    }

    public function editSop($edit_id, Request $request){
        $main_title= "Admin-Edit-SOP";

        $title =    "Edit SOP";

        $details = Sop::with('departments')->where("id", $edit_id)->first();
        // echo "<pre>";
        // print_r($details);
        // echo "</pre>";
        // exit;
        if(!$details){
            return redirect()->back()->with('error', 'Target not found!');
        }

        $departments = Department::where("status", "1")->get();

        return view('admin.sop.add', [
            'main_title'        =>  $main_title,
            'title'             =>  $title,
            'edit_id'           =>  $edit_id,
            'details'           =>  $details,
            'departments'       =>  $departments,
        ]);
    }

    public function saveSop(Request $request){
        return $this->addUpdateSop($request, "add");
    }

    public function addUpdateSop($request, $cond){
        $request->validate([
            'department_id' => 'required',
            'timming' => 'required|in:0,1,2,3,4,5,6',
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'sop' => 'required|string',
            'edit_id' => 'nullable|integer|exists:sops,id',
        ]);

        if($request->input("edit_id")==""){
            $insert= Sop::create([
                "department_id" =>  $request->input("department_id"),
                "timming" =>  $request->input("timming"),
                "date" =>  $request->input("date"),
                "title" =>  $request->input("title"),
                "sop" =>  $request->input("sop"),
            ]); 

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            
            $update= Sop::where("id", $request->input("edit_id"))->update([
                "department_id" =>  $request->input("department_id"),
                "timming" =>  $request->input("timming"),
                "date" =>  $request->input("date"),
                "title" =>  $request->input("title"),
                "sop" =>  $request->input("sop"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteSop($del_id, Request $request){
        $delete  = Sop::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

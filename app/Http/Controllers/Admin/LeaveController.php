<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function viewLeaves(Request $request){
        $main_title= "Admin-Leaves-View";

        $title =    "Leaves View";

        $details= Leave::all();

        return view('admin.leave.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addLeave(Request $request){
        $main_title= "Admin-Add-Leave";

        $title =    "Add Leave";

        return view('admin.leave.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editLeave($edit_id, Request $request){
        $main_title= "Admin-Edit-Leave";

        $title =    "Edit Leave";

        $details = Leave::where("id", $edit_id)->first();

        return view('admin.leave.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
        ]);
    }

    public function saveLeave(Request $request){
        return $this->addUpdateLeave($request, "add");
    }

    public function addUpdateLeave($request, $cond){
        $request->validate([
            'start_date' => 'required|string|max:255',
            'end_date'   => 'required|string|max:20',
            'leave_type' => 'required|string|max:11',
            'reason'     => 'required|string|max:255',
            'status'     => 'required|string|max:255',
            'edit_id'    => 'nullable|integer|exists:leaves,id',
        ]);

        if($request->input("edit_id")==""){
            $insert= Leave::create([
                "employee_id"   => Auth::id(),
                "start_date"    =>  $request->input("start_date"),
                "end_date"      =>  $request->input("end_date"),
                "leave_type"    =>  $request->input("leave_type"),
                "reason"        =>  $request->input("reason"),
                "status"        =>  $request->input("status"),
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            
            $update= Leave::where("id", $request->input("edit_id"))->update([
                "employee_id"   => Auth::id(),
                "start_date"    =>  $request->input("start_date"),
                "end_date"      =>  $request->input("end_date"),
                "leave_type"    =>  $request->input("leave_type"),
                "reason"        =>  $request->input("reason"),
                "status"        =>  $request->input("status"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteLeave($del_id){
        $delete  = Leave::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

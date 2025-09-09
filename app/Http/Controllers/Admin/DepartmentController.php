<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\PageAccess;

class DepartmentController extends Controller
{
    public function viewDepartment(Request $request){
        $main_title= "Admin-Department";

        $title =    "Department";

        $details= Department::all(); 

        return view('admin.department.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function viewPages($id, Request $request){
        $main_title= "Admin-View-Pages";

        $title =    "Department Pages";

        $details= PageAccess::where("department_id", $id)->get();

        return view('admin.department.page_view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details,
            "id"            =>  $id
        ]);
    }

    public function savePageAccess(Request $request){
        try {
           $request->validate([
                "department_id" =>  "required",
                "page_name"     =>  "required"
           ]);
           $delete_old_data = PageAccess::where("department_id", $request->department_id)->delete();
        //    if($delete_old_data){
                foreach ($request->page_name as $key => $value) {
                    PageAccess::create([
                        "department_id" =>  $request->department_id,
                        "page_name"     =>  $value,
                        "is_access"     =>  'yes'
                    ]);
                }
            // }
            return redirect()->back()->with("success", "Successfully insert data");
            } catch (\Throwable $th) {
                return redirect()->back()->with("error", $th->getMessage());        
            }
    }

    public function addDepartment(Request $request){
        $main_title= "Admin-Add-Department";

        $title =    "Add Department";

        return view('admin.department.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editDepartment($edit_id, Request $request){
        $main_title= "Admin-Edit-Department";

        $title =    "Edit Department";

        $details = Department::where("id", $edit_id)->first();
        return view('admin.department.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details
        ]);
    }

    public function saveDepartment(Request $request){
        return $this->addUpdateDepartment($request, "add");
    }

    public function addUpdateDepartment($request, $cond){
        $request->validate([
            "name"      =>  "required|unique:departments,name,".$request->input('edit_id'),
            "status"    =>  "required"
        ]);
        if($request->input("edit_id")==""){
            $insert= Department::create([
                "name"   => $request->input("name"),
                "status" => $request->input("status"),
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            
            $update= Department::where("id", $request->input("edit_id"))->update([
                "name"   => $request->input("name"),
                "status" => $request->input("status"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteDepartment($del_id, Request $request){
        $delete  = Department::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}
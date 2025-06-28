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
            "page_name"      =>  "required|unique:departments,name,".$request->input('edit_id'),
            "department_id"    =>  "required"
        ]);
        PageAccess::where("department_id", $request->input("department_id"))->delete();
        foreach ($request->input("page_name") as $key => $value) {
            // PageAccess::create([
            //     "department_id" => $request->input("department_id"),
            //     "page_name"     => $value,
            //     "isaccess"      => 'yes'
            // ]);
            PageAccess::updateOrCreate(
                [
                    'department_id' => $request->input("department_id"),
                    'page_name'     => $value
                ],
                [
                    'isaccess'      => 'yes'
                ]
            );
        }
        return redirect()->back()->with('success', 'Successfully Saved!!!');
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
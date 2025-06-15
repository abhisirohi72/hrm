<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BranchController extends Controller
{
    public function viewBranch(Request $request){
        $main_title= "Admin-Branch";

        $title =    "Branch";

        $details= Branch::with('departments')->get(); 
        // echo "<pre>";
        // print_r($details);
        // exit;
        return view('admin.branch.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addBranch(Request $request){
        $main_title= "Admin-Add-Branch";

        $title =    "Add Branch";

        $details = Department::all();
        return view('admin.branch.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details,
        ]);
    }

    public function editBranch($edit_id, Request $request){
        $main_title= "Admin-Edit-Branch";

        $title =    "Edit Branch";

        $details = Department::all();
        // echo "<pre>";
        // print_r($details);
        // exit;
        $b_details = Branch::with('departments')->where("id", $edit_id)->first();

        return view('admin.branch.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
            'b_details'     =>  $b_details
        ]);
    }

    public function saveBranch(Request $request){
        return $this->addUpdateBranch($request, "add");
    }

    public function addUpdateBranch($request, $cond){
        $request->validate([
            "dept_name" =>  "required",
            "name"      =>  "required|unique:branches,name,".$request->input('edit_id'),
            "status"    =>  "required"
        ]);

        $directory = "company";
        Storage::disk('public')->makeDirectory($directory);

        if($request->input("edit_id")==""){
            $filename="";
            if($request->file("c_logo")->isValid()){
                $file = $request->file('c_logo');

                // Generate encrypted (random) filename with original extension
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $filename, 'public');
            }
            $insert= Branch::create([
                "dept_id"   =>  $request->input("dept_name"),
                "name"      =>  $request->input("name"),
                "status"    =>  $request->input("status"),
                "address"   =>  $request->input("address"),
                "c_logo"    =>  $filename,
                "c_website" =>  $request->input("c_website"),
                "c_email"   =>  $request->input("c_email"),
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            $filename  = $request->input("old_c_logo");
            // echo $request->file("image")->isValid(); exit;
            if($request->file("c_logo")->isValid()){
                $file = $request->file('c_logo');

                // Generate encrypted (random) filename with original extension
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $filename, 'public');
                    // echo "<pre>";
                    // print_r($path);
            }
            $update= Branch::where("id", $request->input("edit_id"))->update([
                "dept_id"   =>  $request->input("dept_name"),
                "name"      =>  $request->input("name"),
                "status"    =>  $request->input("status"),
                "address"   =>  $request->input("address"),
                'c_logo'    =>  $filename,
                "c_website" =>  $request->input("c_website"),
                "c_email"   =>  $request->input("c_email"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteBranch($del_id, Request $request){
        $delete  = Department::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

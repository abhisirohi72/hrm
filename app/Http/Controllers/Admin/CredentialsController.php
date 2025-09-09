<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Credential;
use Illuminate\Http\Request;

class CredentialsController extends Controller
{
    public function __construct()
    {
        
    }

    public function viewCredentials(Request $request){
        $main_title= "View Credentials";

        $title =    "Credentials";

        $details= Credential::all(); 

        return view('admin.credentials.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addCredentials(Request $request){
        $main_title= "Add Credentials";

        $title =    "Credentials";

        // $details= Credential::all(); 

        return view('admin.credentials.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            // 'details'       =>  $details
        ]);
    }

    public function editCredentials($edit_id, Request $request){
        $main_title= "Admin-Edit-Credentials";

        $title =    "Edit Credentials";

        $details = Credential::where("id", $edit_id)->first();
        return view('admin.credentials.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details
        ]);
    }

    public function saveCredentials(Request $request){
        return $this->addUpdateCredentials($request, "add");
    }

    public function addUpdateCredentials($request, $cond){
        $request->validate([
            "url"   =>  "required|url",
            "user_email"   =>  "nullable",
            "user_pass"   =>  "nullable",
            "admin_email"   =>  "nullable",
            "admin_password"   =>  "nullable",
            "developer_email"   =>  "nullable",
            "developer_password"   =>  "nullable",
        ]);

        if($request->input("edit_id")==""){
            $insert= Credential::create([
                "url"   =>  $request->input("url"),
                "user_email"   =>  $request->input("user_email"),
                "user_pass"   =>  $request->input("user_pass"),
                "admin_email"   =>  $request->input("admin_email"),
                "admin_password"   =>  $request->input("admin_password"),
                "developer_email"   =>  $request->input("developer_email"),
                "developer_password"   =>  $request->input("developer_password"),
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            
            $update= Credential::where("id", $request->input("edit_id"))->update([
                "url"   =>  $request->input("url"),
                "user_email"   =>  $request->input("user_email"),
                "user_pass"   =>  $request->input("user_pass"),
                "admin_email"   =>  $request->input("admin_email"),
                "admin_password"   =>  $request->input("admin_password"),
                "developer_email"   =>  $request->input("developer_email"),
                "developer_password"   =>  $request->input("developer_password"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteCredentials($del_id, Request $request){
        $delete  = Credential::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

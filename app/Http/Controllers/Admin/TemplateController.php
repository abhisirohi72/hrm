<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function viewTemplate(Request $request){
        $main_title= "Admin-Template-View";

        $title =    "Template View";

        $details= Template::where("status", "1")->get();

        return view('admin.template.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addTemplate(Request $request){
        $main_title= "Admin-Add-Template";

        $title =    "Add Template";

        return view('admin.template.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editTemplate($edit_id, Request $request){
        $main_title= "Admin-Edit-Template";

        $title =    "Edit Template";

        $details = Template::where("id", $edit_id)->first();

        return view('admin.template.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
        ]);
    }

    public function saveTemplate(Request $request){
        return $this->addUpdateTemplate($request, "add");
    }

    public function addUpdateTemplate($request, $cond){
        $request->validate([
            'title'     =>  'required',
            "template"  =>  "required",
            "status"    =>  "required",
        ]);

        if($request->input("edit_id")==""){
            $insert= Template::create([
                "title"     =>  $request->title ?? '',
                "template"  =>  $request->template ?? '',
                "status"    =>  $request->status ?? '',
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            $update= Template::where("id", $request->input("edit_id"))->update([
                "title"     =>  $request->title ?? '',
                "template"  =>  $request->template ?? '',
                "status"    =>  $request->status ?? '',
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteTemplate($del_id){
        $delete  = Template::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

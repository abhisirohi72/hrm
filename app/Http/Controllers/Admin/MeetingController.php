<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function viewMeeting(Request $request){
        $main_title= "Admin-Metting-View";

        $title =    "Metting View";

        $details= Meeting::with(["users", "templates"])->get();

        // echo "<pre>";
        // print_r($details);
        // exit;

        return view('admin.meetings.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addMeeting(Request $request){
        $main_title= "Admin-Add-Meeting";

        $title =    "Add Meeting";

        $user_details  = User::where("role", "1")->get();

        $templates = Template::where("status", "1")->get();

        return view('admin.meetings.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'user_details'  =>  $user_details,
            'templates'     =>  $templates
        ]);
    }

    public function editMeeting($edit_id, Request $request){
        $main_title= "Admin-Edit-Meeting";

        $title =    "Edit Meeting";

        $user_details  = User::where("role", "1")->get();

        $templates = Template::where("status", "1")->get();

        $details = Meeting::where("id", $edit_id)->first();

        return view('admin.meetings.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
            'user_details'  =>  $user_details,
            'templates'     =>  $templates,
        ]);
    }

    public function saveMeeting(Request $request){
        return $this->addUpdateMeeting($request, "add");
    }

    public function addUpdateMeeting($request, $cond){
        $request->validate([
            'assing_to'         =>  'required',
            "date"              =>  "required",
            "meeting_template"  =>  "required",
            "title"             =>  "required",
            "message"           =>  "required",
            "customer_name"     =>  "required",
            "status"            =>  "required",
        ]);

        if($request->input("edit_id")==""){
            $insert= Meeting::create([
                "assing_to"         =>  $request->assing_to ?? '',
                "date"              =>  $request->date ?? '',
                "meeting_template"  =>  $request->meeting_template ?? '',
                "title"             =>  $request->title ?? '',
                "message"           =>  $request->message ?? '',
                "customer_name"     =>  $request->customer_name ?? '',
                "status"            =>  $request->status ?? '',
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            $update= Meeting::where("id", $request->input("edit_id"))->update([
                "assing_to"         =>  $request->assing_to ?? '',
                "date"              =>  $request->date ?? '',
                "meeting_template"  =>  $request->meeting_template ?? '',
                "title"             =>  $request->title ?? '',
                "message"           =>  $request->message ?? '',
                "customer_name"     =>  $request->customer_name ?? '',
                "status"            =>  $request->status ?? '',
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteMeeting($del_id){
        $delete  = Meeting::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

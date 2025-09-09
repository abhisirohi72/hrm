<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function viewCampaign(Request $request){
        $main_title= "Admin-Campaign-View";

        $title =    "Campaign View";

        $details= Campaign::all();
        // echo "<pre>";
        // print_r($details);
        // echo "</pre>";

        return view('admin.campaign.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details,
        ]);
    }

    public function addCampaign(Request $request){
        $main_title= "Admin-Add-Campaign";

        $title =    "Add Campaign";

        return view('admin.campaign.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editCampaign($edit_id, Request $request){
        $main_title= "Admin-Edit-Campaign";

        $title =    "Edit Campaign";

        $details = Campaign::where("id", $edit_id)->first();
        // echo "<pre>";
        // print_r($details);
        // echo "</pre>";
        // exit;
        if(!$details){
            return redirect()->back()->with('error', 'Target not found!');
        }

        return view('admin.campaign.add', [
            'main_title'        =>  $main_title,
            'title'             =>  $title,
            'edit_id'           =>  $edit_id,
            'details'           =>  $details,
        ]);
    }

    public function saveCampaign(Request $request){
        return $this->addUpdateCampaign($request, "add");
    }

    public function addUpdateCampaign($request, $cond){
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            'notes' => 'required',
            'edit_id' => 'nullable|integer|exists:campaigns,id',
        ]);

        if($request->input("edit_id")==""){
            $insert= Campaign::create([
                "name" =>  $request->input("name"),
                "type" =>  $request->input("type"),
                "start_date" =>  $request->input("start_date"),
                "end_date" =>  $request->input("end_date"),
                "budget" =>  $request->input("budget"),
                "status" =>  $request->input("status"),
                "notes" =>  $request->input("notes"),
            ]); 

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            
            $update= Campaign::where("id", $request->input("edit_id"))->update([
                "name" =>  $request->input("name"),
                "type" =>  $request->input("type"),
                "start_date" =>  $request->input("start_date"),
                "end_date" =>  $request->input("end_date"),
                "budget" =>  $request->input("budget"),
                "status" =>  $request->input("status"),
                "notes" =>  $request->input("notes"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteCampaign($del_id, Request $request){
        $delete  = Campaign::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

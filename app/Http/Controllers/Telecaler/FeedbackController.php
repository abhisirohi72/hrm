<?php

namespace App\Http\Controllers\Telecaler;

use App\Http\Controllers\Controller;
use App\Models\TelecalerFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function viewTFeedback(Request $request)
    {
        $main_title = "Telecaler-Feedback";

        $title =    "Telecaler Feedback";

        $details = TelecalerFeedback::all();

        return view('telecaler.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addTFeedback(Request $request)
    {
        $main_title = "Telecaler-Feedback";

        $title =    "Telecaler Feedback";

        // $details = Department::all();
        return view('telecaler.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            // 'details'       =>  $details,
        ]);
    }

    public function editTFeedback($edit_id, Request $request)
    {
        $main_title = "Edit-Telecaler-Feedback";

        $title =    "Edit Telecaler-Feedback";

        // $details = Department::all();
        // echo "<pre>";
        // print_r($details);
        // exit;
        $b_details = TelecalerFeedback::where("id", $edit_id)->first();

        return view('telecaler.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            // 'details'       =>  $details,
            'b_details'     =>  $b_details
        ]);
    }

    public function saveTFeedback(Request $request)
    {
        return $this->addUpdateTfeedback($request, "add");
    }

    public function addUpdateTfeedback($request, $cond)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'call_purpose' => 'required|string',
            'insterested' => 'required|string',
            'feedback_notes' => 'required|string',
            'next_followup' => 'nullable|date',
        ]);

        // if ($request->input("edit_id") == "") {
            $insert = TelecalerFeedback::create([
                "customer_name"   =>  $request->input("customer_name"),
                "contact_number"  =>  $request->input("contact_number"),
                "call_purpose"    =>  $request->input("call_purpose"),
                "insterested"     =>  $request->input("insterested"),
                "feedback_notes"  =>  $request->input("feedback_notes"),
                "next_followup"   =>  $request->input("next_followup"),
                "user_id"         =>  Auth::user()->id,
            ]);
            
            if ($insert) {
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            } else {
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        // } else {

        //     $update = TelecalerFeedback::where("id", $request->input("edit_id"))->update([
        //         "customer_name"   =>  $request->input("customer_name"),
        //         "contact_number"  =>  $request->input("contact_number"),
        //         "call_purpose"    =>  $request->input("call_purpose"),
        //         "insterested"     =>  $request->input("insterested"),
        //         "feedback_notes"  =>  $request->input("feedback_notes"),
        //         "next_followup"   =>  $request->input("next_followup"),
        //         "user_id"         =>  Auth::user()->id,
        //     ]);

        //     if ($update) {
        //         return redirect()->back()->with('success', 'Successfully Updated!!!');
        //     } else {
        //         return redirect()->back()->with('error', 'There is some issue in updated!!!');
        //     }
        // }
    }

    public function deleteTFeedback($del_id, Request $request)
    {
        $delete  = TelecalerFeedback::where("id", $del_id)->delete();

        if ($delete) {
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        } else {
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function viewHolidays(Request $request){
        $main_title= "Admin-Holidays-View";

        $title =    "Holidays View";

        $details= Holiday::all();

        return view('admin.holiday.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addHoliday(Request $request){
        $main_title= "Admin-Add-Holiday";

        $title =    "Add Holiday";

        return view('admin.holiday.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editHoliday($edit_id, Request $request){
        $main_title= "Admin-Edit-Holiday";

        $title =    "Edit Holiday";

        $details = Holiday::where("id", $edit_id)->first();

        return view('admin.holiday.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
        ]);
    }

    public function saveHoliday(Request $request){
        return $this->addUpdateHoliday($request, "add");
    }

    public function addUpdateHoliday($request, $cond){
        $request->validate([
            'holiday_name' => 'required|string|max:255',
            'holiday_date'   => 'required|date',
        ]);

        if($request->input("edit_id")==""){
            $insert= Holiday::create([
                "holiday_name"    =>  $request->input("holiday_name"),
                "holiday_date"      =>  $request->input("holiday_date"),
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            
            $update= Holiday::where("id", $request->input("edit_id"))->update([
                "holiday_name"    =>  $request->input("holiday_name"),
                "holiday_date"      =>  $request->input("holiday_date"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteHoliday($del_id){
        $delete  = Holiday::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

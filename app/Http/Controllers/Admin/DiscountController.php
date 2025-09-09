<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function viewDiscount(Request $request){
        $main_title= "Admin-Discount";

        $title =    "Discount";

        $details= Discount::with(['products'])->get();

        return view('admin.discount.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addDiscount(Request $request){
        $main_title= "Admin-Add-Discount";

        $title =    "Add Discount";

        $discount = Discount::all();

        return view('admin.discount.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'discount'      =>  $discount
        ]);
    }

    public function editDiscount($edit_id, Request $request){
        $main_title= "Admin-Edit-Discount";

        $title =    "Edit Discount";

        $details = Discount::where("id", $edit_id)->first();

        return view('admin.discount.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
        ]);
    }

    public function saveDiscount(Request $request){
        return $this->addUpdateDiscount($request, "add");
    }

    public function addUpdateDiscount($request, $cond){
        $request->validate([
            "name"              =>  "required|unique:discounts,name,".$request->input('edit_id'),
            'discount_type'     => 'required',
            "discount_value"    =>  "required",
            "start_date"        =>  "required",
            "end_date"          =>  "required",
            "status"            =>  "required",
        ]);

        if($request->input("edit_id")==""){
            $insert= Discount::create([
                "name"              =>  $request->input("name"),
                "description"       =>  $request->input("description"),
                "discount_type"     =>  $request->input("discount_type"),
                "discount_value"    =>  $request->input("discount_value"),
                "start_date"        =>  $request->input("start_date"),
                "end_date"          =>  $request->input("end_date"),   
                "status"            =>  $request->input("status"),
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            $update= Discount::where("id", $request->input("edit_id"))->update([
                "name"              =>  $request->input("name"),
                "description"       =>  $request->input("description"),
                "discount_type"     =>  $request->input("discount_type"),
                "discount_value"    =>  $request->input("discount_value"),
                "start_date"        =>  $request->input("start_date"),
                "end_date"          =>  $request->input("end_date"),   
                "status"            =>  $request->input("status"),
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteDiscount($del_id, Request $request){
        $delete  = Discount::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function viewCategory(){
        $main_title= "Admin-Category";

        $title =    "Category";

        $details= Category::all();

        return view('category.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addCategory(){
        $main_title= "Admin-Category";

        $title =    "Add Category";

        return view('category.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editCategory($edit_id){
        $main_title= "Edit-Category";

        $title =    "Edit Category";

        $details = Category::where("id", $edit_id)->first();

        return view('category.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
        ]);
    }

    public function saveCategory(Request $request){
        return $this->addUpdateCategory($request);
    }

    public function addUpdateCategory($request){
        $request->validate([
            "name"      =>  "required|unique:categories,name,".$request->input('edit_id'),
            "type"      =>  "required",
        ]);

        if($request->input("edit_id")==""){
            $insert= Category::create([
                "name"  =>  $request->name,
                "type"  =>  $request->type
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            $update= Category::where("id", $request->input("edit_id"))->update([
                "name"  =>  $request->name,
                "type"  =>  $request->type
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteCategory($del_id){
        $delete  = Category::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

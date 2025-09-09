<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function viewProduct(){
        $main_title =   "Admin-Product";

        $title      =   "Product";

        $details= Product::with('category')->get();

        return view('product.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addProduct(){
        $main_title= "Admin-Product";

        $title =    "Add Product";

        $cat_details = Category::all();

        return view('product.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'cat_details'   =>  $cat_details
        ]);
    }

    public function editProduct($edit_id){
        $main_title= "Edit-Product";

        $title =    "Edit Product";

        $cat_details = Category::all();

        $details =  Product::where("id", $edit_id)->first();

        return view('product.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'cat_details'   =>  $cat_details,
            'details'       =>  $details,
        ]);
    }

    public function saveProduct(Request $request){
        return $this->addUpdateProduct($request);
    }

    public function addUpdateProduct($request){
        $request->validate([
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "category_id"   =>  "required",
            "name"          =>  "required|unique:products,name,".$request->input('edit_id'),
            "sku"           =>  "required",
            "description"   =>  "required",
            "price"         =>  "required",
            "quantity"      =>  "required",
        ]);

        $directory = "product/images";
        Storage::disk('public')->makeDirectory($directory);

        if($request->input("edit_id")==""){
            $filename="";
            if($request->file("image")->isValid()){
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $filename, 'public');
            }
            
            $insert= Product::create([
                "image"         =>  $filename,
                "category_id"   =>  $request->category_id,
                "name"          =>  $request->name,
                "sku"           =>  $request->sku,
                "description"   =>  $request->description,
                "price"         =>  $request->price,
                "quantity"      =>  $request->quantity,
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            $filename  = $request->input("old_image");
            // echo $request->file("image")->isValid(); exit;
            if($request->file("image")->isValid()){
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $filename, 'public');
                    // echo "<pre>";
                    // print_r($path);
            }

            $update= Product::where("id", $request->input("edit_id"))->update([
                "image"         =>  $filename,
                "category_id"   =>  $request->category_id,
                "name"          =>  $request->name,
                "sku"           =>  $request->sku,
                "description"   =>  $request->description,
                "price"         =>  $request->price,
                "quantity"      =>  $request->quantity,
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteProduct($del_id){
        $delete  = Product::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

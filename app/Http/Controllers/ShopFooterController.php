<?php

namespace App\Http\Controllers;

use App\Models\ShopFooter;
use Illuminate\Http\Request;

class ShopFooterController extends Controller
{
    public function viewShopFooterDetails(Request $request){
        $main_title =   "Shop-Footer-Details";

        $title      =   "Shop Footer Details";

        $details    =   ShopFooter::all();

        return view('shop_footer.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addShopFooterDetails(){
        $main_title= "Shop-Footer-Details";

        $title =    "Shop Footer Details";

        return view('shop_footer.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            // 'cat_details'   =>  $cat_details
        ]);
    }

    public function editShopFooterDetails($edit_id, Request $request)
    {
        $main_title = "Edit-Shop-Footer-Details";

        $title =    "Edit Shop Footer Details";

        $details = ShopFooter::where("id", $edit_id)->first();

        return view('shop_footer.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
        ]);
    }

    public function saveShopFooterDetails(Request $request)
    {
        return $this->addUpdateShopFooterDetails($request);
    }

    public function addUpdateShopFooterDetails($request)
    {   
        ShopFooter::updateOrCreate(
            ['id' => 1],
            [
                'mini_desc'     => $request->input('mini_desc') ?? '',
                'c_name'        => $request->input('c_name') ?? '',
                'fb_url'        => $request->input('fb_url') ?? '',
                'insta_url'     => $request->input('insta_url') ?? '',
                'twitter_url'   => $request->input('twitter_url') ?? '',
                'linkedin_url'  => $request->input('linkedin_url') ?? '',
                'youtube_url'   => $request->input('youtube_url') ?? '',
                'contact'       => $request->input('contact') ?? '',
                'c_email'       => $request->input('c_email') ?? '',
            ]
        );

        return redirect()->back()->with("success", "Record has been successfully saved!!!");
    }

    public function deleteEmp($del_id, Request $request)
    {
        $delete  = Setting::where("id", $del_id)->delete();

        if ($delete) {
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        } else {
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}

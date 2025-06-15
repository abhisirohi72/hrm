<?php

namespace App\Http\Controllers;

use App\Models\ShopFooter;
use Illuminate\Http\Request;

class ShopFooterController extends Controller
{
    public function viewShopFooterDetails(Request $request){
        $main_title =   "Shop-Footer-Details";

        $title      =   "Shop Footer Details";

        $details    =   ShopFooter::first();

        return view('shop_footer.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addShopFooterDetails(){
        $main_title= "Shop-Footer-Details";

        $title =    "Shop Footer Details";

        return view('product.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            // 'cat_details'   =>  $cat_details
        ]);
    }
}

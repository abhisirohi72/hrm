<?php

namespace App\Http\Controllers;

use App\Models\CallToAction;
use Illuminate\Http\Request;
use App\Models\ContactUsHome;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\HomeAboutUs;
use App\Models\HomeCustomData;
use App\Models\HomeHeader;
use App\Models\Pricing;
use App\Models\Service;
use App\Models\Theme;
use App\Services\CommonService;

class HomeController extends Controller
{
    public function __construct(protected CommonService $commonService)
    {
        
    }
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $main_title= "Home";
        $selected_theme = Theme::where("is_selected", "1")->first();
        
        $home_header= $this->commonService->getSingleRow(HomeHeader::class, ['theme_id'=> $selected_theme->id, 'status'=>'1']);

        $custom_col_name = json_decode($home_header->custom_col_name, true);
        $custom_col_value = json_decode($home_header->custom_col_value, true);

        $home_custom_data = $this->commonService->getAllData(HomeCustomData::class, ['theme_id'=> $selected_theme->id, 'status'=>'1']);

        $home_about_us = $this->commonService->getAllData(HomeAboutUs::class, ['theme_id'=> $selected_theme->id, 'status'=>'1']);

        $home_service = $this->commonService->getAllData(Service::class, ['theme_id'=> $selected_theme->id, 'status'=>'1']);

        $call_to_action = $this->commonService->getAllData(CallToAction::class, ['theme_id'=> $selected_theme->id, 'status'=>'1']);

        $features = $this->commonService->getAllData(Feature::class, ['theme_id'=> $selected_theme->id, 'status'=>'1']);

        $pricing = $this->commonService->getAllData(Pricing::class, ['theme_id'=> $selected_theme->id, 'status'=>'1']);

        $faq = $this->commonService->getAllData(Faq::class, ['theme_id'=> $selected_theme->id, 'status'=>'1']);
        // echo "<pre>";
        // print_r($home_about_us);
        // exit;

        return view('home', [
            'main_title'        =>  $main_title,
            'home_header'       =>  $home_header,
            'custom_col_name'   =>  $custom_col_name,
            'custom_col_value'  =>  $custom_col_value,
            'home_custom_data'  =>  $home_custom_data,
            'home_about_us'     =>  $home_about_us,
            'home_service'      =>  $home_service,
            'call_to_action'    =>  $call_to_action,
            'features'          =>  $features,
            'pricing'           =>  $pricing,
            'faq'               =>  $faq,
        ]);
    }

    public function contactUs(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required',
            'message' => 'required|string|max:1000',
        ]);

        $insert = ContactUsHome::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject'=> $request->subject,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting us!',
            'data' => $insert,
            'msg' => 'OK'
        ]);
    }
}

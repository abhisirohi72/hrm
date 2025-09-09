<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallToAction;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\HomeAboutUs;
use App\Models\HomeCustomData;
use App\Models\HomeHeader;
use App\Models\Pricing;
use App\Models\Service;
use App\Models\Team;
use App\Models\Theme;
use App\Models\ThemeAboutUs;
use App\Models\ThemeContactUs;
use App\Models\ThemeFeaturePercentage;
use App\Models\ThemeOurFeature;
use App\Models\ThemeServiceCustomization;
use App\Models\ThemeTeamMember;
use App\Models\ThemeWhatWeDo;
use App\Models\ThemeWhyChooseUs;
use App\Services\CommonService;
use App\Services\SliderImageService;
use App\Services\ThemeService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function __construct(protected ThemeService $themeService, protected CommonService $commonService) {}

    public function addingTheme(Request $request, $edit_id=null){
        $main_title = "Adding Theme";

        $title= "Adding Theme";

        $details= Theme::all();
        $edit_details = "";
        if(!empty($edit_id)){
            $edit_details = Theme::where("id", $edit_id)->first();
        }
        // $usdt_details = AddUsdt::where("id", 1)->first();
        return view("admin.theme.create_theme.add",[
            "main_title"         =>  $main_title,
            "details"       =>  $details,
            "edit_details"  =>  $edit_details,
            "title" =>  $title,
        ]);
    }

    public function saveTheme(Request $request){
        
        $request->validate([
            "name"      =>  "required",
            "image"     =>  $request->edit_id ? "nullable|mimes:jpg,jpeg,png|max:2048":"required|mimes:jpg,jpeg,png|max:2048",
            "status"    => "required"
        ]);

        $theme  = $this->themeService->addOrUpdate($request);
        
        if($theme){
            return redirect()->back()->with("success", "Data has been saved!!!");
        }else {
            return redirect()->back()->with("error", "There is some issue in saving!!!");
        }
    }

    public function deleteTheme($del_id){
        if(empty($del_id)){
            return redirect()->back()->with("error", "Theme ID Is Required!!!");
        }

        $theme  = $this->themeService->deleteTheme($del_id);
        
        if($theme){
            return redirect()->back()->with("success", "Data has been deleted!!!");
        }else {
            return redirect()->back()->with("error", "There is some issue in deleted!!!");
        }   
    }

    public function selectTheme()
    {
        $main_title = "Theme Details";

        $title = "Select Theme";

        $details = $this->commonService->getAllData(Theme::class, ['is_deleted'=>"0"]);

        return view("admin.theme.select_theme.add", [
            "main_title"         =>  $main_title,
            "details"       =>  $details,
            "title"     =>  $title,
        ]);
    }

    public function saveSelectedTheme(Request $request)
    {
        $request->validate([
            'theme' =>  "required"
        ]);

        $update = $this->themeService->updateSelectedTheme($request);

        if ($update) {
            return back()->with("success", "Records has been updated, Please Logout Then Login To See Effect Changes...");
        } else {
            return back()->with("error", "There is some issue on updating...");
        }
    }

    public function homeHeaderCustomization(Request $request, $id=null){
        // echo $id; exit;
        $selected_theme = $this->themeService->getTheme();

        $main_title = "Home Header Customization";

        $title = "Header Customization";

        $details = $this->commonService->getAllData(HomeHeader::class, ['status'=>'1']);

        $edit_details= $this->commonService->getSingleRow(HomeHeader::class, ['id'=> $id]);

        return view("admin.theme.$selected_theme->theme_slug.home.header.add", [
            "main_title"        =>  $main_title,
            "title"             =>  $title,
            'selected_theme'    =>  $selected_theme,
            'details'           =>  $details ?? '',
            'edit_details'      =>  $edit_details ?? '',
        ]);
    }

    public function homeHeaderSaveFirstStep(Request $request){
        $request->validate([
            "bg_img"       =>  (empty($request->edit_id))
                                    ?"required|image|mimes:jpg,jpeg,png|max:2048"
                                    :"nullable|image|mimes:jpg,jpeg,png|max:2048",
            "title"  =>  "required",
            "desc"   =>  "required",
        ]);

        $insert= $this->themeService->savehomeFirstStep($request);

        if ($insert ?? '') {
            return redirect()->route('theme.home.services')->with("success", "Records has been saved...");
        } else {
            return back()->with("error", "There is some issue on saving...");
        }
    }

     public function deleteHomeHeader($del_id){
        $delete= $this->commonService->deleteData(HomeHeader::class, ['id'=>$del_id]);

        if ($delete) {
            return back()->with("success", "Records has been deleted...");
        } else {
            return back()->with("error", "There is some issue on deleting...");
        }
    }

    public function homeCustomData(Request $request, $id=null){
        // echo $id; exit;
        $selected_theme = $this->themeService->getTheme();

        $main_title = "Home Header Customization";

        $title = "Header Customization";

        $details = $this->commonService->getAllData(HomeCustomData::class, ['status'=>'1']);

        $edit_details= $this->commonService->getSingleRow(HomeCustomData::class, ['id'=> $id]);

        return view("admin.theme.$selected_theme->theme_slug.home.custom_data.add", [
            "main_title"        =>  $main_title,
            "title"             =>  $title,
            'selected_theme'    =>  $selected_theme,
            'details'           =>  $details ?? '',
            'edit_details'      =>  $edit_details ?? '',
        ]);
    }

    public function homeSaveSecStep(Request $request){
        $request->validate([
            "icon"  =>  "required",
            "title"  =>  "required",
            "desc"   =>  "required",
            "url"   =>  "required",
        ]);

        $insert= $this->themeService->savehomeSecStep($request);

        if ($insert ?? '') {
            return back()->with("success", "Records has been saved...");
        } else {
            return back()->with("error", "There is some issue on saving...");
        }
    }

     public function deleteCustomData($del_id){
        $delete= $this->commonService->deleteData(HomeCustomData::class, ['id'=>$del_id]);

        if ($delete) {
            return back()->with("success", "Records has been deleted...");
        } else {
            return back()->with("error", "There is some issue on deleting...");
        }
    }

    public function homeAboutUs(Request $request, $id=null){
        // echo $id; exit;
        $selected_theme = $this->themeService->getTheme();

        $main_title = "Home-About Us";

        $title = "About Us";

        $details = $this->commonService->getAllData(HomeAboutUs::class, ['status'=>'1']);

        $edit_details= $this->commonService->getSingleRow(HomeAboutUs::class, ['id'=> $id]);

        return view("admin.theme.$selected_theme->theme_slug.home.about_us.add", [
            "main_title"        =>  $main_title,
            "title"             =>  $title,
            'selected_theme'    =>  $selected_theme,
            'details'           =>  $details ?? '',
            'edit_details'      =>  $edit_details ?? '',
        ]);
    }

    public function homeSaveThirdStep(Request $request){
        $request->validate([
            "icon"  =>  "required",
            "title"  =>  "required",
            "desc"   =>  "required",
            "s_desc"   =>  "required",
            "status"   =>  "required",
            'video'     =>  (empty($request->edit_id))
                                ?'required'
                                :'nullable',
            'video_image'     =>  (empty($request->edit_id))
                                ?'required'
                                :'nullable',                    
        ]);

        $insert= $this->themeService->savehomeThirdStep($request);

        if ($insert ?? '') {
            return back()->with("success", "Records has been saved...");
        } else {
            return back()->with("error", "There is some issue on saving...");
        }
    }

     public function deleteAboutUs($del_id){
        $delete= $this->commonService->deleteData(HomeAboutUs::class, ['id'=>$del_id]);

        if ($delete) {
            return back()->with("success", "Records has been deleted...");
        } else {
            return back()->with("error", "There is some issue on deleting...");
        }
    }

    public function homeService(Request $request, $id=null){
        // echo $id; exit;
        $selected_theme = $this->themeService->getTheme();

        $main_title = "Home-Our Services";

        $title = "Our Services";

        $details = $this->commonService->getAllData(Service::class, ['status'=>'1']);

        $edit_details= $this->commonService->getSingleRow(Service::class, ['id'=> $id]);

        return view("admin.theme.$selected_theme->theme_slug.home.service.add", [
            "main_title"        =>  $main_title,
            "title"             =>  $title,
            'selected_theme'    =>  $selected_theme,
            'details'           =>  $details ?? '',
            'edit_details'      =>  $edit_details ?? '',
        ]);
    }

    public function homeSaveFourthStep(Request $request){
        $request->validate([
            "m_title"  =>  "required",
            "img"    =>  (empty($request->edit_id))
                            ?"required|image|mimes:jpg,jpeg,png|max:2048"
                            :"nullable|image|mimes:jpg,jpeg,png|max:2048",
            "title"  =>  "required",
            "desc"   =>  "required",
            "status"   =>  "required",
        ]);

        $insert= $this->themeService->savehomeFourthStep($request);

        if ($insert ?? '') {
            return back()->with("success", "Records has been saved...");
        } else {
            return back()->with("error", "There is some issue on saving...");
        }
    }

    public function deleteService($del_id){
        $delete= $this->commonService->deleteData(HomeAboutUs::class, ['id'=>$del_id]);

        if ($delete) {
            return back()->with("success", "Records has been deleted...");
        } else {
            return back()->with("error", "There is some issue on deleting...");
        }
    }

    public function homecallToAction(Request $request, $id=null){
        // echo $id; exit;
        $selected_theme = $this->themeService->getTheme();

        $main_title = "Home-Call To Action";

        $title = "Call To Action";

        $details = $this->commonService->getAllData(CallToAction::class, ['status'=>'1']);

        $edit_details= $this->commonService->getSingleRow(CallToAction::class, ['id'=> $id]);

        return view("admin.theme.$selected_theme->theme_slug.home.call_to_action.add", [
            "main_title"        =>  $main_title,
            "title"             =>  $title,
            'selected_theme'    =>  $selected_theme,
            'details'           =>  $details ?? '',
            'edit_details'      =>  $edit_details ?? '',
        ]);
    }

    public function homeSaveFifthStep(Request $request){
        $request->validate([
            "m_title"   =>  "required",
            "bg_img"    =>  (empty($request->edit_id))
                            ?"required|image|mimes:jpg,jpeg,png|max:2048"
                            :"nullable|image|mimes:jpg,jpeg,png|max:2048",
            "desc"      =>  "required",
            "url"       =>  "required",
            "status"    =>  "required",
        ]);

        $insert= $this->themeService->savehomeFifthStep($request);

        if ($insert ?? '') {
            return back()->with("success", "Records has been saved...");
        } else {
            return back()->with("error", "There is some issue on saving...");
        }
    }

    public function deleteCallToAction($del_id){
        $delete= $this->commonService->deleteData(CallToAction::class, ['id'=>$del_id]);

        if ($delete) {
            return back()->with("success", "Records has been deleted...");
        } else {
            return back()->with("error", "There is some issue on deleting...");
        }
    }

    public function homeFeatures(Request $request, $id=null){
        // echo $id; exit;
        $selected_theme = $this->themeService->getTheme();

        $main_title = "Home-Features";

        $title = "Features";

        $details = $this->commonService->getAllData(Feature::class, ['status'=>'1']);

        $edit_details= $this->commonService->getSingleRow(Feature::class, ['id'=> $id]);

        return view("admin.theme.$selected_theme->theme_slug.home.feature.add", [
            "main_title"        =>  $main_title,
            "title"             =>  $title,
            'selected_theme'    =>  $selected_theme,
            'details'           =>  $details ?? '',
            'edit_details'      =>  $edit_details ?? '',
        ]);
    }

    public function homeSaveSixthStep(Request $request){
        $request->validate([
            "m_title"   =>  "required",
            "image"     =>  (empty($request->edit_id))
                            ?"required|image|mimes:jpg,jpeg,png|max:2048"
                            :"nullable|image|mimes:jpg,jpeg,png|max:2048",
            "s_desc"    =>  "required",
            "title"     =>  "required",
            "desc"      =>  "required",
            "status"    =>  "required",
        ]);

        $insert= $this->themeService->savehomeSixthStep($request);

        if ($insert ?? '') {
            return back()->with("success", "Records has been saved...");
        } else {
            return back()->with("error", "There is some issue on saving...");
        }
    }

    public function deleteFeatures($del_id){
        $delete= $this->commonService->deleteData(Feature::class, ['id'=>$del_id]);

        if ($delete) {
            return back()->with("success", "Records has been deleted...");
        } else {
            return back()->with("error", "There is some issue on deleting...");
        }
    }

    public function homePricing(Request $request, $id=null){
        // echo $id; exit;
        $selected_theme = $this->themeService->getTheme();

        $main_title = "Home-Pricing";

        $title = "Pricing";

        $details = $this->commonService->getAllData(Pricing::class, ['status'=>'1']);

        $edit_details= $this->commonService->getSingleRow(Pricing::class, ['id'=> $id]);

        return view("admin.theme.$selected_theme->theme_slug.home.pricing.add", [
            "main_title"        =>  $main_title,
            "title"             =>  $title,
            'selected_theme'    =>  $selected_theme,
            'details'           =>  $details ?? '',
            'edit_details'      =>  $edit_details ?? '',
        ]);
    }

    public function homeSaveSeventhStep(Request $request){
        $request->validate([
            "m_title"   =>  "required",
            "s_desc"    =>  "required",
            "title"     =>  "required",
            "price"      =>  "required",
            "points"      =>  "required",
            "status"    =>  "required",
        ]);

        $insert= $this->themeService->savehomeSeventhStep($request);

        if ($insert ?? '') {
            return back()->with("success", "Records has been saved...");
        } else {
            return back()->with("error", "There is some issue on saving...");
        }
    }

    public function deletePricing($del_id){
        $delete= $this->commonService->deleteData(Feature::class, ['id'=>$del_id]);

        if ($delete) {
            return back()->with("success", "Records has been deleted...");
        } else {
            return back()->with("error", "There is some issue on deleting...");
        }
    }

    public function homeFrequentlyQst(Request $request, $id=null){
        // echo $id; exit;
        $selected_theme = $this->themeService->getTheme();

        $main_title = "Home-Frequently Question";

        $title = "Frequently Question";

        $details = $this->commonService->getAllData(Faq::class, ['status'=>'1']);

        $edit_details= $this->commonService->getSingleRow(Faq::class, ['id'=> $id]);

        return view("admin.theme.$selected_theme->theme_slug.home.faq.add", [
            "main_title"        =>  $main_title,
            "title"             =>  $title,
            'selected_theme'    =>  $selected_theme,
            'details'           =>  $details ?? '',
            'edit_details'      =>  $edit_details ?? '',
        ]);
    }

    public function homeSaveEighthStep(Request $request){
        $request->validate([
            "m_title"   =>  "required",
            "s_desc"    =>  "required",
            "qst"      =>  "required",
            "ans"      =>  "required",
            "status"    =>  "required",
        ]);

        $insert= $this->themeService->savehomeEighthStep($request);

        if ($insert ?? '') {
            return back()->with("success", "Records has been saved...");
        } else {
            return back()->with("error", "There is some issue on saving...");
        }
    }

    public function deleteFrequentlyQst($del_id){
        $delete= $this->commonService->deleteData(Faq::class, ['id'=>$del_id]);

        if ($delete) {
            return back()->with("success", "Records has been deleted...");
        } else {
            return back()->with("error", "There is some issue on deleting...");
        }
    }

    public function aboutTeamMember(Request $request, $id=null){
        $selected_theme = $this->themeService->getTheme();

        $main_title = "About - Team Member";

        $title = "Team Member";

        $details = $this->commonService->getAllData(Team::class, ['status'=>'1']);

        $edit_details= $this->commonService->getSingleRow(Team::class, ['id'=> $id]);

        return view("admin.theme.$selected_theme->theme_slug.about.team_member", [
            "main_title"        =>  $main_title,
            "title"             =>  $title,
            'selected_theme'    =>  $selected_theme,
            'details'           =>  $details ?? '',
            'edit_details'      =>  $edit_details ?? '',
        ]);
    }

    public function saveThemeTeamMember(Request $request){
        $request->validate([
            "title"         =>  "required",
            "desc"          =>  "required",
            "image"         =>  (empty($request->edit_id))
                                ?"required|image|mimes:jpg,jpeg,png|max:2048"
                                :"nullable|image|mimes:jpg,jpeg,png|max:2048",      
            "designation"   =>  "required",
            "s_desc"        =>  "required",
            "t_url"         =>  "required",
            "fb_url"        =>  "required",
            "insta_url"     =>  "required",
            "linkedin_url"  =>  "required",
            "status"        =>  "required",
        ]);

        $insert= $this->themeService->saveTeamMember($request);

        if ($insert ?? '') {
            return back()->with("success", "Records has been saved...");
        } else {
            return back()->with("error", "There is some issue on saving...");
        }
    }

    public function deleteTeamMember($del_id){
        $delete= $this->commonService->deleteData(Client::class, ['id'=>$del_id]);

        if ($delete) {
            return back()->with("success", "Records has been deleted...");
        } else {
            return back()->with("error", "There is some issue on deleting...");
        }
    }

    public function themeContact(Request $request, $id=null){
        $selected_theme = $this->themeService->getTheme();

        $main_title = "Theme - Contact Us";

        $title = "Contact Us";

        $details = $this->commonService->getAllData(ThemeContactUs::class, ['status'=>'1']);

        $edit_details= $this->commonService->getSingleRow(ThemeContactUs::class, ['id'=> $id]);

        return view("admin.theme.$selected_theme->theme_slug.home.contact_us.add", [
            "main_title"        =>  $main_title,
            "title"             =>  $title,
            'selected_theme'    =>  $selected_theme,
            'details'           =>  $details ?? '',
            'edit_details'      =>  $edit_details ?? '',
        ]);
    }

    public function saveContact(Request $request){
        $request->validate([
            "title"         =>  "required",
            "desc"          =>  "required",  
            "address"       =>  "required",
            "call_us"       =>  "required",
            "email_us"      =>  "required",
            "status"        =>  "required",
        ]);

        $insert= $this->themeService->saveContactUs($request);

        if ($insert ?? '') {
            return back()->with("success", "Records has been saved...");
        } else {
            return back()->with("error", "There is some issue on saving...");
        }
    }

    public function deleteContact($del_id){
        $delete= $this->commonService->deleteData(ThemeContactUs::class, ['id'=>$del_id]);

        if ($delete) {
            return back()->with("success", "Records has been deleted...");
        } else {
            return back()->with("error", "There is some issue on deleting...");
        }
    }
}

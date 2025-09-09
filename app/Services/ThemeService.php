<?php

namespace App\Services;

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
use App\Models\ThemeService as ModelsThemeService;
use App\Models\ThemeServiceCustomization;
use App\Models\ThemeTeamMember;
use App\Models\ThemeWhatWeDo;
use App\Models\ThemeWhyChooseUs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Request;

class ThemeService
{
    public function __construct(protected CommonService $commonService)
    {
        
    }
    public function addOrUpdate($request)
    {
        $directory = "themes";
        Storage::disk('public')->makeDirectory($directory);

        $image_name = null;

        if ($request->hasFile("image") && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $image_name = "image_" . time() . "." . $file->extension();
            $image_path = $file->storeAs($directory, $image_name, 'public');
        }

        if (empty($request->edit_id)) {
            $theme = Theme::create([
                "name"  =>  $request->name,
                "theme_slug"    =>  Str::slug($request->name),
                "image"  =>  $image_name,
                "url"  =>  $request->url,
                "status"  =>  $request->status,
                'is_deleted'=>"0",
            ]);
            return $theme;
        } else {
            $img_name = (empty($image_name)) ? $request->edit_image : $image_name;
            $theme = Theme::where("id", $request->edit_id)->update([
                "name"  =>  $request->name,
                "theme_slug"    =>  Str::slug($request->name),
                "image"  =>  $img_name,
                "url"  =>  $request->url,
                "status"  =>  $request->status,
            ]);
            return $theme;
        }

        return null;
    }

    public function deleteTheme($del_id)
    {
        $theme = Theme::where("id", $del_id)->delete();
        return $theme;
    }

    public function updateSelectedTheme($request)
    {
        //firstly remove all selected
        Theme::query()->update([
            "is_selected"   =>  0
        ]);
        $update = Theme::where("id", $request->theme)->update([
            "is_selected"   =>  1
        ]);

        return $update;
    }

    public function getTheme()
    {
        $get_theme = Theme::where("is_selected", 1)->first();
        return $get_theme;
    }

    public function savehomeFirstStep($request){
        $directory = "themes/home/header";
        Storage::disk('public')->makeDirectory($directory);

        // Handle file upload
        $image_name = "";
        if ($request->hasFile("bg_img") && $request->file('bg_img')->isValid()) {
            $file = $request->file('bg_img');
            $image_name = "image_" . time() . "." . $file->extension();
            $file->storeAs($directory, $image_name, 'public');
        }

        // If updating, get old data (only needed if image is optional during edit)
        $old_image = null;
        if (!empty($request->edit_id)) {
            $old_image = HomeHeader::where("id", $request->edit_id)->value('bg_img');
        }

        // Prepare data
        $data = [
            "theme_id"          => $request->theme_id,
            "bg_img"            => $image_name ?: $old_image, // use old image if no new upload
            "title"             => $request->title,
            "desc"              => $request->desc,
            'custom_col_name'   => json_encode($request->col_name),
            'custom_col_value'  => json_encode($request->col_value),
            'status'            => $request->status,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        return $this->commonService->updateOrInsert(HomeHeader::class, ['id'=>$request->edit_id ?? 0], $data);
    }

    public function savehomeSecStep($request){
        // Prepare data
        // echo "<pre>";
        // print_r($request->all());
        foreach($request->icon as $key=>$details){
            $data = [
                "theme_id"          => $request->theme_id,
                "icon"             => $details,
                "title"             => $request->title[$key],
                "desc"              => $request->desc[$key],
                "url"              => $request->url[$key],
                'status'            => $request->status[$key],
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ];
            $this->commonService->updateOrInsert(HomeCustomData::class, ['id'=>$request->edit_id ?? 0], $data);
        }
        return true;
    }

    public function savehomeThirdStep($request){
        // Prepare data
        // echo "<pre>";
        // print_r($request->all());
        $directory = "themes/about_us";
        Storage::disk('public')->makeDirectory($directory);

        // Handle file upload
        $video_name = "";
        if ($request->hasFile("video") && $request->file('video')->isValid()) {
            $file = $request->file('video');
            $video_name = "video_" . time() . "." . $file->extension();
            $file->storeAs($directory, $video_name, 'public');
        }

        // If updating, get old data (only needed if image is optional during edit)
        $old_video = null;
        if (!empty($request->edit_id)) {
            $old_video = HomeAboutUs::where("id", $request->edit_id)->value('video');
        }

        $video_image = "";
        if ($request->hasFile("video_image") && $request->file('video_image')->isValid()) {
            $file = $request->file('video_image');
            $video_image = "image_" . time() . "." . $file->extension();
            $file->storeAs($directory, $video_image, 'public');
        }

        // If updating, get old data (only needed if image is optional during edit)
        $old_video_image = null;
        if (!empty($request->edit_id)) {
            $old_video_image = HomeAboutUs::where("id", $request->edit_id)->value('video_image');
        }
        // echo "video_name=".$video_name;
        // echo "<br>video_image=".$video_image;
        // exit;
        foreach($request->icon as $key=>$details){
            $data = [
                "theme_id"      => $request->theme_id,
                'desc'          => $request->desc,
                "icon"          => $details,
                "video"         => $video_name ?: $old_video, // use old image if no new upload
                "video_image"   => $video_image ?: $old_video_image, // use old image if no new upload
                "title"         => $request->title[$key],
                "s_desc"        => $request->s_desc[$key],
                'status'        => $request->status,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ];
            $this->commonService->updateOrInsert(HomeAboutUs::class, ['id'=>$request->edit_id ?? 0], $data);
        }

        return true;
    }

    public function savehomeFourthStep($request){
        $directory = "themes/service";
        Storage::disk('public')->makeDirectory($directory);

        // Handle file upload
        $image_name = "";
        if ($request->hasFile("img") && $request->file('img')->isValid()) {
            $file = $request->file('img');
            $image_name = "image_" . time() . "." . $file->extension();
            $file->storeAs($directory, $image_name, 'public');
        }

        // If updating, get old data (only needed if image is optional during edit)
        $old_image = null;
        if (!empty($request->edit_id)) {
            $old_image = Service::where("id", $request->edit_id)->value('image');
        }

        // Prepare data
        $data = [
            "theme_id"          => $request->theme_id,
            "m_title"          => $request->m_title,
            "image"            => $image_name ?: $old_image, // use old image if no new upload
            "title"             => $request->title,
            "desc"              => $request->desc,
            'status'            => $request->status,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        return $this->commonService->updateOrInsert(Service::class, ['id'=>$request->edit_id ?? 0], $data);
    }

    public function savehomeFifthStep($request){
        $directory = "themes/call_to_action";
        Storage::disk('public')->makeDirectory($directory);

        // Handle file upload
        $image_name = "";
        if ($request->hasFile("bg_img") && $request->file('bg_img')->isValid()) {
            $file = $request->file('bg_img');
            $image_name = "image_" . time() . "." . $file->extension();
            $file->storeAs($directory, $image_name, 'public');
        }

        // If updating, get old data (only needed if image is optional during edit)
        $old_image = null;
        if (!empty($request->edit_id)) {
            $old_image = CallToAction::where("id", $request->edit_id)->value('bg_img');
        }

        // Prepare data
        $data = [
            "theme_id"          => $request->theme_id,
            "main_title"          => $request->m_title,
            "bg_img"            => $image_name ?: $old_image, // use old image if no new upload
            "desc"              => $request->desc,
            "url"             => $request->url,
            'status'            => $request->status,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        return $this->commonService->updateOrInsert(CallToAction::class, ['id'=>$request->edit_id ?? 0], $data);
    }

    public function savehomeSixthStep($request){
        $directory = "themes/feature";
        Storage::disk('public')->makeDirectory($directory);

        // Handle file upload
        $image_name = "";
        if ($request->hasFile("image") && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $image_name = "image_" . time() . "." . $file->extension();
            $file->storeAs($directory, $image_name, 'public');
        }

        // If updating, get old data (only needed if image is optional during edit)
        $old_image = null;
        if (!empty($request->edit_id)) {
            $old_image = Feature::where("id", $request->edit_id)->value('image');
        }

        // Prepare data
        $data = [
            "theme_id"          => $request->theme_id,
            "m_title"          => $request->m_title,
            "s_desc"              => $request->s_desc,
            "image"            => $image_name ?: $old_image, // use old image if no new upload
            "desc"              => $request->desc,
            "title"             => $request->title,
            'status'            => $request->status,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        return $this->commonService->updateOrInsert(Feature::class, ['id'=>$request->edit_id ?? 0], $data);
    }

    public function savehomeSeventhStep($request){
        // Prepare data
        $data = [
            "theme_id"          => $request->theme_id,
            "m_title"           => $request->m_title,
            "s_desc"            => $request->s_desc,
            "title"             => $request->title,
            "price"             => $request->price,
            "points"            => json_encode($request->points),
            'status'            => $request->status,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        return $this->commonService->updateOrInsert(Pricing::class, ['id'=>$request->edit_id ?? 0], $data);
    }

    public function savehomeEighthStep($request){
        // Prepare data
        $data = [
            "theme_id"          => $request->theme_id,
            "m_title"           => $request->m_title,
            "s_desc"            => $request->s_desc,
            "qst"               => $request->qst,
            "ans"               => $request->ans,
            'status'            => $request->status,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        return $this->commonService->updateOrInsert(Faq::class, ['id'=>$request->edit_id ?? 0], $data);
    }

    public function saveTeamMember($request){
        $directory = "themes/teams";
        Storage::disk('public')->makeDirectory($directory);

        // Handle file upload
        $image_name = "";
        if ($request->hasFile("image") && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $image_name = "image_" . time() . "." . $file->extension();
            $file->storeAs($directory, $image_name, 'public');
        }

        // If updating, get old data (only needed if image is optional during edit)
        $old_image = null;
        if (!empty($request->edit_id)) {
            $old_image = Team::where("id", $request->edit_id)->value('image');
        }
        
        // Prepare data
        $data = [
            "theme_id"          => $request->theme_id,
            "title"             => $request->title,
            "desc"              => $request->desc,
            "image"             => $image_name ?: $old_image, // use old image if no new upload
            "name"              => $request->name,
            "designation"       => $request->designation,
            "s_desc"            => $request->s_desc,
            "t_url"             => $request->t_url,
            "fb_url"            => $request->fb_url,
            "insta_url"         => $request->insta_url,
            "linkedin_url"      => $request->linkedin_url,
            'status'            => $request->status,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        return $this->commonService->updateOrInsert(Team::class, ['id'=>$request->edit_id ?? 0], $data);
    }

    public function saveContactUs($request){
        // Prepare data
        $data = [
            "theme_id"          => $request->theme_id,
            "title"             => $request->title,
            "desc"              => $request->desc,
            "address"           => $request->address,
            "call_us"           => $request->call_us,
            "email_us"          => $request->email_us,
            'status'            => $request->status,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        return $this->commonService->updateOrInsert(ThemeContactUs::class, ['id'=>$request->edit_id ?? 0], $data);
    }
}

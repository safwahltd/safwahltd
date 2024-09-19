<?php

namespace App\Http\Controllers;

use App\Models\WebsiteCMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsiteCMSController extends Controller
{
    public function index(){
        $cms = WebsiteCMS::first();
        return view('admin.settings.cms',compact('cms'));
    }
    public function update(Request $request){
        $name = $request->name;
        try {
            $feature = WebsiteCMS::first();

//             dd($feature[$name]);
            if ($feature[$name] == 1){
                $feature[$name] = 0;
            }
            else{
                $feature[$name] = 1;
            }

            $feature->save();
            toastr()->success('Update Success.');
            return response()->json(['success' => true, 'message' => 'Setting updated successfully.']);
        }
        catch (\Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function updateValue(Request $request){
        try {
            $cms = WebsiteCMS::first();
            $cms->website_title = $request->website_title;
            $cms->top_bar_bg_color = $request->top_bar_bg_color;
            $cms->top_bar_text_color = $request->top_bar_text_color;
            $cms->header_bg_color = $request->header_bg_color;
            $cms->home_section_bg_color = $request->home_section_bg_color;
            $cms->footer_section_bg_color = $request->footer_section_bg_color;
            $cms->contact_form_color = $request->contact_form_color;
            $cms->bulk_order_form_color = $request->bulk_order_form_color;
            $cms->wholesaler_form_color = $request->wholesaler_form_color;
            if ($request->file('loading_image')){
                $loading_image = $request->file('loading_image');
                $loading_imageName = $loading_image->getClientOriginalName();
                $directory = 'upload/loading_image/';
                $loading_image->move($directory,$loading_imageName);
                $loading_imageUrl = $directory.$loading_imageName;
                $cms->loading_image = $loading_imageUrl;
            }
            $cms->save();
            toastr()->success('Update Successfully.');
            return back();
        }
        catch (\Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }

}

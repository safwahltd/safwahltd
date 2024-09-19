<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('serial','asc')->paginate(20);
        return view('admin.slider.index',compact('sliders'));
    }
    public function store(Request $request){
        try {
            $validate = Validator::make($request->all(),[
                "title"         => "required",
                "banner"         => [
                    'image',
                    'mimes:jpg,png,jpeg,gif,svg,webp',
                    'dimensions:min_width=1920,min_height=1080,max_width=1920,max_height=1080'
                ],
            ]);

            if($validate->fails()){
                toastr()->error($validate->messages());
                return redirect()->back();
            }
            $slider = new Slider();
            $slider->title = $request->title;
            $slider->slogan = $request->slogan;
            $slider->description = $request->description;
            if ($request->file('banner')){
                $banner = $request->file('banner');
                $bannerName = $banner->getClientOriginalName();
                $directory = 'upload/slider/';
                $banner->move($directory , $bannerName);
                $bannerUrl = $directory.$bannerName;
                $slider->banner = $bannerUrl;
            }
            if ($request->serial){
                $sliderCount = Slider::count();
                $sliderSerial = Slider::where('serial',$request->serial)->first();
                if ($sliderSerial){
                    $sliderSerial->serial = $sliderCount + 1;
                    $sliderSerial->save();
                    $slider->serial = $request->serial;
                }
                else{
                    $slider->serial = $sliderCount + 1;
                }
            }
            else{
                $sliderCount = Slider::count();
                $slider->serial = $sliderCount + 1;
            }
            $slider->url = $request->url;
            $slider->status = $request->status;
            $slider->save();
            toastr()->success('Create Success.');
            return back();
        }
        catch (Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function update(Request $request,$id){
        try {
            $validate = Validator::make($request->all(),[
                "title"         => "required",
                "banner"         => [
                    'image',
                    'mimes:jpg,png,jpeg,gif,svg,webp',
                    'dimensions:min_width=1920,min_height=1080,max_width=1920,max_height=1080'
                ],
            ]);

            if($validate->fails()){
                toastr()->error($validate->messages());
                return redirect()->back();
            }
            $slider = Slider::find($id);
            $slider->title = $request->title;
            $slider->slogan = $request->slogan;
            $slider->description = $request->description;
            if ($request->file('banner')){
                if (file_exists($slider->banner))
                {
                    unlink($slider->banner);
                }
                $banner = $request->file('banner');
                $bannerName = $banner->getClientOriginalName();
                $directory = 'upload/slider/';
                $banner->move($directory , $bannerName);
                $bannerUrl = $directory.$bannerName;
                $slider->banner = $bannerUrl;
            }
            if ($request->serial == $slider->serial){
                $slider->serial = $request->serial;
            }
            else{
                $sliderSerial = Slider::where('serial',$request->serial)->first();
                if ($sliderSerial){
                    $sliderSerial->serial = $slider->serial;
                    $sliderSerial->save();
                    $slider->serial = $request->serial;
                }
                else{
                    $slider->serial = $request->serial;
                }
            }
            $slider->url = $request->url;
            $slider->status = $request->status;
            $slider->save();
            toastr()->success('Update Success.');
            return back();
        }
        catch (Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function destroy($id){
        try {
            $slider = Slider::find($id);
            if (file_exists($slider->banner))
            {
                unlink($slider->banner);
            }
            $slider->delete();
            toastr()->success('Delete Success.');
            return back();
        }
        catch (Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
}

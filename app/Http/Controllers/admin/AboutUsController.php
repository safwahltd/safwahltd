<?php

namespace App\Http\Controllers\admin;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;

class AboutUsController extends Controller
{
    public function index(){
        return view('admin.settings.about-us',[
            'about'=>AboutUs::first(),
        ]);
    }
    public function update(Request $request,$id){
        if(auth()->user()->hasPermission('admin about update')){
            try {
                $validate = Validator::make($request->all(),[
                    "title"         => "required",
                    "image_1"         => [
                        'image',
                        'mimes:jpg,png,jpeg,gif,svg,webp',
                        'dimensions:min_width=500,min_height=450,max_width=500,max_height=450'
                    ],
                    "image_2"         => [
                        'image',
                        'mimes:jpg,png,jpeg,gif,svg,webp',
                        'dimensions:min_width=500,min_height=450,max_width=500,max_height=450'
                    ],

                ]);

                if($validate->fails()){
                    toastr()->error($validate->messages());
                    return redirect()->back();
                }
                $about = AboutUs::find($id);
                $about->title = $request->title;
                $about->description = $request->description;
                if ($request->file('image_1')){
                    if (file_exists($about->image_1))
                    {
                        unlink($about->image_1);
                    }
                    $imageOne = $request->file('image_1');
                    $imageOneName = $imageOne->getClientOriginalName();
                    $directory = 'upload/about/';
                    $imageOne->move($directory , $imageOneName);
                    $imageOneUrl = $directory.$imageOneName;
                    $about->image_1 = $imageOneUrl;
                }
                if ($request->file('image_2')){
                    if (file_exists($about->image_2))
                    {
                        unlink($about->image_2);
                    }
                    $imageTwo = $request->file('image_2');
                    $imageTwoName = $imageTwo->getClientOriginalName();
                    $directory = 'upload/about/';
                    $imageTwo->move($directory , $imageTwoName);
                    $imageTwoUrl = $directory.$imageTwoName;
                    $about->image_2 = $imageTwoUrl;
                }
                $about->status = $request->status;
                $about->save();
                toastr()->success('Update Success.');
                return back();
            }
            catch (Exception $e){
                toastr()->error($e->getMessage());
                return back();
            }
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }

    }
}

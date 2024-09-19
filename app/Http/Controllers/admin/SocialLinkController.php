<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Validation\Rule;

class SocialLinkController extends Controller
{
    public function index(){
        $socialLinks = SocialLink::orderBy('serial','asc')->paginate(20);
        return view('admin.social-link.index',compact('socialLinks'));
    }
    public function store(Request $request){
        try {
            $validate = Validator::make($request->all(),[
                "name"         => "required",
            ]);

            if($validate->fails()){
                toastr()->error($validate->messages());
                return redirect()->back();
            }
            $social = new SocialLink();
            $social->name = $request->name;
            if ($request->file('icon')){
                $icon = $request->file('icon');
                $iconName = $icon->getClientOriginalName();
                $directory = 'upload/social-link/';
                $icon->move($directory , $iconName);
                $iconUrl = $directory.$iconName;
                $social->icon = $iconUrl;
            }
            if ($request->serial){
                $shopCount = SocialLink::count();
                $shopSerial = SocialLink::where('serial',$request->serial)->first();
                if ($shopSerial){
                    $shopSerial->serial = $shopCount + 1;
                    $shopSerial->save();
                    $social->serial = $request->serial;
                }
                else{
                    $social->serial = $shopCount + 1;
                }
            }
            else{
                $shopCount = SocialLink::count();
                $social->serial = $shopCount + 1;
            }
            $social->url = $request->url;
            $social->status = $request->status;
            $social->save();
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
                "name"         => [
                    "required",
                    Rule::unique('social_links','name')->ignore($id)
                ],
            ]);

            if($validate->fails()){
                toastr()->error($validate->messages());
                return redirect()->back();
            }
            $social = SocialLink::find($id);
            $social->name = $request->name;
            if ($request->file('icon')){
                if (file_exists($social->icon))
                {
                    unlink($social->icon);
                }
                $icon = $request->file('icon');
                $iconName = $icon->getClientOriginalName();
                $directory = 'upload/social-link/';
                $icon->move($directory , $iconName);
                $iconUrl = $directory.$iconName;
                $social->icon = $iconUrl;
            }
            if ($request->serial == $social->serial){
                $social->serial = $request->serial;
            }
            else{
                $socialSerial = SocialLink::where('serial',$request->serial)->first();
                if ($socialSerial){
                    $socialSerial->serial = $social->serial;
                    $socialSerial->save();
                    $social->serial = $request->serial;
                }
                else{
                    $social->serial = $request->serial;
                }
            }
            $social->url = $request->url;
            $social->status = $request->status;
            $social->save();
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
            $social = SocialLink::find($id);
            if (file_exists($social->banner))
            {
                unlink($social->banner);
            }
            $social->delete();
            toastr()->success('Delete Success.');
            return back();
        }
        catch (Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
}

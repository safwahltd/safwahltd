<?php

namespace App\Http\Controllers\admin;

use App\Models\Topbar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;

class TopbarController extends Controller
{
    public function index(){
        $topbars = Topbar::orderBy('serial','asc')->paginate(20);
        return view('admin.top-bar.index',compact('topbars'));
    }
    public function store(Request $request){
        try {
            $validate = Validator::make($request->all(),[
                "title"         => "required",
            ]);

            if($validate->fails()){
                toastr()->error($validate->messages());
                return redirect()->back();
            }
            $social = new Topbar();
            $social->title = $request->title;
            if ($request->serial){
                $shopCount = Topbar::count();
                $shopSerial = Topbar::where('serial',$request->serial)->first();
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
                $shopCount = Topbar::count();
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
                "title"         => "required",
            ]);

            if($validate->fails()){
                toastr()->error($validate->messages());
                return redirect()->back();
            }
            $social = Topbar::find($id);
            $social->title = $request->title;
            if ($request->serial == $social->serial){
                $social->serial = $request->serial;
            }
            else{
                $socialSerial = Topbar::where('serial',$request->serial)->first();
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
            $social = Topbar::find($id);
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

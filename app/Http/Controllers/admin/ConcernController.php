<?php

namespace App\Http\Controllers\admin;

use App\Models\Concern;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;

class ConcernController extends Controller
{
    public function index(){
        if(auth()->user()->hasPermission('admin concern index')){
            $concerns = Concern::orderBy('serial','ASC')->paginate(20);
            return view('admin.concern.index',compact('concerns'));
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }
    }
    public function store(Request $request){
        if(auth()->user()->hasPermission('admin concern store')){
            try{
                $validate = Validator::make($request->all(),[
                    'name' => 'required',
                ]);
                if($validate->fails()){
                    toastr()->error($validate->messages());
                    return back();
                }
                $concern = new Concern();
                $concern->name = $request->name;
                if ($request->file('banner')){
                    $banner = $request->file('banner');
                    $bannerName = $banner->getClientOriginalName();
                    $directory = 'upload/concern/';
                    $banner->move($directory,$bannerName);
                    $bannerUrl = $directory.$bannerName;
                    $concern->banner = $bannerUrl;
                }
                if ($request->serial){
                    $concernCount = Concern::count();
                    $concernSerial = Concern::where('serial',$request->serial)->first();
                    if ($concernSerial){
                        $concernSerial->serial = $concernCount + 1;
                        $concernSerial->save();
                        $concern->serial = $request->serial;
                    }
                    else{
                        $concern->serial = $concernCount + 1;
                    }
                }
                else{
                    $concernCount = Concern::count();
                    $concern->serial = $concernCount + 1;
                }
                $concern->url = $request->url;
                $concern->status = $request->status;
                $concern->save();
                toastr()->success('Concern Create Successfully.');
                return back();
            }
            catch(Exception $e){
                toastr()->error($e->getMessage());
                return back();
            }
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }
    }
    public function update(Request $request,$id){
        if(auth()->user()->hasPermission('admin concern update')){
            try{
                $validate = Validator::make($request->all(),[
                    'name' => 'required',
                ]);
                if($validate->fails()){
                    toastr()->error($validate->messages());
                    return back();
                }
                $concern = Concern::find($id);
                $concern->name = $request->name;
                if ($request->file('banner')){
                    if (file_exists($concern->banner)){
                        unlink($concern->banner);
                    }
                    $banner = $request->file('banner');
                    $bannerName = $banner->getClientOriginalName();
                    $directory = 'upload/core-value/';
                    $banner->move($directory,$bannerName);
                    $bannerUrl = $directory.$bannerName;
                    $concern->banner = $bannerUrl;
                }
                if ($request->serial == $concern->serial){
                    $concern->serial = $request->serial;
                }
                else{
                    $concernCount = Concern::count();
                    $concernSerial = Concern::where('serial',$request->serial)->first();
                    if ($concernSerial){
                        $concernSerial->serial = $concern->serial;
                        $concernSerial->save();
                        $concern->serial = $request->serial;
                    }
                    else{
                        $concern->serial = $request->serial;
                    }
                }
                $concern->url = $request->url;
                $concern->status = $request->status;
                $concern->save();
                toastr()->success('Concern Update Successfully.');
                return back();
            }
            catch(Exception $e){
                toastr()->error($e->getMessage());
                return back();
            }
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }
    }
    public function destroy($id){
        if(auth()->user()->hasPermission('admin concern destroy')){
            try{
                $concern = Concern::find($id);
                if (file_exists($concern->banner)){
                    unlink($concern->banner);
                }
                $concern->delete();
                toastr()->success('Concern Delete Successfully.');
                return back();
            }
            catch(Exception $e){
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

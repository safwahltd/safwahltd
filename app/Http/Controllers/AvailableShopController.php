<?php

namespace App\Http\Controllers;

use App\Models\AvailableShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class AvailableShopController extends Controller
{
    public function index(){
        return view('');
    }
    public function store(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                'name' => 'required',
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $shop = new AvailableShop();
            $shop->name = $request->name;
            if ($request->file('banner')){
                $banner = $request->file('banner');
                $bannerName = $banner->getClientOriginalName();
                $directory = 'upload/shop/';
                $banner->move($directory,$bannerName);
                $bannerUrl = $directory.$bannerName;
                $shop->banner = $bannerUrl;
            }
            if ($request->serial){
                $shopCount = AvailableShop::count();
                $shopSerial = AvailableShop::where('serial',$request->serial)->first();
                if ($shopSerial){
                    $shopSerial->serial = $shopCount + 1;
                    $shopSerial->save();
                    $shop->serial = $request->serial;
                }
                else{
                    $shop->serial = $shopCount + 1;
                }
            }
            else{
                $shopCount = AvailableShop::count();
                $shop->serial = $shopCount + 1;
            }
            $shop->url = $request->url;
            $shop->status = $request->status;
            $shop->save();
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function update(Request $request,$id){
        try{
            $validate = Validator::make($request->all(),[
                's' => 'required',
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $shop = AvailableShop::find($id);
            $shop->name = $request->name;
            if ($request->file('banner')){
                if (file_exists($shop->banner)){
                    unlink($shop->banner);
                }
                $banner = $request->file('banner');
                $bannerName = $banner->getClientOriginalName();
                $directory = 'upload/core-value/';
                $banner->move($directory,$bannerName);
                $bannerUrl = $directory.$bannerName;
                $shop->banner = $bannerUrl;
            }
            if ($request->serial == $shop->serial){
                $shop->serial = $request->serial;
            }
            else{
                $shopCount = AvailableShop::count();
                $shopSerial = AvailableShop::where('serial',$request->serial)->first();
                if ($shopSerial){
                    $shopSerial->serial = $shop->serial;
                    $shopSerial->save();
                    $shop->serial = $request->serial;
                }
                else{
                    $shop->serial = $request->serial;
                }
            }
            $shop->url = $request->url;
            $shop->status = $request->status;
            $shop->save();
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function destroy($id){
        try{
            $d = AvailableShop::find($id);
            $d->delete();
            toastr()->success('Delete Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }

    }
}

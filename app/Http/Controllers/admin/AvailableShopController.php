<?php

namespace App\Http\Controllers\admin;

use App\Models\AvailableShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Controllers\Controller;

class AvailableShopController extends Controller
{
    public function index(){
        try {
//            if(auth()->user()->hasPermission('admin shop index')){
            $shops = AvailableShop::orderBy('serial','ASC')->paginate(20);
            return view('admin.shop.index',compact('shops'));
//        }
//        else{
//            toastr()->error('You Have No Permission.');
//            return back();
//        }
        }
        catch (Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }

    }
    public function store(Request $request){

        try{
                if(auth()->user()->hasPermission('admin shop store')){
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
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function update(Request $request,$id){
        try{
            if(auth()->user()->hasPermission('admin shop update')){
                $validate = Validator::make($request->all(),[
                    'name' => 'required',
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
                    $directory = 'upload/shop/';
                    $banner->move($directory,$bannerName);
                    $bannerUrl = $directory.$bannerName;
                    $shop->banner = $bannerUrl;
                }
                if ($request->serial == $shop->serial){
                    $shop->serial = $request->serial;
                }
                else{
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
                toastr()->success('Shop Create Success.');
                return back();
            }
            else{
                toastr()->error('You Have No Permission.');
                return back();
            }
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function destroy($id){

            try{
                if(auth()->user()->hasPermission('admin shop destroy')){
                $shop = AvailableShop::find($id);
                $shop->delete();
                toastr()->success('Delete Successfully.');
                return back();
                }
                else{
                    toastr()->error('You Have No Permission.');
                    return back();
                }
            }
            catch(Exception $e){
                toastr()->error($e->getMessage());
                return back();
            }


    }
}

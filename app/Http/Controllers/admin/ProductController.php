<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('serial','ASC')->paginate(20);
        return view('admin.product.index',compact('products'));
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
            $product = new Product();
            $product->name = $request->name;
            if ($request->file('banner')){
                $banner = $request->file('banner');
                $bannerName = $banner->getClientOriginalName();
                $directory = 'upload/product/banner/';
                $banner->move($directory,$bannerName);
                $bannerUrl = $directory.$bannerName;
                $product->banner = $bannerUrl;
            }
            if ($request->file('icon')){
                $icon = $request->file('icon');
                $iconName = $icon->getClientOriginalName();
                $directory = 'upload/product/icon/';
                $icon->move($directory,$iconName);
                $iconUrl = $directory.$iconName;
                $product->icon = $iconUrl;
            }

            if ($request->serial){
                $productCount = Product::count();
                $productSerial = Product::where('serial',$request->serial)->first();
                if ($productSerial){
                    $productSerial->serial = $productCount + 1;
                    $productSerial->save();
                    $product->serial = $request->serial;
                }
                else{
                    $product->serial = $productCount + 1;
                }
            }
            else{
                $productCount = Product::count();
                $product->serial = $productCount + 1;
            }

            $product->url = $request->url;
            $product->status = $request->status;
            $product->save();
            toastr()->success('product Create Successfully.');
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
                'name' => 'required',
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $product = Product::find($id);
            $product->name = $request->name;
            if ($request->file('banner')){
                if (file_exists($product->banner)){
                    unlink($product->banner);
                }
                $banner = $request->file('banner');
                $bannerName = $banner->getClientOriginalName();
                $directory = 'upload/product/banner/';
                $banner->move($directory,$bannerName);
                $bannerUrl = $directory.$bannerName;
                $product->banner = $bannerUrl;
            }
            if ($request->file('icon')){
                if (file_exists($product->icon)){
                    unlink($product->icon);
                }
                $icon = $request->file('icon');
                $iconName = $icon->getClientOriginalName();
                $directory = 'upload/product/icon/';
                $icon->move($directory,$iconName);
                $iconUrl = $directory.$iconName;
                $product->icon = $iconUrl;
            }

            if ($request->serial == $product->serial){
                $product->serial = $request->serial;
            }
            else{
                $productCount = Product::count();
                $productSerial = Product::where('serial',$request->serial)->first();
                if ($productSerial){
                    $productSerial->serial = $product->serial;
                    $productSerial->save();
                    $product->serial = $request->serial;
                }
                else{
                    $product->serial = $request->serial;
                }
            }
            $product->url = $request->url;
            $product->status = $request->status;
            $product->save();
            toastr()->success('product Update Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function destroy($id){
        try{
            $product = Product::find($id);
            if (file_exists($product->banner)){
                unlink($product->banner);
            }
            if (file_exists($product->icon)){
                unlink($product->icon);
            }

            $product->delete();
            toastr()->success('product Delete Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }

    }
}

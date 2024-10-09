<?php

namespace App\Http\Controllers\admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;
use function League\Flysystem\move;

class GalleryController extends Controller
{
    public function gallery(){
        $images = Gallery::latest()->get();
        return view('website.gallery.index',compact('images'));
    }
    public function index(){
        $images = Gallery::latest()->get();
        return view('admin.gallery.index',compact('images'));
    }
    public function store(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                'images.*' => 'mimes:jpeg,png,jpg,gif,svg,webp',
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {
                    $fileName = time() . '-' . $file->getClientOriginalName();
                    $directory = 'upload/gallery/';
                    $file->move($directory,$fileName);
                    $fileUrl = $directory.$fileName;
                    $gallery = new Gallery();
                    $gallery->user_id = auth()->user()->id;
                    $gallery->title = $file->getClientOriginalName();
                    $imageDetails = getimagesize($fileUrl);
                    $gallery->image = $fileUrl;
                    $gallery->size = filesize($fileUrl);
                    $gallery->resolution = "$imageDetails[0] x $imageDetails[1]";
                    $gallery->alt = $file->getClientOriginalName();
                    $gallery->caption = $request->caption;
                    $gallery->status = $request->status;
                    $gallery->save();
                }
            }
            toastr()->success('Image Upload Successfully.');
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
                'image' => 'mimes:jpeg,png,jpg,gif,svg,webp',
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $gallery = Gallery::find($id);
            if ($request->hasfile('image')){
                if (file_exists($gallery->image)){
                    unlink($gallery->image);
                }
                $file = $request->file('image');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $directory = 'upload/gallery/';
                $file->move($directory,$fileName);
                $fileUrl = $directory.$fileName;
                $gallery->user_id = auth()->user()->id;
                $gallery->title = $file->getClientOriginalName();
                $imageDetails = getimagesize($fileUrl);
                $gallery->image = $fileUrl;
                $gallery->size = filesize($fileUrl);
                $gallery->resolution = "$imageDetails[0] x $imageDetails[1]";
                $gallery->alt = $file->getClientOriginalName();
            }
            else{
                $gallery->title = $gallery->title;
                $gallery->image = $gallery->image;
                $gallery->size = $gallery->size;
                $gallery->resolution = $gallery->resolution;
                $gallery->alt = $gallery->alt;
            }
            $gallery->user_id = auth()->user()->id;
            $gallery->caption = $request->caption;
            $gallery->status = $request->status;
            $gallery->save();
            toastr()->success('Image Update Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function destroy($id){
        try{
            $gallery = Gallery::find($id);
            if (file_exists($gallery->image)){
                unlink($gallery->image);
            }
            $gallery->delete();
            toastr()->success('Delete Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function downloadImage($id)
    {
        $image = Gallery::find($id);
        $imagePath = $image->image;
        if (!file_exists($imagePath)) {
            toastr()->error('Image not found');
            return back();
        }
        return response()->download($imagePath, basename($imagePath));
    }

}

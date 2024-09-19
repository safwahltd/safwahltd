<?php

namespace App\Http\Controllers\admin;

use App\Models\MissionVision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;

class MissionVisionController extends Controller
{
    public function index(){
        $missions=  MissionVision::orderBy('serial','asc')->paginate(20);
        return view('admin.mission-vision.index',compact('missions'));
    }
    public function store(Request $request){
        try {
            $validate = Validator::make($request->all(),[
                "title"         => "required",
                "image"         => [
                    'image',
                    'mimes:jpg,png,jpeg,gif,svg,webp',
                    'dimensions:min_width=500,min_height=450,max_width=500,max_height=450'
                ],
            ]);

            if($validate->fails()){
                toastr()->error($validate->messages());
                return redirect()->back();
            }
            $mission = new MissionVision();
            $mission->title = $request->title;
            $mission->description = $request->description;
            if ($request->file('image')){
                $image = $request->file('image');
                $imageName = $image->getClientOriginalName();
                $directory = 'upload/mission-vision/';
                $image->move($directory,$imageName);
                $imageUrl = $directory.$imageName;
                $mission->image = $imageUrl;
            }
            if ($request->serial){
                $shopCount = MissionVision::count();
                $shopSerial = MissionVision::where('serial',$request->serial)->first();
                if ($shopSerial){
                    $shopSerial->serial = $shopCount + 1;
                    $shopSerial->save();
                    $mission->serial = $request->serial;
                }
                else{
                    $mission->serial = $shopCount + 1;
                }
            }
            else{
                $shopCount = MissionVision::count();
                $mission->serial = $shopCount + 1;
            }
            $mission->status = $request->status;
            $mission->save();
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
                "image"         => [
                    'image',
                    'mimes:jpg,png,jpeg,gif,svg,webp',
                    'dimensions:min_width=500,min_height=450,max_width=500,max_height=450'
                ],
            ]);

            if($validate->fails()){
                toastr()->error($validate->messages());
                return redirect()->back();
            }
            $mission = MissionVision::find($id);
            $mission->title = $request->title;
            $mission->description = $request->description;
            if ($request->file('image')){
                if (file_exists($mission->image)){
                    unlink($mission->image);
                }
                $image = $request->file('image');
                $imageName = $image->getClientOriginalName();
                $directory = 'upload/mission-vision/';
                $image->move($directory,$imageName);
                $imageUrl = $directory.$imageName;
                $mission->image = $imageUrl;
            }
            if ($request->serial == $mission->serial){
                $mission->serial = $request->serial;
            }
            else{
                $missionSerial = MissionVision::where('serial',$request->serial)->first();
                if ($missionSerial){
                    $missionSerial->serial = $mission->serial;
                    $missionSerial->save();
                    $mission->serial = $request->serial;
                }
                else{
                    $mission->serial = $request->serial;
                }
            }
            $mission->status = $request->status;
            $mission->save();
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
            $mission = MissionVision::find($id);
            $mission->delete();
            toastr()->success('Delete Success.');
            return back();
        }
        catch (Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Models\CoreValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;

class CoreValueController extends Controller
{
    public function index(){
        $coreValues = CoreValue::orderBy('serial','ASC')->paginate(20);
        return view('admin.core-value.index',compact('coreValues'));
    }
    public function store(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                'title' => 'required',
                'serial' => 'required',
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $core = new CoreValue();
            $core->title = $request->title;
            if ($request->file('icon')){
                $icon = $request->file('icon');
                $iconName = $icon->getClientOriginalName();
                $directory = 'upload/core-value/';
                $icon->move($directory,$iconName);
                $iconUrl = $directory.$iconName;
                $core->icon = $iconUrl;
            }
            if ($request->serial){
                $coreCount = CoreValue::count();
                $coreSerial = CoreValue::where('serial',$request->serial)->first();
                if ($coreSerial){
                    $coreSerial->serial = $coreCount + 1;
                    $coreSerial->save();
                    $core->serial = $request->serial;
                }
                else{
                    $core->serial = $coreCount + 1;
                }
            }

            $core->status = $request->status;
            $core->save();
            toastr()->success('Core Value Create Successfully.');
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
                'title' => 'required',
                'serial' => 'required',
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $core = CoreValue::find($id);
            $core->title = $request->title;
            if ($request->file('icon')){
                if (file_exists($core->icon)){
                    unlink($core->icon);
                }
                $icon = $request->file('icon');
                $iconName = $icon->getClientOriginalName();
                $directory = 'upload/core-value/';
                $icon->move($directory,$iconName);
                $iconUrl = $directory.$iconName;
                $core->icon = $iconUrl;
            }
            if ($request->serial == $core->serial){
                $core->serial = $request->serial;
            }
            else{
                $coreCount = CoreValue::count();
                $coreSerial = CoreValue::where('serial',$request->serial)->first();
                if ($coreSerial){
                    $coreSerial->serial = $core->serial;
                    $coreSerial->save();
                    $core->serial = $request->serial;
                }
                else{
                    $core->serial = $request->serial;
                }
            }
            $core->status = $request->status;
            $core->save();
            toastr()->success('Core Value Update Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function destroy($id){
        try{
            $core = CoreValue::find($id);
            if (file_exists($core->icon)){
                unlink($core->icon);
            }
            $core->delete();
            toastr()->success('Core Value Delete Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }

    }
}

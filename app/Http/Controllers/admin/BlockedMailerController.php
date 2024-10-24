<?php

namespace App\Http\Controllers\admin;

use App\Models\BlockedMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;

class BlockedMailerController extends Controller
{
    public function index(){
        $blockMailers = BlockedMailer::latest()->paginate(100);
        return view('admin.block-mail.index',compact('blockMailers'));
    }
    public function store(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                'email' => 'required | unique:blocked_mailers,email'
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $blockMailer = new BlockedMailer();
            $blockMailer->email = $request->email;
            $blockMailer->name = $request->name;
            $blockMailer->status = $request->status;
            $blockMailer->save();
            toastr()->success('Created Successfully.');
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
                'email' => 'required'
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $blockMailer = BlockedMailer::find($id);
            $blockMailer->email = $request->email;
            $blockMailer->name = $request->name;
            $blockMailer->status = $request->status;
            $blockMailer->save();
            toastr()->success('Update Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function destroy($id){
        try{
            $blockMailer = BlockedMailer::find($id);
            $blockMailer->delete();
            toastr()->success('Delete Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }

    }
}

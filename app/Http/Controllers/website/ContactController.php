<?php

namespace App\Http\Controllers\website;

use App\Mail\BulkOrderMail;
use App\Mail\BulkOrderMailReply;
use App\Mail\contactMailReply;
use App\Mail\WholeSalerMail;
use App\Mail\WholeSalerMailReply;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contactSubmit(Request $request)
    {
        $mail = Setting::first();
        try {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ]);
            if ($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $data = $request->all();
            Mail::to($mail->sender_email)->send(new ContactMail($data));
            Mail::to($request->email)->send(new contactMailReply($data));
            toastr()->success('Thank you for contacting us. We will respond soon.');
            return back();
        }
        catch (\Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function bulkOrderSubmit(Request $request)
    {
        try {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ]);
            if ($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $data = $request->all();
            Mail::to('nazmulhaque.safwahltd@gmail.com')->send(new BulkOrderMail($data));
            Mail::to($request->email)->send(new BulkOrderMailReply($data));
            toastr()->success('Thank you for contacting us. We will respond soon.');
            return back();
        }
        catch (\Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }

    }
    public function becomeWholesalerSubmit(Request $request)
    {
        try {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ]);
            if ($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $data = $request->all();
            Mail::to('nazmulhaque.safwahltd@gmail.com')->send(new WholeSalerMail($data));
            Mail::to($request->email)->send(new WholeSalerMailReply($data));
            toastr()->success('Thank you for contacting us. We will respond soon.');
            return back();
        }
        catch (\Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }

    }
}

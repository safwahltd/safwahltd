<?php

namespace App\Http\Controllers\website;

use App\Mail\BulkOrderMail;
use App\Mail\BulkOrderMailReply;
use App\Mail\contactMailReply;
use App\Mail\WholeSalerMail;
use App\Mail\WholeSalerMailReply;
use App\Models\BlockedMailer;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function contactSubmit(Request $request)
    {
        if (RateLimiter::tooManyAttempts($request->ip(), 5)) {
            toastr()->error('Too many submissions. Please try again later.');
            return back();
        }
        RateLimiter::hit($request->ip(), 3600);
        $mail = Setting::first();
        $mailer = BlockedMailer::where('email',$request->email)->where('status',1)->first();
        try {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'nullable | email:rfc,dns',
                'phone' => 'required',
                'subject' => 'required',
                'message' => 'required',
                'captcha' => 'required|captcha'
            ]);
            if ($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            // Dynamically set email configurations
            Config::set('mail.default', $mail->mail_mailer); // Ensure you're using the right mailer
            // Set SMTP settings dynamically
            Config::set('mail.mailers.smtp.host', $mail->mail_host);
            Config::set('mail.mailers.smtp.port', $mail->mail_port);
            Config::set('mail.mailers.smtp.username', $mail->mail_username);
            Config::set('mail.mailers.smtp.password', $mail->mail_password);
            Config::set('mail.mailers.smtp.encryption', $mail->mail_encryption);

            // Set "from" address
            Config::set('mail.from.address', $mail->sender_email);
            Config::set('mail.from.name', $mail->sender_name);

            // Clear the resolved instance of the mailer, so the new configuration is used
            app()->forgetInstance('mailer');
            app()->make('mailer');

            $data = $request->all();
            if (!$mailer){
                Mail::to($mail->sender_email)->send(new ContactMail($data));
                /*Mail::to($request->email)->send(new contactMailReply($data));*/
                toastr()->success('Thank you for contacting us. We will respond soon.');
                return back();
            }
            return back();
        }
        catch (\Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function bulkOrderSubmit(Request $request)
    {
        if (RateLimiter::tooManyAttempts($request->ip(), 5)) {
            toastr()->error('Too many submissions. Please try again later.');
            return back();
        }
        RateLimiter::hit($request->ip(), 3600);
        $mail = Setting::first();
        $mailer = BlockedMailer::where('email',$request->email)->where('status',1)->first();
        try {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'nullable | email:rfc,dns',
                'phone' => 'required',
                'subject' => 'required',
                'message' => 'required',
                'captcha' => 'required|captcha'
            ]);
            if ($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            // Dynamically set email configurations
            Config::set('mail.default', $mail->mail_mailer); // Ensure you're using the right mailer

            // Set SMTP settings dynamically
            Config::set('mail.mailers.smtp.host', $mail->mail_host);
            Config::set('mail.mailers.smtp.port', $mail->mail_port);
            Config::set('mail.mailers.smtp.username', $mail->mail_username);
            Config::set('mail.mailers.smtp.password', $mail->mail_password);
            Config::set('mail.mailers.smtp.encryption', $mail->mail_encryption);

            // Set "from" address
            Config::set('mail.from.address', $mail->sender_email);
            Config::set('mail.from.name', $mail->sender_name);

            // Clear the resolved instance of the mailer, so the new configuration is used
            app()->forgetInstance('mailer');
            app()->make('mailer');

            $data = $request->all();
            if (!$mailer){
                Mail::to($mail->sender_email)->send(new BulkOrderMail($data));
                /*Mail::to($request->email)->send(new BulkOrderMailReply($data));*/
                toastr()->success('Thank you for contacting us. We will respond soon.');
                return back();
            }
            return back();

        }
        catch (\Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }

    }
    public function becomeWholesalerSubmit(Request $request)
    {
        if (RateLimiter::tooManyAttempts($request->ip(), 5)) {
            toastr()->error('Too many submissions. Please try again later.');
            return back();
        }
        RateLimiter::hit($request->ip(), 3600);
        $mail = Setting::first();
        $mailer = BlockedMailer::where('email',$request->email)->where('status',1)->first();
        try {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'nullable | email:rfc,dns',
                'phone' => 'required',
                'subject' => 'required',
                'message' => 'required',
                'captcha' => 'required|captcha'
            ]);
            if ($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            // Dynamically set email configurations
            Config::set('mail.default', $mail->mail_mailer); // Ensure you're using the right mailer

            // Set SMTP settings dynamically
            Config::set('mail.mailers.smtp.host', $mail->mail_host);
            Config::set('mail.mailers.smtp.port', $mail->mail_port);
            Config::set('mail.mailers.smtp.username', $mail->mail_username);
            Config::set('mail.mailers.smtp.password', $mail->mail_password);
            Config::set('mail.mailers.smtp.encryption', $mail->mail_encryption);

            // Set "from" address
            Config::set('mail.from.address', $mail->sender_email);
            Config::set('mail.from.name', $mail->sender_name);

            // Clear the resolved instance of the mailer, so the new configuration is used
            app()->forgetInstance('mailer');
            app()->make('mailer');

            $data = $request->all();
            if (!$mailer){
                Mail::to($mail->sender_email)->send(new WholeSalerMail($data));
                /*Mail::to($request->email)->send(new WholeSalerMailReply($data));*/
                toastr()->success('Thank you for contacting us. We will respond soon.');
                return back();
            }
            return back();
        }
        catch (\Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }

    }
}


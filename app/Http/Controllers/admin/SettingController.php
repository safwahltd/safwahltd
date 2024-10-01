<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    public function companySetting(){
        $companySetting = Setting::first();
        return view('admin.settings.company',compact('companySetting'));
    }
    public function companySettingUpdate(Request $request,$id){
        try {
            $setting = Setting::find($id);
            $setting->company_name = $request->company_name;
            $setting->company_title = $request->company_title;
            $setting->phone = $request->phone;
            $setting->hotLine = $request->hotLine;
            $setting->email = $request->email;
            $setting->address = $request->address;
            $setting->map = $request->map;
            if ($request->file('logo')){
                $logo = $request->file('logo');
                $logoExtension = $logo->getClientOriginalExtension();
                $logoName = time().'.'.$logoExtension;
                $directory = 'upload/company-setting/';
                $logo->move($directory,$logoName);
                $logoUrl = $directory.$logoName;
                $setting->logo = $logoUrl;
            }
            if ($request->file('favicon')){
                $favicon = $request->file('favicon');
                $faviconExtension = $favicon->getClientOriginalExtension();
                $faviconName = time().'.'.$faviconExtension;
                $directory = 'upload/company-setting/';
                $favicon->move($directory,$faviconName);
                $faviconUrl = $directory.$faviconName;
                $setting->favicon = $faviconUrl;
            }
            $setting->website_link = $request->website_link;
            $setting->app_link = $request->app_link;
            $setting->ios_link = $request->ios_link;
            $setting->meta_title = $request->meta_title;
            $setting->meta_keyword = $request->meta_keyword;
            $setting->meta_description = $request->meta_description;
            $setting->meta_author = $request->meta_author;
            $setting->save();
            toastr()->success('update success.');
            return back();
        }
        catch (Exception $exception){
            toastr()->error($exception->getMessage());
        }
    }
    public function emailSetting(){
        $emailSetting = Setting::first();
        return view('admin.settings.email',compact('emailSetting'));
    }
    public function emailSettingUpdate(Request $request,$id){
        try {
            $setting = Setting::find($id);
            $setting->sender_name = $request->sender_name;
            $setting->sender_email = $request->sender_email;
            $setting->mail_mailer = $request->mail_mailer;
            $setting->mail_host = $request->mail_host;
            $setting->mail_port = $request->mail_port;
            $setting->mail_encryption = $request->mail_encryption;
            $setting->mail_username = $request->mail_username;
            $setting->mail_password = $request->mail_password;
            $setting->save();

            // Set dynamic email configurations
            Config::set('mail.mailers.smtp.mailer', $setting->mail_mailer);
            Config::set('mail.mailers.smtp.host', $setting->mail_host);
            Config::set('mail.mailers.smtp.port', $setting->mail_port);
            Config::set('mail.mailers.smtp.username', $setting->mail_username);
            Config::set('mail.mailers.smtp.password', $setting->mail_password);
            Config::set('mail.mailers.smtp.encryption', $setting->mail_encryption);
            Config::set('mail.from.address', $setting->sender_email);
            Config::set('mail.from.name', $setting->sender_name);

            toastr()->success('update success.');
            return back();
        }
        catch (Exception $exception){
            toastr()->error($exception->getMessage());
        }
    }

}

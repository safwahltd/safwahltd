<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
    public function loginConfirm(Request $request){
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if ($validate->fails()) {
                toastr()->error($validate->getMessageBag()->first());
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $credentials = $request->only('email', 'password');
            $user = User::where('email',$request->email)->first();
            if($user){
                if ($user->status == 1){
                        if (Auth::guard('web')->attempt($credentials)){
                            toastr()->success('Login Successfull');
                            return redirect()->route('admin.dashboard');
                        }
                        else{
                            toastr()->error("Invalid Credentials!");
                            return back();
                        }
                }
                else{
                    toastr()->error("Your account is Inactive!");
                    return back();
                }
            }
            else{
                toastr()->error("You Are Not Registered!");
                return back();
            }
        }
        catch (Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function logout()
    {
        Auth::logout();
        toastr()->success("Logout Successfully");
        return redirect()->route('admin.login');
    }

    public function userDetails(){
        return view('admin.settings.details');
    }
    public function userDetailsUpdate(Request $request){
        try{
            $user = User::find(auth()->user()->id);
            if ($user) {
                if ($request->name != ''){
                    $user->name = $request->name;
                }
                else{
                    $user->name = $user->name;
                }
                if ($request->new_email != null){
                    if ($user->email == $request->current_email) {
                        $user->email = $request->new_email;
                    }
                    else {

                        toastr()->error('Current Email Not Matched.');
                        return back();
                    }
                }
                else{
                    $user->email = $user->email;
                }
                $user->save();
                toastr()->success('Account Info Change Successfully');
                return back();
            }
            else {
                toastr()->error('Data Not Found');
                return back();
            }
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function userPasswordChange(){
        return view('admin.settings.password-change');
    }
    public function userPasswordChangeSubmit(Request $request){
        try {
            $validate = Validator::make($request->all(),[
                'old_password'=> 'required',
                'password' => 'min:6|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'min:6'
            ]);
            if ($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $user = User::find(auth()->user()->id);
            if ($user) {
                if (password_verify($request->old_password, $user->password)) {
                    $user->password = bcrypt($request->password);
                    $user->save();
                    toastr()->success('Password Change Successfully');
                    return back();
                }
                else {
                    toastr()->error('Current Password Not Matched.');
                    return back();
                }
            }
            else {
                toastr()->error('Data Not Found');
                return back();
            }
        }
        catch (Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
}

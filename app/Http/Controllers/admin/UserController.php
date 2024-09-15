<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Validation\Rule;
use function League\Flysystem\Local\ensureDirectoryExists;

class UserController extends Controller
{
    public function index(){
        if(auth()->user()->hasPermission('admin user index')){
            $users = User::latest()->whereNotIn('id',[1,auth()->user()->id])->paginate(20);
            $roles = Role::where('status',1)->get();
            return view('admin.user.index',compact('users','roles'));
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }

    }
    public function store(Request $request){
        if(auth()->user()->hasPermission('admin user store')) {
            $validate = Validator::make($request->all(), [
                "name" => "required|min:3",
                "email" => "required|unique:users,email",
                'password' => 'required|min:8|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'required|min:8'
            ]);
            if ($validate->fails()) {
                Toastr::error($validate->getMessageBag()->first());
                return redirect()->back()->withErrors($validate)->withInput();
            }
            try {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role = 'user';
                $user->status = $request->status;
                $user->saveOrFail();
                if ($request->role_id){
                    foreach ($request->role_id as $role) {
                        $userRole = new UserRole();
                        $userRole->user_id = $user->id;
                        $userRole->role_id = $role;
                        $userRole->saveOrFail();
                    }
                }

                toastr()->success('user added successfully.');
                return back();
            } catch (Exception $e) {
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }
    }
    public function update(Request $request,$id){
        if (auth()->user()->hasPermission('admin user update')){
            $user = User::find($id);
            $validate = Validator::make($request->all(), [
                "name" => "required|min:3",
                "email" => [
                    "required",
                    Rule::unique('users')->ignore($user->id, 'id')
                ],
            ]);
            if ($validate->fails()) {
                Toastr::error($validate->getMessageBag()->first());
                return redirect()->back()->withErrors($validate)->withInput();
            }
            try {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role = 'user';
                $user->status = $request->status;
                $user->save();

                if ($request->role_id){
                    $userRoles = UserRole::where('user_id',$id)->whereNotIn('role_id',$request->role_id)->pluck('id')->toArray();
                    UserRole::destroy($userRoles);
                    foreach ($request->role_id as $role){
                        $permit = UserRole::where('user_id',$id)->where('role_id',$role)->first();
                        if (!$permit){
                            $permit = new UserRole();
                            $permit->user_id = $user->id;
                            $permit->role_id = $role;
                            $permit->save();
                        }
                    }
                }

                toastr()->success('user update successfully.');
                return back();
            }
            catch (Exception $e){
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }

    }
    public function destroy($id){
        if (auth()->user()->hasPermission('admin user destroy')){
            try{
                $user = User::find($id);
                $userRolesIds = UserRole::where('user_id',$id)->pluck('id')->toArray();
                UserRole::destroy($userRolesIds);
                $user->delete();
                toastr()->success('Delete Successfully.');
                return back();
            }
            catch(Exception $e){
                toastr()->error($e->getMessage());
                return back();
            }
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }

    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Validation\Rule;

class RolePermissionController extends Controller
{
    public function roleIndex(){
        if(auth()->user()->hasPermission('admin role index')){
            $roles = Role::latest()->paginate(500);
            $permissionsGroup = Permission::where('status',1)->get()
                ->groupBy(function ($permission) {
                    if (str_contains($permission->name, 'core value ')) {
                        return 'Core Value ';
                    } elseif (str_contains($permission->name, 'concern')) {
                        return 'Concern';
                    } elseif (str_contains($permission->name, 'product')) {
                        return 'Product';
                    } elseif (str_contains($permission->name, 'article')) {
                        return 'Article';
                    } elseif (str_contains($permission->name, 'post page')) {
                        return 'Post Page';
                    } elseif (str_contains($permission->name, 'shop')) {
                        return 'Shop';
                    } elseif (str_contains($permission->name, 'gallery')) {
                        return 'Gallery ';
                    } elseif (str_contains($permission->name, 'role')) {
                        return 'Role';
                    } elseif (str_contains($permission->name, 'permission')) {
                        return 'Permission';
                    } elseif (str_contains($permission->name, 'setting')) {
                        return 'Settings';
                    } elseif (str_contains($permission->name, 'slider')) {
                        return 'Slider';
                    } elseif (str_contains($permission->name, 'about')) {
                        return 'About Us';
                    } elseif (str_contains($permission->name, 'topbar')) {
                        return 'Top Bar';
                    } elseif (str_contains($permission->name, 'cms')) {
                        return 'Website CMS';
                    } elseif (str_contains($permission->name, 'pass')) {
                        return 'Password';
                    } elseif (str_contains($permission->name, 'user')) {
                        return 'User';
                    } elseif (str_contains($permission->name, 'block email')) {
                        return 'Block Email';
                    } elseif (str_contains($permission->name, 'social')) {
                        return 'Social Link';
                    } elseif (str_contains($permission->name, '')) {
                        return 'Missions';
                    }
                });
            return view('admin.role-permission.role-index',compact('roles','permissionsGroup'));
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }

    }
    public function roleStore(Request $request){
        if(auth()->user()->hasPermission('admin role store')){
            try{
                $validate = Validator::make($request->all(),[
                    'name' => 'required',
                ]);
                if($validate->fails()){
                    toastr()->error($validate->messages());
                    return back();
                }

                $role = new Role();
                $role->name = $request->name;
                $role->permission_ids = json_encode($request->permission_ids);
                $role->status = $request->status;
                $role->save();
                if (!empty($request->permission_ids)){
                    foreach ($request->permission_ids as $permission){
                        $permit = new RolePermission();
                        $permit->role_id = $role->id;
                        $permit->permission_id = $permission;
                        $permit->save();
                    }
                }
                else{
                    toastr()->error('Role Create Success But No Permission Selected.');
                    return back();
                }
                toastr()->success('Role Create Success.');
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
    public function roleUpdate(Request $request,$id){
        if(auth()->user()->hasPermission('admin role update')){
            try{
                $validate = Validator::make($request->all(),[
                    'name' => 'required',
                    'permission_ids' => 'required',
                ]);
                if($validate->fails()){
                    toastr()->error($validate->messages());
                    return back();
                }
                $role = Role::find($id);
                $role->name = $request->name;
                $role->permission_ids = json_encode($request->permission_ids);
                $role->status = $request->status;
                $role->save();
                if (!empty($request->permission_ids)){
                    $rolePermissions = RolePermission::where('role_id',$id)->whereNotIn('permission_id',$request->permission_ids)->pluck('id')->toArray();
                    RolePermission::destroy($rolePermissions);
                    foreach ($request->permission_ids as $permission){
                        $permit = RolePermission::where('role_id',$id)->where('permission_id',$permission)->first();
                        if (!$permit){
                            $permit = new RolePermission();
                            $permit->role_id = $role->id;
                            $permit->permission_id = $permission;
                            $permit->save();
                        }
                    }
                }
                else{
                    toastr()->error('No Permission Selected.');
                    return back();
                }

                toastr()->success('Role Update Success.');
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
    public function roleDestroy($id){
        if(auth()->user()->hasPermission('admin role destroy')){
            try{
                $role = Role::find($id);
                $rolePermissionIds = RolePermission::where('role_id',$role->id)->pluck('id')->toArray();
                RolePermission::destroy($rolePermissionIds);
                $role->delete();
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
    public function permissionIndex(){
        if(auth()->user()->hasPermission('admin permission index')){
            $permissions = Permission::latest()->get();
            $routeCollections = Route::getRoutes();
            return view('admin.role-permission.permission-index',compact('permissions','routeCollections'));
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }
    }
    public function permissionStore(Request $request){
        if(auth()->user()->hasPermission('admin permission store')){
            try{
                $validate = Validator::make($request->all(),[
                    'name' => 'required',
                ]);
                if($validate->fails()){
                    toastr()->error($validate->messages());
                    return back();
                }
                $permission = new Permission();
                $permission->name = $request->name;
                $permission->status = $request->status;
                $permission->save();
                toastr()->success('Rermission Create Success.');
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
    public function permissionUpdate(Request $request,$id){
        if(auth()->user()->hasPermission('admin permission update')){
            try{
                $validate = Validator::make($request->all(),[
                    'name' => [
                        'required',
                        Rule::unique('permissions','name')->ignore($id)
                    ],
                ]);
                if($validate->fails()){
                    toastr()->error($validate->messages());
                    return back();
                }
                $permission = Permission::find($id);
                $permission->name = $request->name;
                $permission->status = $request->status;
                $permission->save();
                toastr()->success('permission Update Success.');
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
    public function permissionDestroy($id){
        if(auth()->user()->hasPermission('admin permission destroy')){
            try{
                $permission = Permission::find($id);
                $permission->delete();
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

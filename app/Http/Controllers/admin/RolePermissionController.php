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
            $roles = Role::latest()->paginate(20);
            $permissions = Permission::latest()->where('status',1)->get();
            return view('admin.role-permission.role-index',compact('roles','permissions'));
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

                foreach ($request->permission_ids as $permission){
                    $permit = new RolePermission();
                    $permit->role_id = $role->id;
                    $permit->permission_id = $permission;
                    $permit->save();
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

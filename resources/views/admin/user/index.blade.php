@extends('admin.layout.app')
@section('title','user')
@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">User Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Module</li>
            </ol>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">User Table</h3>
                            <a class="btn btn-primary px-5"  data-bs-toggle="modal" data-bs-target="#addUser"   href="#">
                                ADD <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table  class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                            <thead>

                            <tr>
                                <th class="border-bottom-0">Select</th>
                                <th class="border-bottom-0">SL No</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Email</th>
                                {{--                                <th class="border-bottom-0">Email Veified At</th>--}}
                                <th class="border-bottom-0 text-center">Role</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td class="justify-content-center">
                                        <input class="form-check form-check-label" style="width: 70px" type="checkbox" name="check">
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    {{--                                    <td>{{ $user->email_verified_at  }}</td>--}}
                                    <td>
                                        @foreach($user->userRoles as $userRole)
                                            <span class="bg-primary p-1 rounded-2">{{ $userRole->role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="col-2">
                                        <span class="p-1 {{$user->status == 1 ? 'bg-success':'bg-warning text-white'}}">{{$user->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    <td class="d-flex">
                                        <a href="#" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#EditUser{{$key}}" ><i class="fa fa-edit"></i></a>
                                        <form action="{{route('admin.user.destroy',$user->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="EditUser{{$key}}">
                                    <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header p-5">
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-header border-bottom justify-content-between">
                                                        <h3 class="card-title"><i class="fa fa-user-circle-o"></i> Edit User</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal" action="{{route('admin.user.update',$user->id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-4">
                                                                <label for="name" class="col-md-3 form-label">Name</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control" value="{{ $user->name }}" id="name" name="name" placeholder="Enter name" type="text">
                                                                    <span class="text-danger">{{$errors->has('name') ? $errors->first('name'):''}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <label for="email" class="col-md-3 form-label">Email Address</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control" value="{{ $user->email }}" id="email" name="email" placeholder="Enter email address" type="email">
                                                                    <span class="text-danger">{{$errors->has('email') ? $errors->first('email'):''}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <label for="password" class="col-md-3 form-label">Password</label>
                                                                <div class="col-md-9 mb-1">
                                                                    <input class="form-control" value="" id="password{{$key}}" name="password" placeholder="your password" type="password">
                                                                    <input class="mt-2" type="checkbox" onchange="document.getElementById('password{{$key}}').type = this.checked ? 'text' : 'password'"> show password
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <label for="password_confirmation" class="col-md-3 form-label">Confirm Password</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control" value="" id="confirm_password{{$key}}" name="confirm_password" placeholder="your confirm password" type="password">
                                                                    <input class="mt-2" type="checkbox" onchange="document.getElementById('confirm_password{{$key}}').type = this.checked ? 'text' : 'password'"> show password
                                                                    <span class="text-danger">{{$errors->has('confirm_password') ? $errors->first('confirm_password'):''}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4 d-flex form-group">
                                                                <div class="col-md-3 form-label">
                                                                    <label class="" for="role">Role</label>
                                                                </div>
                                                                @php($userRoles = \App\Models\UserRole::where('user_id',$user->id)->pluck('role_id')->toArray())
                                                                <div class="col-md-9">
                                                                    <select class="form-control select2 form-select" multiple id="role" name="role_id[]" data-placeholder="Choose one">
                                                                        <option class="form-control" label="Choose one" disabled></option>
                                                                        @foreach($roles as $role)
                                                                            <option {{ in_array($role->id, $userRoles) ? 'selected' : '' }} value="{{$role->id}}">{{$role->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4 d-flex form-group">
                                                                <div class="col-md-3 form-label">
                                                                    <label class="" for="status">Status</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <select class="form-control select2 form-select" id="status" name="status" data-placeholder="Choose one">
                                                                        <option class="form-control" label="Choose one"></option>
                                                                        <option {{$user->status == 1 ? 'selected':''}} value="1">Active</option>
                                                                        <option {{$user->status == 0 ? 'selected':''}} value="0">Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <button class="btn btn-primary float-end" type="submit">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-grid my-2 justify-content-end">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addUser">
        <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header p-5">
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title"><i class="fa fa-user-circle-o"></i> Create User</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <label for="name" class="col-md-3 form-label">Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('name')}}" id="name" name="name" placeholder="Enter name" type="text">
                                        <span class="text-danger">{{$errors->has('name') ? $errors->first('name'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="email" class="col-md-3 form-label">Email Address</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('email')}}" id="email" name="email" placeholder="Enter email address" type="email">
                                        <span class="text-danger">{{$errors->has('email') ? $errors->first('email'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="password" class="col-md-3 form-label">Password</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('password')}}" id="password" name="password" placeholder="your password" type="password">
                                        <span class="text-danger">{{$errors->has('password') ? $errors->first('password'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="password_confirmation" class="col-md-3 form-label">Confirm Password</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('confirm_password')}}" id="confirm_password" name="confirm_password" placeholder="your confirm password" type="password">
                                        <span class="text-danger">{{$errors->has('confirm_password') ? $errors->first('confirm_password'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4 d-flex form-group">
                                    <div class="col-md-3 form-label">
                                        <label class="" for="role">Role</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control select2 form-select" multiple id="role" name="role_id[]" data-placeholder="Choose one">
                                            @foreach($roles as $role)
                                                <option {{--{{ $user->role == 'admin' ? 'selected':'' }}--}} value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4 d-flex form-group">
                                    <div class="col-md-3 form-label">
                                        <label class="" for="status">Status</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control select2 form-select"  id="status" name="status" data-placeholder="Choose one">
                                            <option class="form-control" label="Choose one" disabled selected></option>
                                            <option selected value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-primary float-end" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@extends('admin.layout.app')
@section('title','role')
@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Role Module</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Role Table</h3>
                            @if(auth()->user()->hasPermission('admin role store'))
                            <a class="btn btn-primary px-5"  data-bs-toggle="modal" data-bs-target="#addRole"   href="#">
                                ADD <i class="fa fa-plus"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                            <thead>

                            <tr>
{{--                                <th class="border-bottom-0">Select</th>--}}
                                <th class="border-bottom-0">SL No</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Status</th>
                                @if(auth()->user()->hasPermission('admin role update') || auth()->user()->hasPermission('admin role destroy'))
                                <th class="border-bottom-0">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $key => $role)
                                <tr>
                                    {{--<td class="justify-content-center">
                                        <input class="form-check form-check-label" style="width: 70px" type="checkbox" name="check">
                                    </td>--}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="col-2">
                                        <span class="p-1 {{$role->status == 1 ? 'bg-success':'bg-warning text-white'}}">{{$role->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    @if(auth()->user()->hasPermission('admin role update') || auth()->user()->hasPermission('admin role destroy'))
                                    <td class="d-flex">
                                        @if(auth()->user()->hasPermission('admin role update'))
                                        <a href="#" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#Editrole{{$key}}" ><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(auth()->user()->hasPermission('admin role destroy'))
                                        <form action="{{route('admin.role.destroy',$role->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                <div class="modal fade" id="Editrole{{$key}}">
                                    <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header p-5">
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" action="{{route('admin.role.update',$role->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row mb-4">
                                                        <label for="name" class="col-md-3 form-label">Name <span class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" value="{{ $role->name }}" id="name" name="name" placeholder="Enter name" type="text">
                                                            <span class="text-danger">{{$errors->has('name') ? $errors->first('name'):''}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4 d-flex form-group">
                                                        <div class="col-md-3 form-label">
                                                            <label class="" for="status">Status</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-control select2 form-select" id="status" name="status" data-placeholder="Choose one">
                                                                <option class="form-control" label="Choose one"></option>
                                                                <option {{$role->status == 1 ? 'selected':''}} value="1">Active</option>
                                                                <option {{$role->status == 0 ? 'selected':''}} value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @php($rolePermissions = \App\Models\RolePermission::where('role_id',$role->id)->pluck('permission_id')->toArray())
                                                    <div class="row mb-4">
                                                        <h5 class="text-center">All Permissions</h5>
                                                        <hr>
                                                        <h5><input class="selectAll" id="selectAll{{$rand = rand()}}" type="checkbox"> <label for="selectAll{{$rand}}">Select All</label></h5>
                                                        @foreach($permissionsGroup as $name => $permissions)
                                                            <div class="row my-2">
                                                                <h5 class="p-1 text-center" style="border: 1px solid black">{{ $name }}</h5>
                                                                @foreach($permissions as $key => $permission)
                                                                    <div class="col-4">
                                                                            <span>
                                                                                <input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}"
                                                                                       {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} id="permissionEdit{{ $rand = rand() }}" class="itemCheckbox">
                                                                                <label class="p-1 rounded-3 {{ in_array($permission->id, $rolePermissions) ? 'bg-success text-white' : '' }}" for="permissionEdit{{$rand}}">{{ ucwords($permission->name)}}</label>
                                                                            </span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button class="btn btn-primary float-end" type="submit">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-grid my-2 justify-content-end">
                        {{$roles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addRole">
        <div class="modal-dialog modal-xl modal-dialog-centered task-view-modal" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header p-5">
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{route('admin.role.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-md-3 form-label">Name <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control" required value="{{old('name')}}" id="name" name="name" placeholder="Enter name" type="text">
                                <span class="text-danger">{{$errors->has('name') ? $errors->first('name'):''}}</span>
                            </div>
                        </div>
                        <div class="row mb-4 d-flex form-group">
                            <div class="col-md-3 form-label">
                                <label class="" for="status">Status</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control select2 form-select" id="status" name="status" data-placeholder="Choose one">
                                    <option class="form-control" label="Choose one" disabled selected></option>
                                    <option selected value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <h3 class="text-center">All Permissions</h3>
                            <hr>
                            <h5><input class="selectAll" type="checkbox" id="selectAll"> <label for="selectAll">Select All</label></h5>
                            @foreach($permissionsGroup as $name => $permissions)
                                <div class="row my-2">
                                    <h5 class="p-1 text-center" style="border: 1px solid black">{{ $name }}</h5>
                                    @foreach($permissions as $key => $permission)
                                        <div class="col-4">
                                                    <span>
                                                    <input type="checkbox" name="permission_ids[]" value="{{$permission->id}}" id="permission{{ $permission->id}}" class="itemCheckbox text-danger">
                                                    <label for="permission{{$permission->id}}">{{$permission->name}}</label>
                                                </span>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn-primary float-end" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('.selectAll').click(function() {
            $('.itemCheckbox').prop('checked', this.checked);
        });

        // Optional: If all checkboxes are manually checked, also check "Select All"
        $('.itemCheckbox').click(function() {
            if ($('.itemCheckbox:checked').length == $('.itemCheckbox').length) {
                $('.selectAll').prop('checked', true);
            } else {
                $('.selectAll').prop('checked', false);
            }
        });
    </script>
@endpush


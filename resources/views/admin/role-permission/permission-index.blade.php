@extends('admin.layout.app')
@section('title','Permission')
@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Permission Module</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Permission Table</h3>
                            @if(auth()->user()->hasPermission('admin permission store'))
                            <a class="btn btn-primary px-5"  data-bs-toggle="modal" data-bs-target="#addPermission"   href="#">
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
                                @if(auth()->user()->hasPermission('admin permission update') || auth()->user()->hasPermission('admin permission destroy'))
                                <th class="border-bottom-0">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $key => $permission)
                                <tr>
                                    {{--<td class="justify-content-center">
                                        <input class="form-check form-check-label" style="width: 70px" type="checkbox" name="check">
                                    </td>--}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td class="col-2">
                                        <span class="p-1 {{$permission->status == 1 ? 'bg-success':'bg-warning text-white'}}">{{$permission->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    @if(auth()->user()->hasPermission('admin permission update') || auth()->user()->hasPermission('admin permission destroy'))
                                    <td class="d-flex">
                                        @if(auth()->user()->hasPermission('admin permission update'))
                                        <a href="#" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#Editpermission{{$key}}" ><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(auth()->user()->hasPermission('admin permission destroy'))
                                        <form action="{{route('admin.permission.destroy',$permission->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                <div class="modal fade" id="Editpermission{{$key}}">
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
                                                        <h3 class="card-title"><i class="fa fa-role-circle-o"></i> Create permission</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal" action="{{route('admin.permission.update',$permission->id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-4">
                                                                <label for="name" class="col-md-3 form-label">Name <span class="text-danger">*</span></label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control" value="{{ $permission->name }}" id="name" name="name" placeholder="Enter name" type="text">
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
                                                                        <option {{$permission->status == 1 ? 'selected':''}} value="1">Active</option>
                                                                        <option {{$permission->status == 0 ? 'selected':''}} value="0">Inactive</option>
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
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addPermission">
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
                            <h3 class="card-title"><i class="fa fa-role-circle-o"></i> Create Permission</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('admin.permission.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <label for="name" class="col-md-3 form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('name')}}" id="name" name="name" placeholder="Enter name" type="text">
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

                                <button class="btn btn-primary float-end" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


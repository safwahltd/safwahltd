@extends('admin.layout.app')
@section('title','Blocked Email')
@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Blocked Email</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title"> Blocked Email</h3>
                            @if(auth()->user()->hasPermission('admin block email store'))
                                <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addmission">
                                    ADD <i class="fa fa-plus"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table  class="table table-bordered text-center text-nowrap key-buttons border-bottom  w-100" id="file-datatable">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">SL No</th>
                                <th class="border-bottom-0">Email</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Status</th>
                                @if(auth()->user()->hasPermission('admin block email update') || auth()->user()->hasPermission('admin mission destroy'))
                                    <th class="border-bottom-0">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blockMailers as $key => $blockMailer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $blockMailer->email }}</td>
                                    <td>{{ $blockMailer->name }}</td>
                                    <td class="col-2">
                                        <span class="p-1 {{$blockMailer->status == 1 ? 'bg-success':'bg-danger'}}"> {{$blockMailer->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    @if(auth()->user()->hasPermission('admin block email update') || auth()->user()->hasPermission('admin mission destroy'))
                                        <td class="d-flex">
                                            @if(auth()->user()->hasPermission('admin block email update'))
                                                <a href=""  data-bs-toggle="modal" data-bs-target="#editmission{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('admin block email destroy'))
                                                <form action="{{route('admin.block.email.destroy',$blockMailer->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                                <div class="modal fade" id="editmission{{$key}}">
                                    <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header p-5">
                                                <h3 class="card-title"> Edit Blocked Email</h3>
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form class="form-horizontal" action="{{route('admin.block.email.update',$blockMailer->id )}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-4">
                                                                <div class="row input-group mb-4">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="email">Email <span class="text-danger">*</span></span>
                                                                        <input type="email" name="email" class="form-control" required value="{{$blockMailer->email}}" placeholder="email" aria-label= "email" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="row input-group mb-4">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="name">Name</span>
                                                                        <input type="text" name="name" class="form-control" value="{{$blockMailer->name}}" placeholder="name" aria-label= "name" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text  text-white col-4 bg-dark-gradient" id="status">Status</span>
                                                                    <select class="form-control" aria-label="status" aria-describedby="basic-addon1" name="status">
                                                                        <option class="form-control" label="Choose one" disabled selected></option>
                                                                        <option {{$blockMailer->status == 1 ? 'selected':''}} value="1">Active</option>
                                                                        <option {{$blockMailer->status == 0 ? 'selected':''}} value="0">Inactive</option>
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
                        {{$blockMailers->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addmission">
        <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header p-5">
                    <h3 class="card-title"> Create New</h3>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('admin.block.email.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="row input-group mb-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text text-white  col-4 bg-dark-gradient" id="email">Email <span class="text-danger">*</span></span>
                                            <input type="text" name="email" class="form-control" required value="{{old('email')}}" placeholder="email" aria-label= "email" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="row input-group mb-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text text-white  col-4 bg-dark-gradient" id="name">Name</span>
                                            <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="name" aria-label= "name" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text  text-white col-4 bg-dark-gradient" id="status">Status</span>
                                        <select class="form-control" aria-label="status" aria-describedby="basic-addon1" name="status">
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


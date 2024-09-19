@extends('admin.layout.app')
@section('title','Top Bar Text')
@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Top Bar Text Module</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title"> Top Bar Text</h3>
                            <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addtopBar">
                                ADD <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table  class="table table-bordered text-center text-nowrap key-buttons border-bottom  w-100" id="file-datatable">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">SL No</th>
                                <th class="border-bottom-0">Title</th>
                                <th class="border-bottom-0">Serial</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($topbars as $key => $topBar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $topBar->title }}</td>
                                    <td class="col-2">
                                        <span class="p-1 {{$topBar->status == 1 ? 'bg-success':'bg-danger'}}"> {{$topBar->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    <td>{{ $topBar->serial }}</td>
                                    <td class="d-flex">
                                        <a href=""  data-bs-toggle="modal" data-bs-target="#edittopBar{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a>
                                        <form action="{{route('admin.topbar.destroy',$topBar->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edittopBar{{$key}}">
                                    <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header p-5">
                                                <h3 class="card-title"> Edit Top Bar Text</h3>
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form class="form-horizontal" action="{{route('admin.topbar.update',$topBar->id )}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-4">
                                                                <div class="row input-group mb-4">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="nameEdit">Title <span class="text-danger">*</span></span>
                                                                        <input type="text" name="title" class="form-control" value="{{ $topBar->title }}" placeholder="title" aria-label= "title" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text text-white col-4 bg-dark-gradient" id="url">Url</span>
                                                                    <input type="text" name="url" class="form-control" value="{{$topBar->url}}" placeholder="url" aria-label="url" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text text-white col-4 bg-dark-gradient" id="serial">Serial <span class="text-danger">(optional)</span></span>
                                                                    <input type="number" name="serial" class="form-control" value="{{$topBar->serial}}" placeholder="serial" aria-label="serial" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text  text-white col-4 bg-dark-gradient" id="status">Status</span>
                                                                    <select class="form-control" aria-label="status" aria-describedby="basic-addon1" name="status">
                                                                        <option class="form-control" label="Choose one" disabled selected></option>
                                                                        <option {{$topBar->status == 1 ? 'selected':''}} value="1">Active</option>
                                                                        <option {{$topBar->status == 0 ? 'selected':''}} value="0">Inactive</option>
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
                        {{$topbars->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addtopBar">
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
                            <form class="form-horizontal" action="{{route('admin.topbar.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="row input-group mb-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text text-white  col-4 bg-dark-gradient" id="title">Title <span class="text-danger">*</span></span>
                                            <input type="text" name="title" class="form-control" required value="{{old('title')}}" placeholder="title" aria-label= "title" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white col-4 bg-dark-gradient" id="url">Url</span>
                                        <input type="text" name="url" class="form-control" value="{{old('url')}}" placeholder="url" aria-label="url" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white col-4 bg-dark-gradient" id="serialAdd">Serial <span class="text-danger">(optional)</span></span>
                                        <input type="number" name="serial" class="form-control" value="{{old('serial')}}" placeholder="serial" aria-label="serial" aria-describedby="basic-addon1">
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

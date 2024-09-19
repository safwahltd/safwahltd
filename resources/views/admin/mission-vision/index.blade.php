@extends('admin.layout.app')
@section('title','Mission & Vision')
@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Mission & Vision</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title"> Mission & Vision</h3>
                            <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addmission">
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
                                <th class="border-bottom-0">Image</th>
                                <th class="border-bottom-0">Serial</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($missions as $key => $mission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mission->title }}</td>
                                    <td><img src="{{asset($mission->image)}}" width="70" alt=""></td>
                                    <td class="col-2">
                                        <span class="p-1 {{$mission->status == 1 ? 'bg-success':'bg-danger'}}"> {{$mission->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    <td>{{ $mission->serial }}</td>
                                    <td class="d-flex">
                                        <a href=""  data-bs-toggle="modal" data-bs-target="#editmission{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a>
                                        <form action="{{route('admin.mission.destroy',$mission->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editmission{{$key}}">
                                    <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header p-5">
                                                <h3 class="card-title"> Edit Mission & Vision</h3>
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form class="form-horizontal" action="{{route('admin.mission.update',$mission->id )}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-4">
                                                                <div class="row input-group mb-4">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="nameEdit">Title <span class="text-danger">*</span></span>
                                                                        <input type="text" name="title" class="form-control" required value="{{ $mission->title }}" placeholder="title" aria-label= "title" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="row input-group mb-4">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="descriptionEdit">Description</span>
                                                                        <textarea class="form-control"  name="description" id="" cols="30" placeholder="description" rows="3" aria-label= "description"  aria-describedby="basic-addon1">{{ $mission->description }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text text-white col-4 bg-dark-gradient" id="imageEdit">Image  <small class="text-danger ms-2"> (500 x 450)</small></span>
                                                                    <input type="file" name="image" class="form-control col-5 image-input" value="" id="b{{$key}}" placeholder="image" aria-label="image" aria-describedby="basic-addon1">
                                                                    <img class="img-fluid img-responsive mx-1" id="imagePreview-b{{$key}}" src="{{asset($mission->image)}}"
                                                                         alt="Your Image" style="width: 200px; height: auto;" />
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text text-white col-4 bg-dark-gradient" id="serial">Serial <span class="text-danger">(optional)</span></span>
                                                                    <input type="number" name="serial" class="form-control" value="{{$mission->serial}}" placeholder="serial" aria-label="serial" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text  text-white col-4 bg-dark-gradient" id="status">Status</span>
                                                                    <select class="form-control" aria-label="status" aria-describedby="basic-addon1" name="status">
                                                                        <option class="form-control" label="Choose one" disabled selected></option>
                                                                        <option {{$mission->status == 1 ? 'selected':''}} value="1">Active</option>
                                                                        <option {{$mission->status == 0 ? 'selected':''}} value="0">Inactive</option>
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
                        {{$missions->links()}}
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
                            <form class="form-horizontal" action="{{route('admin.mission.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="row input-group mb-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text text-white  col-4 bg-dark-gradient" id="title">Title <span class="text-danger">*</span></span>
                                            <input type="text" name="title" class="form-control" required value="{{old('title')}}" placeholder="title" aria-label= "title" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="row input-group mb-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text text-white  col-4 bg-dark-gradient" id="descriptionAdd">Description</span>
                                            <textarea class="form-control"  name="description" id="" cols="30" placeholder="description" rows="3" aria-label= "description"  aria-describedby="basic-addon1"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white col-4 bg-dark-gradient" id="imageEdit">Image  <small class="text-danger ms-2"> (500 x 450)</small></span>
                                        <input type="file" name="image" class="form-control col-5 image-input" value="" id="b{{$key}}" placeholder="image" aria-label="image" aria-describedby="basic-addon1">
                                        <img class="img-fluid img-responsive mx-1" id="imagePreview-b{{$key}}" src=""
                                             alt="Your Image" style="width: 200px; height: auto;" />
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

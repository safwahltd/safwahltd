@extends('admin.layout.app')
@section('title','Slider')
@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Slider Module</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title"> Slider</h3>
                            @if(auth()->user()->hasPermission('admin slider store'))
                            <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addSlider">
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
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">slug</th>
                                <th class="border-bottom-0">Icon</th>
                                <th class="border-bottom-0">Serial</th>
                                <th class="border-bottom-0">Status</th>
                                @if(auth()->user()->hasPermission('admin slider update') || auth()->user()->hasPermission('admin slider destroy'))
                                <th class="border-bottom-0">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $key => $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->slogan }}</td>
                                    <td><img src="{{ asset($slider->banner) }}" class="img-responsive img-fluid" width="50" height="50" alt="{{ $slider->title }}"></td>
                                    <td class="col-2">
                                        <span class="p-1 {{$slider->status == 1 ? 'bg-success':'bg-danger'}}"> {{$slider->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    <td>{{ $slider->serial }}</td>
                                    @if(auth()->user()->hasPermission('admin slider update') || auth()->user()->hasPermission('admin slider destroy'))
                                    <td class="d-flex">
                                        @if(auth()->user()->hasPermission('admin slider update') || auth()->user()->hasPermission('admin slider destroy'))
                                        <a href=""  data-bs-toggle="modal" data-bs-target="#editSlider{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(auth()->user()->hasPermission('admin slider update') || auth()->user()->hasPermission('admin slider destroy'))
                                        <form action="{{route('admin.slider.destroy',$slider->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                <div class="modal fade" id="editSlider{{$key}}">
                                    <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header p-5">
                                                <h3 class="card-title"> Edit Slider </h3>
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form class="form-horizontal" action="{{route('admin.slider.update',$slider->id )}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-4">
                                                                <div class="row input-group mb-4">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="title">Title <span class="text-danger">*</span></span>
                                                                        <input type="text" name="title" class="form-control" required value="{{$slider->title}}" placeholder="slider title" aria-label= title" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="row input-group mb-4">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="sloganEdit">Slogan</span>
                                                                        <input type="text" name="slogan" class="form-control" value="{{$slider->slogan}}" placeholder="slogan" aria-label="slogan" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text  text-white col-4 bg-dark-gradient" id="descriptionEdit">Description</span>
                                                                    <textarea class="form-control" aria-label="description" placeholder="description"  aria-describedby="basic-addon1" name="description" id="description" cols="30" rows="5">{{$slider->description}}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text text-white col-4 bg-dark-gradient" id="bannerEdit">Banner  <small class="text-danger ms-2"> (1920 x 1080)</small></span>
                                                                    <input type="file" name="banner" class="form-control col-5 image-input" value="" id="b{{$key}}" placeholder="banner" aria-label="banner" aria-describedby="basic-addon1">
                                                                    <img class="img-fluid img-responsive mx-1" id="imagePreview-b{{$key}}" src="{{asset($slider->banner)}}"
                                                                         alt="{{ $slider->title }}" style="width: 200px; height: auto;" />
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text text-white col-4 bg-dark-gradient" id="url">Url</span>
                                                                    <input type="text" name="url" class="form-control" value="{{$slider->url}}" placeholder="url" aria-label="url" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text text-white col-4 bg-dark-gradient" id="serialEdit">Serial <span class="text-danger">(optional)</span></span>
                                                                    <input type="number" name="serial" class="form-control" value="{{$slider->serial}}" placeholder="serial" aria-label="serial" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text  text-white col-4 bg-dark-gradient" id="statusEdit">Status</span>
                                                                    <select class="form-control" aria-label="status" aria-describedby="basic-addon1" name="status">
                                                                        <option class="form-control" label="Choose one" disabled selected></option>
                                                                        <option {{$slider->status == 1 ? 'selected':''}} value="1">Active</option>
                                                                        <option {{$slider->status == 0 ? 'selected':''}}  value="0">Inactive</option>
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
                        {{$sliders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addSlider">
        <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header p-5">
                    <h3 class="card-title">Create New</h3>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('admin.slider.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="row input-group mb-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text text-white  col-4 bg-dark-gradient" id="title">Title <span class="text-danger">*</span></span>
                                            <input type="text" name="title" class="form-control" required value="{{old('title')}}" placeholder="slider title" aria-label= title" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="row input-group mb-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text text-white  col-4 bg-dark-gradient" id="sloganAdd">Slogan <span class="text-danger">*</span></span>
                                            <input type="text" name="slogan" class="form-control" value="{{old('slogan')}}" placeholder="slogan" aria-label="slogan" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text  text-white col-4 bg-dark-gradient" id="descriptionAdd">Description</span>
                                        <textarea class="form-control" aria-label="description" placeholder="description"  aria-describedby="basic-addon1" name="description" id="description" cols="30" rows="5">{{old('description')}}</textarea>
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white col-4 bg-dark-gradient" id="bannerAdd">Banner <small class="text-danger ms-2"> (1920 x 1080)</small></span>
                                        <input type="file" name="banner" class="form-control col-5 image-input" value="" id="banner" placeholder="banner" aria-label="banner" aria-describedby="basic-addon1">
                                        <img class="img-fluid img-responsive mx-1" id="imagePreview-banner" src=""
                                             alt="Your Image" style="width: 200px; height: auto;" />
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

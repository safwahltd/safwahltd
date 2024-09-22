@extends('admin.layout.app')
@section('title','Social Link')
@section('body')
    <div class="page-header">
        <div>
            <h1 class="page-title">Social Link Module</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title"> Social Link</h3>
                            @if(auth()->user()->hasPermission('admin social link store'))
                            <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addPaymentProcessor">
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
                                <th class="border-bottom-0">Icon</th>
                                <th class="border-bottom-0">Serial</th>
                                <th class="border-bottom-0">Status</th>
                                @if(auth()->user()->hasPermission('admin social link update') || auth()->user()->hasPermission('admin social link destroy'))
                                <th class="border-bottom-0">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($socialLinks as $key => $socialLink)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $socialLink->name }}</td>
                                    <td><img src="{{ asset($socialLink->icon) }}" class="img-responsive img-fluid" width="50" height="50" alt="{{ $socialLink->name }}"></td>
                                    <td class="col-2">
                                        <span class="p-1 {{$socialLink->status == 1 ? 'bg-success':'bg-danger'}}"> {{$socialLink->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    <td>{{ $socialLink->serial }}</td>
                                    @if(auth()->user()->hasPermission('admin social link update') || auth()->user()->hasPermission('admin social link destroy'))
                                    <td class="d-flex">
                                        @if(auth()->user()->hasPermission('admin social link update'))
                                        <a href=""  data-bs-toggle="modal" data-bs-target="#editPaymentProcessor{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(auth()->user()->hasPermission('admin social link destroy'))
                                        <form action="{{route('admin.social.link.destroy',$socialLink->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                <div class="modal fade" id="editPaymentProcessor{{$key}}">
                                    <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header p-5">
                                                <h3 class="card-title"> Edit Social Link </h3>
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form class="form-horizontal" action="{{route('admin.social.link.update',$socialLink->id )}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-4">
                                                                <div class="row input-group mb-4">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="nameEdit">Name <span class="text-danger">*</span></span>
                                                                        <input type="text" name="name" class="form-control" value="{{ $socialLink->name }}" placeholder="name" aria-label= name" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text text-white col-4 bg-dark-gradient" id="iconAdd">Icon</span>
                                                                    <input type="file" name="icon" class="form-control col-5 image-input" value="" id="{{$key}}" placeholder="icon" aria-label="logo" aria-describedby="basic-addon1">
                                                                    <img class="img-fluid img-responsive mx-1" id="imagePreview-{{$key}}" src="{{asset($socialLink->icon)}}"
                                                                         alt="{{ $socialLink->name }}" style="width: 200px; height: auto;" />
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text text-white col-4 bg-dark-gradient" id="url">Url</span>
                                                                    <input type="text" name="url" class="form-control" value="{{$socialLink->url}}" placeholder="url" aria-label="url" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text text-white col-4 bg-dark-gradient" id="serial">Serial <span class="text-danger">(optional)</span></span>
                                                                    <input type="number" name="serial" class="form-control" value="{{$socialLink->serial}}" placeholder="serial" aria-label="serial" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                            <div class="row input-group mb-4">
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text  text-white col-4 bg-dark-gradient" id="status">Status</span>
                                                                    <select class="form-control" aria-label="status" aria-describedby="basic-addon1" name="status">
                                                                        <option class="form-control" label="Choose one" disabled selected></option>
                                                                        <option {{$socialLink->status == 1 ? 'selected':''}} value="1">Active</option>
                                                                        <option {{$socialLink->status == 0 ? 'selected':''}} value="0">Inactive</option>
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
                        {{$socialLinks->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addPaymentProcessor">
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
                            <form class="form-horizontal" action="{{route('admin.social.link.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="row input-group mb-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text text-white  col-4 bg-dark-gradient" id="name">Name <span class="text-danger">*</span></span>
                                            <input type="text" name="name" class="form-control" required value="{{old('name')}}" placeholder="name" aria-label= name" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>

                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white col-4 bg-dark-gradient" id="iconAdd">Icon</span>
                                        <input type="file" name="icon" class="form-control col-5 image-input" value="" id="icon" placeholder="logo" aria-label="logo" aria-describedby="basic-addon1">
                                        <img class="img-fluid img-responsive mx-1" id="imagePreview-icon" src=""
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

@extends('admin.layout.app')
@section('title','Core Values')
@section('body')
    <div class="row mt-1 row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Core Values</h3>
                            <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addCoreValue" href="">
                                ADD <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table  class="table table-bordered text-center text-nowrap key-buttons border-bottom  w-100">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">SL No</th>
                                <th class="border-bottom-0">Title</th>
                                <th class="border-bottom-0">Icon</th>
                                <th class="border-bottom-0">Serial</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($coreValues as $key => $coreValue)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $coreValue->title }}</td>
                                    <td><img src="{{ asset($coreValue->icon) }}" class="img-responsive img-fluid" width="50" height="50" alt=""></td>
                                    <td>{{ $coreValue->serial }}</td>
                                    <td class="col-2">
                                        <span class="p-1 {{$coreValue->status == 1 ? 'bg-success':'bg-danger'}}">{{$coreValue->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>

                                    <td class="d-flex justify-content-center">
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#editCoreValue{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a>
                                        <form action="{{route('admin.core.value.destroy',$coreValue->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editCoreValue{{$key}}">
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
                                                        <h3 class="card-title"><i class="fa fa-credit-card-alt"></i> Edit Core Values </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal" action="{{route('admin.core.value.update',$coreValue->id )}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-4">
                                                                <label for="titleEdit" class="col-md-3 form-label">Title</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control" value="{{ $coreValue->title }}" id="titleEdit" name="title" placeholder="Enter title" type="text">
                                                                    <span class="text-danger">{{$errors->has('title') ? $errors->first('title'):''}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <label for="iconEdit" class="col-md-3 form-label">Image <small class="text-danger">(500 x 450)</small></label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control" value="" id="iconEdit" name="icon" type="file">
                                                                    <img src="{{asset($coreValue->icon)}}" class="img-fluid img-responsive my-2" width="100" height="100" alt="">
                                                                    <span class="text-danger">{{$errors->has('icon') ? $errors->first('icon'):''}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <label for="serialshow" class="col-md-3 form-label">Serial</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control bg-transparent" value="{{ $coreValue->serial }}" id="serialshow" name="serial" placeholder="Enter Serial Number" type="number">
                                                                    <span class="text-danger">{{$errors->has('serial') ? $errors->first('serial'):''}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4 d-flex form-group">
                                                                <div class="col-md-3 form-label">
                                                                    <label class="" for="statusEdit">Status</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <select class="form-control select2 form-select" id="statusEdit" name="status" data-placeholder="Choose one">
                                                                        <option class="form-control" label="Choose one" disabled selected></option>
                                                                        <option {{ $coreValue->status == 1 ? 'selected':''  }}  value="1">Active</option>
                                                                        <option {{ $coreValue->status == 0 ? 'selected':''  }}  value="0">Inactive</option>
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
                        {{ $coreValues->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addCoreValue">
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
                            <h3 class="card-title"><i class="fa fa-credit-card-alt"></i> Create New</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('admin.core.value.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <label for="titleAdd" class="col-md-3 form-label">Title <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" required value="{{old('title')}}" id="titleAdd" name="title" placeholder="Enter Title" type="text">
                                        <span class="text-danger">{{$errors->has('title') ? $errors->first('title'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="iconAdd" class="col-md-3 form-label">Image <small class="text-danger">(500 x 450)</small></label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('icon')}}" id="iconAdd" name="icon" type="file">
                                        <span class="text-danger">{{$errors->has('icon') ? $errors->first('icon'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="serialAdd" class="col-md-3 form-label">Serial</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('serial')}}" id="serialAdd" name="serial" placeholder="Enter Serial No" type="number">
                                        <span class="text-danger">{{$errors->has('serial') ? $errors->first('serial'):''}}</span>
                                    </div>
                                </div>

                                <div class="row mb-4 d-flex form-group">
                                    <div class="col-md-3 form-label">
                                        <label class="" for="statusAdd">Status</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control select2 form-select" id="statusAdd" name="status" data-placeholder="Choose one">
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

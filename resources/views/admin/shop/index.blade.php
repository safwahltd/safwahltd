@extends('admin.layout.app')
@section('title','Shops')
@section('body')
    <div class="row mt-1 row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Shops</h3>
                            @if(auth()->user()->hasPermission('admin shop store'))
                            <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addshop" href="">
                                ADD <i class="fa fa-plus"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-center text-nowrap key-buttons border-bottom  w-100">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">SL No</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Banner</th>
                                <th class="border-bottom-0">Serial</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($shops as $key => $shop)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $shop->name }}</td>
                                    <td><img src="{{ asset($shop->banner) }}" class="img-responsive img-fluid" width="50" height="50" alt="{{$shop->name}}"></td>
                                    <td>{{ $shop->serial }}</td>
                                    <td class="col-2">
                                        <span class="p-1 {{$shop->status == 1 ? 'bg-success':'bg-danger'}}">{{$shop->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        @if(auth()->user()->hasPermission('admin shop update'))
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#editshop{{$key}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        @endif
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#showshop{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-eye"></i></a>
                                        @if(auth()->user()->hasPermission('admin shop destroy'))
                                        <form action="{{route('admin.shop.destroy',$shop->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="editshop{{$key}}">
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
                                                            <h3 class="card-title"><i class="fa fa-credit-card-alt"></i> Edit shop</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal" action="{{route('admin.shop.update',$shop->id )}}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row mb-4">
                                                                    <label for="titleEdit" class="col-md-3 form-label">name <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" required value="{{ $shop->name }}" id="nameEdit" name="name" placeholder="Enter name" type="text">
                                                                        <span class="text-danger">{{$errors->has('name') ? $errors->first('name'):''}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <label for="{{$key}}" class="col-md-3 form-label">Banner</label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control image-input" value="{{old('banner')}}" id="{{$key}}" name="banner"
                                                                               type="file">
                                                                        <img class="img-fluid img-responsive my-2" id="imagePreview-{{$key}}" src="{{asset($shop->banner)}}"
                                                                             alt="{{$shop->name}}" style="width: 150px; height: auto;" />
                                                                        <span class="text-danger">{{$errors->has('banner') ? $errors->first('banner'):''}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <label for="serialshow" class="col-md-3 form-label">Serial <span class="text-danger">(optional)</span></label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control bg-transparent" value="{{ $shop->serial }}" id="serialshow" name="serial" placeholder="Enter Serial Number" type="number">
                                                                        <span class="text-danger">{{$errors->has('serial') ? $errors->first('serial'):''}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <label for="urlShow" class="col-md-3 form-label">Url</label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control bg-transparent" required value="{{ $shop->url }}" id="urlShow" name="url" placeholder="Enter Url" type="url">
                                                                        <span class="text-danger">{{$errors->has('url') ? $errors->first('url'):''}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4 d-flex form-group">
                                                                    <div class="col-md-3 form-label">
                                                                        <label class="" for="statusEdit">Status</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select class="form-control select2 form-select" id="statusEdit" name="status" data-placeholder="Choose one">
                                                                            <option class="form-control" label="Choose one" disabled selected></option>
                                                                            <option {{ $shop->status == 1 ? 'selected':''  }}  value="1">Active</option>
                                                                            <option {{ $shop->status == 0 ? 'selected':''  }}  value="0">Inactive</option>
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
                                <div class="modal fade" id="showshop{{$key}}">
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
                                                        <h3 class="card-title"><i class="fa fa-credit-card-alt"></i> Show shop </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-4">
                                                                <label for="" class="col-md-3 form-label">name</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control bg-transparent" readonly value="{{ $shop->name }}" id="" name="name" placeholder="Enter name" type="text">
                                                                    <span class="text-danger">{{$errors->has('name') ? $errors->first('name'):''}}</span>
                                                                </div>
                                                            </div>
                                                        <div class="row mb-4">
                                                                <label for="" class="col-md-3 form-label">banner</label>
                                                                <div class="col-md-9">
                                                                    <img src="{{asset($shop->banner)}}" class="img-fluid img-responsive my-2" width="150" height="150" alt="{{$shop->name}}">
                                                                    <span class="text-danger">{{$errors->has('logo') ? $errors->first('logo'):''}}</span>
                                                                </div>
                                                            </div>
                                                        <div class="row mb-4">
                                                                <label for="serialshow" class="col-md-3 form-label">Serial</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control  bg-transparent" readonly value="{{ $shop->serial }}" id="serialshow" name="serial" placeholder="Enter Serial Number" type="number">
                                                                    <span class="text-danger">{{$errors->has('serial') ? $errors->first('serial'):''}}</span>
                                                                </div>
                                                            </div>
                                                        <div class="row mb-4">
                                                                <label for="urlShow" class="col-md-3 form-label">Url</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control bg-transparent" readonly value="{{ $shop->url }}" id="urlShow" name="url" placeholder="Enter Url" type="url">
                                                                    <span class="text-danger">{{$errors->has('url') ? $errors->first('url'):''}}</span>
                                                                </div>
                                                            </div>
                                                        <div class="row mb-4 d-flex form-group">
                                                                <div class="col-md-3 form-label">
                                                                    <label class="" for="status">Status</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <select class="form-control select2 form-select" disabled readonly id="status" name="status" data-placeholder="Choose one">
                                                                        <option class="form-control" label="Choose one" disabled selected></option>
                                                                        <option {{ $shop->status == 1 ? 'selected':''  }}  value="1">Active</option>
                                                                        <option {{ $shop->status == 0 ? 'selected':''  }}  value="0">Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
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
                        {{ $shops->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addshop">
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
                            <h3 class="card-title"><i class="fa fa-credit-card-alt"></i> Create New Shop</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('admin.shop.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <label for="nameAdd" class="col-md-3 form-label">name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" required value="{{old('name')}}" id="nameAdd" name="name" placeholder="Enter name" type="text">
                                        <span class="text-danger">{{$errors->has('name') ? $errors->first('name'):''}}</span>
                                    </div>
                                </div>
                                @php($rand = rand(0,10))
                                <div class="row mb-4">
                                    <label for="b{{$rand}}" class="col-md-3 form-label">Banner</label>
                                    <div class="col-md-9">
                                        <input class="form-control image-input" value="{{old('banner')}}" id="b{{$rand}}" name="banner"
                                               type="file">
                                        <img class="img-fluid img-responsive my-2" id="imagePreview-b{{$rand}}" src=""
                                             alt="Your Image" style="width: 150px; height: auto;" />
                                        <span class="text-danger">{{$errors->has('banner') ? $errors->first('banner'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="serialAdd" class="col-md-3 form-label">Serial <span class="text-danger">(optional)</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('serial')}}" id="serialAdd" name="serial" placeholder="Enter Serial No" type="number">
                                        <span class="text-danger">{{$errors->has('serial') ? $errors->first('serial'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="urlShow" class="col-md-3 form-label">Url</label>
                                    <div class="col-md-9">
                                        <input class="form-control bg-transparent" value="{{ old('url') }}" id="urlShow" name="url" placeholder="Enter Url" type="url">
                                        <span class="text-danger">{{$errors->has('url') ? $errors->first('url'):''}}</span>
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

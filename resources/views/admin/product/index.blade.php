@extends('admin.layout.app')
@section('title','Product')
@section('body')
    <div class="row mt-1 row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Product</h3>
                            <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addProduct" href="">
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
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Banner</th>
                                <th class="border-bottom-0">Icon</th>
                                <th class="border-bottom-0">Serial</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($products as $key => $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td><img src="{{ asset($product->banner) }}" class="img-responsive img-fluid" width="50" height="50" alt="no banner"></td>
                                    <td><img src="{{ asset($product->icon) }}" class="img-responsive img-fluid" width="50" height="50" alt="no icon"></td>
                                    <td>{{ $product->serial }}</td>
                                    <td class="col-2">
                                        <span class="p-1 {{$product->status == 1 ? 'bg-success':'bg-danger'}}">{{$product->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#editProduct{{$key}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#showproduct{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-eye"></i></a>
                                        <form action="{{route('admin.product.destroy',$product->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editProduct{{$key}}">
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
                                                            <h3 class="card-title"><i class="fa fa-credit-card-alt"></i> Edit product</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal" action="{{route('admin.product.update',$product->id )}}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row mb-4">
                                                                    <label for="titleEdit" class="col-md-3 form-label">name <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" required value="{{ $product->name }}" id="nameEdit" name="name" placeholder="Enter name" type="text">
                                                                        <span class="text-danger">{{$errors->has('name') ? $errors->first('name'):''}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <label for="bannerEdit" class="col-md-3 form-label">banner</label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" value="" id="bannerEdit" name="banner" type="file">
                                                                        <img src="{{asset($product->banner)}}" class="img-fluid img-responsive my-2" width="100" height="100" alt="">
                                                                        <span class="text-danger">{{$errors->has('banner') ? $errors->first('banner'):''}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <label for="iconEdit" class="col-md-3 form-label">Icon</label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" value="" id="iconEdit" name="icon" type="file">
                                                                        <img src="{{asset($product->icon)}}" class="img-fluid img-responsive my-2" width="100" height="100" alt="">
                                                                        <span class="text-danger">{{$errors->has('icon') ? $errors->first('icon'):''}}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-4">
                                                                    <label for="serialshow" class="col-md-3 form-label">Serial <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control bg-transparent" required value="{{ $product->serial }}" id="serialshow" name="serial" placeholder="Enter Serial Number" type="number">
                                                                        <span class="text-danger">{{$errors->has('serial') ? $errors->first('serial'):''}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <label for="urlShow" class="col-md-3 form-label">Url</label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control bg-transparent" required value="{{ $product->url }}" id="urlShow" name="url" placeholder="Enter Url" type="url">
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
                                                                            <option {{ $product->status == 1 ? 'selected':''  }}  value="1">Active</option>
                                                                            <option {{ $product->status == 0 ? 'selected':''  }}  value="0">Inactive</option>
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
                                <div class="modal fade" id="showproduct{{$key}}">
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
                                                        <h3 class="card-title"><i class="fa fa-credit-card-alt"></i> Product Details</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-4">
                                                                <label for="" class="col-md-3 form-label">name</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control bg-transparent" readonly value="{{ $product->name }}" id="" name="name" placeholder="Enter name" type="text">
                                                                    <span class="text-danger">{{$errors->has('name') ? $errors->first('name'):''}}</span>
                                                                </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label for="serialshow" class="col-md-3 form-label">Serial</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control  bg-transparent" readonly value="{{ $product->serial }}" id="serialshow" name="serial" placeholder="Enter Serial Number" type="number">
                                                                <span class="text-danger">{{$errors->has('serial') ? $errors->first('serial'):''}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label for="urlShow" class="col-md-3 form-label">Url</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control bg-transparent" readonly value="{{ $product->url }}" id="urlShow" name="url" placeholder="Enter Url" type="url">
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
                                                                    <option {{ $product->status == 1 ? 'selected':''  }}  value="1">Active</option>
                                                                    <option {{ $product->status == 0 ? 'selected':''  }}  value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center mb-4">
                                                            <div class="col-md-6 text-center border">
                                                                <label for="" class="form-label">Banner</label>
                                                                <img src="{{asset($product->banner)}}" class="img-fluid img-responsive my-2" width="500" alt="">
                                                            </div>
                                                            <div class="col-md-6 text-center border">
                                                                <label for="" class="form-label">Icon</label>
                                                                <img src="{{asset($product->icon)}}" class="img-fluid img-responsive my-2" width="500" alt="">
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addProduct">
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
                            <form class="form-horizontal" action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <label for="nameAdd" class="col-md-3 form-label">name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" required value="{{old('name')}}" id="nameAdd" name="name" placeholder="Enter name" type="text">
                                        <span class="text-danger">{{$errors->has('name') ? $errors->first('name'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="bannerAdd" class="col-md-3 form-label">Banner</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('banner')}}" id="bannerAdd" name="banner" type="file">
                                        <span class="text-danger">{{$errors->has('banner') ? $errors->first('banner'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="iconAdd" class="col-md-3 form-label">Icon</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('icon')}}" id="iconAdd" name="icon" type="file">
                                        <span class="text-danger">{{$errors->has('icon') ? $errors->first('icon'):''}}</span>
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

@extends('admin.layout.app')
@section('title','about us')
@section('body')
    <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="border-bottom m-3">
                        <div class="row">
                            <div class="card-header border-bottom justify-content-between">
                                <h3 class="card-title">About Us</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal " action="{{route('admin.about.update',$about->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-4">
                                <label for="slider_text_header" class="col-md-3 form-label">Title</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="title" id="title" cols="30" rows="2">{{ $about->title ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="description" class="col-md-3 form-label"> description </label>
                                <div class="col-md-9">
                                    <textarea class="form-control summernote" id="description" name="description" cols="30" rows="5">{{ $about->description ?? '' }}</textarea>
                                    <span class="text-danger">{{$errors->has('description') ? $errors->first('description'):''}}</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="image_1" class="col-md-3 form-label">Image One <small class="text-danger"> (500 x 450)</small></label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control image-input mb-1" id="image_1"  name="image_1">
                                    <img class="img-fluid img-responsive mx-1" id="imagePreview-image_1" src="{{asset($about->image_1)}}"
                                         alt="Your Image" style="width: 150px; height: auto;" />
                                    <span class="text-danger">{{$errors->has('image_1') ? $errors->first('image_1'):''}}</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="image_2" class="col-md-3 form-label">Image Two <small class="text-danger"> (500 x 450)</small></label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control image-input mb-1" id="image_2"  name="image_2">
                                    <img class="img-fluid img-responsive mx-1" id="imagePreview-image_2" src="{{asset($about->image_2)}}"
                                         alt="Your Image" style="width: 150px; height: auto;" />
                                    <span class="text-danger">{{$errors->has('image_2') ? $errors->first('image_2'):''}}</span>
                                </div>
                            </div>

                            <div class="row mb-4 d-flex form-group">
                                <div class="col-md-3 form-label">
                                    <label class="" for="status">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control  bg-transparent select2 form-select" id="status" readonly="true" name="status" data-placeholder="Choose one">
                                        <option class="form-control" label="Choose one"  selected></option>
                                        <option {{$about->status == 1 ? 'selected':'' }} value="1">Active</option>
                                        <option {{$about->status == 0 ? 'selected':'' }} value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary float-end" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection


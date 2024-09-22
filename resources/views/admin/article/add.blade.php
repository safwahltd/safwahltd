@extends('admin.layout.app')
@section('title','Article Create')
@section('body')
    <div class="row mt-1 row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Article</h3>
                            @if(auth()->user()->hasPermission('admin article index'))
                                <a class="btn btn-primary px-5" href="{{route('admin.article.index')}}">
                                    List <i class="fa fa-plus"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{route('admin.article.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <label for="nameAdd" class="col-md-3 form-label">Title <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" required value="{{ old('title') }}" id="titleAdd" name="title" placeholder="Enter Title" type="text">
                                        <span class="text-danger">{{$errors->has('title') ? $errors->first('title'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="slugAdd" class="col-md-3 form-label">Slug <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" required value="{{old('slug')}}" id="slugAdd" name="slug" type="text">
                                        <span class="text-danger">{{$errors->has('slug') ? $errors->first('slug'):''}}</span>
                                    </div>
                                </div>
                                @php($rand = rand(0,10))
                                <div class="row mb-4">
                                    <label for="thumbnailAdd" class="col-md-3 form-label">thumbnail <small class="text-danger">(550 x 350)</small></label>
                                    <div class="col-md-9">
                                        <input class="form-control image-input" value="{{old('thumbnail')}}" id="{{$rand}}" name="thumbnail" type="file">
                                        <img class="img-fluid img-responsive my-2" id="imagePreview-{{$rand}}" src="" alt="Your Image" style="width: 150px; height: auto;" />
                                        <span class="text-danger">{{$errors->has('thumbnail') ? $errors->first('thumbnail'):''}}</span>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="short_descriptionAdd" class="col-md-3 form-label">Short Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="short_description" id="" maxlength="300" cols="30" rows="3" placeholder="short description">{{old('short_description')}}</textarea>
                                        <span class="text-danger">{{$errors->has('long_description') ? $errors->first('long_description'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="short_descriptionAdd" class="col-md-3 form-label">Long Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control summernote" name="long_description" id="" cols="30" rows="3" placeholder="short description">{{old('long_description')}}</textarea>
                                        <span class="text-danger">{{$errors->has('long_description') ? $errors->first('long_description'):''}}</span>
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
                                    <label for="urlShow" class="col-md-3 form-label">Url <span class="text-danger">(optional)</span></label>
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
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#titleAdd').on('keyup', function() {
                let title = $(this).val();
                let slug = title.toLowerCase()
                    .replace(/\s+/g, '-');
                $('#slugAdd').val(slug);
            });
            $('.titleEdit').on('keyup', function() {
                let title = $(this).val();
                let slug = title.toLowerCase().replace(/\s+/g, '-');          // Replace multiple dashes with one
                $('.slugEdit').val(slug);
            });

        });
    </script>
@endpush

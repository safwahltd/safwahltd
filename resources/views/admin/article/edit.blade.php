@extends('admin.layout.app')
@section('title','Article Edit')
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
                    <form class="form-horizontal" action="{{route('admin.article.update',$article->id )}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label for="titleEdit" class="col-md-3 form-label">Title <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control titleEdit" required value="{{ $article->title }}" id="titleEdit" name="title" placeholder="Enter Title" type="text">
                                <span class="text-danger">{{$errors->has('title') ? $errors->first('title'):''}}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="slugEdit" class="col-md-3 form-label">Slug <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control slugEdit" required value="{{ $article->slug }}" id="slugEdit" name="slug" type="text">
                                <span class="text-danger">{{$errors->has('slug') ? $errors->first('slug'):''}}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="thumbnail" class="col-md-3 form-label">thumbnail <small class="text-danger">(550 x 350)</small></label>
                            <div class="col-md-9">
                                <input class="form-control image-input" value="" id="thumbnail" name="thumbnail" type="file">
                                <img class="img-fluid img-responsive my-2" id="imagePreview-thumbnail" src="{{asset($article->thumbnail)}}" alt="Your Image" style="width: 150px; height: auto;" />
                                <span class="text-danger">{{$errors->has('thumbnail') ? $errors->first('thumbnail'):''}}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="short_descriptionAdd" class="col-md-3 form-label">Short Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="short_description" id="" cols="30" maxlength="300" rows="3" placeholder="short description">{{$article->short_description}}</textarea>
                                <span class="text-danger">{{$errors->has('short_description') ? $errors->first('short_description'):''}}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="short_descriptionAdd" class="col-md-3 form-label">Long Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control summernote" name="long_description" id="" cols="30" rows="3" placeholder="short description">{!! $article->long_description !!}</textarea>
                                <span class="text-danger">{{$errors->has('long_description') ? $errors->first('long_description'):''}}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="serialshow" class="col-md-3 form-label">Serial</label>
                            <div class="col-md-9">
                                <input class="form-control bg-transparent" value="{{ $article->serial }}" id="serialshow" name="serial" placeholder="Enter Serial Number" type="number">
                                <span class="text-danger">{{$errors->has('serial') ? $errors->first('serial'):''}}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="urlShow" class="col-md-3 form-label">Url</label>
                            <div class="col-md-9">
                                <input class="form-control bg-transparent" value="{{ $article->url }}" id="urlShow" name="url" placeholder="Enter Url" type="url">
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
                                    <option {{ $article->status == 1 ? 'selected':''  }}  value="1">Active</option>
                                    <option {{ $article->status == 0 ? 'selected':''  }}  value="0">Inactive</option>
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


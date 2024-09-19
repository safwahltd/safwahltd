@extends('admin.layout.app')
@section('title','Article')
@section('body')
    <div class="row mt-1 row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Article</h3>
                            <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addArticle" href="">
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
                                <th class="border-bottom-0">thumbnail</th>
                                <th class="border-bottom-0">Icon</th>
                                <th class="border-bottom-0">Serial</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($articles as $key => $article)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td><img src="{{ asset($article->thumbnail) }}" class="img-responsive img-fluid" width="50" height="50" alt="no thumbnail"></td>
                                    <td>{{ $article->serial }}</td>
                                    <td class="col-2">
                                        <span class="p-1 {{$article->status == 1 ? 'bg-success':'bg-danger'}}">{{$article->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#editarticle{{$key}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#showarticle{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-eye"></i></a>
                                        <form action="{{route('admin.article.destroy',$article->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editarticle{{$key}}">
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
                                                            <h3 class="card-title"><i class="fa fa-credit-card-alt"></i> Edit article</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal" action="{{route('admin.article.update',$article->id )}}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row mb-4">
                                                                    <label for="titleEdit{{$key}}" class="col-md-3 form-label">Title <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control titleEdit" required value="{{ $article->title }}" id="titleEdit{{$key}}" name="title" placeholder="Enter Title" type="text">
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
                                                                    <label for="{{$key}}" class="col-md-3 form-label">thumbnail <small class="text-danger">(550 x 350)</small></label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control image-input" value="" id="{{$key}}" name="thumbnail" type="file">
                                                                        <img class="img-fluid img-responsive my-2" id="imagePreview-{{$key}}" src="{{asset($article->thumbnail)}}" alt="Your Image" style="width: 150px; height: auto;" />
                                                                        <span class="text-danger">{{$errors->has('thumbnail') ? $errors->first('thumbnail'):''}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <label for="short_descriptionAdd" class="col-md-3 form-label">Short Description</label>
                                                                    <div class="col-md-9">
                                                                        <textarea class="form-control" name="short_description" id="" cols="30" maxlength="300" rows="3" placeholder="short description">{{$article->short_description}}</textarea>
                                                                        <span class="text-danger">{{$errors->has('long_description') ? $errors->first('long_description'):''}}</span>
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
                                    </div>
                                </div>
                                <div class="modal fade" id="showarticle{{$key}}">
                                    <div class="modal-dialog modal-xl modal-dialog-centered task-view-modal" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header p-5">
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-header border-bottom justify-content-between">
                                                        <h3 class="card-title">{{ $article->title }}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 ><span style="background-color: orangered" class="rounded-2 text-white p-1 fw-bold">Slug : {{ $article->slug }}</span></h6>
                                                        <div class="row mb-4">
                                                            <div class="col-md-4">
                                                                <img src="{{asset($article->thumbnail)}}" class="img-fluid img-responsive my-2" width="500" alt="">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h4>{{ $article->title }} </h4>
                                                                <p>
                                                                    <small>status :
                                                                        <span class="rounded-2 fw-bold p-1 {{ $article->status == 1 ? 'bg-success':'bg-danger'  }}">{{ $article->status == 1 ? 'Active':'Inactive'  }}</span>
                                                                    </small> &nbsp;
                                                                    <small>
                                                                        <span  class="rounded-2 fw-bold p-1 bg-success">serial : {{ $article->serial }}</span>
                                                                    </small>
                                                                </p>
                                                                <h6>{{ $article->short_description }}</h6>
                                                                <h6>URL : <a href="{{ $article->url }}">{{ $article->url }}</a></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-10">
                                                                <p>{!! $article->long_description !!}</p>
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
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addArticle" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered"  role="document">
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

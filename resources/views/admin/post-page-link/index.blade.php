@extends('admin.layout.app')
@section('title','Page/Post Link')
@section('body')
    <div class="row mt-1 row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Post or Page Link</h3>
                            @if(auth()->user()->hasPermission('admin post page store'))
                                <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addpostPageLink" href="">
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
                                <th class="border-bottom-0">Article</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($postPageLinks as $key => $postPageLink)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $postPageLink->article->title }}</td>
                                    <td class="col-2">
                                        <span class="p-1 {{$postPageLink->status == 1 ? 'bg-success':'bg-danger'}}">{{$postPageLink->status == 1 ? 'Active':'Inactive'}}</span>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        @if(auth()->user()->hasPermission('admin post page update'))
                                            <a href="#"  data-bs-toggle="modal" data-bs-target="#editpostPageLink{{$key}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        @endif
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#showpostPageLink{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-eye"></i></a>
                                        @if(auth()->user()->hasPermission('admin post page destroy'))
                                            <form action="{{route('admin.post.page.destroy',$postPageLink->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="editpostPageLink{{$key}}">
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
                                                        <h3 class="card-title"> Edit Post Page Link</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal" action="{{route('admin.post.page.update',$postPageLink->id )}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-4 d-flex form-group">
                                                                <div class="col-md-3 form-label">
                                                                    <label class="" for="statusAdd">Article</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <select class=" select2-show-search select2 form-select" id="article_idAdd" name="article_id" data-placeholder="Choose one">
                                                                        <option class="" label="Choose one" disabled selected></option>
                                                                        @foreach($articles as $article)
                                                                            <option {{$postPageLink->article_id == $article->id ? 'selected':''}} value="{{$article->id}}">{{$article->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- Textarea for Post (Initially hidden) -->
                                                            <div class="row mb-4 post-input" id="">
                                                                <label for="post_content" class="col-md-3">Post Url <span class="text-danger">*</span> </label>
                                                                <div class="col-md-9">
                                                                    <textarea id="post_content" required name="link" class="form-control" rows="8" placeholder="Enter Embed Code here">{{ $postPageLink->link }}</textarea>
                                                                    <span>Example : <pre>{{ '<iframe src="https://www.facebook.com/plugins/post.php" width="300" height="667"></iframe>' }}</pre></span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4 d-flex form-group">
                                                                <div class="col-md-3 form-label">
                                                                    <label class="" for="statusAdd">Status</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <select class="form-control select2 form-select" id="statusAdd" name="status" data-placeholder="Choose one">
                                                                        <option class="form-control" label="Choose one" disabled selected></option>
                                                                        <option {{$postPageLink->status == 1 ? 'selected':''}} value="1">Active</option>
                                                                        <option {{$postPageLink->status == 0 ? 'selected':''}} value="0">Inactive</option>
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
                                <div class="modal fade" id="showpostPageLink{{$key}}">
                                    <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header p-5">
                                                <h4>{{ $postPageLink->article->title }}</h4>
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card" style="background-color: whitesmoke">
                                                    <div class="card-body">
                                                        <div class="text-center">
                                                            {!! $postPageLink->link !!}
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
                        {{ $postPageLinks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addpostPageLink">
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
                            <h3 class="card-title"> Create New</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('admin.post.page.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4 d-flex form-group">
                                    <div class="col-md-3 form-label">
                                        <label class="" for="statusAdd">Article</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class=" select2-show-search select2 form-select" id="article_idAdd" name="article_id" data-placeholder="Choose one">
                                            <option class="" label="Choose one" disabled selected></option>
                                            @foreach($articles as $article)
                                            <option value="{{$article->id}}">{{$article->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Textarea for Post (Initially hidden) -->
                                <div class="row mb-4 post-input" id="">
                                    <label for="post_content" class="col-md-3">Post Url <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <textarea id="post_content" required name="link" class="form-control" rows="6" placeholder="Enter Embed Code here"></textarea>
                                        <span>Example : <pre>{{ '<iframe src="https://www.facebook.com/plugins/post.php" width="300" height="667"></iframe>' }}</pre></span>
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

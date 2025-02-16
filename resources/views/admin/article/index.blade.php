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
                            @if(auth()->user()->hasPermission('admin article store'))
                            <a class="btn btn-primary px-5" href="{{route('admin.article.create')}}">
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
                                <th class="border-bottom-0">thumbnail</th>
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
                                        @if(auth()->user()->hasPermission('admin article update'))
                                        <a href="{{route('admin.article.edit',$article->slug)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        @endif
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#showarticle{{$key}}" class="btn btn-primary mx-2"><i class="fa fa-eye"></i></a>
                                        @if(auth()->user()->hasPermission('admin article destroy'))
                                        <form action="{{route('admin.article.destroy',$article->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('are you sure to delete ? ')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
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
                                                        <div class="row mb-4">
                                                            <div class="col-md-4">
                                                                <img src="{{asset($article->thumbnail)}}" class="img-fluid img-responsive my-2" width="500" alt="">
                                                                <br>
                                                                <span>Alt Text : {{ $article->alt_text }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h4>{{ $article->title }} </h4>
                                                                <p>
                                                                    <small>Status :
                                                                        <span class="rounded-2 fw-bold p-1 {{ $article->status == 1 ? 'bg-success':'bg-danger'  }}">{{ $article->status == 1 ? 'Active':'Inactive'  }}</span>
                                                                    </small> &nbsp;
                                                                </p>
                                                                <h6>Serial No : {{ $article->serial }}</h6>
                                                                <h6>Meta Title : {{ $article->meta_title }}</h6>
                                                                <h6>Meta Keyword : {{ $article->meta_keyword }}</h6>
                                                                <h6>Meta Description : {{ $article->meta_description }}</h6>
                                                                <h6>{{ $article->short_description }}</h6>
                                                                <h6>URL : <a href="{{ $article->url }}">{{ $article->url }}</a></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-12 overflow-scroll position-relative">
                                                                <div class="">
                                                                    {!! $article->long_description !!}
                                                                </div>
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
@endsection

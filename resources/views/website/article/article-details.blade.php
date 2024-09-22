@extends('website.layout.app')
@section('title','Article Details')
@section('body')
    <style>
        .article-details {
            overflow: auto;
            max-height: 100%;
        }
    </style>
    <div class="container py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-dark my-1 animated slideInDown">{{$article->title}}</h3>
                            <p><small>{{\Illuminate\Support\Carbon::parse($article->created_at)->format('d M, Y')}}</small></p>
                        </div>
                        <div class="card-body overflow-auto">
                            {!! $article->long_description !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-dark my-1 animated slideInDown">Suggested Articles</h3>
                        </div>
                        <div class="card-body overflow-auto">
                            @foreach($articles as $article)
                                <a href="{{$article->url == '' ? route('website.article.details',$article->slug) : $article->url}}" target="{{$article->url == '' ? "" : '_blank'}}">
                                    <div class="card my-1">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3 d-grid justify-content-between align-content-center">
                                                    <img src="{{asset($article->thumbnail)}}" width="80" alt="{{$article->title}}">
                                                </div>
                                                <div class="col-9"><p>{{$article->title}}</p></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            <div class="text-center my-2">
                                <a class="bg-dark text-white form-control" href="{{route('website.articles')}}">More Details</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

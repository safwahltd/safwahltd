@extends('website.layout.app')
@section('title','Article Details')
@section('body')
    <style>
        .article-details {
            overflow: auto;
            max-height: 100%;
        }
         .article-details-container {
             display: flex;
             flex-direction: column;
             overflow-x: hidden; /* Hide horizontal scroll */
             width: 100%;        /* Ensure it takes full width */
         }

        .article-details {
            flex: 1;
            max-width: 100%; /* Prevents content from exceeding the container width */
            word-wrap: break-word; /* Ensures long words or URLs break to avoid overflow */
        }
        img {
            max-width: 100%; /* Makes images responsive */
            height: auto;
        }
    </style>
    <div class="container py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-dark my-1 animated slideInDown" style="font-family: Times New Roman, Times, serif;">{{$article->title}}</h3>
                            <p><small>{{\Illuminate\Support\Carbon::parse($article->created_at)->format('d M, Y')}}</small></p>
                        </div>
                        <div class="card-body" style="font-family: Times New Roman, Times, serif;">
                            <div class="article-details-container">
                                <div class="article-details" style="word-wrap: break-word;">
                                    {!! $article->long_description !!}
                                </div>
                            </div>
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
                                                <div class="col-9"><p style="font-family: Times New Roman, Times, serif;">{{$article->title}}</p></div>
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
                    <div class="card my-2">
                        <div class="card-header text-center">
                            <h3 class="text-dark my-1 animated slideInDown">Facebook</h3>
                        </div>
                        <div class="card-body overflow-auto">
                            <div class="card my-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div id="fb-root"></div>
                                        <div class="fb-page text-center my-1"
                                             data-href="https://www.facebook.com/safwahmartbd"
                                             data-width="300"
                                             data-layout="button"
                                             data-action="like"
                                             data-size="small"
                                             data-share="false">
                                        </div>
                                        <div class="my-2 text-center">
                                           <h4> Related Product </h4>
                                            @foreach($links as $link)
                                                {!! $link->link !!}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card my-2">
                        <div class="card-header text-center">
                            <h3 class="text-dark my-1 animated slideInDown">Instagram</h3>
                        </div>
                        <div class="card-body overflow-auto">
                            <a href="{{$article->url == '' ? route('website.article.details',$article->slug) : $article->url}}" target="{{$article->url == '' ? "" : '_blank'}}">
                                <div class="card my-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/safwahmart/" data-instgrm-version="12" style="max-width:540px; min-width:326px; width:99%; margin:auto;"></blockquote>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

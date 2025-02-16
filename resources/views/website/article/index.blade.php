@extends('website.layout.app')
@section('title','Articles')
@section('body')
    <!-- Blog Start -->
    <div class="container-fluid blog py-5" style="background-color: #2a2c2a">
        <div class="container">
            <div class="text-center mx-auto pb-5" data-wow-delay=".3s" style="max-width: 600px;">
                <h2 class="text-white">Our Articles</h2>
            </div>
            <div class="row g-5">
                @foreach($articles as $article)
                    <div class="col-lg-6 col-xl-3" data-wow-delay=".3s">
                        <div class="blog-item position-relative bg-light rounded" style="height:370px">
                            <a href="{{$article->url == '' ? route('website.article.details',$article->slug) : $article->url}}" target="{{$article->url == '' ? "" : '_blank'}}">
                                <img src="{{asset($article->thumbnail)}}" class="img-fluid w-100 rounded-top" alt="{{$article->alt_text}}">
                                <div class="blog-content text-center position-relative px-3 pt-5" style="margin-top: -25px;">
                                    <span class="text-dark">{{\Carbon\Carbon::parse($article->created_at)->format('d M, Y')}}</span>
                                    <h5 class="py-2" style="font-family: Times New Roman, Times, serif;">{{$article->title}}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection

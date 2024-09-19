@extends('website.layout.app')
@section('title','Article Details')
@section('body')
    <div class="container py-5">
        <div class="container py-5">
            <h3 class="text-dark mb-4 animated slideInDown">{{$article->title}}</h3>
            <p><small>{{\Illuminate\Support\Carbon::parse($article->created_at)->format('d M, Y')}}</small></p>
            <div class="">
                {!! $article->long_description !!}
            </div>
        </div>
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <title>{{$cms->website_title}} - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{$company->meta_title}}" name="title">
    <meta content="{{$company->meta_keyword}}" name="keywords">
    <meta content="{{$company->meta_author}}" name="author">
    <meta content="{{$company->meta_description}}" name="description">

   @include('website.layout.style')
</head>

<body>
<!-- Spinner Start -->

<div id="spinner" class="{{$cms->loading_image_status == 1 ? 'show':''}} position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <img src="{{asset($cms->loading_image)}}" width="50" alt="">
</div>

<!-- Spinner End -->

<!-- Topbar Start -->
@include('website.layout.topbar')
<!-- Topbar End -->

<!-- Navbar Start -->
@include('website.layout.header')
<!-- Navbar End -->

    @yield('body')

<!-- Footer Start -->
@include('website.layout.footer')
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-dark btn-square rounded-circle back-to-top"><i class="fa fa-arrow-up text-white"></i></a>


@include('website.layout.script')
</body>

</html>

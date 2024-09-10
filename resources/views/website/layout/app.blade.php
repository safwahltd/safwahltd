<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <title>HighTech - IT Solutions Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Saira:wght@500;600;700&amp;display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="{{asset('/')}}website/cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{asset('/')}}website/cdn.jsdelivr.net/npm/bootstrap-icons%401.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('/')}}website/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{asset('/')}}website/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('/')}}website/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('/')}}website/css/style.css" rel="stylesheet">
</head>

<body>
<!-- Spinner Start -->
<div id="spinner" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
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
<a href="#" class="btn btn-secondary btn-square rounded-circle back-to-top"><i class="fa fa-arrow-up text-white"></i></a>


<!-- JavaScript Libraries -->
<script src="{{asset('/')}}website/ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{asset('/')}}website/cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}website/lib/wow/wow.min.js"></script>
<script src="{{asset('/')}}website/lib/easing/easing.min.js"></script>
<script src="{{asset('/')}}website/lib/waypoints/waypoints.min.js"></script>
<script src="{{asset('/')}}website/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="{{asset('/')}}website/js/main.js"></script>
</body>

</html>

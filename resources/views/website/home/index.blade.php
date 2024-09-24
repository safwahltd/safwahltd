@extends('website.layout.app')
@section('title','Home Page')
@section('body')
    <!-- Carousel Start -->
    @if($cms->slider == 1)
    <div class="container-fluid px-0">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($sliders as $key => $slider)
                <li data-bs-target="#carouselId" data-bs-slide-to="{{$key}}" class="bg-white {{$key == 0 ? 'active':''}}" aria-current="true" aria-label="First slide"></li>
                @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach($sliders as $key => $slider)
                <div class="carousel-item {{$key == 0 ? 'active':''}}">
                    <img src="{{asset($slider->banner)}}" class="img-fluid" alt="{{ $slider->title }}">
                    <div class="carousel-caption">
                        <div class="container carousel-content">
                            <h6 class="text-white h4 animated fadeInUp">{{ $slider->title }}</h6>
                            <h3 class="text-white display-3 mb-4 animated fadeInRight">{{$slider->slogan}}</h3>
                            <p class="mb-4 text-white fs-5 animated fadeInDown">{{$slider->description}}</p>
                            <a href="{{$slider->url}}" class="mx-2">
                                <button type="button" style="border: 1px solid white" class="px-4 my-2 text-white py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">Read More</button>
                            </a>
                            <a href="{{route('website.contact')}}" class="mx-2">
                                <button type="button" style="border: 1px solid white" class="px-4 py-sm-3 px-sm-5 btn btn-primary text-white rounded-pill carousel-content-btn2 animated fadeInRight">Contact Us</button>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    @endif
    <!-- Carousel End -->

    {{--<!-- Fact Start -->
    <div class="container-fluid bg-dark py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".1s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-dark counter-value">99</h1>
                        <h5 class="text-white mt-1">Success in getting happy customer</h5>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".3s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-dark counter-value">25</h1>
                        <h5 class="text-white mt-1">Thousands of successful business</h5>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".5s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-dark counter-value">120</h1>
                        <h5 class="text-white mt-1">Total clients who love HighTech</h5>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".7s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-dark counter-value">5</h1>
                        <h5 class="text-white mt-1">Stars reviews given by satisfied clients</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact End -->--}}
    <!-- About Start -->
    @if($about->status == 1)
    <div class="container-fluid py-5 my-5">
        <div class="container pt-5" id="about_us">
            <div class="row g-5">
                <div class="col-lg-5 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                    <div class="h-100 position-relative">
                        <img src="{{asset($about->image_1)}}" class="img-fluid w-75 rounded" alt="{{$about->title}}" style="margin-bottom: 25%;">
                        <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                            <img src="{{asset($about->image_2)}}" class="img-fluid w-100 rounded" alt="{{$about->title}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s">
                    <h2 class="text-dark">About Us</h2>
                    <h3 class="mb-4" style="font-family: Times New Roman, Times, serif;">{{$about->title}}</h3>
                    <p class="text-dark" align="justify" style="font-family: Times New Roman, Times, serif;">{!! $about->description !!}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- About End -->

    <!-- Core Value Start -->
    <div class="container-fluid services py-5 mb-5">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h2 class="text-dark">Core Values</h2>
{{--                <h1>Services Built Specifically For Your Business</h1>--}}
            </div>
            <div class="row g-5 services-inner">
                @foreach($coreValues as $coreValue)
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay=".3s">
                    <div class="services-item">
                        <div class="text-center">
                            <div class="">
                                <img class="mb-2" src="{{asset($coreValue->icon)}}" width="250"  alt="{{$coreValue->title}}">
                                <h5 class="mb-3 p-2 text-dark" style="font-family: Times New Roman, Times, serif;">{{$coreValue->title}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Core Value End -->

    <!-- Mission & Vision Start -->
    <div class="container-fluid services py-5 mb-5" style="background-color: {{$cms->home_section_bg_color}}">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h2 class="text-dark " style="font-family: Times New Roman, Times, serif;">Mission & Vision</h2>
            </div>
            <div class="row g-5 services-inner">
                @foreach($missions as $mission)
                    <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay=".3s">
                        <div class="services-item bg-dark">
                            <div class="text-center">
                                <div class="">
                                    <img class="mb-2" src="{{asset($mission->image)}}" width="250"  alt="{{$mission->title}}">
                                    <h5 class="mb-3 px-2 text-white"  style="font-family: Times New Roman, Times, serif;">{{$mission->title}}</h5>
                                    <p class="mb-3 px-2 text-white" style="font-family: Times New Roman, Times, serif;">{{$mission->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Mission & Vision End -->

    <!-- Concern Start -->
    <div class="container-fluid project py-5 mb-5">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h2 class="text-dark">Our Concern</h2>
            </div>
            <div class="row g-5">
                @foreach($concerns as $concern)
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                    <div class="project-item">
                        <div class="project-img">
                            <img src="{{asset($concern->banner)}}" class="img-fluid w-100 rounded" alt="{{$concern->name}}">
                            <div class="project-content">
                                <a href="{{$concern->url}}" target="_blank" class="text-center">
                                    <h4 class="text-white" style="font-family: Times New Roman, Times, serif;">{{$concern->name}}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Concern End -->
    <!-- Products Start -->
    <div class="container-fluid py-5 mb-5 team" style="background-color: {{$cms->home_section_bg_color}}">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h2 class="text-dark">Products</h2>
            </div>
            <div class="owl-carousel team-carousel wow fadeIn" data-wow-delay=".5s">
                @foreach($products as $product)
                <div class="rounded team-item">
                    <div class="team-content">
                        <div class="team-img-icon">
                            <div class="team-img">
                                <a href="{{$product->url}}">
                                    <img src="{{asset($product->banner)}}" class="img-fluid w-100" alt="{{$product->name}}">
                                </a>
                            </div>
                            <div class="team-name text-center py-3">
                                <h6 class="" style="font-family: Times New Roman, Times, serif;">{{$product->name}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Products End -->
    <!-- Available On Start -->
    <div class="container-fluid project py-5 mb-5">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h2 class="text-dark">Available On</h2>
            </div>
            <div class="row g-5">
                @foreach($shops as $shop)
                    <div class="col-md-4 col-6 col-lg-2 wow fadeIn" data-wow-delay=".3s">
                        <div class="project-item">
                            <div class="project-img">
                                <a href="{{$shop->url}}" target="_blank" class="text-center">
                                <img src="{{asset($shop->banner)}}" class="img-fluid w-100 rounded" alt="{{$shop->name}}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Available On End -->
    <!-- Article Start -->
    <div class="container-fluid blog py-5 mb-5" style="background-color: {{$cms->home_section_bg_color}}">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h2 class="text-dark">Articles</h2>
            </div>
            <div class="row g-5 justify-content-center">
                @foreach($articles as $article)
                <div class="col-lg-6 col-xl-4 wow fadeIn" data-wow-delay=".3s">
                    <div class="blog-item position-relative bg-light rounded">
                        <a href="{{$article->url == '' ? route('website.article.details',$article->slug) : $article->url}}" target="{{$article->url == '' ? "" : '_blank'}}">
                            <img src="{{asset($article->thumbnail)}}" class="img-fluid w-100 rounded-top" alt="{{$article->title}}">
                            <div class="blog-content text-center position-relative px-3 pt-5" style="margin-top: -25px;">
                                <span class="text-dark">{{\Carbon\Carbon::parse($article->created_at)->format('d M, Y')}}</span>
                                <h5 class="py-2" style="font-family: Times New Roman, Times, serif;">{{$article->title}}</h5>
                            </div>
                        </a>

                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center my-2">
                <a href="{{route('website.articles')}}" class="btn btn-dark">More Articles</a>
            </div>
        </div>
    </div>
    <!-- Article End -->
    <!-- Contact Start -->
    <div class="container-fluid position-relative py-5 mb-5">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h1 class="mb-3">Contact for any query</h1>
            </div>
            <div class="row g-5">
                    <div class="col-lg-5 wow fadeIn" data-wow-delay=".3s">
                        <div class="row g-5 mb-5 justify-content-center">
                            <div class="col-xl-12 col-lg-12 wow fadeIn" data-wow-delay=".3s">
                                <div class="d-flex bg-light p-3 rounded">
                                    <div class="flex-shrink-0 btn-square bg-dark rounded-circle" style="width: 64px; height: 64px;">
                                        <i class="fas fa-map-marker-alt text-white"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="text-dark">Address</h4>
                                        <p class="text-dark"><small class="fw-bold">{{$company->address}}</small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 wow fadeIn" data-wow-delay=".5s">
                                <div class="d-flex bg-light p-3 rounded">
                                    <div class="flex-shrink-0 btn-square bg-dark rounded-circle" style="width: 64px; height: 64px;">
                                        <i class="fa fa-phone text-white"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="text-dark">Call Us</h4>
                                        <p class="text-dark"><small class="fw-bold">{{$company->hotLine}}</small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 wow fadeIn" data-wow-delay=".7s">
                                <div class="d-flex bg-light p-3 rounded">
                                    <div class="flex-shrink-0 btn-square bg-dark rounded-circle" style="width: 64px; height: 64px;">
                                        <i class="fa fa-envelope text-white"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="text-dark">Email Us</h4>
                                        <a class="h5" href="mailto:info@example.com" target="_blank">{{$company->email}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                        <form action="{{route('contact.submit')}}" method="post">
                            @csrf
                            <div class="p-5 rounded"  style="background-color: {{$cms->contact_form_color}}">
                                <div class="mb-4">
                                    <input type="text" name="name" required class="form-control border-0 py-3" placeholder="Name *">
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="email" required class="form-control border-0 py-3" placeholder="Email *">
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="phone" required class="form-control border-0 py-3" placeholder="Phone *">
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="subject" required class="form-control border-0 py-3" placeholder="Subject *">
                                </div>
                                <div class="mb-4">
                                    <textarea name="message" required class="w-100 form-control border-0 py-3" rows="6" cols="10" placeholder="Message *"></textarea>
                                </div>
                                <div class="text-start">
                                    <button class="btn bg-dark text-white py-3 px-5" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

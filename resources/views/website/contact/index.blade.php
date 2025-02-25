@extends('website.layout.app')
@section('title','Contact')
@section('body')
    <style>
        /* Map container should be 100% width and maintain a responsive height */
        #map {
            width: 100%;
            height: 0;
            padding-bottom: 45%; /* 16:9 aspect ratio */
            position: relative;
        }

        /* Actual map should cover the container */
        #map iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70%;
            border: 0;
        }
    </style>
    <!-- Contact Start -->
    <div class="container-fluid position-relative py-5 mb-5">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h1 class="mb-3">Contact for any query</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
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
                                    <a class="h5" href="tel:+0123456789" target="_blank"><small class="fw-bold">{{$company->hotLine}}</small></a>
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
                <div class="col-lg-5 wow fadeIn" data-wow-delay=".3s">
                    <form action="{{route('contact.submit')}}" method="post">
                        @csrf
                        <div class="p-5 rounded"  style="background-color: {{$cms->contact_form_color}}">
                            <div class="mb-4">
                                <input type="text" name="name" required class="form-control border-0 py-3" value="{{old('name')}}" placeholder="Name *">
                            </div>
                            <div class="mb-4">
                                <input type="email" name="email" class="form-control border-0 py-3" value="{{old('email')}}" placeholder="Email">
                            </div>
                            <div class="mb-4">
                                <input type="number" name="phone" required class="form-control border-0 py-3" value="{{old('phone')}}" placeholder="Phone *">
                            </div>
                            <div class="mb-4">
                                <input type="text" name="subject" required class="form-control border-0 py-3" value="{{old('subject')}}" placeholder="Subject *">
                            </div>
                            <div class="mb-4">
                                <textarea name="message" required class="w-100 form-control border-0 py-3" rows="6" cols="10" placeholder="Message *"> {{old('message')}}</textarea>
                            </div>
                            <div class="mb-4 captcha">
                                <label for="" class="">
                                    {!! \Mews\Captcha\Facades\Captcha::img('math') !!}
                                    <button type="button" onclick="reloadCaptcha()">Reload CAPTCHA</button>
                                </label>

                                <input class="form-control my-1 border-0 py-3" type="text" name="captcha" required placeholder="Enter the result from image">
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
    <!-- Contact Start -->
    @if($cms->google_map == 1)
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 wow fadeIn" data-wow-delay=".1s">
                        <div class="rounded text-center position-relative" id="map">
                            {!! $company->map !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Contact End -->
@endsection

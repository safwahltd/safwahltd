<div class="container-fluid footer wow fadeIn" data-wow-delay=".3s"  style="background-color: {{$cms->footer_section_bg_color}}">
    <div class="container pt-5 pb-4">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                @if($cms->company_logo_footer == 1)
                    <h3 class="text-white fw-bold d-block"><span class="text-white"><img src="{{asset($company->logo)}}" style="width: 200px;" alt=""></span> </h3>
                @else
                    <h3 class="text-white fw-bold d-block"><span class="text-white">{{$company->company_name}}</span> </h3>
                @endif
                @if($cms->footer_social_link == 1)
                    <div class="d-flex hightech-link">
                        @foreach($socials as $social)
                            <a href="{{$social->url}}" target="_blank" class="btn-light nav-fill btn btn-square rounded-circle me-2"><img src="{{asset($social->icon)}}" style="width: 20px; border-radius: 100%;" alt=""></a>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="#" class="h3 text-white">Quick Link</a>
                <div class="mt-4 d-flex flex-column short-link">
                    <a href="{{route('website.index')}}#about_us" class="mb-2 text-white"><i class="fas fa-angle-right text-white me-2"></i>About us</a>
                    <a href="{{route('website.articles')}}" class="mb-2 text-white"><i class="fas fa-angle-right text-white me-2"></i>Articles</a>
                    <a href="{{route('website.contact')}}" class="mb-2 text-white"><i class="fas fa-angle-right text-white me-2"></i>Contact</a>
                    <a href="{{route('bulk.order')}}" class="mb-2 text-white"><i class="fas fa-angle-right text-white me-2"></i>Bulk Order</a>
                    <a href="{{route('become.wholesaler')}}" class="mb-2 text-white"><i class="fas fa-angle-right text-white me-2"></i>Become Wholesaler</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="#" class="h3 text-white">Keep In Touch</a>
                <div class="text-white mt-4 d-flex flex-column short-link">
                    <p class="text-light "><i class="fas fa-map-marker-alt text-white me-2"></i> {{$company->address}}</p>
                    <p class=" text-light"><i class="fas fa-phone-alt text-white me-2"></i> {{$company->hotLine}}</p>
                    <p class="text-light"><i class="fas fa-envelope text-white me-2"></i> {{$company->email}}</p>
                </div>
            </div>
        </div>
        <hr class="text-light mt-5 mb-4">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <span class="text-light">
                    All Rights Reserved By
                    <a href="{{route('website.index')}}" class="text-white">SAFWAH LIMITED</a>
                </span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <span class="text-light">Powered By <a href="{{route('website.index')}}" class="text-white">SAFWAH LIMITED</a></span>
            </div>
        </div>
    </div>
</div>

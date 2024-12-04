<div class="container-fluid" style="background-color: {{$cms->header_bg_color}}">
    <div class="container">
        <nav class="navbar navbar-dark navbar-expand-lg py-0">
            <a href="{{route('website.index')}}" class="navbar-brand">
                @if($cms->company_logo_header == 1)
                    <h3 class="text-white fw-bold d-block"><span class="text-dark"><img src="{{asset($company->logo)}}" style="width: 200px;" alt=""></span> </h3>
                @else
                    <h3 class="text-white fw-bold d-block"><span class="text-dark">{{$company->company_name}}</span> </h3>
                @endif
            </a>
            <button id="navbar-toggler" type="button" class="navbar-toggler bg-dark me-0 border-dark" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"  aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-dark"></span>
            </button>
            <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">
                <div class="navbar-nav ms-auto mx-xl-auto p-0">
                    <a href="{{route('website.index')}}" class="nav-item nav-link text-dark" style="{{ \Illuminate\Support\Facades\Request::route()->getName() =='website.index' ? 'background-color: #a89a9a':''}}; font-size: 17px">HOME</a>
                    <a href="{{route('website.index')}}#about_us" class="nav-item nav-link text-dark">ABOUT US</a>
                    <a href="{{route('website.index')}}#productSection" class="nav-item nav-link text-dark">PRODUCT</a>
                    <a href="{{route('website.articles')}}" class="nav-item active nav-link" style="{{ \Illuminate\Support\Facades\Request::route()->getName() =='website.articles' ? 'background-color: #a89a9a':''}}; font-size: 17px">ARTICLES</a>
                    <a href="{{route('bulk.order')}}" class="nav-item nav-link text-dark" style="{{ \Illuminate\Support\Facades\Request::route()->getName() =='bulk.order' ? 'background-color: #a89a9a':''}}; font-size: 17px">BULK ORDER</a>
                    <a href="{{route('become.wholesaler')}}" class="nav-item nav-link text-dark" style="{{ \Illuminate\Support\Facades\Request::route()->getName() =='become.wholesaler' ? 'background-color: #a89a9a':''}}; font-size: 17px">BECOME WHOLESALER</a>
                    <a href="{{route('website.contact')}}" class="nav-item nav-link text-dark" style="{{ \Illuminate\Support\Facades\Request::route()->getName() =='website.contact' ? 'background-color: #a89a9a':''}}; font-size: 17px">CONTACT</a>
                    <a href="{{route('website.gallery')}}" class="nav-item nav-link text-dark" style="{{ \Illuminate\Support\Facades\Request::route()->getName() =='website.gallery' ? 'background-color: #a89a9a':''}}; font-size: 17px">GALLERY</a>
{{--                    <a href="{{route('website.contact')}}" class="nav-item nav-link text-dark" style="{{ \Illuminate\Support\Facades\Request::route()->getName() =='website.contact' ? 'background-color: #a89a9a':''}}; font-size: 17px">LOGIN</a>--}}
                </div>
            </div>

        </nav>
    </div>
</div>

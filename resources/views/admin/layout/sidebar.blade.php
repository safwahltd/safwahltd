<div class="sticky bg-dark">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar bg-dark">
        <div class="side-header bg-dark">
            <a class="header-brand1 p-0 m-0" href="{{route('admin.dashboard')}}">
                <span class="header-brand-img text-white fw-bold desktop-logo">{{$company->company_name}}</span>

{{--                <span class="header-brand-img text-white fw-bold light-logo1">{{$company->company_name}}</span>--}}
                {{--<img src="{{asset($company->logo)}}" class="header-brand-img desktop-logo"
                     alt="logo">--}}
                <img src="{{asset($company->favicon)}}" class="header-brand-img toggle-logo"
                     alt="logo">
                <img src="{{asset($company->favicon)}}" class="header-brand-img light-logo" alt="logo">
{{--                <img src="{{asset($company->logo)}}" class="header-brand-img light-logo1" alt="logo">--}}
                <span class="header-brand-img light-logo1 text-white fw-bold">{{$company->company_name}}</span>
            </a><!-- LOGO -->
        </div>

        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>
            <ul class="side-menu">
                <li>
                    <h3 class="text-white">Menu</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('admin.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon text-white"
                             enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                            <path d="M19.9794922,7.9521484l-6-5.2666016c-1.1339111-0.9902344-2.8250732-0.9902344-3.9589844,0l-6,5.2666016C3.3717041,8.5219116,2.9998169,9.3435669,3,10.2069702V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h2.5h7c0.0001831,0,0.0003662,0,0.0006104,0H18c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-8.7930298C21.0001831,9.3435669,20.6282959,8.5219116,19.9794922,7.9521484z M15,21H9v-6c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2V21z M20,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2h-2v-6c-0.0018311-1.6561279-1.3438721-2.9981689-3-3h-2c-1.6561279,0.0018311-2.9981689,1.3438721-3,3v6H6c-1.1040039-0.0014038-1.9985962-0.8959961-2-2v-8.7930298C3.9997559,9.6313477,4.2478027,9.0836182,4.6806641,8.7041016l6-5.2666016C11.0455933,3.1174927,11.5146484,2.9414673,12,2.9423828c0.4853516-0.0009155,0.9544067,0.1751099,1.3193359,0.4951172l6,5.2665405C19.7521973,9.0835571,20.0002441,9.6313477,20,10.2069702V19z" />
                        </svg>
                        <span class="side-menu__label text-white">Dashboard</span>
                    </a>
                </li>
                @if(auth()->user()->hasPermission('admin core value index'))
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('admin.core.value.index')}}">
                        <i class="side-menu__icon text-white fa fa-solid fa-wand-magic-sparkles"></i>
                        <span class="side-menu__label text-white">Core Values</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hasPermission('admin concern index'))
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('admin.concern.index')}}">
                        <i class="side-menu__icon text-white fa fa-solid fa-c"></i>
                        <span class="side-menu__label text-white">Concerns</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hasPermission('admin mission index'))
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('admin.mission.index')}}">
                        <i class="side-menu__icon text-white fa fa-solid fa-m"></i>
                        <span class="side-menu__label text-white">Mission & Vision</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->hasPermission('admin product index'))
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('admin.product.index')}}">
                        <i class="side-menu__icon text-white fa fa-solid fa-product-hunt"></i>
                        <span class="side-menu__label text-white">Product</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hasPermission('admin article index'))
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon text-white fa fa-regular fa-newspaper"></i>
                        <span class="side-menu__label text-white">Articles</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="{{route('admin.article.index')}}" class="slide-item">Article</a></li>
                        <li><a href="{{route('admin.post.page.index')}}" class="slide-item">Page/Post Link</a></li>
                    </ul>
                </li>
                @endif
                @if(auth()->user()->hasPermission('admin shop index'))
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('admin.shop.index')}}">
                        <i class="side-menu__icon text-white fa fa-shop"></i>
                        <span class="side-menu__label text-white">Available Shop</span>
                    </a>
                </li>
                @endif
                {{--@if(auth()->user()->hasPermission('admin shop index'))
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon text-white fa-solid fa-address-book"></i>
                        <span class="side-menu__label text-white">Contacts</span>
                    </a>
                </li>
                @endif--}}
                @if(auth()->user()->hasPermission('admin company setting index') || auth()->user()->hasPermission('admin email setting index')
                || auth()->user()->hasPermission('admin social link index') || auth()->user()->hasPermission('admin slider index')
                || auth()->user()->hasPermission('admin about index') || auth()->user()->hasPermission('admin topbar index') || auth()->user()->hasPermission('admin cms index'))
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon text-white fa-solid fa-gear"></i>
                        <span class="side-menu__label text-white">Settings</span><i class="angle fa fa-angle-right text-white"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Company Setting</a></li>
                        @if(auth()->user()->hasPermission('admin social link index'))
                        <li><a href="{{route('admin.social.link.index')}}" class="slide-item text-white">Social Link</a></li>
                        @endif
                        @if(auth()->user()->hasPermission('admin slider index'))
                        <li><a href="{{route('admin.slider.index')}}" class="slide-item text-white">Sliders</a></li>
                        @endif
                        @if(auth()->user()->hasPermission('admin about index'))
                        <li><a href="{{route('admin.about.index')}}" class="slide-item text-white">About Us</a></li>
                        @endif
                        @if(auth()->user()->hasPermission('admin topbar index'))
                        <li><a href="{{route('admin.topbar.index')}}" class="slide-item text-white">Top Bar Text</a></li>
                        @endif
                        @if(auth()->user()->hasPermission('admin company setting index'))
                            <li><a href="{{route('admin.company.setting.index')}}" class="slide-item text-white">Company Setting</a></li>
                        @endif
                        @if(auth()->user()->hasPermission('admin email setting index'))
                            <li><a href="{{route('admin.email.setting.index')}}" class="slide-item text-white">Email Setting</a></li>
                        @endif
                        @if(auth()->user()->hasPermission('admin cms index'))
                            <li><a href="{{route('admin.cms.index')}}" class="slide-item text-white">Website CMS</a></li>
                        @endif


{{--                        <li><a href="{{route('admin.dashboard')}}" class="slide-item text-white">CMS Setting</a></li>--}}
                    </ul>
                </li>
                @endif
                @if(auth()->user()->hasPermission('admin user index') || auth()->user()->hasPermission('admin role index') || auth()->user()->hasPermission('admin permission index'))
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon text-white fa-solid fa-key"></i>
                            <span class="side-menu__label text-white">User & Access</span><i class="angle fa fa-angle-right text-white"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">User & Access</a></li>
                            @if(auth()->user()->hasPermission('admin user index'))
                            <li><a href="{{route('admin.user.index')}}" class="slide-item text-white">users</a></li>
                            @endif
                            @if(auth()->user()->hasPermission('admin role index'))
                                <li><a href="{{route('admin.role.index')}}" class="slide-item text-white">Role</a></li>
                            @endif
                            @if(auth()->user()->hasPermission('admin permission index'))
                                <li><a href="{{route('admin.permission.index')}}" class="slide-item text-white">Permission</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
            </ul>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" /></svg>
            </div>
        </div>
    </div>
</div>

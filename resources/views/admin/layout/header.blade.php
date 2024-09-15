<div class="app-header header sticky" style="background-color: rgb(44,47,62)">
    <div class="container-fluid  main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle text-white" data-bs-toggle="sidebar" href="#"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal" href="{{ route('admin.dashboard') }}">
                <img src="{{--{{ asset($websiteSetup->banner) }}--}}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{--{{ asset($websiteSetup->banner) }}--}}" class="header-brand-img light-logo1" alt="logo">
            </a>
            <!-- LOGO -->
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                        aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white fe fe-more-vertical"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex bg-dark order-lg-2">
                            <!-- SEARCH -->
                            <div class="dropdown d-flex">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout">
                                        <i class="fa text-white fa-moon"></i>
                                    </span>
                                    <span class="light-layout text-white">
                                        <i class="fa fa-sun"></i>
                                    </span>
                                </a>
                            </div>
                            <!-- Messages-->
                           {{-- <div class="dropdown d-md-flex notifications">
                                <a class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fa text-success fa-bell"></i>
                                    <span class=" pulse"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading border-bottom">
                                        <div class="d-flex">
                                            <h6 class="mt-1 mb-0 fs-15 text-dark">Notifications</h6>
                                            <div class="ms-auto">
                                                <span
                                                    class="xm-title badge bg-secondary text-white fw-normal fs-12 badge-pill">
                                                    <a href="javascript:void(0);"
                                                       class="showall-text text-white">Clear</a> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notifications-menu ps3 overflow-hidden">
                                        <a class="dropdown-item" href="chat.html">
                                            <div class="notification-each d-flex">
                                                <div class="me-3 notifyimg  bg-primary brround">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                                        <path
                                                            d="M17.4541016,11H6.5458984c-0.276123,0-0.5,0.223877-0.5,0.5s0.223877,0.5,0.5,0.5h10.9082031c0.276123,0,0.5-0.223877,0.5-0.5S17.7302246,11,17.4541016,11z M19.5,2h-15C3.119812,2.0012817,2.0012817,3.119812,2,4.5v11c0.0012817,1.380188,1.119812,2.4987183,2.5,2.5h12.7930298l3.8534546,3.8535156C21.2402344,21.9473267,21.3673706,22,21.5,22c0.276123,0,0.5-0.223877,0.5-0.5v-17C21.9987183,3.119812,20.880188,2.0012817,19.5,2z M21,20.2929688l-3.1464844-3.1464844C17.7597656,17.0526733,17.6326294,17,17.5,17h-13c-0.828064-0.0009155-1.4990845-0.671936-1.5-1.5v-11C3.0009155,3.671936,3.671936,3.0009155,4.5,3h15c0.828064,0.0009155,1.4990845,0.671936,1.5,1.5V20.2929688z M17.4541016,8H6.5458984c-0.276123,0-0.5,0.223877-0.5,0.5s0.223877,0.5,0.5,0.5h10.9082031c0.276123,0,0.5-0.223877,0.5-0.5S17.7302246,8,17.4541016,8z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="notification-label mb-1">New Message Received</span>
                                                    <span class="notification-subtext text-muted">2 hours ago</span>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="chat.html">
                                            <div class="notification-each d-flex">
                                                <div class="me-3 notifyimg  bg-secondary brround">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                                        <path
                                                            d="M17.5078125,22.9736328h-12.5c-2.2081909-0.0023804-3.9976196-1.7918091-4-4v-8.5c0-0.276123-0.223877-0.5-0.5-0.5s-0.5,0.223877-0.5,0.5v8.5c0.0032349,2.7600708,2.2399292,4.9967651,5,5h12.5c0.276123,0,0.5-0.223877,0.5-0.5S17.7839355,22.9736328,17.5078125,22.9736328z M21.0078125,3.9736328h-14c-1.6561279,0.0018311-2.9981689,1.3438721-3,3v10c0.0018311,1.6561279,1.3438721,2.9981689,3,3h14c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-10C24.0059814,5.3175049,22.6639404,3.9754639,21.0078125,3.9736328z M7.0078125,4.9736328h14c0.3700562,0.0004883,0.7122192,0.1081543,1.0094604,0.2835693l-6.9489136,6.9489136c-0.5864868,0.5839844-1.534668,0.5839844-2.1210938,0L5.9985962,5.256958C6.2957764,5.081665,6.6378784,4.9740601,7.0078125,4.9736328z M23.0078125,16.9736328c-0.0014038,1.1039429-0.8959961,1.9985352-2,2h-14c-1.1040649-0.0012817-1.9987183-0.8959351-2-2v-10c0.0004272-0.3701782,0.1082153-0.7124634,0.2836914-1.0097656l6.9487305,6.9492188c0.4683838,0.4692993,1.1045532,0.7325439,1.7675781,0.7314453c0.6630249,0.0010986,1.2991333-0.262146,1.7675781-0.7314453l6.9488525-6.9489136c0.175415,0.2972412,0.2830811,0.6394043,0.2835693,1.0094604V16.9736328z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="notification-label mb-1">New Mail Received</span>
                                                    <span class="notification-subtext text-muted">1 week ago</span>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="cart.html">
                                            <div class="notification-each d-flex">
                                                <div class="me-3 notifyimg  bg-info brround">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                                        <path
                                                            d="M19.5,7H16V5.9169922c0-2.2091064-1.7908325-4-4-4s-4,1.7908936-4,4V7H4.5C4.4998169,7,4.4996338,7,4.4993896,7C4.2234497,7.0001831,3.9998169,7.223999,4,7.5V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h10c1.6561279-0.0018311,2.9981689-1.3438721,3-3V7.5c0-0.0001831,0-0.0003662,0-0.0006104C19.9998169,7.2234497,19.776001,6.9998169,19.5,7z M9,5.9169922c0-1.6568604,1.3431396-3,3-3s3,1.3431396,3,3V7H9V5.9169922z M19,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H7c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V8h3v2.5C8,10.776123,8.223877,11,8.5,11S9,10.776123,9,10.5V8h6v2.5c0,0.0001831,0,0.0003662,0,0.0005493C15.0001831,10.7765503,15.223999,11.0001831,15.5,11c0.0001831,0,0.0003662,0,0.0006104,0C15.7765503,10.9998169,16.0001831,10.776001,16,10.5V8h3V19z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="notification-label mb-1">New Order Received</span>
                                                    <span class="notification-subtext text-muted">1 day ago</span>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="blog-details.html">
                                            <div class="notification-each d-flex">
                                                <div class="me-3 notifyimg  bg-warning brround">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                                        <path
                                                            d="M8,13c-0.276123,0-0.5,0.223877-0.5,0.5v2c0,0.0001831,0,0.0003662,0,0.0005493C7.5001831,15.7765503,7.723999,16.0001831,8,16c0.0001831,0,0.0003662,0,0.0006104,0C8.2765503,15.9998169,8.5001831,15.776001,8.5,15.5v-2C8.5,13.223877,8.276123,13,8,13z M12,10c-0.276123,0-0.5,0.223877-0.5,0.5v5c0,0.0001831,0,0.0003662,0,0.0005493C11.5001831,15.7765503,11.723999,16.0001831,12,16c0.0001831,0,0.0003662,0,0.0006104,0c0.2759399-0.0001831,0.4995728-0.223999,0.4993896-0.5v-5C12.5,10.223877,12.276123,10,12,10z M19.4152832,5.2902832c-3.7055054-4.09552-10.02948-4.4117432-14.125-0.7062988c-4.09552,3.7055054-4.4117432,10.02948-0.7062988,14.125l-2.4375,2.4375c-0.09375,0.09375-0.1464233,0.2208862-0.1464233,0.3534546C2,21.776062,2.223877,21.999939,2.5,22H12c2.4794312-0.000061,4.8704224-0.9212646,6.7089844-2.5847168C22.8045654,15.7097778,23.1207275,9.3858032,19.4152832,5.2902832z M12,21H3.7069702l1.928772-1.9287109c0.000061-0.000061,0.0001221-0.0001221,0.0001221-0.0001831c0.1951904-0.1952515,0.1951294-0.5117188-0.0001221-0.7068481C3.9483643,16.6768799,3.0002441,14.3883667,3,12.0020142c-0.0005493-4.9700317,4.0279541-8.9994507,8.9979858-9c4.9699707-0.0005493,8.9994507,4.0279541,9,8.9979858C20.9985352,16.9699707,16.9700317,20.9994507,12,21z M16,8c-0.276123,0-0.5,0.223877-0.5,0.5v7c0,0.0001831,0,0.0003662,0,0.0005493C15.5001831,15.7765503,15.723999,16.0001831,16,16c0.0001831,0,0.0003662,0,0.0006104,0c0.2759399-0.0001831,0.4995728-0.223999,0.4993896-0.5v-7C16.5,8.223877,16.276123,8,16,8z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="notification-label mb-1">New Comment Received</span>
                                                    <span class="notification-subtext text-muted">1 day ago</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <div class="text-center p-3">
                                        <a class="btn btn-primary">View All Notifications</a>
                                    </div>
                                </div>
                            </div>--}}
                            <!-- NOTIFICATIONS -->
                            <div class="dropdown py-1 d-md-flex profile-1">
                                <a href="#" data-bs-toggle="dropdown"
                                   class="nav-link pe-2 leading-none d-flex animate">
                                    <span>
                                        <img src="{{asset('/')}}safwah.jpeg" alt="" class="avatar  profile-user brround cover-image">
                                    </span>
                                    <div class="text-center p-1 d-flex">
                                        <p class="mb-0 text-white" id="">{{ auth()->user()->name ?? '' }} <i class="user-angle ms-1 text-white-lg fa fa-angle-down "></i></p>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                                    <a class="dropdown-item" href="{{--{{ route('admin.profile') }}--}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-inner-icn"
                                             enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                            <path
                                                d="M14.6650391,13.3672485C16.6381226,12.3842773,17.9974365,10.3535767,18,8c0-3.3137207-2.6862793-6-6-6S6,4.6862793,6,8c0,2.3545532,1.3595581,4.3865967,3.3334961,5.3690186c-3.6583862,1.0119019-6.5859375,4.0562134-7.2387695,8.0479736c-0.0002441,0.0013428-0.0004272,0.0026855-0.0006714,0.0040283c-0.0447388,0.272583,0.1399536,0.5297852,0.4125366,0.5745239c0.272522,0.0446777,0.5297241-0.1400146,0.5744629-0.4125366c0.624939-3.8344727,3.6308594-6.8403931,7.465332-7.465332c4.9257812-0.8027954,9.5697632,2.5395508,10.3725586,7.465332C20.9594727,21.8233643,21.1673584,21.9995117,21.4111328,22c0.0281372,0.0001831,0.0562134-0.0021362,0.0839844-0.0068359h0.0001831c0.2723389-0.0458984,0.4558716-0.303833,0.4099731-0.5761719C21.2677002,17.5184937,18.411377,14.3986206,14.6650391,13.3672485z M12,13c-2.7614136,0-5-2.2385864-5-5s2.2385864-5,5-5c2.7600708,0.0032349,4.9967651,2.2399292,5,5C17,10.7614136,14.7614136,13,12,13z" />
                                        </svg>
                                        Profile
                                    </a>
                                    <form class="dropdown-item" action="{{ route('admin.logout') }}" method="post">
                                        @csrf
                                        <button type="submit" onclick="return confirm('are you sure to logout ?')"
                                                class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('backend/assets/images/logo-sm.png')}}" alt="logo-sm" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{asset('backend/assets/images/logo-dark.png')}}" alt="logo-dark" height="20">
                                </span>
                </a>

                <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('backend/assets/images/logo-sm.png')}}" alt="logo-sm-light" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{asset('backend/assets/images/logo-light.png')}}" alt="logo-light" height="20">
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form>

            {{--Mega Menu--}}
            {{--<div class="dropdown dropdown-mega d-none d-lg-block ms-2">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                    Mega Menu
                    <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu dropdown-megamenu">
                    <div class="row">
                        <div class="col-sm-8">

                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="font-size-14">UI Components</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);">Lightbox</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Range Slider</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Sweet Alert</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Rating</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Forms</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Tables</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Charts</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <h5 class="font-size-14">Applications</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);">Ecommerce</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Calendar</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Email</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Projects</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Tasks</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Contacts</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <h5 class="font-size-14">Extra Pages</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);">Light Sidebar</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Compact Sidebar</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Horizontal layout</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Maintenance</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Coming Soon</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Timeline</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">FAQs</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="font-size-14">UI Components</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);">Lightbox</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Range Slider</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Sweet Alert</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Rating</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Forms</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Tables</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Charts</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-5">
                                    <div>
                                        <img src="{{asset('backend/assets/images/megamenu-img.png')}}" alt="megamenu-img" class="img-fluid mx-auto d-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>--}}
        </div>

        <div class="d-flex">







            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>



            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{asset('backend/assets/images/users/avatar-1.jpg')}}"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">Julia</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> My Wallet</a>
                    <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end mt-1">11</span><i class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock screen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{route('admin.logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                    {{--<a class="dropdown-item text-danger" href="{{route('logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>--}}
                </div>
            </div>


        </div>
    </div>
</header>

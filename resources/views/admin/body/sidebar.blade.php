<div class="vertical-menu">

    <div data-simplebar class="h-100">


        @php
            $id = \Illuminate\Support\Facades\Auth::user()->id;
            $admin_data=\App\Models\User::find($id);
        @endphp
        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img
                    src="{{ empty($admin_data->profile_image) ? url('upload/no_image.jpg') : url('upload/admin_images/'.$admin_data->profile_image) }}"
                    alt=""
                    class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{$admin_data->name}}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="index.html" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Calendar</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Email</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox.html">Inbox</a></li>
                        <li><a href="email-read.html">Read Email</a></li>
                    </ul>
                </li>


                {{--Home Slider Setup menu--}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Home Slider Setup</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       {{-- <li><a href="http://127.0.0.1:8000/home/slide">Home Slide</a></li>--}}
                        <li><a href="{{ route('home.slide') }}">Home Slide</a></li>

                        {{--<li><a href="{{route('home.slide')}}">Home Slide</a></li>--}}
                    </ul>
                </li>

                {{--About Setup menu--}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>About Page Setup</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="http://127.0.0.1:8000/home/slide">Home Slide</a></li>--}}
                        <li><a href="{{route('about.page')}}">About</a> </li>

                        {{--<li><a href="{{route('home.slide')}}">Home Slide</a></li>--}}
                    </ul>
                </li>

                {{--remove layout--}}

                <li class="menu-title">Pages</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Authentication</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login.html">Login</a></li>
                        <li><a href="auth-register.html">Register</a></li>
                        <li><a href="auth-recoverpw.html">Recover Password</a></li>
                        <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Utility</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter.html">Starter Page</a></li>
                        <li><a href="pages-timeline.html">Timeline</a></li>
                        <li><a href="pages-directory.html">Directory</a></li>
                        <li><a href="pages-invoice.html">Invoice</a></li>
                        <li><a href="pages-404.html">Error 404</a></li>
                        <li><a href="pages-500.html">Error 500</a></li>
                    </ul>
                </li>




            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

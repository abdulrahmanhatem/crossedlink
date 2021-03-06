<!--Top Menu Start -->
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
                {{--
            <!-- Messages-->
            <li class="dropdown custom-dropdown messages-menu">
                <a href="#" class="nav-link" data-toggle="dropdown">
                    <i class="icon-message "></i>
                    <span class="badge badge-success badge-mini rounded-circle">4</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu pl-2 pr-2">
                            <!-- start message -->
                            <li>
                                <a href="#">
                                    <div class="avatar float-left">
                                        <img src="{{asset("img/dummy/u4.png")}}"  alt="">
                                        <span class="avatar-badge busy"></span>
                                    </div>
                                    <h4>
                                        Support Team
                                        <small><i class="icon icon-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                            </li>
                            <!-- end message -->
                            <!-- start message -->
                            <li>
                                <a href="#">
                                    <div class="avatar float-left">
                                        <img src="{{asset("img/dummy/u1.png")}}"  alt="">
                                        <span class="avatar-badge online"></span>
                                    </div>
                                    <h4>
                                        Support Team
                                        <small><i class="icon icon-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                            </li>
                            <!-- end message -->
                            <!-- start message -->
                            <li>
                                <a href="#">
                                    <div class="avatar float-left">
                                        <img src="{{asset("img/dummy/u2.png")}}"  alt="">
                                        <span class="avatar-badge idle"></span>
                                    </div>
                                    <h4>
                                        Support Team
                                        <small><i class="icon icon-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                            </li>
                            <!-- end message -->
                            <!-- start message -->
                            <li>
                                <a href="#">
                                    <div class="avatar float-left">
                                        <img src="{{asset("img/dummy/u3.png")}}"  alt="">
                                        <span class="avatar-badge busy"></span>
                                    </div>
                                    <h4>
                                        Support Team
                                        <small><i class="icon icon-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                            </li>
                            <!-- end message -->
                        </ul>
                    </li>
                    <li class="footer s-12 p-2 text-center"><a href="#">See All Messages</a></li>
                </ul>
            </li>
            <!-- Notifications -->
            <li class="dropdown custom-dropdown notifications-menu">
                <a href="#" class=" nav-link" data-toggle="dropdown" aria-expanded="false">
                    <i class="icon-notifications "></i>
                    <span class="badge badge-danger badge-mini rounded-circle">4</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="header">You have 10 notifications</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li>
                                <a href="#">
                                    <i class="icon icon-data_usage text-success"></i> 5 new members joined today
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon icon-data_usage text-danger"></i> 5 new members joined today
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon icon-data_usage text-yellow"></i> 5 new members joined today
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer p-2 text-center"><a href="#">View all</a></li>
                </ul>
            </li>
            <li>
                <a class="nav-link " data-toggle="collapse" data-target="#navbarToggleExternalContent"
                aria-controls="navbarToggleExternalContent"
                aria-expanded="false" aria-label="Toggle navigation">
                    <i class=" icon-search3 "></i>
                </a>
            </li>
            <!-- Right Sidebar Toggle Button -->
            <li>
                <a class="nav-link ml-2" data-toggle="control-sidebar">
                    <i class="icon-tasks "></i>
                </a>
            </li>
            --}}
            <!-- User Account-->
            <li class="dropdown custom-dropdown user user-menu ">
                <a href="#" class="nav-link" data-toggle="dropdown">
                    @if(auth()->check())
                        @if(empty(auth()->user()->profile_image))
                            <img class="user_avatar no-b no-p" src="{{url('uploads/images/profile_images/default.jpg')}}" alt="User Image">
                        @else
                            <img class="user_avatar no-b no-p" src="{{url('uploads/images/profile_images/'.auth()->user()->profile_image)}}" alt="User Image">
                        @endif
                    @endif 
                    <i class="icon-more_vert "></i>
                </a>
                <div class="dropdown-menu p-4 dropdown-menu-right">
                   
                    <div class="row box justify-content-between">
                        <div class="col">
                            <a href="{{ url('/')}}">
                                <i class="icon-apps purple lighten-2 avatar  r-5"></i>
                                <div class="pt-1">Home</div>
                            </a>
                        </div>
                        {{--<div class="col"><a href="{{url('profiles/'.auth()->user()->id)}}">
                            <i class="icon-beach_access pink lighten-1 avatar  r-5"></i>
                            <div class="pt-1">Profile</div>
                        </a></div>--}}

                        <div class="col">
                            <a href="{{ url('logout') }}">
                                <i class="icon-perm_data_setting indigo lighten-2 avatar  r-5"></i>
                                <a class="dropdown-item" href="{{ route('logout') }}"> Log out</a>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        @endguest
    </ul>
</div>
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{trans('main.Business Register')}}</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Themesdesign" />
    
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" type="text/css">

        <!-- Fontawesom CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.css')}}" />
    
        <!--Material Icon -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/materialdesignicons.min.css')}}" />
    
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/selectize.css')}}" />
    
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/nice-select.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.css')}}" />
    
        <!-- Custom  Css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}" />
        @if (Config::get('app.locale') == 'ar')
            <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rtl.css')}}" />
        @endif
        <style>
            input{
                font-family: 'Cairo', sans-serif!important;
            }
        </style>
    </head>

    <body>
        @include('inc.home.messeges')
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div>

        <!-- Loader -->
        <div class="back-to-home rounded d-none d-sm-block">
            <a href="{{ url('/') }}" class="text-white rounded d-inline-block text-center"><i class="mdi mdi-home"></i></a>
        </div>

        <!-- Hero Start -->
        <section class="vh-100 login-background" style="background: url({{ asset('assets/images/header-3.jpg')}}) left top;background-size: 100% 120%">
            <div class="home-center">
                <div class="home-desc-center register">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-7 col-lg-9 col-md-11">
                                <div class="login_page bg-white shadow rounded p-4">
                                    <div class="text-center">
                                    <h4 class="mb-4">{{trans('main.Sign Up')}}</h4>
                                    </div>
                                    <div class="row justify-content-center  login-form">
                                        <div class="col-lg-9 text-center mt-4 pt-2">
                                            <ul class="nav nav-pills nav nav-pills bg-white rounded nav-justified flex-column flex-sm-row" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                <a class="nav-link rounded active" id="featured-job-tab" data-toggle="pill" href="#person-register" role="tab" aria-controls="person-register" aria-selected="false">{{trans('main.Personal')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link rounded" id="recent-job-tab" data-toggle="pill" href="#company-register" role="tab" aria-controls="recent-job" aria-selected="true">{{trans('main.Company')}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="tab-content mt-2" id="pills-tabContent">
                                                @include('inc.home.messeges-alert')
                                                <div class="tab-pane fade" id="company-register" role="tabpanel" aria-labelledby="company-register-tab">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <form method="POST" action="{{ route('register') }}" class="needs-validation login-form">
                                                                @csrf 
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group position-relative">                          
                                                                        <input class="form-control form-control-lg"  id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" required autocomplete="company_name" autofocus  placeholder="{{trans('main.Company Name')}}">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-6">
                                                                        <div class="form-group position-relative">                                     
                                                                            <input class="form-control form-control-lg"  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus  placeholder="{{trans('main.Email')}}">
                                                                        </div>
                                                                    </div>
                                                                    {{--  <div class="col-md-6">
                                                                        <div class="form-group position-relative">                                               
                                                                            <label>Company Phone<span class="text-danger">*</span></label>
                                                                            <input class="form-control form-control-lg"  id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone" autofocus  placeholder="Company Phone">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group position-relative">                                               
                                                                            <label>Company Website<span class="text-secondary"> (optional)</span></label>
                                                                            <input class="form-control form-control-lg"  id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" required autocomplete="website" autofocus  placeholder="Company Website">
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" value="2" name="role" hidden>

                                                                </div>
                                                                    <h5 class="mb-4">Contact Information</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group position-relative">                                               
                                                                                <label>First name <span class="text-danger">*</span></label>
                                                                                <input class="form-control form-control-lg"  id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required autocomplete="name" autofocus  placeholder="First Name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group position-relative">                                                
                                                                                <label>Last name <span class="text-danger">*</span></label>
                                                                                <input class="form-control form-control-lg"  id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" required autocomplete="name" autofocus  placeholder="Last Name">
                                                                            </div>
                                                                        </div>--}}
                                                                        <div class="col-md-6">
                                                                            <div class="form-group position-relative">
                                                                                <input class="form-control form-control-lg" placeholder="{{trans('main.Password')}}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        {{--  <div class="col-md-6">
                                                                            <div class="form-group position-relative">
                                                                                <label>Confirm Password <span class="text-danger">*</span></label>
                                                                                <input class="form-control form-control-lg" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 form-group">
                                                                            <div class="form-button">
                                                                                <label>Country <span class="text-danger">*</span></label>
                                                                                {!! Form::select('country', Helper::employers_countries(), '', [ 'class' => 'nice-select rounded form-control', 'placeholder' => 'Country'])!!}

                                                                            </div>
                                                                        </div>--}}
                                                                        
                                                                
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="custom-control m-0 custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                                                                    <label class="custom-control-label" for="customCheck1">
                                                                                        {{trans('main.I Accept')}}
                                                                                        <span >
                                                                                            <a href="{{url('policy')}}" class="text-primary" target="_blank">
                                                                                                {{trans('main.Terms And Condition')}}
                                                                                            </a>   
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                        <button type="submit" class="btn btn-primary w-100 login-button my-2" value="Register" name="company">{{trans('main.Register')}}</button>
                                                                        <div class="row">
                                                                            <div class="col-md-4 col-sm-12 google">
                                                                                <div class="form-group position-relative">                                         
                                                                                   <button class="form-control">
                                                                                        <div class="icon d-inline-block ">
                                                                                            <i class="fab fa-google"></i>
                                                                                        </div>
                                                                                        @php 
                                                                                        $google_url = url('/redirectg/2?role=2')
                                                                                        @endphp
                                                                                        <div class="text d-inline-block" onclick="return social_login_popup('{{$google_url}}')">
                                                                                            {{ trans('main.Sign in with Google') }}
                                                                                        </div>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-12 facebook">
                                                                                <div class="form-group position-relative">                                         
                                                                                     <button class="form-control">
                                                                                        <div class="icon d-inline-block ">
                                                                                            <i class="fab fa-facebook-f"></i>
                                                                                        </div>
                                                                                        @php 
                                                                                        $facbookurl = url('/redirect/2?role=2')
                                                                                        @endphp
                                                                                    <div class="text d-inline-block" onclick="return social_login_popup('{{$facbookurl}}')">
                                                                                          {{ trans('main.Sign in with Facebook') }}  
                                                                                    </div>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-12 apple">
                                                                                <div class="form-group position-relative">                                         
                                                                                    <button class="form-control">
                                                                                        <div class="icon d-inline-block ">
                                                                                    <i class="fab fa-twitter"></i>
                                                                                </div>
                                                                                @php 
                                                                                    $twitter_url = url('/twitter/redirect/2?role=2')
                                                                                @endphp
                                                                                <div class="text d-inline-block" onclick="return social_login_popup('{{$twitter_url}}')">
                                                                                    {{ trans('main.Sign in with Twitter') }}
                                                                                </div>
                                                                                
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    
                                                                    
                                                                    </div>
                                                                </form>
                                                                <!--<div class="col-lg-12 mt-4 text-center">
                                                                    <h6>Or Signup With</h6>
                                                                    <ul class="list-unstyled social-icon mb-0 mt-3">
                                                                        <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="Facebook"></i></a></li>
                                                                        <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-google-plus" title="Google"></i></a></li>
                                                                        <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-github-circle" title="Github"></i></a></li>
                                                                    </ul>
                                                                </div>-->
                                                                <div class="mx-auto">
                                                                    <p class="mb-0 mt-3"><small class="text-dark mr-2">{{ trans('main.Already have an account ?') }}</small> <a href="{{ url('login') }}" class="text-dark font-weight-bold">{{ trans('main.Sign In') }}</a></p>
                                                                </div>
                                                        </div>
                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show active" id="person-register" role="tabpanel" aria-labelledby="person-register-tab">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <form method="POST" action="{{ route('register') }}" class="needs-validation login-form">
                                                              
                                                                @csrf 
                                                                <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group position-relative">                        
                                                                        <input class="form-control form-control-lg"  id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required autocomplete="name" autofocus  placeholder="{{trans('main.First Name')}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group position-relative">                        
                                                                        <input class="form-control form-control-lg"  id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" required autocomplete="name" autofocus  placeholder="{{trans('main.Last Name')}}">
                                                                    </div>
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <div class="form-group position-relative">
                                                                        <input class="form-control form-control-lg" placeholder="{{trans('main.Email')}}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                                    </div>
                                                                </div>
                                                                
                                                                {{--  <div class="col-md-6 form-group">
                                                                    <div class="form-button">
                                                                        <label>Country <span class="text-danger">*</span></label>
                                                                        {!! Form::select('country', Helper::employers_countries(), '', [ 'class' => 'nice-select rounded form-control', 'placeholder' => 'Country'])!!}

                                                                    </div>
                                                                </div>--}}

                                                                <div class="col-md-6">
                                                                    <div class="form-group position-relative">
                                                                        <input class="form-control form-control-lg" placeholder="{{trans('main.Password')}}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                                    </div>
                                                                </div>
                                                                
                                                                {{-- <div class="col-md-6">
                                                                    <div class="form-group position-relative">
                                                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                                                        <input class="form-control form-control-lg" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                                                    </div>
                                                                </div> --}}
                                                                
                                                            
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="custom-control m-0 custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck2" required>
                                                                            <label class="custom-control-label" for="customCheck2">
                                                                                {{trans('main.I Accept')}}
                                                                                <span >
                                                                                    <a href="{{url('policy')}}" class="text-primary" target="_blank">
                                                                                        {{trans('main.Terms And Condition')}}
                                                                                    </a>   
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-primary w-100 login-button my-2" value="Register" name="personal">{{trans('main.Register')}}</button>
                                                                </div>
                                                                <!--<div class="col-lg-12 mt-4 text-center">
                                                                    <h6>Or Signup With</h6>
                                                                    <ul class="list-unstyled social-icon mb-0 mt-3">
                                                                        <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="Facebook"></i></a></li>
                                                                        <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-google-plus" title="Google"></i></a></li>
                                                                        <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-github-circle" title="Github"></i></a></li>
                                                                    </ul>
                                                                </div>-->
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-12 google">
                                                                        <div class="form-group position-relative">                                         
                                                                            <button class="form-control">
                                                                                <div class="icon d-inline-block ">
                                                                                    <i class="fab fa-google"></i>
                                                                                </div>
                                                                                @php 
                                                                                    $google_url = url('/redirectg/1?role=1')
                                                                                @endphp
                                                                                <div class="text d-inline-block" onclick="return social_login_popup('{{$google_url}}')">
                                                                                    {{ trans('main.Sign in with Google') }}
                                                                                </div>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4 col-sm-12 facebook">
                                                                        <div class="form-group position-relative">                                         
                                                                            <button class="form-control">
                                                                                <div class="icon d-inline-block ">
                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                </div>
                                                                                @php 
                                                                                    $facbookurl = url('/redirect/1?role=1')
                                                                                @endphp
                                                                                <div class="text d-inline-block" onclick="return social_login_popup('{{$facbookurl}}')">
                                                                                   {{ trans('main.Sign in with Facebook') }}
                                                                                </div>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4 col-sm-12 apple">
                                                                        <div class="form-group position-relative">                                         
                                                                           <button class="form-control">
                                                                                <div class="icon d-inline-block ">
                                                                                    <i class="fab fa-twitter"></i>
                                                                                </div>
                                                                                @php 
                                                                                    $twitter_url = url('/twitter/redirect/1?role=1')
                                                                                @endphp
                                                                                <div class="text d-inline-block" onclick="return social_login_popup('{{$twitter_url}}')">
                                                                                    {{ trans('main.Sign in with Twitter') }}
                                                                                </div>
                                                                                
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="mx-auto">
                                                                        <p class="mb-0 mt-3"><small class="text-dark mr-2">{{ trans('main.Already have an account ?') }}</small> <a href="{{ url('login') }}" class="text-dark font-weight-bold">{{ trans('main.Sign In') }}</a></p>
                                                                    </div>
                                                                </div>
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
                    </div> <!--end col-->
                </div><!--end row-->
            </div> <!--end container-->
        </div>
    </div>
</section><!--end section-->
                <!-- Hero End -->

                <!-- javascript -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('assets/js/plugins.js')}}"></script>

<!-- selectize js -->
<script src="{{asset('assets/js/selectize.min.js')}}"></script>

<script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>

<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>

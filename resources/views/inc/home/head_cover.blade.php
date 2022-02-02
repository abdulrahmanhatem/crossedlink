<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title> 
            Crossed Link
            @isset($title)
            - {{ $title }}
            @endisset
        </title> 
     <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="userId" content="{{ Auth::check() ?  Auth::user()->id:'' }}">

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Themesdesign" />

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    @include('inc.home.styles')
</head>
@auth
<body class="fixed-pages">
    <button onclick="notifyMe()" class="notify" style="border-radius: 50%;width: 50px;height: 50px;background: #ff9200;left: 40px;position: fixed;bottom: 17px;z-index: 9999;cursor: pointer;border: 0;box-shadow: 3px 6px 13px #88888899;"><i class="fa fa-bell" style="
    color: #fff !important;
    margin: -7px;
    font-size: larger;
    vertical-align: middle;
"></i>
</button>
@endauth

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

    <!-- Navigation Bar-->
    <header id="topnav" class="defaultscroll scroll-active not-fi-cation">

        <audio id="ChatAudio">
          <source src="{{ asset('sounds/chat.mp3') }}">
        </audio>
        
        @include('inc.home.header-content')

    </header><!--end header-->
    <!-- Navbar End -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="4000">
        <div class="carousel-inner">
            
          <div class="carousel-item active">
              <div class="bg-over"></div>
            <img src="{{ asset('assets/images/header.jpg')}}" class="d-block w-100" alt="...">
            {{--<div class="carousel-caption d-none d-md-block">
                <h6 class="small-title text-uppercase text-light mb-3">{{ trans('main.Find jobs, create trackable resumes and enrich your applications.')}}</h6>
                <h1 class="heading font-weight-bold mb-4">{{ trans('main.The Easiest Way to Get Your New Job.')}}</h1>
                @if(!auth()->check())
                  <!--<a href="{{url('/employer/register')}}" class="btn btn-primary">{{trans('main.Employer')}}</a>-->
                  <a href="{{url('/register')}}" class="btn btn-danger">{{trans('main.Register')}}</a>
                @endif
                
            </div>--}}
          </div>
          <div class="carousel-item">
            <div class="bg-over"></div>
            <img src="{{ asset('assets/images/header-3.jpg')}}" class="d-block w-100" alt="...">
            {{--<div class="carousel-caption d-none d-md-block">
                <h6 class="small-title text-uppercase text-light mb-3">{{ trans('main.Find Candidates, create Job details and enrich your Candidates.')}}</h6>
                <h1 class="heading font-weight-bold mb-4">{{ trans('main.The Easiest Way to Get Your New Candidate.')}}</h1> 
                @if(!auth()->check())
                  <!--<a href="{{url('/employer/register')}}" class="btn btn-primary">{{trans('main.Employer')}}</a>-->
                  <a href="{{url('/register')}}" class="btn btn-danger">{{trans('main.Register')}}</a>
                @endif
            </div>--}}
          </div>
          <div class="carousel-item">
            <div class="bg-over"></div>
            <img src="{{ asset('assets/images/header-2.jpg')}}" class="d-block w-100" alt="...">
            {{--<div class="carousel-caption d-none d-md-block">
                <h6 class="small-title text-uppercase text-light mb-3">{{ trans('main.Find Candidates, create Job details and enrich your Candidates.')}}</h6>
                <h1 class="heading font-weight-bold mb-4">{{ trans('main.The Easiest Way to Get Your New Candidate.')}}</h1> 
                @if(!auth()->check())
                  <!--<a href="{{url('/employer/register')}}" class="btn btn-primary">{{trans('main.Employer')}}</a>-->
                  <a href="{{url('/register')}}" class="btn btn-danger">{{trans('main.Register')}}</a>
                @endif
            </div>--}}
          </div>
          <div class="row justify-content-center slider-text">
            <div class="col-lg-12">
                <div class="title-heading text-center text-white">
                    @if(auth()->check())
                        @if (auth()->user()->role == 0)
                          <h6 class="small-title text-uppercase text-light mb-3">{{ trans('main.The Easiest Way to Find Your Ideal Employee or Employer')}}</h6>
                          <h1 class="heading font-weight-bold mb-4">{{ trans('main.We Link with a Click')}}</h1>
                        @elseif(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 3)
                          <h6 class="small-title text-uppercase text-light mb-3">{{ trans('main.The Easiest Way to Find Your Ideal Employee or Employer')}}</h6>
                          <h1 class="heading font-weight-bold mb-4">{{ trans('main.We Link with a Click')}}</h1>
                        @endif
                    @else 
                      <h6 class="small-title text-uppercase text-light mb-3">{{ trans('main.The Easiest Way to Find Your Ideal Employee or Employer')}}</h6>
                      <h1 class="heading font-weight-bold mb-4">{{ trans('main.We Link with a Click')}}</h1>
                      <!--<a href="{{url('/employer/register')}}" class="btn btn-primary">{{trans('main.Employer')}}</a>-->
                      <a href="{{url('/register')}}" class="btn btn-danger">{{trans('main.Register')}}</a>
                    @endif
                </div>
            </div>
        </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
       
      </div>
      
      
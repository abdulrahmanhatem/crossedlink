<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> 
        @isset($title)
        {{ $title }}
        @endisset
    </title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Themesdesign" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="userId" content="{{ Auth::check() ?  Auth::user()->id:'' }}">


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    @include('inc.home.styles')

</head>

<body class="all-body" >
    <button onclick="notifyMe()" class="notify" style="border-radius: 50%;width: 50px;height: 50px;background: #ff9200;left: 40px;position: fixed;bottom: 17px;z-index: 9999;cursor: pointer;border: 0;box-shadow: 3px 6px 13px #88888899;"><i class="fa fa-bell" style="
    color: #fff !important;
    margin: -7px;
    font-size: larger;
    vertical-align: middle;
">
</i>
</button>

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
    
    <header id="topnav" class="defaultscroll scroll-active all-pages not-fi-cation head-error">

        <audio id="ChatAudio">
            <source src="{{ asset('sounds/chat.mp3') }}">
        </audio>

        @include('inc.home.header-content')
        
    </header><!--end header-->
    <!-- Navbar End -->
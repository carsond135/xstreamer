<?php
    $config = GetSiteConfig();
    $get_banip = CheckBanIP();
    $check_watch = CheckWatchingVideo();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="keywords" content="{{ $config->site_keyword }}" />
        @if (isset($viewvideo))
        <meta name="description" content="{{ str_limit($viewvideo->description, 170) }}" />
        <meta property="og:url" content="{{URL('watch').'/'.$viewvideo->string_Id.'/'.$viewvideo->post_name.'.html'}}" />
        <meta property="og:description" content="{{ str_limit($viewvideo->description, 170) }}" />
        <meta property="og:image" content="{{ $viewvideo->poster }}" />
        @else
        <meta name="description" content="{{ $config->site_description }}" />
        <meta property="og:url" content="{{ URL() }}" />
        <meta property="og:description" content="{{ $config->site_description }}" />
        <meta property="og:image" content="{{ URL('public/assets/images/logo.png') }}" />
        @endif
        <meta property="og:type" content="{{$config->site_name}}" />
        <meta property="og:title" content="@yield('title')" />
        <title>@yield('title') | {{$config->site_name}}</title>

        <link href="{{URL::asset('public/upload/site/logo.png')}}" rel="icon" type="image/png" />
        <link href="{{URL::asset('public/assets/font-awesome-4.3.0/css/font-awesome.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('public/assets/font-end/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/css/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/css/jquery.raty.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/css/uploadify.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/css/bonsai.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/font-end/brick.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/font-end/reponsive.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/css/jquery.tagsinput.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/font-end/custom-style.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/css/ticker.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/css/uploadfile.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.0.0/animate.min.css" rel="stylesheet" />
        <link href="{{URL::asset('public/assets/css/blueimp-gallery.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/css/bootstrap-image-gallery.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('public/assets/font-end/styles.css?v='.time())}}" rel="stylesheet" type="text/css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{URL::asset('public/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/js/jquery.bootstrap.newsbox.js')}}"></script>
        <script src="{{URL::asset('public/assets/js/jquery.uploadfile.js')}}"></script>
        <script src="{{URL::asset('public/assets/js/jquery.blueimp-gallery.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/js/bootstrap-image-gallery.js')}}"></script>
        <script src="{{URL::asset('public/assets/js/jquery.tagsinput.js')}}"></script>
        <script src="{{URL::asset('public/assets/js/select2.min.js')}}"></script>
        <script src="{{URL('public/assets/js/modernizr.dev.js')}}"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        @include('header.header')
        
        @yield('content')

        @include('footer.footer')
    </body>
</html>
@php($setting = \App\library\Settings::getSeetingWithDescription())
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="copyright" content="&amp;copy; 2000-<?php echo date('Y').' '.\App\library\Settings::getSettings()->name;?>">
    <meta name="keywords" content="{{ config('app.meta_keyword') }}">
    <meta name="description" content="{{ config('app.meta_description') }}">
    <meta property="og:url"  content="{{ config('app.meta_url') }}" />
    <meta property="og:type"  content="{{ config('app.meta_type') }}" />
    <meta property="og:title"  content="{{ config('app.meta_title') }}" />
    <meta property="og:description" content="{{ config('app.meta_description') }}" />
    <meta property="og:image"       content="{{ config('app.meta_image') }}" />
    <meta name='robots' content='index,follow' />
    <meta name="theme-color" content="#002A5B">
    <?php
    $icon = \App\library\Settings::getIcon();
    if(!empty($icon)) { ?>
    <link rel="shortcut icon" type="image/png" href="{{ asset($icon) }}" class="lazyload"/>
    <?php }?>
    <link rel="stylesheet" href="{{asset('/css/default/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('/css/default/animate.css')}}">
    <link rel="stylesheet" href="{{asset('/css/default/icofont.css')}}">
    <link rel="stylesheet" href="{{asset('/css/default/meanmenu.css')}}">
    <link rel="stylesheet" href="{{asset('/css/default/owl.css')}}">
    <link rel="stylesheet" href="{{asset('/css/default/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('/css/default/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/default/responsive.css')}}">
    <title>{{ config('app.meta_title') }}</title>
    <style>
        .navbar-brand img {
            max-height: 40px !important;
        }
    </style>
    @yield('stylesheet')
    @yield('styles')
</head>
<body>
    <header class="header-area">
        @include('front/common/top_header')
        @include('front/common/navbar_area')
       @yield('header')
    </header>

  @yield('content')
    <footer class="footer-area">
        <div class="copyright-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <p>Copyright © 2019 <a href="#" target="_blank">{{$setting['description']->name}}</a>. All Rights Reserved.</p>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <div class="go-top" style="display: none;"><i class="icofont-swoosh-up"></i></div>
    <script src="{{asset('/js/default/jquery_003.js')}}"></script>
    <script src="{{asset('/js/default/popper.js')}}"></script>
    <script src="{{asset('/js/default/bootstrap.js')}}"></script>
    <script src="{{asset('/js/default/jquery_004.js')}}"></script>
    <script src="{{asset('/js/default/mixitup.js')}}"></script>
    <script src="{{asset('/js/default/owl.js')}}"></script>
    <script src="{{asset('/js/default/jquery.js')}}"></script>
    <script src="{{asset('/js/default/form-validator.js')}}"></script>
    <script src="{{asset('/js/default/contact-form-script.js')}}"></script>
    <script src="{{asset('/js/default/jquery_002.js')}}"></script>
    <script src="{{asset('/js/default/main.js')}}"></script>
    @yield('javascript')
@yield('scripts')
</body>
</html>

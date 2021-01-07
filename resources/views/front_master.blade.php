@include('/front/common/header')
@yield('stylesheet')
@yield('styles')
<body id="bd" class="homepage">
    @include('/front/common/mobile_menu')

    <div class="mm-page">
        <div id="yt_wrapper" class=" ">
        @include('front/common/secondary_header')
            <nav id="yt_header" class="block">
                <div class="container">
                    <div class="row">
                        <div id="yt_logo" class="col-md-3 col-sm-6 col-xs-6">
                            <a class="logo" href="#" title="sj thedaily">
                                <img data-placeholder="no" src="{{asset('/js/logo.png')}}" alt="sj thedaily" style="width:px;height:px;">
                            </a>
                        </div>
                        <div id="search" class="col-md-9 col-sm-6 col-xs-6">
                        </div>
                    </div>
                </div>
            </nav>
            @include('/front/common/main_menu')
            @yield('content')
       @include('/front/common/footer')
        </div>
        <a id="yt-totop" class="backtotop hidden-top" href="#"><i class="fa fa-angle-up"></i></a>
    </div>


    <script type="text/javascript" async="" src="{{asset('/js/ga.js')}}"></script>
    <script src="{{asset('/js/bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/keepmenu.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/ytcpanel.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jquery_008.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/yt-script.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jquery_009.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/touchswipe.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jquery_006.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jquery_003.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/prettify.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/shortcodes.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/slider.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jsmart.js')}}" type="text/javascript"></script>

    <script src="{{asset('/js/jquery_002.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jquery_005.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jcarousel_002.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jquery_004.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/owl.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jcarousel.js')}}" type="text/javascript"></script>
    @yield('javascripts')

    <script type="text/javascript">
        function useSP(){
            jQuery(document).ready(function($){
                var width = $(window).width()+17; //alert(width);
                var events = 'click';
                if(width>767){
                    YTScript.slidePositions('#yt_sticky_right .yt-sticky', 'right', events);
                }
            });
        }

        useSP();

    </script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $(".yt-resmenu").addClass("hidden-lg hidden-md");
        });
    </script>
    <script type="text/javascript">
        jQuery(".backtotop").addClass("hidden-top");
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() === 0) {
                jQuery(".backtotop").addClass("hidden-top")
            } else {
                jQuery(".backtotop").removeClass("hidden-top")
            }
        });

        jQuery('.backtotop').click(function () {
            jQuery('body,html').animate({
                scrollTop:0
            }, 1200);
            return false;
        });
        jQuery('.dropdown-toggle').click(function(){
            jQuery(".dropdown-menu").toggle(function (){
                jQuery(".dropdown-menu").fadeIn();
            });
            });
    </script>
    @yield('scripts')
</body>
</html>

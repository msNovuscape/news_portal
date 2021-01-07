<header id="yt_spotlight1" class="block">
    <div class="container">
        <div class="row">
            <div id="top1" class="col-md-8  hidden-sm hidden-xs">
                <div id="sj_splash_1606117468471059737" class="sj-splash   slide" data-interval="5000" data-pause="hover">
                    <div class="spl-title">
                        <span class="spl-title-inner">Breaking News</span>
                    </div>
                    <div class="spl-items">
                        <div class="spl-items-inner">
                            <div class="spl-item  item" data-href="#">
										<span class="spl-item-title">
						                    <a href="#/categories-1-layout/item/239-mauris-vel-libero-sagittis-congue" title="Mauris vel libero sagittis congue">Mauris vel libero sagittis congue</a>
					                    </span>
                            </div>
                            <div class="spl-item  item active" data-href="/templates/joomla3/sj-thedaily/index.php/categories-1-layout/item/238-sed-porta-metus-at-est-suscipit-sagittis">
										<span class="spl-item-title">
                                            <a href="#/categories-1-layout/item/238-sed-porta-metus-at-est-suscipit-sagittis" title="Sed porta metus at est suscipit sagittis">
                                                Sed porta metus at est suscipit sagittis						</a>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    //<![CDATA[
                    jQuery(function($){
                        ;(function(element){
                            var $element = $(element);
                            $element.each(function(){
                                var $this = $(this), options = options = !$this.data('modal') && $.extend({}, $this.data());
                                $this.jcarousel(options);
                                $this.bind('jslide', function(e){
                                    var index = $(this).find(e.relatedTarget).index();

                                    // process for nav
                                    $('[data-jslide]').each(function(){
                                        var $nav = $(this), $navData = $nav.data(), href, $target = $($nav.attr('data-target') || (href = $nav.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, ''));
                                        if ( !$target.is($this) ) return;
                                        if (typeof $navData.jslide == 'number' && $navData.jslide==index){
                                            $nav.addClass('sel');
                                        } else {
                                            $nav.removeClass('sel');
                                        }
                                    });

                                });
                            });
                            return ;

                        })('#sj_splash_1606117468471059737');
                    });
                    //]]>
                </script>
            </div>
            <div id="top2" class="col-md-4 col-sm-12 col-xs-12">
                <div class="mod-languages me-inline">
                    <a class="dropdown-toggle">
                        <img src="{{asset('/css/en.gif')}}" alt="English " title="English ">English <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu ">
                        <li class="lang-active" dir="ltr">
                            <a href="https://demo.smartaddons.com/templates/joomla3/sj-thedaily/">
                                <img src="{{asset('/css/en.gif')}}" alt="English " title="English ">							English 											</a>
                        </li>
                        <li class="" dir="rtl">
                            <a href="#/ar/">
                                <img src="{{asset('/css/ar.gif')}}" alt="Arabic" title="Arabic">							Arabic											</a>
                        </li>
                    </ul>


                </div>

                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        var ua = navigator.userAgent,
                            _device = (ua.match(/iPad/i)||ua.match(/iPhone/i)||ua.match(/iPod/i)) ? "smartphone" : "desktop";

                        if(_device == "desktop") {
                            $(".mod-languages").bind('hover', function() {
                                $(this).children(".dropdown-toggle").addClass(function(){
                                    if($(this).hasClass("open")){
                                        $(this).removeClass("open");
                                        return "";
                                    }
                                    return "open";
                                });
                                $(this).children(".dropdown-menu").stop().slideToggle(350);

                            }, function(){
                                $(this).children(".dropdown-menu").stop().slideToggle(350);
                            });
                        }else{
                            $('.mod-languages .dropdown-toggle').bind('touchstart', function(){
                                $('.mod-languages .dropdown-menu').stop().slideToggle(350);
                            });
                        }
                    });
                </script>
            </div>

        </div>
    </div>

</header>

<div class="navbar-area">
    <div class="sinmun-mobile-nav">
        <div class="logo">
            <a href="{{url('/')}}">
                <img src="{{\App\library\Settings::getLogo()}}" alt="logo">
            </a>
        </div>
    </div>
    <div class="sinmun-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{\App\library\Settings::getLogo()}}" alt="logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent" style="display: block;">
                    <ul class="navbar-nav">
                        @php($menus = \App\Models\Menu::getFrontMenu())
                        @if(count($menus) > 0)
                        @foreach($menus as $menu)
                                @if($menu['layout_id'] == 0)
                                <li class="nav-item"><a href="#" class="nav-link">{{$menu['title']}}</a>
                                @else
                                    <li class="nav-item"><a href="{{$menu['seo_url']}}" class="nav-link">{{$menu['title']}}</a>
                                @endif
                        @if(count($menu['children']) > 0)
                            <ul class="dropdown-menu">
                                @foreach($menu['children'] as $smenu)
                                    @if($smenu['layout_id'] == 0)
                                        <li class="nav-item"><a href="#" class="nav-link">{{$smenu['title']}}</a>
                                    @else
                                        <li class="nav-item"><a href="{{$smenu['seo_url']}}" class="nav-link">{{$smenu['title']}}</a>
                                    @endif
                                    @if(count($smenu['children']) > 0)
                                    <ul class="dropdown-menu">
                                        @foreach($smenu['children'] as $children)
                                        <li class="nav-item"><a href="{{$children['seo_url']}}" class="nav-link">{{$children['title']}}</a></li>
                                        @endforeach
                                    </ul>
                                            @endif
                                </li>
                                        @endforeach
                            </ul>
                                        @endif
                        </li>
                            @endforeach
                        @endif
                    </ul>
                    {{--                            <div class="others-options">--}}
                    {{--                                <ul>--}}
                    {{--                                    <li><a href="#/login.html"><i class="icofont-user-alt-5"></i></a></li>--}}
                    {{--                                    <li class="header-search">--}}
                    {{--                                        <div class="nav-search">--}}
                    {{--                                            <div class="nav-search-button"> <i class="icofont-ui-search"></i> </div>--}}
                    {{--                                            <form>--}}
                    {{--                                                <span class="nav-search-close-button" tabindex="0">✕</span>--}}
                    {{--                                                <div class="nav-search-inner">--}}
                    {{--                                                    <input name="search" placeholder="Search here....">--}}
                    {{--                                                </div>--}}
                    {{--                                            </form>--}}
                    {{--                                        </div>--}}
                    {{--                                    </li>--}}
                    {{--                                </ul>--}}
                    {{--                            </div>--}}
                </div>
            </nav>
        </div>
    </div>
</div>

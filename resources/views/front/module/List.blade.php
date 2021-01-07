@if(count($datas['article']) > 0)
    <?php $firstarray = array_shift($datas['article']);?>
    <div class="around-the-world-news pt-40">
        <div class="section-title">
            <h2>{{$datas['title']}}</h2>
            @if($datas['menu_href'] != '')
            <a href="{{$datas['menu_href']}}" class="view-more">View More <i class="icofont-rounded-double-right"></i></a>
            @endif
        </div>
        <div class="row">
            <div class="{{$datas['class']}}">
                <div class="single-around-the-world-news">
                    <div class="news-image">
                        <a href="{{$firstarray['url']}}"><img src="{{asset($firstarray['image'])}}" alt="{{$firstarray['title']}}"></a>
                    </div>
                    <div class="news-content">
                        <ul>
                            <li><i class="icofont-calendar"></i> {{$firstarray['created_at']->format('F j, Y')}}</li>
{{--                            <li><i class="icofont-speech-comments"></i> <a href="#">50</a></li>--}}
                        </ul>
                        <h3><a href="{{$firstarray['url']}}">{{$firstarray['title']}}</a></h3>
                        <p>{{$firstarray['description']}}</p>
                    </div>
                </div>
            </div>
            @if($datas['column'] > 1)
                @php($second_array = array_shift($datas['article']))
                <div class="{{$datas['class']}}">
                    <div class="single-around-the-world-news">
                        <div class="news-image">
                            <a href="{{$second_array['url']}}"><img src="{{asset($second_array['image'])}}" alt="{{$second_array['title']}}"></a>
                        </div>
                        <div class="news-content">
                            <ul>
                                <li><i class="icofont-calendar"></i> {{$second_array['created_at']->format('F j, Y')}}</li>
                                {{--                            <li><i class="icofont-speech-comments"></i> <a href="#">50</a></li>--}}
                            </ul>
                            <h3><a href="{{$second_array['url']}}">{{$second_array['title']}}</a></h3>
                            <p>{{$second_array['description']}}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($datas['column'] > 2)
                @php($third_array = array_shift($datas['article']))
                <div class="{{$datas['class']}}">
                    <div class="single-around-the-world-news">
                        <div class="news-image">
                            <a href="{{$third_array['url']}}"><img src="{{asset($third_array['image'])}}" alt="{{$third_array['title']}}"></a>
                        </div>
                        <div class="news-content">
                            <ul>
                                <li><i class="icofont-calendar"></i> {{$third_array['created_at']->format('F j, Y')}}</li>
                                {{--                            <li><i class="icofont-speech-comments"></i> <a href="#">50</a></li>--}}
                            </ul>
                            <h3><a href="{{$third_array['url']}}">{{$third_array['title']}}</a></h3>
                            <p>{{$third_array['description']}}</p>
                        </div>
                    </div>
                </div>
            @endif
            @if($datas['column'] > 3)
                @php($fourth_array = array_shift($datas['article']))
                <div class="{{$datas['class']}}">
                    <div class="single-around-the-world-news">
                        <div class="news-image">
                            <a href="{{$fourth_array['url']}}"><img src="{{asset($fourth_array['image'])}}" alt="{{$fourth_array['title']}}"></a>
                        </div>
                        <div class="news-content">
                            <ul>
                                <li><i class="icofont-calendar"></i> {{$fourth_array['created_at']->format('F j, Y')}}</li>
                                {{--                            <li><i class="icofont-speech-comments"></i> <a href="#">50</a></li>--}}
                            </ul>
                            <h3><a href="{{$fourth_array['url']}}">{{$fourth_array['title']}}</a></h3>
                            <p>{{$fourth_array['description']}}</p>
                        </div>
                    </div>
                </div>
            @endif
            @foreach($datas['article'] as $article)
            <div class="{{$datas['class']}}">
                <div class=" media around-the-world-news-media align-items-center">
                    <a href="{{$article['url']}}" class="col-lg-2 col-md-2 col-sm-3 col-4"> <img src="{{asset($article['image'])}}" alt="{{$article['title']}}"> </a>
                    <div class="content col-lg-10 col-md-10 col-sm-9 col-8">
                        <span><i class="icofont-calendar"></i> {{$article['created_at']->format('F j, Y')}}</span>
                        <h3><a href="{{$article['url']}}">{{$article['title']}}</a></h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endif

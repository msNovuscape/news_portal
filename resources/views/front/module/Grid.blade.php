@if(count($datas['article']) > 0)
    <div class="around-the-world-news pt-40">
        <div class="section-title">
            <h2>{{$datas['title']}}</h2>
            @if($datas['menu_href'] != '')
            <a href="{{$datas['menu_href']}}" class="view-more">View More <i class="icofont-rounded-double-right"></i></a>
            @endif
        </div>
        <div class="row">
            @foreach($datas['article'] as $article)
            <div class="{{$datas['class']}}">
                <div class="single-around-the-world-news">
                    <div class="news-image">
                        <a href="{{$article['url']}}"><img src="{{asset($article['image'])}}" alt="{{$article['title']}}"></a>
                    </div>
                    <div class="news-content">
                        <ul>
                            <li><i class="icofont-calendar"></i> {{$article['created_at']->format('F j, Y')}}</li>
{{--                            <li><i class="icofont-speech-comments"></i> <a href="#">50</a></li>--}}
                        </ul>
                        <h3><a href="{{$article['url']}}">{{$article['title']}}</a></h3>
{{--                        <p>{{$article['description']}}</p>--}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endif

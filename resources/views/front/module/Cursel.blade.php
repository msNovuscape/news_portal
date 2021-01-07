@if(count($datas['article']) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="section-title">
            <h2>{{$datas['title']}}</h2>
            @if($datas['menu_href'] != '')
                <a href="{{$datas['menu_href']}}" class="view-more">View More <i class="icofont-rounded-double-right"></i></a>
            @endif
        </div>
        <div class="row">
            <div class="popular-news-slides owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        @foreach($datas['article'] as $article)
                        <div class="owl-item">
                            <div class="col-lg-12 col-md-12">
                                <div class="single-popular-news">
                                    <div class="news-image">
                                        <img src="{{asset($article['image'])}}" alt="{{$article['title']}}">
                                    </div>
                                    <div class="news-content">
                                        <h3>{{$article['title']}}</h3>
                                        <span><i class="icofont-calendar"></i> {{$article['created_at']->format('F j, Y')}}</span>
                                    </div>
                                    <a href="{{$article['url']}}" class="link-overlay"></a>
{{--                                    <div class="tags bg-3"> <a href="#">Sports</a> </div>--}}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev"><i class="icofont-rounded-left"></i></button>
                    <button type="button" role="presentation" class="owl-next"><i class="icofont-rounded-right"></i></button>
                </div>

                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </div>
</div>

@endif

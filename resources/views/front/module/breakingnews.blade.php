<div class="breaking-news">
    <div class="container">
        <div class="breaking-news-content clearfix">
            <h6 class="breaking-title"><i class="icofont-flash"></i> {{$datas['title']}}:</h6>
            <div class="breaking-news-slides owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        @foreach($datas['article'] as $article)
                        <div class="owl-item cloned">
                            <div class="single-breaking-news">
                                <p><a href="{{$article['url']}}">{{$article['title']}}</a></p>
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

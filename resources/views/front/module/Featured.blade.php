@if(count($datas['article']) > 0)
    <?php $firstarray = array_shift($datas['article']);?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="section-title"> <h2>{{$datas['title']}} <a href="{{$datas['menu_href']}}" class="view_button">View All</a> </h2> </div>
        <div class="international-news-inner">
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-international-news">
                        <div class="news-image">
                            <img src="{{asset($firstarray['image'])}}" alt="{{$firstarray['title']}}">
                        </div>
                        <div class="news-content">
                            <span><i class="icofont-calendar"></i> {{$firstarray['created_at']->format('F j, Y')}}</span>
                            <h3><a href="{{$firstarray['url']}}">{{$firstarray['title']}}</a></h3>
                            <p>{{$firstarray['description']}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="international-news-list">
                        @foreach($datas['article'] as $article)
                        <div class="row media news-media align-items-center">
                            <a class="col-lg-3 col-md-4 col-sm-4 col-4" href="{{$article['url']}}"> <img src="{{asset($article['image'])}}" alt="{{$article['title']}}"> </a>
                            <div class="content col-lg-9 col-md-8 col-sm-8 col-8">
                                <span><i class="icofont-calendar"></i> {{$article['created_at']->format('F j, Y')}}</span>
                                <h3><a href="{{$article['url']}}">{{$article['title']}}</a></h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endif

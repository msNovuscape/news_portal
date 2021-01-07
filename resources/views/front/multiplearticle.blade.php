@extends('front_master1')
@section('header')
    @if(count($datas['header_content']) > 0)
    @foreach($datas['header_content'] as $header_content)
        <?php echo $header_content['module']; ?>
    @endforeach
    @endif
@endsection
@section('content')
    @if(count($datas['top_content']) > 0)
        <section class="default-news-area ptb-15">
            <div class="container">
                @foreach($datas['top_content'] as $top_content)

                    <?php echo $top_content['module']; ?>

                @endforeach

            </div>
        </section>
    @endif

    <?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
        $class = 'col-lg-6 col-md-4 col-12 center-panel';
    } elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
        $class = 'col-md-9 col-lg-9 col-12';
    }
    elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
        $class = 'col-md-9 col-lg-9 col-12';
    } else{
        $class = 'col-md-12';
    } ?>
        <section class="default-news-area ptb-15">
            <div class="container pt-4 pb-4 bg-white">
                <div class="page-title-content">
                    <h2>{{$datas['title']}}</h2>
                    @php($total_pagination = count($datas['pagination']))
                    @if($total_pagination > 0)
                        <ul>
                            @foreach($datas['pagination'] as $key => $value)
                                @if($key == $total_pagination - 1)
                                    <li>{{$value['title']}}</li>
                                @else
                                    <li><a href="{{$value['url']}}"> {{$value['title']}}</a></li>
                                    <li><i class="icofont-rounded-right"></i></li>
                                @endif
                            @endforeach

                        </ul>
                    @endif
                </div>
                <div class="row">
                    @if (count($datas['left_content']) > 0)
                        <aside class="col-lg-3 col-md-4 col-12">
                            @foreach($datas['left_content'] as $lcontent)
                                <?php echo $lcontent['module']; ?>
                            @endforeach
                        </aside>
                    @endif
                    <div class="{{$class}}">
                        @if(count($datas['articles']) > 0)
                            @foreach($datas['articles'] as $article)
                                <div class="single-category-news">
                                    <div class="row m-0 align-items-center">
                                        <div class="col-lg-2 col-md-3 col-sm-4 p-0">
                                            <div class="category-news-image">
                                                @php($logo = $datas['logo'])
                                                @if(is_file(DIR_IMAGE.$article->image))
                                                    @php($logo = asset(\App\Models\ImageTool::mycrop($article->image, 450, 300)))
                                                @endif

                                                <a href="{{url('/article/'.$article->seo_url)}}"><img src="{{$logo}}" alt="{{$article->title}}"></a>

{{--                                                <div class="tags">--}}
{{--                                                    <a href="#">Sports</a>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>

                                        <div class="col-lg-10 col-md-9 col-sm-8">
                                            <div class="category-news-content">
                                                <span><i class="icofont-clock-time"></i> {{$article->created_at->format('F j, Y')}}</span>
                                                <h3><a href="{{url('/article/'.$article->seo_url)}}">{{$article->title}}</a></h3>
                                                <p>{{\App\library\Settings::getLimitedWords($article->description,0,$datas['description_limit'])}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                                <div class="pagination-area">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <?php echo $datas['articles']->links();?>
                                    </ul>
                                </div>
                        @endif

                        @foreach($datas['main_modules'] as $main_module)
                            <?php echo $main_module['module']; ?>
                        @endforeach
                    </div>
                    @if (count($datas['right_content']) > 0)
                        <aside class="col-lg-3 col-md-4 col-12">
                            @foreach($datas['right_content'] as $rcontent)
                                <?php echo $rcontent['module']; ?>
                            @endforeach
                        </aside>
                    @endif
                </div>
            </div>
        </section>
    @if(count($datas['bottom_content']) > 0)
        <section class="default-news-area ptb-15">
            <div class="container">
                @foreach($datas['bottom_content'] as $bottom_content)

                    <?php echo $bottom_content['module']; ?>

                @endforeach

            </div>
        </section>
    @endif
@endsection

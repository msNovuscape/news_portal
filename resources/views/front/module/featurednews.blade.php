
        <div class="row">
            <div class="col-md-9">
                <div class="block_posts block_1"><!-- block_posts block_1 -->
                    <div class="featured_title"><!-- featured_title -->
                        <h4>Featured News</h4>
                    </div><!-- // featured_title -->

                    <div class="block_inner row"><!-- block_inner -->
                        <div class="big_post col-lg-6 col-md-6 col-sm-6 col-xs-6"><!-- big_post -->

                            <div class="block_img_post"><!-- block_img_post -->
                                <img src="{{asset($datas['featured_image'])}}" alt="{{$datas['featured']->title}}" class="hz_appear">
                            </div><!-- // block_img_post -->

                            <div class="inner_big_post"><!-- inner_big_post -->
                                <div class="title_post"><!-- title_post -->
                                    <a href="{{url('/article/'.$datas['featured']->seo_url)}}"><h4>{{$datas['featured']->title}}</h4></a>
                                </div><!-- // title_post -->

                                <div class="big_post_content"><!-- big_post_content -->
                                    <p>{{\App\library\Settings::getLimitedWords($datas['featured']->description,0,25)}}</p>
                                </div><!-- // big_post_content -->

                                <div class="post_date"><!-- post_date -->
                                    <em><a href="{{url('/article/'.$datas['featured']->seo_url)}}">{{$datas['featured']->created_at->format('F j, Y')}}</a></em>
                                </div><!-- // post_date -->
                            </div><!-- // inner_big_post -->
                        </div><!-- // big_post -->

                        <div class="small_list_post col-lg-6 col-md-6 col-sm-6 col-xs-6"><!-- small_list_post -->
                            <ul>
                                @if(count($datas['news'])> 0)
                                    @foreach($datas['news'] as $news)
                                        <li class="small_post clearfix"><!-- small_post -->
                                    <div class="img_small_post"><!-- img_small_post -->
                                        @php($smimage = $datas['placeholder'])
                                        @if(is_file(DIR_IMAGE.$news->image))
                                            @php($smimage = \App\Models\ImageTool::mycrop($news->image,450,300))
                                        @endif
                                        <img src="{{asset($smimage)}}" alt="{{$news->title}}" class="hz_appear">
                                    </div><!-- // img_small_post -->
                                    <div class="small_post_content"><!-- small_post_content -->
                                        <div class="title_small_post"><!-- title_small_post -->
                                            <a href="{{url('/article/'.$news->seo_url)}}"><h5> {{$news->title}}</h5></a>
                                        </div><!-- // title_small_post -->
                                        <div class="post_date"><em><a href="{{url('/article/'.$news->seo_url)}}">{{$news->created_at->format('F j, Y')}}</a></em></div>
                                    </div><!-- // small_post_content -->
                                </li><!-- // small_post -->
                                    @endforeach
                                @endif

                            </ul>
                        </div><!-- // small_list_post -->
                    </div><!-- // block_inner -->
                </div>

            </div>
            <div class="col-md-3">
                {!! $datas['module'] !!}
            </div>
        </div>

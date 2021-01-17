@extends('front_master1')
@section('header')
    <style>
        .news-details-area img{
            width: 100%;
        }
        .center-4 {
            margin: auto;
            width: 60%;
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .hide-form {
            display: none;
        }
    </style>
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
        <section class="news-details-area pb-40">
            <div class="container pt-4">
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
                        @if($datas['articles'])
                            <div class="news-details">
                                @if($datas['image'] != '')
                                <div class="article-img">
                                    <img src="{{$datas['image']}}" alt="{{$datas['articles']->title}}">
                                </div>
                                @endif

                                <div class="article-content">
                                    <ul class="entry-meta">
                                        <li><i class="icofont-eye-alt"></i> {{$datas['articles']->visit}}</li>
                                        <li><i class="icofont-calendar"></i> {{$datas['articles']->created_at->format('F j, Y')}}</li>
                                    </ul>

                                    <h3>{{$datas['articles']->title}}</h3>
                                    {!! $datas['articles']->description !!}

                                    @if($datas['video'] != '')
                                        <div style="position: relative;padding-bottom: 56.25%; padding-top: 25px;height: 0; margin-top: 20px;">
                                            <iframe src="{{$datas['video']}}" frameborder="0" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;"></iframe>
                                        </div>
                                    @endif


                                    {{--            <ul class="category">--}}
                                    {{--                <li><span>Tags:</span></li>--}}
                                    {{--                <li><a href="#">Business</a></li>--}}
                                    {{--                <li><a href="#">IT</a></li>--}}
                                    {{--                <li><a href="#">Tips</a></li>--}}
                                    {{--                <li><a href="#">Design</a></li>--}}
                                    {{--            </ul>--}}
                                </div>
                            </div>
                            <div class="comments-area">
                                <h3 class="comments-title">Comments:</h3>
                                @if(count($datas['comment']) > 0)
                                    @foreach($datas['comment']->where('parent_id',0) as $comment)
                                       <ol class="comment-list">
                                          <li class="comment">
                                            <article class="comment-body">
                                                <footer class="comment-meta">
                                                    <div class="comment-author vcard">
                                                        <b class="fn">{{$comment->name}}</b>
                                                        <span class="says">says:</span>
                                                    </div>

                                                    <div class="comment-metadata">
                                                        <a href="#">
                                                            <time>{{$comment->created_at}}</time>
                                                        </a>
                                                    </div>
                                                </footer>

                                                <div class="comment-content">
                                                    <p>{{$comment->comment}}</p>
                                                </div>

                                                <div class="reply">
                                                    <a href = "javascript:;" onclick = "show_reply_form({{$comment->id}});">Reply</a>
                                                </div>
                                                <div class="center-{{$comment->id}} hide-form comment-respond">
                                                    <button onclick = "close_reply_form({{$comment->id}});" style="float: right;">X</button>

                                                    <form method="POST" action="{{ route('store_comment') }}">
                                                        {!! csrf_field() !!}

                                                        <p class="comment-form-comment">
                                                            <label for="comment">Comment</label>
                                                            <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                                        </p>
                                                        <p class="comment-form-author">
                                                            <label for="name">Name <span class="required">*</span></label>
                                                            <input type="text" id="name" name="name" required="required">
                                                        </p>
                                                        <p class="comment-form-email">
                                                            <label for="email">Email <span class="required">*</span></label>
                                                            <input type="email" id="email" name="email" required="required">
                                                        </p>
                                                        <input type="hidden" name="article_id" value="{{$datas['articles']->article_id}}">
                                                        <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                                        <p class="form-submit">
                                                            <input type="submit" name="reply" id="reply" value="Post Reply">
                                                        </p>
                                                    </form>
                                                </div>



                                            </article>



                                        @foreach($datas['comment_replies']->where('parent_id',$comment->id) as $comment_reply)

                                        <ol class="children">
                                            <li class="comment">
                                                <article class = "comment-body">
                                                    <footer class = "comment-meta">
                                                        <div class = "comment-author vcard">

                                                            <b class="fn">{{$comment_reply->name}}</b>
                                                            <span class="says">says:</span>
                                                        </div>

                                                        <div class="comment-metadata">
                                                            <a href="#">
                                                                <time>{{$comment_reply->created_at}}{{--April 24, 2019 at 10:59 am--}}</time>
                                                            </a>
                                                        </div>
                                                    </footer>

                                                    <div class="comment-content">
                                                        <p>{{$comment_reply->comment}}</p>
                                                    </div>

                                                </article>
                                            </li>
                                        </ol>
                                        @endforeach
                                    </li>


                                </ol>
                                    @endforeach

                                @endif

                                <div class="comment-respond">
                                    <h3 class="comment-reply-title">Leave a Comment</h3>

                                    <form class="comment-form" method="POST" action="{{ route('store_comment') }}">
                                        {!! csrf_field() !!}

                                        <p class="comment-notes">
                                            <span id="email-notes">Your email address will not be published.</span>
                                            Required fields are marked
                                            <span class="required">*</span>
                                        </p>
                                        <p class="comment-form-comment">
                                            <label for="comment">Comment</label>
                                            <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                        </p>
                                        <p class="comment-form-author">
                                            <label for="name">Name <span class="required">*</span></label>
                                            <input type="text" id="name" name="name" required="required">
                                        </p>
                                        <p class="comment-form-email">
                                            <label for="email">Email <span class="required">*</span></label>
                                            <input type="email" id="email" name="email" required="required">
                                        </p>
                                        <p class="form-recaptcha">
                                            <label class="control-label">Captcha<span class="required">*</span></label>

                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_SITE_KEY') }}"></div>
                                        </p>
                                        <br/>
                                        {{--@if ($errors->has('g-recaptcha-response'))
                                            <span class="invalid-feedback" style="display: block;">
                                              <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                        @endif--}}
                                        <input type="hidden" name="article_id" value="{{$datas['articles']->article_id}}">
                                        <p class="form-submit">
                                            <input type="submit" name="submit" id="reply-submit" class="submit" value="Post Comment">
                                        </p>
                                    </form>
                                </div>
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
@section('javascript')

    <script type="text/javascript">

    function show_reply_form(comment_id)
    {
        $('.center-'+comment_id).show();
            $(this).hide();
    }
    function close_reply_form(comment_id) {
        $('.center-'+comment_id).hide();
        $('#show').show();
    }
    /*$('#close').on('click', function () {
        $('.center').hide();
    })*/
    </script>
@endsection

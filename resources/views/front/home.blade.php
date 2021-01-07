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
    @if (count($datas['left_content']) > 0 || count($datas['right_content']) > 0 || count($datas['main_modules']) > 0)
        <section class="default-news-area ptb-15">
            <div class="container pt-4 pb-4 bg-white">
                <div class="row">
                    @if (count($datas['left_content']) > 0)
                        <aside class="col-lg-3 col-md-4 col-12">
                            @foreach($datas['left_content'] as $lcontent)
                                <?php echo $lcontent['module']; ?>
                            @endforeach
                        </aside>
                    @endif
                    <div class="{{$class}}">
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
    @endif
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

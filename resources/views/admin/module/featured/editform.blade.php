@extends('admin_master')
@section('stylesheet')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop
@section('heading')
    Featured News
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/modules') }}"> Modules</a></li>
    <li class="breadcrumb-item active">Featured News</li>

@stop
@section('content')
    <style>
        .featured_box{
            padding: 5px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #CCC;
        }
        .featured_box .box{
            background: #FFF;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/module/update') }}">
                <div class="panel panel-default">
                    <div class="card-body">
                        <input type="hidden" name="module_id" value="{{ $datas['id'] }}" />
                            <input type="hidden" name="module_page" value="FeaturedNews" />
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-md-10">
                                    <ul class="nav nav-tabs ml-auto" id="secondary-tab" role="tablist">
                                        @if(count($datas['language']) > 0)
                                            @foreach($datas['language'] as $language)
                                                <li class="nav-item waves-effect waves-light"><a class="nav-link {{$language['active']}}" href="#tab-title{{$language['id']}}" data-toggle="tab">@if($language['flag'] != '') <img src="{{asset($language['flag'])}}">@endif {{$language['title']}} </a></li>
                                            @endforeach
                                        @endif

                                    </ul>
                                    @if(count($datas['language']) > 0)
                                        <div class="tab-content" id="language_tab">
                                            @if(is_array(old('description')) > 0)
                                                @if(count(old('description')) > 0)
                                                    @foreach(old('description') as $key => $old)
                                                        <div class="tab-pane pt-3 " id="tab-title{{$key}}">
                                                            <div class="form-group row">
                                                                <label class="col-md-3 control-label">Module Title</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" required name="description[{{$key}}][title]" value="{{ $old['title'] }}" placeholder="Module Title" class="form-control {{ $errors->has('description.'.$key.'.title') ? ' is-invalid' : '' }}" />
                                                                    @if($errors->has('description.'.$key.'.title'))
                                                                        <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('description.'.$key.'.title') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @else
                                                @foreach($datas['language'] as $language)
                                                    <div class="tab-pane pt-3 {{$language['active']}}" id="tab-title{{$language['id']}}">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 control-label">Module Title</label>
                                                            <div class="col-md-9">
                                                                <input type="text" required name="description[{{$language['id']}}][title]" value="{{ $language['detail']['title']}}" placeholder="Module Title" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Language</label>
                                <div class="col-md-9">
                                    <select class="form-control {{ $errors->has('language_id') ? ' is-invalid' : '' }}" name="language_id">
                                        <option value="">Select Language</option>
                                        @if(count($datas['lang']) > 0)
                                            @foreach($datas['lang'] as $lang)
                                                @if($datas['setting']->language_id == $lang['value'])
                                                <option value="{{$lang['value']}}" selected>{{$lang['title']}}</option>
                                                @else
                                                    <option value="{{$lang['value']}}">{{$lang['title']}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('language_id'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('language_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="featured_box row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 box">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="featured_news" placeholder="Select Article" autocomplete="off" value="{{\App\Models\ArticleDescription::getTitle($datas['setting']->featured_news)}}" >
                                            <input type="hidden" name="featured_news" id="fid" value="{{$datas['setting']->featured_news}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 box">
                                        <div class="form-group">
                                            <input type="text" name="path" value="" placeholder="Article Title" id="path_id" autocomplete="off" class="form-control" />
                                        </div>
                                        <div class="well" id="article_menu" style="height: 150px; overflow: auto; background: #CCC;">
                                            @if(count($datas['setting']->article_id) > 0)
                                                @foreach($datas['setting']->article_id as $menu)
                                                    <div id="article_menu<?php echo $menu ;?>">
                                                        <i class="fa fa-minus-circle" style="cursor:pointer;"></i> <?php echo \App\Models\ArticleDescription::getTitle($menu);?>
                                                        <input type="hidden" name="article_id[]" value="<?php echo $menu;?>" />
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 box">
                                <div class="form-group">
                                    <select class="form-control" name="module">
                                        @foreach($datas['modules'] as $module)
                                            @if($datas['setting']->module == $module->id)
                                            <option value="{{$module->id}}" selected>{{$module->title}}</option>
                                            @else
                                                <option value="{{$module->id}}">{{$module->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-fw fa-save"></i>Save
                        </button>
                    </div>
                </div>
                </form>
                <div class="form-group row">
                    <div class="col-md-12">
                        <img src="{{asset('images/featured.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>



@endsection

@section('javascript')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
@section('script')
    <script type="text/javascript">
        $('input[name=\'path\']').autocomplete({

            source: '{{ url('admin/article/autocomplete/') }}',
            minlength:1,
            autoFocus:true,
            select:function(e,ui){
                $('#path_id').val('');
                $('#article_menu' + ui.item.id).remove();
                $('#article_menu').append('<div id="article_menu' + ui.item.id + '"><i class="fa fa-minus-circle" style="cursor:pointer;"></i> ' + ui.item.value + '<input type="hidden" name="article_id[]" value="' + ui.item.id + '" /></div>');

            }

        });

        $('#featured_news').autocomplete({

            source: '{{ url('admin/article/autocomplete/') }}',
            minlength:1,
            autoFocus:true,
            select:function(e,ui){
                $('#fid').val(ui.item.id)
            }

        });
    </script>
@endsection


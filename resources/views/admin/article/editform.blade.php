@extends('admin_master')
@section('stylesheet')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop
@section('styles')
    <style>
        .well{
            padding: 9px;
            border-radius: 3px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, .05), 0 1px 0 rgba(255, 255, 255, .1);
        }
    </style>
@stop
@section('heading')
    Edit Article
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/article') }}">Article</a></li>
    <li class="breadcrumb-item active">Edit Article</li>

@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    @if(count($errors))
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                    {{ '* : '.$error }}</br>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endif
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/article/update') }}">
                        <input type="hidden" name="id" value="{{$datas['article']->id}}">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light"><a class="nav-link active" href="#tab-general" data-toggle="tab">General</a></li>
                                    <li class="nav-item waves-effect waves-light"><a class="nav-link" href="#tab-data" data-toggle="tab">Data</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active pt-3" id="tab-general">
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
                                                                    <label class="col-md-3 control-label">Title</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="description[{{$key}}][title]" data-id="{{$key}}" value="{{ $old['title'] }}" placeholder="Article Title" class="form-control title {{ $errors->has('description.'.$key.'.title') ? ' is-invalid' : '' }}" />
                                                                        @if($errors->has('description.'.$key.'.title'))
                                                                            <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('description.'.$key.'.title') }}</strong>
                                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-md-3 control-label">Seo URL</label>

                                                                    <div class="col-md-9">

                                                                        <input type="text" name="description[{{$key}}][seo_url]" id="seo_url{{$key}}" value="{{ $old['seo_url'] }}" placeholder="seo_url" class="form-control {{ $errors->has('description.'.$key.'.seo_url') ? ' is-invalid' : '' }}" />
                                                                        @if($errors->has('description.'.$key.'.seo_url'))
                                                                            <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('description.'.$key.'.seo_url') }}</strong>
                                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-md-3 control-label">Description</label>
                                                                    <div class="col-md-9">
                                                                        <textarea id="description{{$key}}" class="form-control {{ $errors->has('description.'.$key.'.description') ? ' is-invalid' : '' }}" name="description[{{$key}}][description]">{{ $old['description'] }}</textarea>
                                                                        @if($errors->has('description.'.$key.'.description'))
                                                                            <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('description.'.$key.'.description') }}</strong>
                                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 control-label">Meta Title</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="description[{{$key}}][meta_title]" value="{{ $old['meta_title'] }}" placeholder="Meta Tag" class="form-control {{ $errors->has('description.'.$key.'.meta_title') ? ' is-invalid' : '' }}" />
                                                                        @if($errors->has('description.'.$key.'.meta_title'))
                                                                            <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('description.'.$key.'.meta_title') }}</strong>
                                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 control-label">Meta Tag Keyword</label>
                                                                    <div class="col-md-9">
                                                                        <textarea name="description[{{$key}}][meta_keyword]" class="form-control {{ $errors->has('description.'.$key.'.meta_keyword') ? ' is-invalid' : '' }}">{{ $old['meta_keyword'] }}</textarea>
                                                                        @if($errors->has('description.'.$key.'.meta_keyword'))
                                                                            <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('description.'.$key.'.meta_keyword') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 control-label">Meta Tag Description</label>
                                                                    <div class="col-md-9">
                                                                        <textarea name="description[{{$key}}][meta_description]" class="form-control {{ $errors->has('description.'.$key.'.meta_description') ? ' is-invalid' : '' }}">{{ $old['meta_description'] }}</textarea>
                                                                        @if($errors->has('description.'.$key.'.meta_description'))
                                                                            <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('description.'.$key.'.meta_description') }}</strong>
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
                                                                <label class="col-md-3 control-label">Title</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="description[{{$language['id']}}][title]" data-id="{{$language['id']}}" value="{{ old('description.'.$language['id'].'.meta_description') ? old('description.'.$key.'.meta_description') : $language['details']['title'] }}" placeholder="Article Title" class="form-control title " />

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-3 control-label">Seo URL</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="description[{{$language['id']}}][seo_url]" id="seo_url{{$language['id']}}" value="{{ $language['details']['seo_url'] }}" placeholder="seo_url" class="form-control" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-3 control-label">Description</label>
                                                                <div class="col-md-9">
                                                                    <textarea id="description{{$language['id']}}" class="form-control" name="description[{{$language['id']}}][description]">{{ $language['details']['description'] }}</textarea>

                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-3 control-label">Meta Title</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="description[{{$language['id']}}][meta_title]" value="{{ $language['details']['meta_title'] }}" placeholder="Meta Tag" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-3 control-label">Meta Tag Keyword</label>

                                                                <div class="col-md-9">
                                                                    <textarea name="description[{{$language['id']}}][meta_keyword]" class="form-control">{{ $language['details']['meta_keyword'] }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-3 control-label">Meta Tag Description</label>

                                                                <div class="col-md-9">
                                                                    <textarea name="description[{{$language['id']}}][meta_description]" class="form-control">{{ $language['details']['meta_description'] }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif



                                            </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane pt-3" id="tab-data">
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Language</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="language">
                                                    <option value="">Select Language</option>
                                                    @foreach($datas['language'] as $language)
                                                        @if($datas['article']->language == $language['id'])
                                                            <option value="{{$language['id']}}" selected>{{$language['title']}}</option>
                                                        @else
                                                            <option value="{{$language['id']}}">{{$language['title']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Menu</label>
                                            <div class="col-md-10">
                                                <input type="text" name="path" value="" placeholder="Article Title" id="path_id" autocomplete="off" class="form-control" />
                                                <div class="well" id="article_menu" style="height: 150px; overflow: auto;">
                                                    @if(count($datas['menu']) > 0)
                                                        @foreach($datas['menu'] as $menu)
                                                            <div id="article_menu<?php echo $menu['menu_id'] ;?>">
                                                                <i class="fa fa-minus-circle" style="cursor:pointer;"></i> <?php echo $menu['menu_title'];?>
                                                                <input type="hidden" name="article_menu[]" value="<?php echo $menu['menu_id'];?>" />
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Video</label>

                                            <div class="col-md-10">
                                                <input type="text" name="video" value="{{$datas['article']->video}}" placeholder="https://www.youtube.com/v=iweuuower" class="form-control {{ $errors->has('video') ? ' is-invalid' : '' }}">


                                                @if ($errors->has('video'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('video') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Audio</label>

                                            <div class="col-md-10">
                                                <input type="text" name="audio" value="{{$datas['article']->audio}}" placeholder="https://www.podcast.com/v=iweuuower" class="form-control {{ $errors->has('audio') ? ' is-invalid' : '' }}">

                                                @if ($errors->has('audio'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('audio') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Status</label>

                                            <div class="col-md-10">
                                                <select name="status" id="status" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" >
                                                    @foreach($datas['status'] as $status)
                                                        @if($status['value'] == $datas['article']->status)
                                                            <option value="{{$status['value']}}" selected>{{$status['title']}}</option>
                                                        @else
                                                            <option value="{{$status['value']}}">{{$status['title']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('status'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Image</label>

                                            <div class="col-md-10">
                                                <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="{{ asset($datas['image']) }} " alt="" title="" data-placeholder="{{asset($datas['placeholder'])}} " /></a>
                                                <input type="hidden" name="image" value="{{$datas['article']->image}}" id="input-image" />

                                                @if ($errors->has('image'))
                                                    <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                                @endif
                                            </div>
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
                </div>
            </div>

        </div>
    </div>

@endsection
@section('javascript')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
@stop
@section('script')
    <script type="text/javascript">
        $(document).delegate('button[data-toggle=\'image\']', 'click', function() {
            $('#modal-image').remove();
            $(this).parents('.note-editor').find('.note-editable').focus();

            $.ajax({
                url: '{{ url('/admin/filemanager') }}',
                dataType: 'html',
                beforeSend: function() {
                    $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#button-image').prop('disabled', true);
                },
                complete: function() {
                    $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
                    $('#button-image').prop('disabled', false);
                },
                success: function(html) {
                    $('body').append('<div id="modal-image" class="modal">' + html + '</div>');

                    $('#modal-image').modal('show');
                }
            });
        });
        // Image Manager
        $(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
            e.preventDefault();

            $('.popover').popover('hide', function() {
                $('.popover').remove();
            });

            var element = this;


            $(element).popover({
                html: true,
                placement: 'right',
                trigger: 'manual',
                container: 'body',
                sanitize: false,
                content: function() {
                    return '<div id="button-image" class="btn btn-primary btn-sm mr-1"><i class="fas fa-pencil-alt"></i></div><div id="button-clear" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></div>';
                }
            });

            $(element).popover('show');

            $(document).on('click','#button-image', function() {
                $('#modal-image').remove();

                $.ajax({
                    url: '{{ url('/admin/filemanager') }}' + '?target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
                    dataType: 'html',
                    beforeSend: function() {
                        $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                        $('#button-image').prop('disabled', true);
                    },
                    complete: function() {
                        $('#button-image i').replaceWith('<i class="fa fa-pencil"></i>');
                        $('#button-image').prop('disabled', false);
                    },
                    success: function(html) {
                        $('body').append('<div id="modal-image" class="modal" style="display: block; padding-right: 17px;" >' + html + '</div>');

                        $('#modal-image').modal('show');
                    }
                });

                $(element).popover('hide', function() {
                    $('.popover').remove();
                });
            });

            $('#button-clear').on('click', function() {
                $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));

                $(element).parent().find('input').attr('value', '');

                $(element).popover('hide', function() {
                    $('.popover').remove();
                });
            });
        });

    </script>
    <script type="text/javascript"><!--
        $('input[name=\'path\']').autocomplete({

            source: '{{ url('admin/menu/autocomplete/') }}',
            minlength:1,
            autoFocus:true,
            select:function(e,ui){
                $('#path_id').val('');
                $('#article_menu' + ui.item.id).remove();
                $('#article_menu').append('<div id="article_menu' + ui.item.id + '"><i class="fa fa-minus-circle" style="cursor:pointer;"></i> ' + ui.item.value + '<input type="hidden" name="article_menu[]" value="' + ui.item.id + '" /></div>');

            }

        });


        $(document).ready(function (){
            $('#language_tab').children(":first").addClass('active');
        })
        $('#article_menu').delegate('.fa-minus-circle', 'click', function() {
            $(this).parent().remove();
        });
        //--></script>
    @if(count($datas['language']) > 0)
        @foreach($datas['language'] as $lang)
            <script>
                CKEDITOR.replace('description{{$lang['id']}}',
                    {
                        filebrowserBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html")}}',
                        filebrowserImageBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html?type=Images")}}',
                        filebrowserFlashBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html?type=Flash")}}',
                        filebrowserUploadUrl :
                            '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files")}}',
                        filebrowserImageUploadUrl :
                            '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images")}}',
                        filebrowserFlashUploadUrl : '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash")}}',
                        enterMode: CKEDITOR.ENTER_BR
                    }

                );
            </script>
        @endforeach
    @endif
@endsection

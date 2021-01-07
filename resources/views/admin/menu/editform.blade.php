@extends('admin_master')
@section('stylesheet')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop
@section('heading')
    Edit Menu
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/menu') }}">Menu</a></li>
    <li class="breadcrumb-item active">Edit Menu</li>

@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/menu/update') }}">
                        <input type="hidden" name="id" value="{{$datas['menu']->id}}">
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
                                                                        <input type="text" name="description[{{$key}}][title]" data-id="{{$key}}" value="{{ $language['details']['title'] }}" placeholder="Menu Title" class="form-control title {{ $errors->has('description.'.$key.'.title') ? ' is-invalid' : '' }}" />
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

                                                                        <input type="text" name="description[{{$key}}][seo_url]" id="seo_url{{$key}}" value="{{ $language['details']['seo_url'] }}" placeholder="seo_url" class="form-control {{ $errors->has('description.'.$key.'.seo_url') ? ' is-invalid' : '' }}" />
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
                                                                        <textarea class="form-control {{ $errors->has('description.'.$key.'.description') ? ' is-invalid' : '' }}" name="description[{{$key}}][description]">{{ $language['details']['description'] }}</textarea>
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
                                                                        <input type="text" name="description[{{$key}}][meta_title]" value="{{ $language['details']['meta_title'] }}" placeholder="Meta Tag" class="form-control {{ $errors->has('description.'.$key.'.meta_title') ? ' is-invalid' : '' }}" />
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
                                                                        <textarea name="description[{{$key}}][meta_keyword]" class="form-control {{ $errors->has('description.'.$key.'.meta_keyword') ? ' is-invalid' : '' }}">{{ $language['details']['meta_keyword'] }}</textarea>
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
                                                                        <textarea name="description[{{$key}}][meta_description]" class="form-control {{ $errors->has('description.'.$key.'.meta_description') ? ' is-invalid' : '' }}">{{ $language['details']['meta_description'] }}</textarea>
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
                                                                    <input type="text" name="description[{{$language['id']}}][title]" data-id="{{$language['id']}}" value="{{ $language['details']['title'] }}" placeholder="Menu Title" class="form-control title " />

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
                                                                    <textarea class="form-control" name="description[{{$language['id']}}][description]">{{ $language['details']['description'] }}</textarea>
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
                                                        @if($datas['menu']->language == $language['id'])
                                                            <option value="{{$language['id']}}" selected>{{$language['title']}}</option>
                                                        @else
                                                            <option value="{{$language['id']}}">{{$language['title']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Parent</label>

                                            <div class="col-md-10">
                                                <input type="text" name="path" value="{{ \App\Models\MenuDescription::getTitle($datas['menu']->parent_id) }}" placeholder="Parent Title" id="path_id" autocomplete="off" class="form-control" />
                                                <input type="hidden" name="parent_id" id="parent_id" value="{{ $datas['menu']->parent_id }}" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Layout</label>

                                            <div class="col-md-10">
                                                <select name="layout_id" id="layout_id" class="form-control{{ $errors->has('layout_id') ? ' is-invalid' : '' }}">
                                                    <option value="0" > No Link</option>
                                                    <?php foreach ($datas['layout'] as $layout){ ?>
                                                    @if($datas['menu']->layout_id == $layout->id)
                                                        <option selected value="<?php echo $layout->id;?>" > <?php echo $layout->layout_title;?></option>
                                                    @else
                                                        <option value="<?php echo $layout->id;?>" > <?php echo $layout->layout_title;?></option>
                                                    @endif
                                                    <?php }?>


                                                </select>


                                                @if ($errors->has('layout_id'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('layout_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Sort Order</label>

                                            <div class="col-md-10">
                                                <input type="text" class="form-control{{ $errors->has('sort_order') ? ' is-invalid' : '' }}" name="sort_order" value="{{ $datas['menu']->sort_order }}" placeholder="1">

                                                @if ($errors->has('sort_order'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sort_order') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label">Status</label>

                                            <div class="col-md-10">
                                                <select name="status" id="status" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" >
                                                    @foreach($datas['status'] as $status)
                                                        @if($status['value'] == $datas['menu']->status)
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
                                                <input type="hidden" name="image" value="{{$datas['menu']->image}}" id="input-image" />

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
                $('#parent_id').val(ui.item.id);
            }

        });

        $(document).ready(function (){
            $('#language_tab').children(":first").addClass('active');
        })
        //--></script>
@endsection

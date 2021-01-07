@extends('admin_master')
@section('heading')
Setting
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Edit Setting</li>
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/setting/update') }}">
                    <input type="hidden" name="setting_id" value="{{ $datas['setting']->id }}">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-10">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item waves-effect waves-light"><a class="nav-link active" href="#tab-general" data-toggle="tab">General</a></li>
                                <li class="nav-item waves-effect waves-light"><a class="nav-link" href="#tab-title" data-toggle="tab">Title</a></li>
                                <li class="nav-item waves-effect waves-light"><a class="nav-link" href="#tab-image" data-toggle="tab">Image</a></li>
                                <li class="nav-item waves-effect waves-light"><a class="nav-link" href="#tab-email" data-toggle="tab">Email</a></li>
                                <li class="nav-item waves-effect waves-light"><a class="nav-link" href="#tab-social" data-toggle="tab">Social</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active pt-3" id="tab-general">
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Email</label>

                                <div class="col-md-9">
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $datas['setting']->email }}">


                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Item Per Page</label>

                                <div class="col-md-9">
                                <input type="text" name="item_perpage" class="form-control {{ $errors->has('item_perpage') ? ' is-invalid' : '' }}" value="{{ $datas['setting']->item_perpage }}">


                                    @if ($errors->has('item_perpage'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('item_perpage') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Description Limit</label>

                                <div class="col-md-9">
                                <input type="text" name="description_limit" class="form-control {{ $errors->has('description_limit') ? ' is-invalid' : '' }}" value="{{ $datas['setting']->description_limit }}">


                                    @if ($errors->has('description_limit'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('description_limit') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Latitude</label>

                                <div class="col-md-9">
                                <input type="text" name="latitude" class="form-control {{ $errors->has('latitude') ? ' is-invalid' : '' }}" value="{{ $datas['setting']->latitude }}">
                                                <span style="color:#999; font-size:11px;">To get your place Latitude and Longitude </span><a href="http://www.itouchmap.com/latlong.html" target="_blank">CLICK HERE</a>

                                    @if ($errors->has('latitude'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('latitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label">Longitude</label>

                                <div class="col-md-9">
                                <input type="text" name="longitude" class="form-control {{ $errors->has('longitude') ? ' is-invalid' : '' }}" value="{{ $datas['setting']->longitude }}">


                                    @if ($errors->has('longitude'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('longitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label">Google Analytic Coad</label>

                                <div class="col-md-9">
                                <textarea name="google_analytic" class="form-control">{{ $datas['setting']->google_analytics }}</textarea>



                                </div>
                            </div>


                        </div>
                                <div class="tab-pane pt-3" id="tab-title">
                                    <ul class="nav nav-tabs ml-auto" id="secondary-tab" role="tablist">
                                        @if(count($datas['language']) > 0)
                                            @foreach($datas['language'] as $language)
                                                <li class="nav-item waves-effect waves-light"><a class="nav-link {{$language['active']}}" href="#tab-title{{$language['id']}}" data-toggle="tab">@if($language['flag'] != '') <img src="{{asset($language['flag'])}}">@endif {{$language['title']}} </a></li>
                                            @endforeach
                                        @endif

                                    </ul>
                                    @if(count($datas['language']) > 0)
                                        <div class="tab-content">
                                        @foreach($datas['language'] as $language)
                                            <div class="tab-pane pt-3 {{$language['active']}}" id="tab-title{{$language['id']}}">
                                                <div class="form-group row">
                                                    <label class="col-md-3 control-label">Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="description[{{$language['id']}}][title]" value="{{ $language['details']['name'] }}" placeholder="Company/Organization Name" class="form-control {{ $errors->has('company') ? ' is-invalid' : '' }}" />
                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 control-label">Telephone</label>

                                                    <div class="col-md-9">

                                                        <input type="text" name="description[{{$language['id']}}][telephone]" value="{{ $language['details']['telephone'] }}" placeholder="Telephone" class="form-control {{ $errors->has('telephone') ? ' is-invalid' : '' }}" />

                                                        @if ($errors->has('telephone'))
                                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('telephone') }}</strong>
                                        </span>
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 control-label">Address</label>

                                                    <div class="col-md-9">
                                                        <textarea class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="description[{{$language['id']}}][address]">{{ $language['details']['address'] }}</textarea>

                                                        @if ($errors->has('address'))
                                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                                        @endif


                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 control-label">Meta Title</label>

                                                    <div class="col-md-9">

                                                        <input type="text" name="description[{{$language['id']}}][meta_title]" value="{{ $language['details']['meta_title'] }}" placeholder="Meta Tag" class="form-control {{ $errors->has('meta_title') ? ' is-invalid' : '' }}" />
                                                        @if ($errors->has('meta_title'))
                                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('meta_title') }}</strong>
                                        </span>
                                                        @endif


                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 control-label">Meta Tag Keyword</label>

                                                    <div class="col-md-9">
                                                        <textarea name="description[{{$language['id']}}][meta_keyword]" class="form-control {{ $errors->has('meta_keyword') ? ' is-invalid' : '' }}">{{ $language['details']['meta_keyword'] }}</textarea>


                                                        @if ($errors->has('meta_keyword'))
                                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('meta_keyword') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 control-label">Meta Tag Description</label>

                                                    <div class="col-md-9">
                                                        <textarea name="description[{{$language['id']}}][meta_description]" class="form-control {{ $errors->has('meta_description') ? ' is-invalid' : '' }}">{{ $language['details']['meta_description'] }}</textarea>


                                                        @if ($errors->has('meta_description'))
                                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('meta_description') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    @endif

                                </div>
                        <div class="tab-pane pt-3" id="tab-image">

                        <?php

                            if(isset($datas['image']->logo) && !empty($datas['image']->logo))
                            {
                                $logo = \App\Models\ImageTool::mycrop($datas['image']->logo, 100, 100);
                            }
                            else {
                                $logo = \App\Models\ImageTool::mycrop('no-image.png', 100, 100);
                            }
                            if(isset($datas['image']->icon) && !empty($datas['image']->icon))
                            {
                                $icon = \App\Models\ImageTool::mycrop($datas['image']->icon, 100, 100);
                            }
                            else {
                                $icon = \App\Models\ImageTool::mycrop('no-image.png', 100, 100);
                            }

                            $placeholder = \App\Models\ImageTool::mycrop('no-image.png', 100, 100);
                            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-md-6 control-label">Logo</label>

                            <div class="col-md-6">
                              <a href="" id="thumb-logo" data-toggle="image" class="img-thumbnail">

                              <img src="{{asset($logo)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="logo" value="{{ $datas['image']->logo }}" id="input-logo" />
                            </div>
                        </div>
                </div>
                <div class="col-md-6">
            <div class="form-group">
                            <label class="col-md-6 control-label">Icon</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-icon" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($icon)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="icon" value="{{ $datas['image']->icon }}" id="input-icon" />
                            </div>
                        </div>
                        </div>

                    </div>

             <div class="form-group row">
                            <label class="col-md-3 control-label">Thumb Size</label>

                            <div class="col-md-9">
                                <div class="col-md-6">
                                <label class="col-md-4 control-label">Thumb Height</label>
                                <div class="col-md-8">
                                     <input type="text" name="thumb_height" class="form-control{{ $errors->has('thumb_height') ? ' is-invalid' : '' }}" value="{{ $datas['image']->thumb_height }}" >
                                      @if ($errors->has('thumb_height'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('thumb_height') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                             <div class="col-md-6">
                                <label class="col-md-4 control-label">Thumb Widht</label>
                                <div class="col-md-8">
                                     <input type="text" name="thumb_width" class="form-control" value="{{ $datas['image']->thumb_width }}" >
                                      @if ($errors->has('thumb_width'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('thumb_width') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            </div>
                        </div>

             <div class="form-group row">
                            <label class="col-md-3 control-label">Image Size</label>

                             <div class="col-md-9">
                                <div class="col-md-6">
                                <label class="col-md-4 control-label">Image Height</label>
                                <div class="col-md-8">
                                     <input type="text" name="image_height" class="form-control {{ $errors->has('image_height') ? ' is-invalid' : '' }}" value="{{ $datas['image']->image_height }}" >
                                      @if ($errors->has('image_height'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image_height') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                             <div class="col-md-6">
                                <label class="col-md-4 control-label">Thumb Widht</label>
                                <div class="col-md-8">
                                     <input type="text" name="image_width" class="form-control" value="{{ $datas['image']->image_width }}" >
                                      @if ($errors->has('image_width'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image_width') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            </div>
                        </div>




            </div>
            <div class="tab-pane pt-3" id="tab-email">

               <div class="form-group row">
                            <label class="col-md-3 control-label">Protocal</label>

                            <div class="col-md-9">
                            <select name="protocal" onChange="changeProto()" id="protocal" class="form-control">

                                <?php
                                $proto[] = array('title' => 'SMTP', 'value' => 'smtp' );
                                $proto[] = array('title' => 'Localhost', 'value' => 'sendmail' );
                                $proto[] = array('title' => 'LocalMail', 'value' => 'mail' );
                                $proto[] = array('title' => 'Mailgun', 'value' => 'mailgun' );
                                $proto[] = array('title' => 'mandrill', 'value' => 'mandrill' );
                                foreach ($proto as $value) {
                                    if($value['value'] == $datas['emails']->protocal){
                                        ?>
                                        <option selected="selected" value="<?php echo $value['value'];?>"><?php echo $value['title'];?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $value['value'];?>"><?php echo $value['title'];?></option>
                                        <?php
                                    }
                                }
                                 ?>

                    </select>



                            </div>
                        </div>
            <div class="form-group row" id="para">
                            <label class="col-md-3 control-label">Parameter</label>

                            <div class="col-md-9">
                            <input type="text" name="parameter" class="form-control" value="{{ $datas['emails']->parameter }}" >

                            </div>
                        </div>

            <div class="form-group row" id="host">
                            <label class="col-md-3 control-label">Host Name</label>

                            <div class="col-md-9">
                            <input type="text" name="host_name" class="form-control" value="{{ $datas['emails']->host_name }}" >

                            </div>
                        </div>
              <div class="form-group row" id="usern">
                            <label class="col-md-3 control-label">Username</label>

                            <div class="col-md-9">

                              <input type="text" name="username" class="form-control" value="{{ $datas['emails']->username }}" >


                            </div>
                        </div>
              <div class="form-group row" id="pass">
                            <label class="col-md-3 control-label">Password</label>

                            <div class="col-md-9">
                            <input type="text" name="password" class="form-control" value="{{ $datas['emails']->password }}" >

                            </div>
                        </div>
              <div class="form-group row" id="port">
                            <label class="col-md-3 control-label">Smtp Port</label>

                            <div class="col-md-9">
                            <input type="text" name="smtp_port" class="form-control" value="{{ $datas['emails']->smtp_port }}" >

                            </div>
                        </div>
            <div class="form-group row" id="enc">
                            <label class="col-md-3 control-label" id="enc_lev">Mail Encryption</label>

                            <div class="col-md-9">
                            <input type="text" name="encription" class="form-control" placeholder="tsl" value="{{ $datas['emails']->encription }}" >

                            </div>
                        </div>

            </div>


            <div class="tab-pane pt-3" id="tab-social">


            <div class="form-group row">
                            <label class="col-md-3 control-label">Facebook</label>

                            <div class="col-md-9">
                             <input type="url" name="facebook" class="form-control {{ $errors->has('facebook') ? ' is-invalid' : '' }}" value="{{ $datas['socials']->facebook }}" >
                              @if ($errors->has('facebook'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

            <div class="form-group row">
                            <label class="col-md-3 control-label">Twitter</label>

                            <div class="col-md-9">
                             <input type="url" name="twitter" class="form-control {{ $errors->has('twitter') ? ' is-invalid' : '' }}" value="{{ $datas['socials']->twitter }}" >
                              @if ($errors->has('twitter'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
             <div class="form-group row">
                            <label class="col-md-3 control-label">Google Plus</label>

                            <div class="col-md-9">
                             <input type="url" name="gplus" class="form-control {{ $errors->has('gplus') ? ' is-invalid' : '' }}" value="{{ $datas['socials']->gplus }}" >
                              @if ($errors->has('gplus'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gplus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

             <div class="form-group row">
                            <label class="col-md-3 control-label">YouTube</label>

                            <div class="col-md-9">
                             <input type="url" name="youtube" class="form-control {{ $errors->has('youtube') ? ' is-invalid' : '' }}" value="{{ $datas['socials']->youtube }}" >
                              @if ($errors->has('youtube'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('youtube') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


             <div class="form-group row">
                            <label class="col-md-3 control-label">LinkedIn</label>

                            <div class="col-md-9">
                             <input type="url" name="linkedin" class="form-control {{ $errors->has('linkedin') ? ' is-invalid' : '' }}" value="{{ $datas['socials']->linkedin }}" >
                              @if ($errors->has('linkedin'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

            </div>

          </div>


                    </div>
                </div>

                        <div class="form-group row">
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

    <script type="text/javascript">
        $.fn.tabs = function() {
            var selector = this;

            this.each(function() {
                var obj = $(this);

                $(obj.attr('href')).hide();

                $(obj).click(function() {
                    $(selector).removeClass('selected');

                    $(selector).each(function(i, element) {
                        $($(element).attr('href')).hide();
                    });

                    $(this).addClass('selected');

                    $($(this).attr('href')).show();

                    return false;
                });
            });

            $(this).show();

            $(this).first().click();
        };
    </script>
    <script type="text/javascript"><!--
        $('#language li:first-child').addClass('active');
        $('#tab-description .tab-content :first-child').addClass('active');
        function changeProto(){
            var data = $('#protocal').val();
            if(data == 'sendmail'){
                $('#para').fadeOut();
                $('#host').fadeOut();
                $('#usern').fadeOut();
                $('#pass').fadeOut();
                $('#port').fadeOut();
                $('#enc').fadeOut();

            }
            else if(data == 'smtp'){
                $('#para').fadeIn();
                $('#host').fadeIn();
                $('#usern').fadeIn();
                $('#pass').fadeIn();
                $('#port').fadeIn();
                $('#enc').fadeIn();

            }
            else if(data == 'mailgun'){
                $('#para').fadeOut();
                $('#host').fadeIn();
                $('#usern').fadeOut();
                $('#pass').fadeOut();
                $('#port').fadeOut();
                $('#enc_lev').html('Secret Key');
                $('#enc').fadeIn();

            }
            else if(data == 'mandrill'){
                $('#para').fadeOut();
                $('#host').fadeOut();
                $('#usern').fadeOut();
                $('#pass').fadeOut();
                $('#port').fadeOut();
                $('#enc_lev').html('Secret Key');
                $('#enc').fadeIn();

            }


        }
        //--></script>
@endsection


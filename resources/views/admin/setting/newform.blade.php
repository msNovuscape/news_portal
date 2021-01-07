@extends('admin_master')
@section('heading')
New Setting
            <small>Detail of New New Setting</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/admin/language') }}">Setting</a></li>
            <li class="active">New Setting</li>
@stop
@section('content')
 
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">New Setting</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/setting/save') }}">
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-10">
                        
                        
                       
                        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
            <li><a href="#tab-description" data-toggle="tab">Description</a></li>
            <li><a href="#tab-image" data-toggle="tab">Image</a></li>
            <li><a href="#tab-email" data-toggle="tab">Email</a></li>
            <li><a href="#tab-social" data-toggle="tab">Social</a></li>
           
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
            
            <div class="form-group{{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Meta Tag Keyword</label>

                            <div class="col-md-9">
                            <textarea name="meta_keyword" class="form-control">{{ old('meta_keyword') }}</textarea>
                              

                                @if ($errors->has('meta_keyword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meta_keyword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
            <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Meta Tag Description</label>

                            <div class="col-md-9">
                            <textarea name="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
                              

                                @if ($errors->has('meta_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meta_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Email</label>

                            <div class="col-md-9">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                                  

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
             <div class="form-group{{ $errors->has('item_perpage') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Item Per Page</label>

                            <div class="col-md-9">
                            <input type="text" name="item_perpage" class="form-control" value="{{ old('item_perpage') }}">
                                                  

                                @if ($errors->has('item_perpage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('item_perpage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                <div class="form-group{{ $errors->has('description_limit') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Description Limit</label>

                            <div class="col-md-9">
                            <input type="text" name="description_limit" class="form-control" value="{{ old('description_limit') }}">
                                                  

                                @if ($errors->has('description_limit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                 <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Latitude</label>

                            <div class="col-md-9">
                            <input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}">
                                                  

                                @if ($errors->has('latitude'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('latitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                  
                  <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Longitude</label>

                            <div class="col-md-9">
                            <input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}">
                                                  

                                @if ($errors->has('longitude'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('longitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         
             
            </div>
            <div class="tab-pane" id="tab-description">
              
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($datas as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="{{asset($language['image'])}}" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($datas as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  
                   
            <div class="form-group">
                            <label class="col-md-3 control-label">Meta Title</label>

                            <div class="col-md-9">
                            
                            <input type="text" name="setting_description[<?php echo $language['language_id']; ?>][meta_title]" value="" placeholder="Meta Tag" class="form-control" />
                              

                               
                            </div>
                        </div>
            <div class="form-group">
                            <label class="col-md-3 control-label">Name</label>

                            <div class="col-md-9">
                            
                            <input type="text" name="setting_description[<?php echo $language['language_id']; ?>][name]" value="" placeholder="Company/Organization Name" class="form-control" />
                              

                               
                            </div>
                        </div>
                  
                  <div class="form-group">
                            <label class="col-md-3 control-label">Telephone</label>

                            <div class="col-md-9">
                            
                            <input type="text" name="setting_description[<?php echo $language['language_id']; ?>][telephone]" value="" placeholder="Telephone" class="form-control" />
                              

                               
                            </div>
                        </div>
                  
                  <div class="form-group">
                            <label class="col-md-3 control-label">Fax</label>

                            <div class="col-md-9">
                            
                            <input type="text" name="setting_description[<?php echo $language['language_id']; ?>][fax]" value="" placeholder="Fax" class="form-control" />
                              

                               
                            </div>
                        </div>
                  
                  <div class="form-group">
                            <label class="col-md-3 control-label">Address</label>

                            <div class="col-md-9">
                            <textarea class="form-control" name="setting_description[<?php echo $language['language_id']; ?>][address]"></textarea>
                           
                              

                               
                            </div>
                        </div>
                  
                  
                  
                </div>
                <?php } ?>
              </div>
            </div>
            
            <div class="tab-pane" id="tab-image">
               
               
            <div class="form-group">
                            <label class="col-md-3 control-label">Logo</label>

                            <div class="col-md-9">
                              <a href="" id="thumb-logo" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset('image/back.png')}} " alt="" title="" data-placeholder="{{asset('image/back.png')}} " />
                              </a>
                      <input type="hidden" name="logo" value="" id="input-logo" />
                            </div>
                        </div>
            
            <div class="form-group">
                            <label class="col-md-3 control-label">Icon</label>

                            <div class="col-md-9">
                             <a href="" id="thumb-icon" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset('image/back.png')}} " alt="" title="" data-placeholder="{{asset('image/back.png')}} " />
                              </a>
                      <input type="hidden" name="icon" value="" id="input-icon" />
                            </div>
                        </div>
             <div class="form-group{{ $errors->has('thumb_height') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Thumb Size</label>

                            <div class="col-md-9">
                                <div class="col-md-6">
                                <label class="col-md-4 control-label">Thumb Height</label>
                                <div class="col-md-8">
                                     <input type="text" name="thumb_height" class="form-control" value="{{ old('thumb_height') }}" >
                                      @if ($errors->has('thumb_height'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('thumb_height') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                             <div class="col-md-6">
                                <label class="col-md-4 control-label">Thumb Widht</label>
                                <div class="col-md-8">
                                     <input type="text" name="thumb_width" class="form-control" value="{{ old('thumb_width') }}" >
                                      @if ($errors->has('thumb_width'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('thumb_width') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            
                            </div>
                        </div>
             
             <div class="form-group{{ $errors->has('image_height') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Image Size</label>

                             <div class="col-md-9">
                                <div class="col-md-6">
                                <label class="col-md-4 control-label">Image Height</label>
                                <div class="col-md-8">
                                     <input type="text" name="image_height" class="form-control" value="{{ old('image_height') }}" >
                                      @if ($errors->has('image_height'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image_height') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                             <div class="col-md-6">
                                <label class="col-md-4 control-label">Thumb Widht</label>
                                <div class="col-md-8">
                                     <input type="text" name="image_width" class="form-control" value="{{ old('image_width') }}" >
                                      @if ($errors->has('image_width'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image_width') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            
                            </div>
                        </div>
                        
                        
             
                     
            </div>
            <div class="tab-pane" id="tab-email">
              
               <div class="form-group">
                            <label class="col-md-3 control-label">Protocal</label>
              
                            <div class="col-md-9">
                            <select name="protocal" id="protocal" class="select">
          
                   <option value="0">Localhost</option>
                    <option value="1">SMTP</option>
            
                    </select>
                              

                               
                            </div>
                        </div>
            <div class="form-group">
                            <label class="col-md-3 control-label">Parameter</label>

                            <div class="col-md-9">
                            <input type="text" name="parameter" class="form-control" value="{{ old('parameter') }}" >
                           
                            </div>
                        </div>
                       
            <div class="form-group">
                            <label class="col-md-3 control-label">Host Name</label>

                            <div class="col-md-9">
                            <input type="text" name="host_name" class="form-control" value="{{ old('host_name') }}" >
                           
                            </div>
                        </div>
              <div class="form-group">
                            <label class="col-md-3 control-label">Username</label>

                            <div class="col-md-9">
                            
                              <input type="text" name="username" class="form-control" value="{{ old('username') }}" >

                               
                            </div>
                        </div>
              <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>

                            <div class="col-md-9">
                            <input type="text" name="password" class="form-control" value="{{ old('password') }}" >
                            
                            </div>
                        </div>
              <div class="form-group">
                            <label class="col-md-3 control-label">Smtp Port</label>

                            <div class="col-md-9">
                            <input type="text" name="smtp_port" class="form-control" value="{{ old('smtp_port') }}" >
                           
                            </div>
                        </div>
              
            </div>
            
            
            <div class="tab-pane" id="tab-social">
               
               
            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Facebook</label>

                            <div class="col-md-9">
                             <input type="url" name="facebook" class="form-control" value="{{ old('facebook') }}" >
                              @if ($errors->has('facebook'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
            
            <div class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Twitter</label>

                            <div class="col-md-9">
                             <input type="url" name="twitter" class="form-control" value="{{ old('twitter') }}" >
                              @if ($errors->has('twitter'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
             <div class="form-group{{ $errors->has('gplus') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Google Plus</label>

                            <div class="col-md-9">
                             <input type="url" name="gplus" class="form-control" value="{{ old('gplus') }}" >
                              @if ($errors->has('gplus'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gplus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
             
             <div class="form-group{{ $errors->has('youtube') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">YouTube</label>

                            <div class="col-md-9">
                             <input type="url" name="youtube" class="form-control" value="{{ old('youtube') }}" >
                              @if ($errors->has('youtube'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('youtube') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
             <div class="form-group{{ $errors->has('linkedin') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">LinkedIn</label>

                            <div class="col-md-9">
                             <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin') }}" >
                              @if ($errors->has('linkedin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
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
</div>
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
      content: function() {
        return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
      }
    });

    $(element).popover('show');

    $('#button-image').on('click', function() {
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

//--></script>
@endsection
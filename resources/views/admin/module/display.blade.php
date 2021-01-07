@extends('admin_master')
@section('heading')
{{ $module->title }}
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/modules') }}"> Modules</a></li>
    <li class="breadcrumb-item active">Display</li>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
                <div class="card-heading">{{ $module->title }}</div>
                <div class="card-body">

                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/module/display/save') }}">
                      <input type="hidden" name="module_id" value="{{ $module->id }}" />


                        {!! csrf_field() !!}

                  <div class="table-responsive">
                <table id="images" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Layout</td>
                      <td class="text-left">Position</td>
                      <td class="text-left">Status</td>
                      <td class="text-left">Sort Order</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                                $types[] = array(
                                  'value' => 'full_width',
                                  'title' => 'Top Full Width'
                                  );
                                $types[] = array(
                                  'value' => 'content_top',
                                  'title' => 'Content Top'
                                  );
                                $types[] = array(
                                  'value' => 'content_bottom',
                                  'title' => 'Content Bottom'
                                  );
                                $types[] = array(
                                  'value' => 'content_left',
                                  'title' => 'Content Left'
                                  );
                                $types[] = array(
                                  'value' => 'content_main',
                                  'title' => 'Content Main'
                                  );
                                $types[] = array(
                                  'value' => 'content_right',
                                  'title' => 'Content Right'
                                  );
                                $types[] = array(
                                  'value' => 'bottom_full_width',
                                  'title' => 'Bottom Full Width'
                                  );
                                $types[] = array(
                                  'value' => 'content_header',
                                  'title' => 'Content Header'
                                  );

                    $i= 0;
                    if(count($datas) > 0){
                    foreach ($datas as $tab) {
                    ?>
                    <tr id="image-row<?php echo $i;?>">
                      <td class="text-left {{ $errors->has('tab.'.$i.'.layout_id') ? ' has-error' : '' }}">

                         <select class="form-control" name="tab[{{$i}}][layout_id]">
                          <?php foreach ($layouts as $value) {
                            if($value['id'] == $tab->layout_id) {
                            ?>
                            <option selected="selected" value="{{$value['id']}}">{{$value['title']}} </option>
                          <?php } else { ?>
                          <option value="{{$value['id']}}">{{$value['title']}} </option>
                          <?php } }?>
                        </select>
                         @if ($errors->has('tab.'.$i.'.layout_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tab.'.$i.'.layout_id') }}</strong>
                                    </span>
                                @endif

                      </td>
                      <td class="text-left {{ $errors->has('tab.'.$i.'.position') ? ' has-error' : '' }}">

                        <select class="form-control" id="types_{{ $i }}" onchange="change({{ $i }})" name="tab[{{ $i }}][position]">
                          <?php

                                  foreach ($types as $type) {
                                   if($type['value'] == $tab->position){
                          ?>

                           <option selected="selected" value="{{$type['value']}}">{{$type['title']}}</option>
                           <?php } else {?>
                            <option value="{{$type['value']}}">{{$type['title']}}</option>

                            <?php }

                          }?>
                        </select>
                         @if ($errors->has('tab.'.$i.'.position'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tab.'.$i.'.position') }}</strong>
                                    </span>
                                @endif

                      </td>
                      <td class="text-left {{ $errors->has('tab.'.$i.'.status') ? ' has-error' : '' }}">

                       <select class="form-control" name="tab[{{ $i }}][status]">
                          <?php if($tab->status == 1) {?>

                            <option selected="selected" value="1">Enable</option>
                             <option value="0">Disable</option>
                             <?php } else { ?>
                               <option value="1">Enable</option>
                             <option selected="selected" value="0">Disable</option>
                             <?php }?>

                        </select>
                         @if ($errors->has('tab.'.$i.'.status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tab.'.$i.'.status') }}</strong>
                                    </span>
                                @endif

                      </td>
                      <td class="text-left {{ $errors->has('tab.'.$i.'.sort_order') ? ' has-error' : '' }}">

                        <input type="text" class="form-control" name="tab[{{ $i }}][sort_order]" value="{{ $tab->sort_order }}"/>
                         @if ($errors->has('tab.'.$i.'.sort_order'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tab.'.$i.'.sort_order') }}</strong>
                                    </span>
                                @endif

                      </td>
                      <td class="text-left">
                      <button type="button" onclick="$('#image-row{{ $i }}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                   <?php  $i++; }} else {
              ?>

                     <tr id="image-row<?php echo $i;?>">
                      <td class="text-left {{ $errors->has('tab.'.$i.'.layout_id') ? ' has-error' : '' }}">

                        <select class="form-control" name="tab[{{ $i }}][layout_id]">
                          <?php foreach ($layouts as $value) { ?>
                            <option value="{{$value['id']}}">{{$value['title']}} </option>
                          <?php } ?>
                        </select>
                        @if ($errors->has('tab.'.$i.'.layout_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tab.'.$i.'.layout_id') }}</strong>
                                    </span>
                                @endif

                      </td>
                      <td class="text-left {{ $errors->has('tab.'.$i.'.position') ? ' has-error' : '' }}">

                        <select class="form-control" name="tab[{{ $i }}][position]">

                          <?php

                                  foreach ($types as $type) {

                          ?>


                            <option value="{{$type['value']}}">{{$type['title']}}</option>

                            <?php

                          }?>
                        </select>
                        @if ($errors->has('tab.'.$i.'.position'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tab.'.$i.'.position') }}</strong>
                                    </span>
                                @endif


                      </td>
                      <td class="text-left{{ $errors->has('tab.'.$i.'.status') ? ' has-error' : '' }}">

                        <select class="form-control" name="tab[{{ $i }}][status]">


                            <option value="1">Enable</option>
                             <option value="0">Disable</option>

                        </select>
                        @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tab.'.$i.'.status') }}</strong>
                                    </span>
                                @endif

                      </td>
                      <td class="text-left{{ $errors->has('tab.'.$i.'.sort_order') ? ' has-error' : '' }}">


                        <input type="text" class="form-control" name="tab[{{ $i }}][sort_order]" value="{{ old('tab.'.$i.'.sort_order') }}"/>
                         @if ($errors->has('tab.'.$i.'.sort_order'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tab.'.$i.'.sort_order') }}</strong>
                                    </span>
                                @endif

                      </td>
                      <td class="text-left">
                      <button type="button" onclick="$('#image-row{{ $i }}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>


                   <?php
             }?>
                   </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4"></td>
                      <td class="text-left">
                      <button type="button" onclick="addTab();" data-toggle="tooltip" title="Add Tab" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                      </td>
                    </tr>
                 </tfoot>
                </table>
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
@section('script')

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
        $('.tab-content :first-child').addClass('active');

        //--></script>

    <script type="text/javascript"><!--
        var image_row = '{{$i}}';

        function addTab() {


            html  = '<tr id="image-row' + image_row + '">';
            html += '  <td class="text-left"><select class="form-control" name="tab[' + image_row + '][layout_id]"><?php foreach ($layouts as $value) { ?><option value="{{$value["id"]}}">{{$value["title"]}} </option><?php } ?></select></td>';
            html += '  <td class="text-right"><select class="form-control" name="tab[' + image_row + '][position]"><?php foreach ($types as $type) {?><option value="{{$type["value"]}}">{{$type["title"]}}</option><?php }?></select></td>';
            html += '  <td class="text-right"><select class="form-control" name="tab[' + image_row + '][status]"><option value="1">Enable</option><option value="0">Disable</option></select></td>';
            html += '  <td class="text-right"><input type="text" class="form-control" name="tab[' + image_row + '][sort_order]" value=""/></td>';
            html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';

            $('#images tbody').append(html);

            image_row++;
        }
        $('#article_menu').delegate('.fa-minus-circle', 'click', function() {
            $(this).parent().remove();
        });

        function change(id){
            var va= $('#types_'+id).val();

            if(va != 'menu')
            {
                $('#menu_'+id).fadeOut('slow');
            }
            else
            {
                $('#menu_'+id).fadeIn('slow');
            }
        }
        //--></script>

@endsection

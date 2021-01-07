@extends('admin_master')
@section('heading')
    Advertise Module
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/modules') }}"> Modules</a></li>
    <li class="breadcrumb-item active">Advertise Module</li>

@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/module/update') }}">
                <div class="panel panel-default">
                    <div class="card-body">
                        <input type="hidden" name="module_id" value="{{ $datas['id'] }}" />
                            <input type="hidden" name="module_page" value="AdvertiseModule" />
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
                        <div class="form-group row">
                            <label class="col-md-3 control-label">Columns</label>

                            <div class="col-md-9">
                                <select class="form-control" name="column_no">
                                    @if($datas['setting']->column_no == 1)
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    @else
                                        <option value="1">1</option>
                                        <option value="2" selected>2</option>
                                    @endif
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 control-label">Advertise</label>

                            <div class="col-md-9">
                                <div id="advertises">
                                    @php($row = 0)
                                    @if(count($datas['setting']->advertise) > 0)
                                        @foreach($datas['setting']->advertise as $ad)
                                    <div id="advertises_row{{$row}}" class="form-group row">
                                        <div class="col-md-10 col-sm-10 col-8">
                                            <select class="form-control mb-3" required name="advertise[{{$row}}][id]">
                                                @foreach($datas['advertise'] as $advertise)
                                                    @if($ad->id == $advertise->id)
                                                    <option value="{{$advertise->id}}" selected>{{$advertise->title}}</option>
                                                    @else
                                                        <option value="{{$advertise->id}}">{{$advertise->title}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-4">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-danger margin-top-10 delete_desc btn-sm" onclick="$('#advertises_row0').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button>
                                                </span>
                                        </div>
                                    </div>
                                            @php($row++)
                                        @endforeach
                                    @else
                                        <div id="advertises_row0" class="form-group row">
                                            <div class="col-md-10 col-sm-10 col-8">
                                                <select class="form-control mb-3" required name="advertise[0][id]">
                                                    @foreach($datas['advertise'] as $advertise)
                                                        <option value="{{$advertise->id}}">{{$advertise->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-4">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-danger margin-top-10 delete_desc btn-sm" onclick="$('#advertises_row0').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <button type="button" onclick="addAdvertise();" data-toggle="tooltip" title="Add Advertise" class="btn btn-success btn-sm float-right mt-3"><i class="fa fa-plus-circle"></i></button>
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



@endsection
@section('script')
    <script type="text/javascript"><!--
        var advertises_row = '{{$row}}';

        function addAdvertise() {
            html  = '<div id="advertises_row'+advertises_row+'" class="form-group row">\n' +
                '                                    <div class="col-md-10 col-sm-10 col-8">\n' +
                '                                        <select class="form-control mb-3" required name="advertise['+advertises_row+'][id]">\n' +
                '                                            @foreach($datas['advertise'] as $advertise)\n' +
                '                                            <option value="{{$advertise->id}}">{{$advertise->title}}</option>\n' +
                '                                            @endforeach\n' +
                '                                        </select>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-2 col-sm-2 col-4">\n' +
                '                                                <span class="input-group-btn">\n' +
                '                                                    <button class="btn btn-danger margin-top-10 delete_desc btn-sm" onclick="$(\'#advertises_row'+advertises_row+'\').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button>\n' +
                '                                                </span>\n' +
                '                                    </div>\n' +
                '                            </div>';

            $('#advertises').append(html);

            advertises_row++;
        }


    </script>
@endsection

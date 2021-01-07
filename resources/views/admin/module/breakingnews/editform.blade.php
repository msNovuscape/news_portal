@extends('admin_master')
@section('heading')
    {{$datas['module_page']}}
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/modules') }}"> Modules</a></li>
    <li class="breadcrumb-item active">{{$datas['module_page']}}</li>

@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/module/update') }}">
                <div class="panel panel-default">
                    <div class="card-body">
                        <input type="hidden" name="module_id" value="{{ $datas['id'] }}" />
                            <input type="hidden" name="module_page" value="{{$datas['module_page']}}" />
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
                        @if(isset($datas['menu']))
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Menu</label>
                                <div class="col-md-9">
                                    <select class="form-control" required name="menu">
                                        @foreach($datas['menu'] as $menu)
                                            @if($menu->id == $datas['setting']->menu)
                                            <option value="{{$menu->id}}" selected>{{$menu->title}}</option>
                                            @else
                                                <option value="{{$menu->id}}">{{$menu->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('menu'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('menu') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        @endif
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Limit</label>
                                <div class="col-md-9">
                                    <input type="text" required name="limit" value="{{$datas['setting']->limit}}" placeholder="10" class="form-control{{ $errors->has('limit') ? ' is-invalid' : '' }}" />
                                    @if ($errors->has('limit'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('limit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @if(isset($datas['layout']))
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Layout</label>
                                <div class="col-md-9">
                                    <select class="form-control" required name="layout">
                                        @foreach($datas['layout'] as $layout)
                                            @if($layout == $datas['setting']->layout)
                                            <option value="{{$layout}}" selected>{{$layout}}</option>
                                            @else
                                                <option value="{{$layout}}">{{$layout}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('layout'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('layout') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        @endif
                        @if(isset($datas['columns']))
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Column</label>
                                <div class="col-md-9">
                                    <select class="form-control" required name="columns">
                                        @foreach($datas['columns'] as $column)
                                            @if($column == $datas['setting']->columns)
                                                <option value="{{$column}}" selected>{{$column}}</option>
                                            @else
                                                <option value="{{$column}}">{{$column}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('columns'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('columns') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        @endif
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

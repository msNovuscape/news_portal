@extends('admin_master')
@section('heading')
New Layout
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/layout') }}">Layouts</a></li>
    <li class="breadcrumb-item active">New Language</li>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/layout/save') }}">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-10">


                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Layout Title</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control {{ $errors->has('layout_title') ? ' is-invalid' : '' }}" name="layout_title" value="{{ old('layout_title') }}">
                                        @if ($errors->has('layout_title'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('layout_title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Layout Route</label>
                                    <div class="col-md-10">
                                        <select name="route" id="route" class="form-control {{ $errors->has('route') ? ' is-invalid' : '' }}" >

                                            <option value="Article">Article Page </option>
                                            <option value="Home">Home Page </option>
                                            <option value="Contact">Contact</option>
                                            <option value="MultipleArticle">Multiple Article </option>
                                            <option value="SingleArticle">Single Article </option>


                                        </select>
                                        @if ($errors->has('route'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('route') }}</strong>
                                        </span>
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
@endsection

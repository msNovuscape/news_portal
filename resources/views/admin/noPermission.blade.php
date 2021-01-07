@extends('admin_master')
@section('heading')
No Permission

@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Permission Denied</li>

@stop
@section('content')
 <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-body">
            <div class="alert alert-danger">Sorry ! You Dont have Permission to Access This page</div>
          </div>
      </div>

    </div>
  <div>
@stop()

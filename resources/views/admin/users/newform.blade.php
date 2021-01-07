@extends('admin_master')
@section('heading')
New User
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/user') }}">Users</a></li>
    <li class="breadcrumb-item active">New User</li>

@stop
@section('content')
 <div class="row">
    <div class="col-md-12">
        <div class="card">

                <div class="card-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/user/save') }}">
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-10">
                         <div class="form-group">
                            <label class="col-md-2 control-label">User Group</label>

                            <div class="col-md-10">
                                <select class="form-control {{ $errors->has('group') ? ' is-invalid' : '' }}" name="group">
                                    @foreach($groups as $group)
                                        @if($group->id == old('group'))
                                            <option selected="selected" value="{{$group->id}}">{{$group->group_title}}</option>
                                        @else
                                            <option value="{{$group->id}}">{{$group->group_title}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('group'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('group') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Name</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">E-Mail Address</label>

                            <div class="col-md-10">
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Password</label>

                            <div class="col-md-10">
                                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Confirm Password</label>

                            <div class="col-md-10">
                                <input type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
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

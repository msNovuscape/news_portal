@extends('admin_master')
@section('heading')
    Edit Language
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/language') }}">Language</a></li>
    <li class="breadcrumb-item active">Edit Language</li>

@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/language/update') }}">
                        <input type="hidden" name="id" value="{{$datas['language']->id}}">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Title</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{$datas['language']->title}}" placeholder="Nepali">

                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Code</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ $datas['language']->code }}" placeholder="NPL">

                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Sort Order</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control{{ $errors->has('sort_order') ? ' is-invalid' : '' }}" name="sort_order" value="{{ $datas['language']->sort_order }}" placeholder="1">

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
                                                @if($status['value'] == $datas['language']->status)
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
                                    <label class="col-md-2 control-label">Default</label>

                                    <div class="col-md-10">
                                        <select name="defa" id="defa" class="form-control{{ $errors->has('defa') ? ' is-invalid' : '' }}" >
                                            @foreach($datas['defa'] as $defa)
                                                @if($defa['value'] == $datas['language']->defa)
                                                    <option value="{{$defa['value']}}" selected>{{$defa['title']}}</option>
                                                @else
                                                    <option value="{{$defa['value']}}">{{$defa['title']}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @if ($errors->has('defa'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('defa') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Flag</label>

                                    <div class="col-md-10">
                                        <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="{{ asset($datas['image']) }} " alt="" title="" data-placeholder="{{asset($datas['placeholder'])}} " /></a>
                                        <input type="hidden" name="image" value="{{$datas['language']->flag}}" id="input-image" />

                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
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
@endsection

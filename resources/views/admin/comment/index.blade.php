@extends('admin_master')
@section('heading')
    Comment
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Comment</li>
@stop

@section('content')

    <div class="row">
        <b style="text-align:center">{{$datas['article']->first()->title}}</b>

        <div class="col-md-12">
            <div class="card">

                <div class="card-body table-responsive p-0">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Comment</th>
                            <th>Author</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td><input type="text" id="filter_comment" value="{{$datas['filter_comment']}}" class="form-control"></td>
                            <td></td>
                            <td></td>
                            <td>
                                <select class="form-control" id="filter_status">
                                    <option value="">Select Status</option>
                                    @foreach($datas['status'] as $status)
                                        @if($status['value'] == $datas['filter_status'])
                                            <option value="{{$status['value']}}" selected>{{$status['title']}}</option>
                                        @else
                                            <option value="{{$status['value']}}">{{$status['title']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td><a href="javascript:void(0)" onclick="filterData()" class="btn btn-success btn-sm float-right"><i class="fa fa-search"></i> Search </a> </td>
                        </tr>

                        <tr>

                        <?php foreach ($datas['comment'] as $row) { ?>
                            <td><?php echo $row->comment;?></td>
                            <td><?php echo $row->name;?></td>
                            <td><?php echo $row->email;?></td>
                            <td><?php echo $row->status == 1 ? 'Active' : 'Inactive';?></td>

                            <td>
{{--
                                <a href="{{url('/admin/comment/'.$row->id)}}" class="btn btn-info btn-sm float-left mr-1">Reply</a>
--}}
                                <a href="{{url('/admin/comment/'.$row->id.'/status')}}" class="btn btn-danger btn-sm float-right mr-1"><?php echo $row->status == 1 ? 'Unpublish' : 'Publish';?></a>

                            </td>
                        </tr>
                        <?php  } ?>
                        </tbody>


                    </table>

                </div><!-- /.box-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <?php echo $datas['comment']->render();?>
                    </ul>
                </div>
            </div>
        </div>
    </div>



@stop()
@section('script')
    <script type="text/javascript">
        function confirm_delete(ids){
            if(confirm('Do You Want To Delete This data?')){
                var url= "{{ url('/admin/article/delete/') }}"+ids;
                location = url;

            }
        }

        function filterData()
        {
            var url = '{{url('/admin/comment/'.$datas['article']->first()->id.'?')}}';
            var filter_comment = $('#filter_comment').val();
            var filter_status = $('#filter_status').val();
            if (filter_comment != '')
            {
                url += '&filter_comment='+filter_comment;
            }
            if (filter_status != '')
            {
                url += '&filter_status='+filter_status;
            }
            location = url;
        }
        function updateStatus() {

        }
    </script>
@stop()

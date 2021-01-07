@extends('admin_master')
@section('heading')
    Article
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Article</li>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/article/addnew') }}" class="btn btn-primary float-right btn-sm"><i class="fa fa-fw fa-plus"></i>Add New Article</a>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td></td>
                            <td><input type="text" id="filter_title" value="{{$datas['filter_title']}}" class="form-control"></td>
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

                        <?php $i= 0;
                        foreach ($datas['article'] as $row) { ?>
                        <tr>
                            <td><?php echo ++$i ;?></td>

                            <td><?php echo $row->title;?></td>
                            <td><?php echo $row->status == 1 ? 'Active' : 'Inactive';?></td>

                            <td>
                                <a href="{{url('/admin/comment/'.$row->id)}}" class="btn btn-info btn-sm float-left mr-1">Comment</a>

                                <a href="{{url('/admin/article/edit/'.$row->id)}}" class="btn btn-primary btn-sm float-left mr-1"><i class="fa fa-edit"></i></a>

                                <a href="javascript:void(0);" onClick="confirm_delete('/{{$row->id}}')" class="btn btn-danger btn-sm float-left"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php  } ?>
                        </tbody>


                    </table>

                </div><!-- /.box-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <?php echo $datas['article']->render();?>
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
            var url = '{{url('/admin/article?')}}';
            var filter_title = $('#filter_title').val();
            var filter_status = $('#filter_status').val();
            if (filter_title != '')
            {
                url += '&filter_title='+filter_title;
            }
            if (filter_status != '')
            {
                url += '&filter_status='+filter_status;
            }
            location = url;
        }
    </script>
@stop()

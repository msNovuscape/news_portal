@extends('admin_master')
@section('heading')
    Users
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Users</li>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/user/addnew') }}" class="btn btn-primary float-right btn-sm"><i class="fa fa-fw fa-plus"></i>Add New Group</a>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Group</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php $i=1;
                        foreach ($data as $row) { ?>
                        <tr>
                            <td><?php echo $i++ ;?></td>
                            <td>{{\App\Models\UserGroup::getTitle($row->group_id)}}</td>
                            <td><?php echo $row->name;?></td>
                            <td> <?php echo $row->email;?></td>
                            <td><a href="{{ url('/admin/user/edit/'.$row->id) }}" class="btn btn-primary btn-sm float-right mr-1"><i class="fa fa-edit"></i></a><a href="javascript:void(0);" onClick="confirm_delete('/{{$row->id}}')" class="btn btn-danger btn-sm float-right mr-1"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <?php  }

                        ?>


                    </table>

                </div><!-- /.box-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <?php echo $data->render();?>
                    </ul>
                </div>
            </div>
        </div>
    </div>



@stop()
@section('script')
    <script type="text/javascript">
        function confirm_delete(ids){
            if(confirm('Do You Want To Delete This User Group?')){
                var url= "{{ url('/admin/user/delete/') }}"+ids;
                location = url;

            }
        }
    </script>
@stop()

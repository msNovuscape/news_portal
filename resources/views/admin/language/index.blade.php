@extends('admin_master')
@section('heading')
    Language
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Language</li>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/language/addnew') }}" class="btn btn-primary float-right btn-sm"><i class="fa fa-fw fa-plus"></i>Add New Language</a>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Default</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php $i=1;
                        foreach ($datas['language'] as $row) { ?>
                        <tr>
                            <td><?php echo $i++ ;?></td>
                            <td><?php echo $row->title;?></td>
                            <td> <?php echo $row->code;?></td>
                            <td>{{$row->status == 1 ? 'Enabled' : 'Disabled'}}</td>
                            <td>{{$row->defa == 1 ? 'Default' : 'Non Default'}}</td>
                            <td><a href="{{ url('/admin/language/edit/'.$row->id) }}" class="btn btn-primary btn-sm float-right mr-1"><i class="fa fa-edit"></i></a><a href="javascript:void(0);" onClick="confirm_delete('/{{$row->id}}')" class="btn btn-danger btn-sm float-right mr-1"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <?php  }

                        ?>
                        </tbody>

                    </table>

                </div><!-- /.box-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <?php echo $datas['language']->render();?>
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
                var url= "{{ url('/admin/language/delete/') }}"+ids;
                location = url;

            }
        }
    </script>
@stop()

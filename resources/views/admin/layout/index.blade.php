@extends('admin_master')
@section('heading')
Layout
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Layout</li>
@stop
@section('content')
 <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ url('/admin/layout/addnew') }}" class="btn btn-primary float-right btn-sm"><i class="fa fa-fw fa-plus"></i>Add New Layout</a>
          </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>S.N.</th>
                        <th> Layout Title</th>
                        <th>Layout Route</th>

                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php $i=1;
                        foreach ($data as $row) { ?>
                          <tr>
                        <td><?php echo $i++ ;?></td>
                        <td><?php echo $row->layout_title;?></td>
                        <td><?php echo $row->layout_route;?></td>

                        <td><a href="{{ url('/admin/layout/delete/'.$row->layout_id) }}" class="btn btn-danger float-left btn-sm"><i class="fa fa-trash"></i></a></td>
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
  <div>
@stop()

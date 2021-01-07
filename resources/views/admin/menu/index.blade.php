@extends('admin_master')
@section('heading')
    Menu
@stop
@section('breadcrubm')
    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Menu</li>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/menu/addnew') }}" class="btn btn-primary float-right btn-sm"><i class="fa fa-fw fa-plus"></i>Add New Menu</a>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Sort Order</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php $i=1;
                        foreach ($datas as $row) { ?>
                        <tr>
                            <td><?php echo $i++ ;?></td>

                            <td><?php echo $row['title'];?></td>
                            <td><?php echo $row['sort_order'];?></td>

                            <td><a href="<?php echo $row['edit'];?>" class="btn btn-primary btn-sm float-left mr-1"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" onClick="confirm_delete('/{{$row['id']}}')" class="btn btn-danger btn-sm float-left"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @if(count($row['children']) > 0)
                            @foreach($row['children'] as $children)
                                <tr>
                                    <td><?php echo $i++ ;?></td>

                                    <td><?php echo $children['title'];?></td>
                                    <td><?php echo $children['sort_order'];?></td>

                                    <td><a href="<?php echo $children['edit'];?>" class="btn btn-primary btn-sm float-left mr-1"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" onClick="confirm_delete('/{{$children['id']}}')" class="btn btn-danger btn-sm float-left"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @if(count($children['children']) > 0)
                                    @foreach($children['children'] as $child)
                                        <tr>
                                            <td><?php echo $i++ ;?></td>

                                            <td><?php echo $child['title'];?></td>
                                            <td><?php echo $child['sort_order'];?></td>

                                            <td>
                                                <a href="<?php echo $child['edit'];?>" class="btn btn-primary btn-sm float-left mr-1"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:void(0);" onClick="confirm_delete('/{{$child['id']}}')" class="btn btn-danger btn-sm float-left"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                    @endforeach

                                @endif
                            @endforeach

                        @endif
                        <?php  } ?>
                        </tbody>


                    </table>

                </div><!-- /.box-body -->

            </div>
        </div>
    </div>



@stop()
@section('script')
    <script type="text/javascript">
        function confirm_delete(ids){
            if(confirm('Do You Want To Delete This data?')){
                var url= "{{ url('/admin/menu/delete/') }}"+ids;
                location = url;

            }
        }
    </script>
@stop()

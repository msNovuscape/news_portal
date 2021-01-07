
<?php $__env->startSection('heading'); ?>
    Advertise
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Advertise</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="<?php echo e(url('/admin/advertise/addnew')); ?>" class="btn btn-primary float-right btn-sm"><i class="fa fa-fw fa-plus"></i>Add New Advertise</a>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Href</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php $i=1;
                        foreach ($datas['advertise'] as $row) { ?>
                        <tr>
                            <td><?php echo $i++ ;?></td>
                            <td><?php echo $row->title;?></td>
                            <td> <?php echo $row->href;?></td>
                            <td><?php echo e($row->status == 1 ? 'Enabled' : 'Disabled'); ?></td>
                            <td><a href="<?php echo e(url('/admin/advertise/edit/'.$row->id)); ?>" class="btn btn-primary btn-sm float-right mr-1"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($row->id); ?>')" class="btn btn-danger btn-sm float-right mr-1"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <?php  }

                        ?>
                        </tbody>

                    </table>

                </div><!-- /.box-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <?php echo $datas['advertise']->render();?>
                    </ul>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function confirm_delete(ids){
            if(confirm('Do You Want To Delete This data?')){
                var url= "<?php echo e(url('/admin/advertise/delete/')); ?>"+ids;
                location = url;

            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\news\local\resources\views/admin/advertise/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('heading'); ?>
    Article
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Article</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="<?php echo e(url('/admin/article/addnew')); ?>" class="btn btn-primary float-right btn-sm"><i class="fa fa-fw fa-plus"></i>Add New Article</a>
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
                            <td><input type="text" id="filter_title" value="<?php echo e($datas['filter_title']); ?>" class="form-control"></td>
                            <td>
                                <select class="form-control" id="filter_status">
                                    <option value="">Select Status</option>
                                    <?php $__currentLoopData = $datas['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($status['value'] == $datas['filter_status']): ?>
                                            <option value="<?php echo e($status['value']); ?>" selected><?php echo e($status['title']); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($status['value']); ?>"><?php echo e($status['title']); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <a href="<?php echo e(url('/admin/comment/'.$row->id)); ?>" class="btn btn-info btn-sm float-left mr-1">Comment</a>

                                <a href="<?php echo e(url('/admin/article/edit/'.$row->id)); ?>" class="btn btn-primary btn-sm float-left mr-1"><i class="fa fa-edit"></i></a>

                                <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($row->id); ?>')" class="btn btn-danger btn-sm float-left"><i class="fa fa-trash"></i></a>
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



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function confirm_delete(ids){
            if(confirm('Do You Want To Delete This data?')){
                var url= "<?php echo e(url('/admin/article/delete/')); ?>"+ids;
                location = url;

            }
        }

        function filterData()
        {
            var url = '<?php echo e(url('/admin/article?')); ?>';
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\news\local\resources\views/admin/article/index.blade.php ENDPATH**/ ?>
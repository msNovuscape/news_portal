<?php $__env->startSection('heading'); ?>
    Comment
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Comment</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <b style="text-align:center"><?php echo e($datas['article']->first()->title); ?></b>

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
                            <td><input type="text" id="filter_comment" value="<?php echo e($datas['filter_comment']); ?>" class="form-control"></td>
                            <td></td>
                            <td></td>
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

                        <tr>

                        <?php foreach ($datas['comment'] as $row) { ?>
                            <td><?php echo $row->comment;?></td>
                            <td><?php echo $row->name;?></td>
                            <td><?php echo $row->email;?></td>
                            <td><?php echo $row->status == 1 ? 'Active' : 'Inactive';?></td>

                            <td>

                                <a href="<?php echo e(url('/admin/comment/'.$row->id.'/status')); ?>" class="btn btn-danger btn-sm float-right mr-1"><?php echo $row->status == 1 ? 'Unpublish' : 'Publish';?></a>

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
            var url = '<?php echo e(url('/admin/comment/'.$datas['article']->first()->id.'?')); ?>';
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\news\local\resources\views/admin/comment/index.blade.php ENDPATH**/ ?>
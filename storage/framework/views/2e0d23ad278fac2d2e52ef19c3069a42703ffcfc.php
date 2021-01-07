
<?php $__env->startSection('heading'); ?>
    Menu
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Menu</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="<?php echo e(url('/admin/menu/addnew')); ?>" class="btn btn-primary float-right btn-sm"><i class="fa fa-fw fa-plus"></i>Add New Menu</a>
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
                                <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($row['id']); ?>')" class="btn btn-danger btn-sm float-left"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php if(count($row['children']) > 0): ?>
                            <?php $__currentLoopData = $row['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo $i++ ;?></td>

                                    <td><?php echo $children['title'];?></td>
                                    <td><?php echo $children['sort_order'];?></td>

                                    <td><a href="<?php echo $children['edit'];?>" class="btn btn-primary btn-sm float-left mr-1"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($children['id']); ?>')" class="btn btn-danger btn-sm float-left"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php if(count($children['children']) > 0): ?>
                                    <?php $__currentLoopData = $children['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo $i++ ;?></td>

                                            <td><?php echo $child['title'];?></td>
                                            <td><?php echo $child['sort_order'];?></td>

                                            <td>
                                                <a href="<?php echo $child['edit'];?>" class="btn btn-primary btn-sm float-left mr-1"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($child['id']); ?>')" class="btn btn-danger btn-sm float-left"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php endif; ?>
                        <?php  } ?>
                        </tbody>


                    </table>

                </div><!-- /.box-body -->

            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function confirm_delete(ids){
            if(confirm('Do You Want To Delete This data?')){
                var url= "<?php echo e(url('/admin/menu/delete/')); ?>"+ids;
                location = url;

            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\news\local\resources\views/admin/menu/index.blade.php ENDPATH**/ ?>
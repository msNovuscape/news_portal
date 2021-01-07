
<?php $__env->startSection('heading'); ?>
Modules
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Modules</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="row">
    <div class="col-md-12">

      <div class="card">
          <div class="card-body table-responsive p-0">
              <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>S.N.</th>
                        <th> Module Title</th>
                          <th> Language</th>
                        <th>Action </th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php $i=1;
                        foreach ($datas as $row) { ?>
                          <tr>
                        <td><?php echo $i++ ;?></td>
                        <td><?php echo $row['title'];?></td>
                              <td></td>
                        <td><a href="<?php echo e(url('/admin/module/addnew/'.$row['title'])); ?>" class="btn btn-primary float-right btn-sm"><i class="fa fa-plus"></i></a></td>
                      </tr>
                      <?php
                            foreach ($row['child'] as $value) { ?>
                              <tr>
                        <td></td>
                        <td><b><?php echo $value['title'];?></b></td>
                                  <td><?php echo e($value['language']); ?></td>
                        <td>
                          <a href="<?php echo e(url('/admin/module/edit/'.$value['id'])); ?>" class="btn btn-primary float-right mr-1 btn-sm"><i class="fa fa-edit"></i></a>
                          <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($value['id']); ?>')" class="btn btn-danger float-right mr-1 btn-sm"><i class="fa fa-trash"></i></a>

                          <a href="<?php echo e(url('/admin/module/display/'.$value['id'])); ?>" class="btn btn-primary float-right mr-1 btn-sm">Display</a></td>
                      </tr>
                           <?php  }
                      ?>
                      <?php  }

                      ?>
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
            if(confirm('Do You Want To Delete This Module?')){
                var url= "<?php echo e(url('/admin/module/delete/')); ?>"+ids;
                location = url;

            }
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\news\local\resources\views/admin/module/index.blade.php ENDPATH**/ ?>
<?php if(count($datas['advertise']) > 0): ?>
<div class="hot-news-ads">
    <div class="row">
    <?php $__currentLoopData = $datas['advertise']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($advertise->href); ?>" target="_blank" class="<?php echo e($datas['class']); ?>"><img src="<?php echo e(asset('/image/'.$advertise->image)); ?>" alt="image"></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/module/advertise.blade.php ENDPATH**/ ?>
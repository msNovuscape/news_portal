
<?php $__env->startSection('header'); ?>
    <?php if(count($datas['header_content']) > 0): ?>
    <?php $__currentLoopData = $datas['header_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $header_content['module']; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(count($datas['top_content']) > 0): ?>
        <section class="default-news-area ptb-15">
            <div class="container">
            <?php $__currentLoopData = $datas['top_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php echo $top_content['module']; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </section>
    <?php endif; ?>
    <?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
        $class = 'col-lg-6 col-md-4 col-12 center-panel';
    } elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
        $class = 'col-md-9 col-lg-9 col-12';
    }
    elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
        $class = 'col-md-9 col-lg-9 col-12';
    } else{
        $class = 'col-md-12';
    } ?>
    <?php if(count($datas['left_content']) > 0 || count($datas['right_content']) > 0 || count($datas['main_modules']) > 0): ?>
        <section class="default-news-area ptb-15">
            <div class="container pt-4 pb-4 bg-white">
                <div class="row">
                    <?php if(count($datas['left_content']) > 0): ?>
                        <aside class="col-lg-3 col-md-4 col-12">
                            <?php $__currentLoopData = $datas['left_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $lcontent['module']; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </aside>
                    <?php endif; ?>
                    <div class="<?php echo e($class); ?>">
                        <?php $__currentLoopData = $datas['main_modules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $main_module['module']; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php if(count($datas['right_content']) > 0): ?>
                        <aside class="col-lg-3 col-md-4 col-12">
                            <?php $__currentLoopData = $datas['right_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $rcontent['module']; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </aside>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php if(count($datas['bottom_content']) > 0): ?>
        <section class="default-news-area ptb-15">
            <div class="container">
                <?php $__currentLoopData = $datas['bottom_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bottom_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php echo $bottom_content['module']; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front_master1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/home.blade.php ENDPATH**/ ?>
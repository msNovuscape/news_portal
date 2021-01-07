<?php if(count($datas['article']) > 0): ?>
    <?php $firstarray = array_shift($datas['article']);?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="section-title"> <h2><?php echo e($datas['title']); ?> <a href="<?php echo e($datas['menu_href']); ?>" class="view_button">View All</a> </h2> </div>
        <div class="international-news-inner">
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-international-news">
                        <div class="news-image">
                            <img src="<?php echo e(asset($firstarray['image'])); ?>" alt="<?php echo e($firstarray['title']); ?>">
                        </div>
                        <div class="news-content">
                            <span><i class="icofont-calendar"></i> <?php echo e($firstarray['created_at']->format('F j, Y')); ?></span>
                            <h3><a href="<?php echo e($firstarray['url']); ?>"><?php echo e($firstarray['title']); ?></a></h3>
                            <p><?php echo e($firstarray['description']); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="international-news-list">
                        <?php $__currentLoopData = $datas['article']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row media news-media align-items-center">
                            <a class="col-lg-3 col-md-4 col-sm-4 col-4" href="<?php echo e($article['url']); ?>"> <img src="<?php echo e(asset($article['image'])); ?>" alt="<?php echo e($article['title']); ?>"> </a>
                            <div class="content col-lg-9 col-md-8 col-sm-8 col-8">
                                <span><i class="icofont-calendar"></i> <?php echo e($article['created_at']->format('F j, Y')); ?></span>
                                <h3><a href="<?php echo e($article['url']); ?>"><?php echo e($article['title']); ?></a></h3>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/module/Featured.blade.php ENDPATH**/ ?>
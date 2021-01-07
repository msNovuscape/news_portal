<?php if(count($datas['article']) > 0): ?>
<div class="row">
    <div class="col-md-12">
        <div class="section-title">
            <h2><?php echo e($datas['title']); ?></h2>
            <?php if($datas['menu_href'] != ''): ?>
                <a href="<?php echo e($datas['menu_href']); ?>" class="view-more">View More <i class="icofont-rounded-double-right"></i></a>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="popular-news-slides owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        <?php $__currentLoopData = $datas['article']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="owl-item">
                            <div class="col-lg-12 col-md-12">
                                <div class="single-popular-news">
                                    <div class="news-image">
                                        <img src="<?php echo e(asset($article['image'])); ?>" alt="<?php echo e($article['title']); ?>">
                                    </div>
                                    <div class="news-content">
                                        <h3><?php echo e($article['title']); ?></h3>
                                        <span><i class="icofont-calendar"></i> <?php echo e($article['created_at']->format('F j, Y')); ?></span>
                                    </div>
                                    <a href="<?php echo e($article['url']); ?>" class="link-overlay"></a>

                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev"><i class="icofont-rounded-left"></i></button>
                    <button type="button" role="presentation" class="owl-next"><i class="icofont-rounded-right"></i></button>
                </div>

                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/module/Cursel.blade.php ENDPATH**/ ?>
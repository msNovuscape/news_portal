<div class="breaking-news">
    <div class="container">
        <div class="breaking-news-content clearfix">
            <h6 class="breaking-title"><i class="icofont-flash"></i> <?php echo e($datas['title']); ?>:</h6>
            <div class="breaking-news-slides owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        <?php $__currentLoopData = $datas['article']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="owl-item cloned">
                            <div class="single-breaking-news">
                                <p><a href="<?php echo e($article['url']); ?>"><?php echo e($article['title']); ?></a></p>
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
<?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/module/breakingnews.blade.php ENDPATH**/ ?>
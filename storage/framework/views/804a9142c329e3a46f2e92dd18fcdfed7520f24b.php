<?php if(count($datas['article']) > 0): ?>
    <div class="around-the-world-news pt-40">
        <div class="section-title">
            <h2><?php echo e($datas['title']); ?></h2>
            <?php if($datas['menu_href'] != ''): ?>
            <a href="<?php echo e($datas['menu_href']); ?>" class="view-more">View More <i class="icofont-rounded-double-right"></i></a>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php $__currentLoopData = $datas['article']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="<?php echo e($datas['class']); ?>">
                <div class="single-around-the-world-news">
                    <div class="news-image">
                        <a href="<?php echo e($article['url']); ?>"><img src="<?php echo e(asset($article['image'])); ?>" alt="<?php echo e($article['title']); ?>"></a>
                    </div>
                    <div class="news-content">
                        <ul>
                            <li><i class="icofont-calendar"></i> <?php echo e($article['created_at']->format('F j, Y')); ?></li>

                        </ul>
                        <h3><a href="<?php echo e($article['url']); ?>"><?php echo e($article['title']); ?></a></h3>

                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/module/Grid.blade.php ENDPATH**/ ?>
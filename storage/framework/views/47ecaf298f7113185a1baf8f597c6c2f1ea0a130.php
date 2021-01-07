<?php if(count($datas['article']) > 0): ?>
    <?php $firstarray = array_shift($datas['article']);?>
    <div class="around-the-world-news pt-40">
        <div class="section-title">
            <h2><?php echo e($datas['title']); ?></h2>
            <?php if($datas['menu_href'] != ''): ?>
            <a href="<?php echo e($datas['menu_href']); ?>" class="view-more">View More <i class="icofont-rounded-double-right"></i></a>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="<?php echo e($datas['class']); ?>">
                <div class="single-around-the-world-news">
                    <div class="news-image">
                        <a href="<?php echo e($firstarray['url']); ?>"><img src="<?php echo e(asset($firstarray['image'])); ?>" alt="<?php echo e($firstarray['title']); ?>"></a>
                    </div>
                    <div class="news-content">
                        <ul>
                            <li><i class="icofont-calendar"></i> <?php echo e($firstarray['created_at']->format('F j, Y')); ?></li>

                        </ul>
                        <h3><a href="<?php echo e($firstarray['url']); ?>"><?php echo e($firstarray['title']); ?></a></h3>
                        <p><?php echo e($firstarray['description']); ?></p>
                    </div>
                </div>
            </div>
            <?php if($datas['column'] > 1): ?>
                <?php ($second_array = array_shift($datas['article'])); ?>
                <div class="<?php echo e($datas['class']); ?>">
                    <div class="single-around-the-world-news">
                        <div class="news-image">
                            <a href="<?php echo e($second_array['url']); ?>"><img src="<?php echo e(asset($second_array['image'])); ?>" alt="<?php echo e($second_array['title']); ?>"></a>
                        </div>
                        <div class="news-content">
                            <ul>
                                <li><i class="icofont-calendar"></i> <?php echo e($second_array['created_at']->format('F j, Y')); ?></li>
                                
                            </ul>
                            <h3><a href="<?php echo e($second_array['url']); ?>"><?php echo e($second_array['title']); ?></a></h3>
                            <p><?php echo e($second_array['description']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($datas['column'] > 2): ?>
                <?php ($third_array = array_shift($datas['article'])); ?>
                <div class="<?php echo e($datas['class']); ?>">
                    <div class="single-around-the-world-news">
                        <div class="news-image">
                            <a href="<?php echo e($third_array['url']); ?>"><img src="<?php echo e(asset($third_array['image'])); ?>" alt="<?php echo e($third_array['title']); ?>"></a>
                        </div>
                        <div class="news-content">
                            <ul>
                                <li><i class="icofont-calendar"></i> <?php echo e($third_array['created_at']->format('F j, Y')); ?></li>
                                
                            </ul>
                            <h3><a href="<?php echo e($third_array['url']); ?>"><?php echo e($third_array['title']); ?></a></h3>
                            <p><?php echo e($third_array['description']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($datas['column'] > 3): ?>
                <?php ($fourth_array = array_shift($datas['article'])); ?>
                <div class="<?php echo e($datas['class']); ?>">
                    <div class="single-around-the-world-news">
                        <div class="news-image">
                            <a href="<?php echo e($fourth_array['url']); ?>"><img src="<?php echo e(asset($fourth_array['image'])); ?>" alt="<?php echo e($fourth_array['title']); ?>"></a>
                        </div>
                        <div class="news-content">
                            <ul>
                                <li><i class="icofont-calendar"></i> <?php echo e($fourth_array['created_at']->format('F j, Y')); ?></li>
                                
                            </ul>
                            <h3><a href="<?php echo e($fourth_array['url']); ?>"><?php echo e($fourth_array['title']); ?></a></h3>
                            <p><?php echo e($fourth_array['description']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php $__currentLoopData = $datas['article']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="<?php echo e($datas['class']); ?>">
                <div class=" media around-the-world-news-media align-items-center">
                    <a href="<?php echo e($article['url']); ?>" class="col-lg-2 col-md-2 col-sm-3 col-4"> <img src="<?php echo e(asset($article['image'])); ?>" alt="<?php echo e($article['title']); ?>"> </a>
                    <div class="content col-lg-10 col-md-10 col-sm-9 col-8">
                        <span><i class="icofont-calendar"></i> <?php echo e($article['created_at']->format('F j, Y')); ?></span>
                        <h3><a href="<?php echo e($article['url']); ?>"><?php echo e($article['title']); ?></a></h3>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/module/List.blade.php ENDPATH**/ ?>
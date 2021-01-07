
        <div class="row">
            <div class="col-md-9">
                <div class="block_posts block_1"><!-- block_posts block_1 -->
                    <div class="featured_title"><!-- featured_title -->
                        <h4>Featured News</h4>
                    </div><!-- // featured_title -->

                    <div class="block_inner row"><!-- block_inner -->
                        <div class="big_post col-lg-6 col-md-6 col-sm-6 col-xs-6"><!-- big_post -->

                            <div class="block_img_post"><!-- block_img_post -->
                                <img src="<?php echo e(asset($datas['featured_image'])); ?>" alt="<?php echo e($datas['featured']->title); ?>" class="hz_appear">
                            </div><!-- // block_img_post -->

                            <div class="inner_big_post"><!-- inner_big_post -->
                                <div class="title_post"><!-- title_post -->
                                    <a href="<?php echo e(url('/article/'.$datas['featured']->seo_url)); ?>"><h4><?php echo e($datas['featured']->title); ?></h4></a>
                                </div><!-- // title_post -->

                                <div class="big_post_content"><!-- big_post_content -->
                                    <p><?php echo e(\App\library\Settings::getLimitedWords($datas['featured']->description,0,25)); ?></p>
                                </div><!-- // big_post_content -->

                                <div class="post_date"><!-- post_date -->
                                    <em><a href="<?php echo e(url('/article/'.$datas['featured']->seo_url)); ?>"><?php echo e($datas['featured']->created_at->format('F j, Y')); ?></a></em>
                                </div><!-- // post_date -->
                            </div><!-- // inner_big_post -->
                        </div><!-- // big_post -->

                        <div class="small_list_post col-lg-6 col-md-6 col-sm-6 col-xs-6"><!-- small_list_post -->
                            <ul>
                                <?php if(count($datas['news'])> 0): ?>
                                    <?php $__currentLoopData = $datas['news']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="small_post clearfix"><!-- small_post -->
                                    <div class="img_small_post"><!-- img_small_post -->
                                        <?php ($smimage = $datas['placeholder']); ?>
                                        <?php if(is_file(DIR_IMAGE.$news->image)): ?>
                                            <?php ($smimage = \App\Models\ImageTool::mycrop($news->image,450,300)); ?>
                                        <?php endif; ?>
                                        <img src="<?php echo e(asset($smimage)); ?>" alt="<?php echo e($news->title); ?>" class="hz_appear">
                                    </div><!-- // img_small_post -->
                                    <div class="small_post_content"><!-- small_post_content -->
                                        <div class="title_small_post"><!-- title_small_post -->
                                            <a href="<?php echo e(url('/article/'.$news->seo_url)); ?>"><h5> <?php echo e($news->title); ?></h5></a>
                                        </div><!-- // title_small_post -->
                                        <div class="post_date"><em><a href="<?php echo e(url('/article/'.$news->seo_url)); ?>"><?php echo e($news->created_at->format('F j, Y')); ?></a></em></div>
                                    </div><!-- // small_post_content -->
                                </li><!-- // small_post -->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </ul>
                        </div><!-- // small_list_post -->
                    </div><!-- // block_inner -->
                </div>

            </div>
            <div class="col-md-3">
                <?php echo $datas['module']; ?>

            </div>
        </div>
<?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/module/featurednews.blade.php ENDPATH**/ ?>
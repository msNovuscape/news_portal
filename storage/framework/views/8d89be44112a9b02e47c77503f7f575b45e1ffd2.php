<?php $__env->startSection('header'); ?>
    <style>
        .news-details-area img{
            width: 100%;
        }
        .center-4 {
            margin: auto;
            width: 60%;
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .hide-form {
            display: none;
        }
    </style>
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
        <section class="news-details-area pb-40">
            <div class="container pt-4">
                <div class="page-title-content">
                    <h2><?php echo e($datas['title']); ?></h2>
                    <?php ($total_pagination = count($datas['pagination'])); ?>
                    <?php if($total_pagination > 0): ?>
                        <ul>
                            <?php $__currentLoopData = $datas['pagination']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key == $total_pagination - 1): ?>
                                    <li><?php echo e($value['title']); ?></li>
                                <?php else: ?>
                                    <li><a href="<?php echo e($value['url']); ?>"> <?php echo e($value['title']); ?></a></li>
                                    <li><i class="icofont-rounded-right"></i></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if(count($datas['left_content']) > 0): ?>
                        <aside class="col-lg-3 col-md-4 col-12">
                            <?php $__currentLoopData = $datas['left_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $lcontent['module']; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </aside>
                    <?php endif; ?>
                    <div class="<?php echo e($class); ?>">
                        <?php if($datas['articles']): ?>
                            <div class="news-details">
                                <?php if($datas['image'] != ''): ?>
                                <div class="article-img">
                                    <img src="<?php echo e($datas['image']); ?>" alt="<?php echo e($datas['articles']->title); ?>">
                                </div>
                                <?php endif; ?>

                                <div class="article-content">
                                    <ul class="entry-meta">
                                        <li><i class="icofont-eye-alt"></i> <?php echo e($datas['articles']->visit); ?></li>
                                        <li><i class="icofont-calendar"></i> <?php echo e($datas['articles']->created_at->format('F j, Y')); ?></li>
                                    </ul>

                                    <h3><?php echo e($datas['articles']->title); ?></h3>
                                    <?php echo $datas['articles']->description; ?>


                                    <?php if($datas['video'] != ''): ?>
                                        <div style="position: relative;padding-bottom: 56.25%; padding-top: 25px;height: 0; margin-top: 20px;">
                                            <iframe src="<?php echo e($datas['video']); ?>" frameborder="0" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;"></iframe>
                                        </div>
                                    <?php endif; ?>


                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="comments-area">
                                <h3 class="comments-title">Comments:</h3>
                                <?php if(count($datas['comment']) > 0): ?>
                                    <?php $__currentLoopData = $datas['comment']->where('parent_id',0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <ol class="comment-list">
                                          <li class="comment">
                                            <article class="comment-body">
                                                <footer class="comment-meta">
                                                    <div class="comment-author vcard">
                                                        <b class="fn"><?php echo e($comment->name); ?></b>
                                                        <span class="says">says:</span>
                                                    </div>

                                                    <div class="comment-metadata">
                                                        <a href="#">
                                                            <time><?php echo e($comment->created_at); ?></time>
                                                        </a>
                                                    </div>
                                                </footer>

                                                <div class="comment-content">
                                                    <p><?php echo e($comment->comment); ?></p>
                                                </div>

                                                <div class="reply">
                                                    <a href = "javascript:;" onclick = "show_reply_form(<?php echo e($comment->id); ?>);">Reply</a>
                                                </div>
                                                <div class="center-<?php echo e($comment->id); ?> hide-form comment-respond">
                                                    <button onclick = "close_reply_form(<?php echo e($comment->id); ?>);" style="float: right;">X</button>

                                                    <form method="POST" action="<?php echo e(route('store_comment')); ?>">
                                                        <?php echo csrf_field(); ?>


                                                        <p class="comment-form-comment">
                                                            <label for="comment">Comment</label>
                                                            <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                                        </p>
                                                        <p class="comment-form-author">
                                                            <label for="name">Name <span class="required">*</span></label>
                                                            <input type="text" id="name" name="name" required="required">
                                                        </p>
                                                        <p class="comment-form-email">
                                                            <label for="email">Email <span class="required">*</span></label>
                                                            <input type="email" id="email" name="email" required="required">
                                                        </p>
                                                        <input type="hidden" name="article_id" value="<?php echo e($datas['articles']->article_id); ?>">
                                                        <input type="hidden" name="parent_id" value="<?php echo e($comment->id); ?>">
                                                        <p class="form-submit">
                                                            <input type="submit" name="reply" id="reply" value="Post Reply">
                                                        </p>
                                                    </form>
                                                </div>



                                            </article>



                                        <?php $__currentLoopData = $datas['comment_replies']->where('parent_id',$comment->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment_reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <ol class="children">
                                            <li class="comment">
                                                <article class = "comment-body">
                                                    <footer class = "comment-meta">
                                                        <div class = "comment-author vcard">

                                                            <b class="fn"><?php echo e($comment_reply->name); ?></b>
                                                            <span class="says">says:</span>
                                                        </div>

                                                        <div class="comment-metadata">
                                                            <a href="#">
                                                                <time><?php echo e($comment_reply->created_at); ?></time>
                                                            </a>
                                                        </div>
                                                    </footer>

                                                    <div class="comment-content">
                                                        <p><?php echo e($comment_reply->comment); ?></p>
                                                    </div>

                                                </article>
                                            </li>
                                        </ol>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </li>


                                </ol>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endif; ?>

                                <div class="comment-respond">
                                    <h3 class="comment-reply-title">Leave a Comment</h3>

                                    <form class="comment-form" method="POST" action="<?php echo e(route('store_comment')); ?>">
                                        <?php echo csrf_field(); ?>


                                        <p class="comment-notes">
                                            <span id="email-notes">Your email address will not be published.</span>
                                            Required fields are marked
                                            <span class="required">*</span>
                                        </p>
                                        <p class="comment-form-comment">
                                            <label for="comment">Comment</label>
                                            <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                        </p>
                                        <p class="comment-form-author">
                                            <label for="name">Name <span class="required">*</span></label>
                                            <input type="text" id="name" name="name" required="required">
                                        </p>
                                        <p class="comment-form-email">
                                            <label for="email">Email <span class="required">*</span></label>
                                            <input type="email" id="email" name="email" required="required">
                                        </p>
                                        <p class="form-recaptcha">
                                            <label class="control-label">Captcha<span class="required">*</span></label>

                                        <div class="g-recaptcha" data-sitekey="<?php echo e(env('CAPTCHA_SITE_KEY')); ?>"></div>
                                        </p>
                                        <br/>
                                        
                                        <input type="hidden" name="article_id" value="<?php echo e($datas['articles']->article_id); ?>">
                                        <p class="form-submit">
                                            <input type="submit" name="submit" id="reply-submit" class="submit" value="Post Comment">
                                        </p>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>

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
<?php $__env->startSection('javascript'); ?>

    <script type="text/javascript">

    function show_reply_form(comment_id)
    {
        $('.center-'+comment_id).show();
            $(this).hide();
    }
    function close_reply_form(comment_id) {
        $('.center-'+comment_id).hide();
        $('#show').show();
    }
    /*$('#close').on('click', function () {
        $('.center').hide();
    })*/
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front_master1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/singlearticle.blade.php ENDPATH**/ ?>
<?php ($setting = \App\library\Settings::getSeetingWithDescription()); ?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="copyright" content="&amp;copy; 2000-<?php echo date('Y').' '.\App\library\Settings::getSettings()->name;?>">
    <meta name="keywords" content="<?php echo e(config('app.meta_keyword')); ?>">
    <meta name="description" content="<?php echo e(config('app.meta_description')); ?>">
    <meta property="og:url"  content="<?php echo e(config('app.meta_url')); ?>" />
    <meta property="og:type"  content="<?php echo e(config('app.meta_type')); ?>" />
    <meta property="og:title"  content="<?php echo e(config('app.meta_title')); ?>" />
    <meta property="og:description" content="<?php echo e(config('app.meta_description')); ?>" />
    <meta property="og:image"       content="<?php echo e(config('app.meta_image')); ?>" />
    <meta name='robots' content='index,follow' />
    <meta name="theme-color" content="#002A5B">
    <?php
    $icon = \App\library\Settings::getIcon();
    if(!empty($icon)) { ?>
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset($icon)); ?>" class="lazyload"/>
    <?php }?>
    <link rel="stylesheet" href="<?php echo e(asset('/css/default/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/default/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/default/icofont.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/default/meanmenu.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/default/owl.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/default/magnific-popup.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/default/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/default/responsive.css')); ?>">
    <title><?php echo e(config('app.meta_title')); ?></title>
    <style>
        .navbar-brand img {
            max-height: 40px !important;
        }
    </style>
    <?php echo $__env->yieldContent('stylesheet'); ?>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <header class="header-area">
        <?php echo $__env->make('front/common/top_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('front/common/navbar_area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <?php echo $__env->yieldContent('header'); ?>
    </header>

  <?php echo $__env->yieldContent('content'); ?>
    <footer class="footer-area">
        <div class="copyright-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <p>Copyright © 2019 <a href="#" target="_blank"><?php echo e($setting['description']->name); ?></a>. All Rights Reserved.</p>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <div class="go-top" style="display: none;"><i class="icofont-swoosh-up"></i></div>
    <script src="<?php echo e(asset('/js/default/jquery_003.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/default/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/default/bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/default/jquery_004.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/default/mixitup.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/default/owl.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/default/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/default/form-validator.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/default/contact-form-script.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/default/jquery_002.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/default/main.js')); ?>"></script>
    <?php echo $__env->yieldContent('javascript'); ?>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\news\local\resources\views/front_master1.blade.php ENDPATH**/ ?>
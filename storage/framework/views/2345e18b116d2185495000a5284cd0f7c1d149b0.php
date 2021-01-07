<?php ($languages = \App\Models\Language::where('status', 1)->get()); ?>
<div class="top-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-8 col-sm-4 col-xs-4">
                <div class="city-temperature hidden-sm hidden-xs"> <span><?php echo e($setting['setting']->email); ?></span> || <span><?php echo e($setting['description']->telephone); ?></span></div>
                <?php if(count($languages) > 1): ?>
                    <?php ($default = \App\Models\Language::getSesFrontLanguage()); ?>
                <ul class="top-nav">
                    <li>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span id="default_flag"><?php if($default['flag'] != ''): ?> <img src="<?php echo e(asset($default['flag'])); ?>"> <?php endif; ?></span> <span class="hidden-sm hidden-xs"><?php echo e($default['name']); ?></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item" href="<?php echo e(url('/change_language/'.$language->id)); ?>"><img src="<?php echo e(asset(\App\Models\ImageTool::mycrop($language->flag,15,15))); ?>"> <?php echo e($language->title); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </li>

                </ul>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-8 col-xs-8 text-right">
                <ul class="top-social">
                    <li><a href="#" target="_blank"><i class="icofont-facebook"></i></a></li>
                    <li><a href="#" target="_blank"><i class="icofont-twitter"></i></a></li>
                    <li><a href="#" target="_blank"><i class="icofont-instagram"></i></a></li>
                    <li><a href="#" target="_blank"><i class="icofont-pinterest"></i></a></li>
                    <li><a href="#" target="_blank"><i class="icofont-vimeo"></i></a></li>
                </ul>
                <div class="header-date hidden-sm hidden-xs"> <i class="icofont-clock-time"></i><?php echo e(date('l, M d')); ?> </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/common/top_header.blade.php ENDPATH**/ ?>
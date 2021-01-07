<div class="navbar-area">
    <div class="sinmun-mobile-nav">
        <div class="logo">
            <a href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(\App\library\Settings::getLogo()); ?>" alt="logo">
            </a>
        </div>
    </div>
    <div class="sinmun-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <img src="<?php echo e(\App\library\Settings::getLogo()); ?>" alt="logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent" style="display: block;">
                    <ul class="navbar-nav">
                        <?php ($menus = \App\Models\Menu::getFrontMenu()); ?>
                        <?php if(count($menus) > 0): ?>
                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($menu['layout_id'] == 0): ?>
                                <li class="nav-item"><a href="#" class="nav-link"><?php echo e($menu['title']); ?></a>
                                <?php else: ?>
                                    <li class="nav-item"><a href="<?php echo e($menu['seo_url']); ?>" class="nav-link"><?php echo e($menu['title']); ?></a>
                                <?php endif; ?>
                        <?php if(count($menu['children']) > 0): ?>
                            <ul class="dropdown-menu">
                                <?php $__currentLoopData = $menu['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($smenu['layout_id'] == 0): ?>
                                        <li class="nav-item"><a href="#" class="nav-link"><?php echo e($smenu['title']); ?></a>
                                    <?php else: ?>
                                        <li class="nav-item"><a href="<?php echo e($smenu['seo_url']); ?>" class="nav-link"><?php echo e($smenu['title']); ?></a>
                                    <?php endif; ?>
                                    <?php if(count($smenu['children']) > 0): ?>
                                    <ul class="dropdown-menu">
                                        <?php $__currentLoopData = $smenu['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item"><a href="<?php echo e($children['seo_url']); ?>" class="nav-link"><?php echo e($children['title']); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                            <?php endif; ?>
                                </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                                        <?php endif; ?>
                        </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
            </nav>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\news\local\resources\views/front/common/navbar_area.blade.php ENDPATH**/ ?>
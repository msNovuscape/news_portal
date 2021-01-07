
<?php $__env->startSection('heading'); ?>
Advertise Module
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/modules')); ?>"> Modules</a></li>
    <li class="breadcrumb-item active">Advertise Module</li>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form class="form-horizontal" role="form" id="testform" method="POST" action="<?php echo e(url('/admin/module/save')); ?>">
                <div class="card-body">

                    <input type="hidden" name="module_page" value="AdvertiseModule" />
                        <?php echo csrf_field(); ?>

                        <div class="row">
                         <div class="col-md-10">
                             <ul class="nav nav-tabs ml-auto" id="secondary-tab" role="tablist">
                                 <?php if(count($datas['language']) > 0): ?>
                                     <?php $__currentLoopData = $datas['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <li class="nav-item waves-effect waves-light"><a class="nav-link <?php echo e($language['active']); ?>" href="#tab-title<?php echo e($language['id']); ?>" data-toggle="tab"><?php if($language['flag'] != ''): ?> <img src="<?php echo e(asset($language['flag'])); ?>"><?php endif; ?> <?php echo e($language['title']); ?> </a></li>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <?php endif; ?>

                             </ul>
                             <?php if(count($datas['language']) > 0): ?>
                                 <div class="tab-content" id="language_tab">
                                     <?php if(is_array(old('description')) > 0): ?>
                                         <?php if(count(old('description')) > 0): ?>
                                             <?php $__currentLoopData = old('description'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $old): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <div class="tab-pane pt-3 " id="tab-title<?php echo e($key); ?>">
                                                 <div class="form-group row">
                                                     <label class="col-md-3 control-label">Module Title</label>
                                                     <div class="col-md-9">
                                                         <input type="text" required name="description[<?php echo e($key); ?>][title]" value="<?php echo e($old['title']); ?>" placeholder="Module Title" class="form-control <?php echo e($errors->has('description.'.$key.'.title') ? ' is-invalid' : ''); ?>" />
                                                         <?php if($errors->has('description.'.$key.'.title')): ?>
                                                             <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('description.'.$key.'.title')); ?></strong>
                                                                    </span>
                                                         <?php endif; ?>
                                                     </div>
                                                 </div>
                                                 </div>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                         <?php endif; ?>
                                     <?php else: ?>
                                         <?php $__currentLoopData = $datas['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <div class="tab-pane pt-3 <?php echo e($language['active']); ?>" id="tab-title<?php echo e($language['id']); ?>">
                                                <div class="form-group row">
                                                    <label class="col-md-3 control-label">Module Title</label>
                                                    <div class="col-md-9">
                                                        <input type="text" required name="description[<?php echo e($language['id']); ?>][title]" value="<?php echo e(old('description.'.$language['id'].'.title')); ?>" placeholder="Module Title" class="form-control" />
                                                    </div>
                                                </div>
                                             </div>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php endif; ?>

                                 </div>
                             <?php endif; ?>

                         </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 control-label">Language</label>
                            <div class="col-md-9">
                                <select class="form-control <?php echo e($errors->has('language_id') ? ' is-invalid' : ''); ?>" name="language_id">

                                    <?php if(count($datas['lang']) > 0): ?>
                                        <?php $__currentLoopData = $datas['lang']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($lang['value']); ?>"><?php echo e($lang['title']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php if($errors->has('language_id')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('language_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                    <div class="form-group row">
                        <label class="col-md-3 control-label">Columns</label>

                        <div class="col-md-9">
                            <select class="form-control" name="column_no">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 control-label">Advertise</label>

                        <div class="col-md-9">
                            <div id="advertises">
                                <div id="advertises_row0" class="form-group row">
                                    <div class="col-md-10 col-sm-10 col-8">
                                        <select class="form-control mb-3" required name="advertise[0][id]">
                                            <?php $__currentLoopData = $datas['advertise']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($advertise->id); ?>"><?php echo e($advertise->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-4">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-danger margin-top-10 delete_desc btn-sm" onclick="$('#advertises_row0').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button>
                                                </span>
                                    </div>
                            </div>


                        </div>
                            <button type="button" onclick="addAdvertise();" data-toggle="tooltip" title="Add Advertise" class="btn btn-success btn-sm float-right mt-3"><i class="fa fa-plus-circle"></i></button>
                    </div>

                    </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-save"></i>Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript"><!--
        var advertises_row = 1;

        function addAdvertise() {
            html  = '<div id="advertises_row'+advertises_row+'" class="form-group row">\n' +
                '                                    <div class="col-md-10 col-sm-10 col-8">\n' +
                '                                        <select class="form-control mb-3" required name="advertise['+advertises_row+'][id]">\n' +
                '                                            <?php $__currentLoopData = $datas['advertise']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                            <option value="<?php echo e($advertise->id); ?>"><?php echo e($advertise->title); ?></option>\n' +
                '                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                '                                        </select>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-2 col-sm-2 col-4">\n' +
                '                                                <span class="input-group-btn">\n' +
                '                                                    <button class="btn btn-danger margin-top-10 delete_desc btn-sm" onclick="$(\'#advertises_row'+advertises_row+'\').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button>\n' +
                '                                                </span>\n' +
                '                                    </div>\n' +
                '                            </div>';

            $('#advertises').append(html);

            advertises_row++;
        }


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\news\local\resources\views/admin/module/advertise/newform.blade.php ENDPATH**/ ?>

<?php $__env->startSection('stylesheet'); ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
    <style>
        .well{
            padding: 9px;
            border-radius: 3px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, .05), 0 1px 0 rgba(255, 255, 255, .1);
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('heading'); ?>
New Article
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/article')); ?>">Article</a></li>
    <li class="breadcrumb-item active">New Article</li>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="row">
    <div class="col-md-12">
        <div class="card">

                <div class="card-body">
                    <?php if(count($errors)): ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="alert alert-danger">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e('* : '.$error); ?></br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="<?php echo e(url('/admin/article/save')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                         <div class="col-md-12">
                             <ul class="nav nav-tabs" id="myTab" role="tablist">
                                 <li class="nav-item waves-effect waves-light"><a class="nav-link active" href="#tab-general" data-toggle="tab">General</a></li>
                                 <li class="nav-item waves-effect waves-light"><a class="nav-link" href="#tab-data" data-toggle="tab">Data</a></li>
                             </ul>
                             <div class="tab-content">
                                 <div class="tab-pane active pt-3" id="tab-general">
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
                                                             <label class="col-md-3 control-label">Title</label>
                                                             <div class="col-md-9">
                                                                 <input type="text" name="description[<?php echo e($key); ?>][title]" data-id="<?php echo e($key); ?>" value="<?php echo e($old['title']); ?>" placeholder="Article Title" class="form-control title <?php echo e($errors->has('description.'.$key.'.title') ? ' is-invalid' : ''); ?>" />
                                                                 <?php if($errors->has('description.'.$key.'.title')): ?>
                                                                     <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('description.'.$key.'.title')); ?></strong>
                                                                    </span>
                                                                 <?php endif; ?>
                                                             </div>
                                                         </div>

                                                         <div class="form-group row">
                                                             <label class="col-md-3 control-label">Seo URL</label>

                                                             <div class="col-md-9">

                                                                 <input type="text" name="description[<?php echo e($key); ?>][seo_url]" id="seo_url<?php echo e($key); ?>" value="<?php echo e($old['seo_url']); ?>" placeholder="seo_url" class="form-control <?php echo e($errors->has('description.'.$key.'.seo_url') ? ' is-invalid' : ''); ?>" />
                                                                 <?php if($errors->has('description.'.$key.'.seo_url')): ?>
                                                                     <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('description.'.$key.'.seo_url')); ?></strong>
                                                                    </span>
                                                                 <?php endif; ?>
                                                             </div>
                                                         </div>

                                                         <div class="form-group row">
                                                             <label class="col-md-3 control-label">Description</label>
                                                             <div class="col-md-9">
                                                                 <textarea id="description<?php echo e($key); ?>" class="form-control <?php echo e($errors->has('description.'.$key.'.description') ? ' is-invalid' : ''); ?>" name="description[<?php echo e($key); ?>][description]"><?php echo e($old['description']); ?></textarea>
                                                                 <?php if($errors->has('description.'.$key.'.description')): ?>
                                                                     <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('description.'.$key.'.description')); ?></strong>
                                                                    </span>
                                                                 <?php endif; ?>
                                                             </div>
                                                         </div>
                                                         <div class="form-group row">
                                                             <label class="col-md-3 control-label">Meta Title</label>
                                                             <div class="col-md-9">
                                                                 <input type="text" name="description[<?php echo e($key); ?>][meta_title]" value="<?php echo e($old['meta_title']); ?>" placeholder="Meta Tag" class="form-control <?php echo e($errors->has('description.'.$key.'.meta_title') ? ' is-invalid' : ''); ?>" />
                                                                 <?php if($errors->has('description.'.$key.'.meta_title')): ?>
                                                                     <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('description.'.$key.'.meta_title')); ?></strong>
                                                                    </span>
                                                                 <?php endif; ?>
                                                             </div>
                                                         </div>
                                                         <div class="form-group row">
                                                             <label class="col-md-3 control-label">Meta Tag Keyword</label>
                                                             <div class="col-md-9">
                                                                 <textarea name="description[<?php echo e($key); ?>][meta_keyword]" class="form-control <?php echo e($errors->has('description.'.$key.'.meta_keyword') ? ' is-invalid' : ''); ?>"><?php echo e($old['meta_keyword']); ?></textarea>
                                                                 <?php if($errors->has('description.'.$key.'.meta_keyword')): ?>
                                                                     <span class="invalid-feedback">
                                                                            <strong><?php echo e($errors->first('description.'.$key.'.meta_keyword')); ?></strong>
                                                                        </span>
                                                                 <?php endif; ?>
                                                             </div>
                                                         </div>
                                                         <div class="form-group row">
                                                             <label class="col-md-3 control-label">Meta Tag Description</label>
                                                             <div class="col-md-9">
                                                                 <textarea name="description[<?php echo e($key); ?>][meta_description]" class="form-control <?php echo e($errors->has('description.'.$key.'.meta_description') ? ' is-invalid' : ''); ?>"><?php echo e($old['meta_description']); ?></textarea>
                                                                 <?php if($errors->has('description.'.$key.'.meta_description')): ?>
                                                                     <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('description.'.$key.'.meta_description')); ?></strong>
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
                                                             <label class="col-md-3 control-label">Title</label>
                                                             <div class="col-md-9">
                                                                 <input type="text" name="description[<?php echo e($language['id']); ?>][title]" data-id="<?php echo e($language['id']); ?>" value="<?php echo e(old('description.'.$language['id'].'.meta_description') ? old('description.'.$key.'.meta_description') : $language['details']['title']); ?>" placeholder="Article Title" class="form-control title " />

                                                             </div>
                                                         </div>

                                                         <div class="form-group row">
                                                             <label class="col-md-3 control-label">Seo URL</label>
                                                             <div class="col-md-9">
                                                                 <input type="text" name="description[<?php echo e($language['id']); ?>][seo_url]" id="seo_url<?php echo e($language['id']); ?>" value="<?php echo e($language['details']['seo_url']); ?>" placeholder="seo_url" class="form-control" />
                                                             </div>
                                                         </div>

                                                         <div class="form-group row">
                                                             <label class="col-md-3 control-label">Description</label>
                                                             <div class="col-md-9">
                                                                 <textarea id="description<?php echo e($language['id']); ?>" class="form-control" name="description[<?php echo e($language['id']); ?>][description]"><?php echo e($language['details']['description']); ?></textarea>

                                                             </div>
                                                         </div>
                                                         <div class="form-group row">
                                                             <label class="col-md-3 control-label">Meta Title</label>
                                                             <div class="col-md-9">
                                                                 <input type="text" name="description[<?php echo e($language['id']); ?>][meta_title]" value="<?php echo e($language['details']['meta_title']); ?>" placeholder="Meta Tag" class="form-control" />
                                                             </div>
                                                         </div>
                                                         <div class="form-group row">
                                                             <label class="col-md-3 control-label">Meta Tag Keyword</label>

                                                             <div class="col-md-9">
                                                                 <textarea name="description[<?php echo e($language['id']); ?>][meta_keyword]" class="form-control"><?php echo e($language['details']['meta_keyword']); ?></textarea>
                                                             </div>
                                                         </div>
                                                         <div class="form-group row">
                                                             <label class="col-md-3 control-label">Meta Tag Description</label>

                                                             <div class="col-md-9">
                                                                 <textarea name="description[<?php echo e($language['id']); ?>][meta_description]" class="form-control"><?php echo e($language['details']['meta_description']); ?></textarea>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                     <?php endif; ?>



                                         </div>
                                     <?php endif; ?>
                                 </div>
                                 <div class="tab-pane pt-3" id="tab-data">
                                     <div class="form-group row">
                                         <label class="col-md-2 control-label">Language</label>
                                         <div class="col-md-10">
                                             <select class="form-control" name="language">
                                                 <option value="">Select Language</option>
                                                 <?php $__currentLoopData = $datas['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <?php if(old('language') == $language['id']): ?>
                                                         <option value="<?php echo e($language['id']); ?>" selected><?php echo e($language['title']); ?></option>
                                                     <?php else: ?>
                                                         <option value="<?php echo e($language['id']); ?>"><?php echo e($language['title']); ?></option>
                                                     <?php endif; ?>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-md-2 control-label">Menu</label>
                                         <div class="col-md-10">
                                             <input type="text" name="path" value="" placeholder="Article Title" id="path_id" autocomplete="off" class="form-control" />
                                             <div class="well" id="article_menu" style="height: 150px; overflow: auto;"></div>
                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <label class="col-md-2 control-label">Video</label>

                                         <div class="col-md-10">
                                             <input type="text" name="video" value="<?php echo e(old('video')); ?>" placeholder="https://www.youtube.com/v=iweuuower" class="form-control <?php echo e($errors->has('video') ? ' is-invalid' : ''); ?>">


                                             <?php if($errors->has('video')): ?>
                                                 <span class="help-block">
                                                    <strong><?php echo e($errors->first('video')); ?></strong>
                                                </span>
                                             <?php endif; ?>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-md-2 control-label">Audio</label>

                                         <div class="col-md-10">
                                             <input type="text" name="audio" value="<?php echo e(old('audio')); ?>" placeholder="https://www.podcast.com/v=iweuuower" class="form-control <?php echo e($errors->has('audio') ? ' is-invalid' : ''); ?>">

                                             <?php if($errors->has('audio')): ?>
                                                 <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('audio')); ?></strong>
                                    </span>
                                             <?php endif; ?>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-md-2 control-label">Status</label>

                                         <div class="col-md-10">
                                             <select name="status" id="status" class="form-control <?php echo e($errors->has('status') ? ' is-invalid' : ''); ?>" >
                                                 <?php $__currentLoopData = $datas['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <?php if($status['value'] == old('status')): ?>
                                                         <option value="<?php echo e($status['value']); ?>" selected><?php echo e($status['title']); ?></option>
                                                     <?php else: ?>
                                                         <option value="<?php echo e($status['value']); ?>"><?php echo e($status['title']); ?></option>
                                                     <?php endif; ?>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             </select>

                                             <?php if($errors->has('status')): ?>
                                                 <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('status')); ?></strong>
                                    </span>
                                             <?php endif; ?>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-md-2 control-label">Image</label>

                                         <div class="col-md-10">
                                             <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo e(asset($datas['placeholder'])); ?> " alt="" title="" data-placeholder="<?php echo e(asset($datas['placeholder'])); ?> " /></a>
                                             <input type="hidden" name="image" value="" id="input-image" />

                                             <?php if($errors->has('image')): ?>
                                                 <span class="invalid-feedback">
                                                    <strong><?php echo e($errors->first('image')); ?></strong>
                                                </span>
                                             <?php endif; ?>
                                         </div>
                                     </div>
                                 </div>
                             </div>

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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(document).delegate('button[data-toggle=\'image\']', 'click', function() {
            $('#modal-image').remove();
            $(this).parents('.note-editor').find('.note-editable').focus();

            $.ajax({
                url: '<?php echo e(url('/admin/filemanager')); ?>',
                dataType: 'html',
                beforeSend: function() {
                    $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#button-image').prop('disabled', true);
                },
                complete: function() {
                    $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
                    $('#button-image').prop('disabled', false);
                },
                success: function(html) {
                    $('body').append('<div id="modal-image" class="modal">' + html + '</div>');

                    $('#modal-image').modal('show');
                }
            });
        });
        // Image Manager
        $(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
            e.preventDefault();

            $('.popover').popover('hide', function() {
                $('.popover').remove();
            });

            var element = this;


            $(element).popover({
                html: true,
                placement: 'right',
                trigger: 'manual',
                container: 'body',
                sanitize: false,
                content: function() {
                    return '<div id="button-image" class="btn btn-primary btn-sm mr-1"><i class="fas fa-pencil-alt"></i></div><div id="button-clear" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></div>';
                }
            });

            $(element).popover('show');

            $(document).on('click','#button-image', function() {
                $('#modal-image').remove();

                $.ajax({
                    url: '<?php echo e(url('/admin/filemanager')); ?>' + '?target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
                    dataType: 'html',
                    beforeSend: function() {
                        $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                        $('#button-image').prop('disabled', true);
                    },
                    complete: function() {
                        $('#button-image i').replaceWith('<i class="fa fa-pencil"></i>');
                        $('#button-image').prop('disabled', false);
                    },
                    success: function(html) {
                        $('body').append('<div id="modal-image" class="modal" style="display: block; padding-right: 17px;" >' + html + '</div>');

                        $('#modal-image').modal('show');
                    }
                });

                $(element).popover('hide', function() {
                    $('.popover').remove();
                });
            });

            $('#button-clear').on('click', function() {
                $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));

                $(element).parent().find('input').attr('value', '');

                $(element).popover('hide', function() {
                    $('.popover').remove();
                });
            });
        });

    </script>
    <script type="text/javascript"><!--
        $('input[name=\'path\']').autocomplete({

            source: '<?php echo e(url('admin/menu/autocomplete/')); ?>',
            minlength:1,
            autoFocus:true,
            select:function(e,ui){
                $('#path_id').val('');
                $('#article_menu' + ui.item.id).remove();
                $('#article_menu').append('<div id="article_menu' + ui.item.id + '"><i class="fa fa-minus-circle" style="cursor:pointer;"></i> ' + ui.item.value + '<input type="hidden" name="article_menu[]" value="' + ui.item.id + '" /></div>');

            }

        });
        $('.title').blur(function(){
            var data = $(this).val();
            var id = $(this).attr('data-id');
            var se_url = data.replace(/ /g,"-");

            $('#seo_url'+id).val(se_url);
        });

        $(document).ready(function (){
            $('#language_tab').children(":first").addClass('active');
        })
        $('#article_menu').delegate('.fa-minus-circle', 'click', function() {
            $(this).parent().remove();
        });
        //--></script>
    <?php if(count($datas['language']) > 0): ?>
        <?php $__currentLoopData = $datas['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script>
                CKEDITOR.replace('description<?php echo e($lang['id']); ?>',
                    {
                        filebrowserBrowseUrl : '<?php echo e(url("assets/ckfinder/ckfinder.html")); ?>',
                        filebrowserImageBrowseUrl : '<?php echo e(url("assets/ckfinder/ckfinder.html?type=Images")); ?>',
                        filebrowserFlashBrowseUrl : '<?php echo e(url("assets/ckfinder/ckfinder.html?type=Flash")); ?>',
                        filebrowserUploadUrl :
                            '<?php echo e(url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files")); ?>',
                        filebrowserImageUploadUrl :
                            '<?php echo e(url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images")); ?>',
                        filebrowserFlashUploadUrl : '<?php echo e(url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash")); ?>',
                        enterMode: CKEDITOR.ENTER_BR
                    }

                );
            </script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\news\local\resources\views/admin/article/newform.blade.php ENDPATH**/ ?>
<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(__('Footer Content')); ?></h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?php echo e(__('Footer')); ?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?php echo e(__('Footer Content')); ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card-title"><?php echo e(__('Update Footer Content')); ?></div>
                        </div>

                        <div class="col-lg-2">
                            <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-5">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <form id="ajaxForm"
                                action="<?php echo e(route('admin.footer.update_content', ['language' => request()->input('language')])); ?>"
                                method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for=""><?php echo e(__('Footer Logo') . '*'); ?></label>
                                    <br>
                                    <div class="thumb-preview">
                                        <?php if($data): ?>
                                            <?php if($data->footer_logo == null): ?>
                                                <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..."
                                                    class="uploaded-img">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/admin/img/footer_logo/' . $data->footer_logo)); ?>"
                                                    alt="..." class="uploaded-img">
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..."
                                                class="uploaded-img">
                                        <?php endif; ?>


                                    </div>

                                    <div class="mt-3">
                                        <div role="button" class="btn btn-primary btn-sm upload-btn">
                                            <?php echo e(__('Choose Image')); ?>

                                            <input type="file" class="img-input" name="footer_logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(__('Footer Background Color') . '*'); ?></label>
                                    <input class="jscolor form-control ltr" name="footer_background_color"
                                        value="<?php echo e(!is_null($data) ? $data->footer_background_color : ''); ?>">
                                    <p id="err_footer_background_color" class="em text-danger mt-2 mb-0"></p>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('About Company') . '*'); ?></label>
                                    <textarea id="descriptionTmce1" class="form-control summernote" name="about_company" rows="5" cols="80"><?php echo !is_null($data) ? $data->about_company : ''; ?></textarea>
                                    <p id="err_about_company" class="em text-danger mt-2 mb-0"></p>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Copyright Text') . '*'); ?></label>
                                    <textarea id="copyrightSummernote" class="form-control summernote" name="copyright_text" data-height="80"><?php echo e(!is_null($data) ? $data->copyright_text : ''); ?></textarea>
                                    <p id="err_copyright_text" class="em text-danger mt-2 mb-0"></p>
                                    <p class="text-warning"> <?php echo e(__('Note: {year} will be replaced by the current year')); ?>

                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" id="submitBtn" class="btn btn-success">
                                <?php echo e(__('Update')); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/footer/content.blade.php ENDPATH**/ ?>
<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(__('SEO Informations')); ?></h4>
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
                <a href="#"><?php echo e(__('Basic Settings')); ?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?php echo e(__('SEO Informations')); ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="<?php echo e(route('admin.basic_settings.update_seo', ['language' => request()->input('language')])); ?>"
                    method="post">
                    <?php echo csrf_field(); ?>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="card-title"><?php echo e(__('Update SEO Informations')); ?></div>
                            </div>

                            <div class="col-lg-2">
                                <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Home Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_home"
                                        value="<?php echo e($data != null ? $data->meta_keyword_home : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Home Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_home" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_home : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Events Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_event"
                                        value="<?php echo e($data != null ? $data->meta_keyword_event : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Events Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_event" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_event : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Organizer Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_organizer"
                                        value="<?php echo e($data != null ? $data->meta_keyword_organizer : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Organizer Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_organizer" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_organizer : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Shop Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_shop"
                                        value="<?php echo e($data != null ? $data->meta_keyword_shop : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Shop Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_shop" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_shop : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Blog Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_blog"
                                        value="<?php echo e($data != null ? $data->meta_keyword_blog : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Blog Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_blog" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_blog : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For FAQ Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_faq"
                                        value="<?php echo e($data != null ? $data->meta_keyword_faq : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For FAQ Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_faq" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_faq : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Contact Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_contact"
                                        value="<?php echo e($data != null ? $data->meta_keyword_contact : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Contact Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_contact" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_contact : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For About Us Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_about"
                                        value="<?php echo e($data != null ? $data->meta_keyword_about : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For About Us Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_about" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_about : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Customer Login Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_customer_login"
                                        value="<?php echo e($data != null ? $data->meta_keyword_customer_login : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Customer Login Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_customer_login" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_customer_login : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Customer Signup Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_customer_signup"
                                        value="<?php echo e($data != null ? $data->meta_keyword_customer_signup : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Customer Signup Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_customer_signup" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_customer_signup : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Organizer Login Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_organizer_login"
                                        value="<?php echo e($data != null ? $data->meta_keyword_organizer_login : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Organizer Login Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_organizer_login" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_organizer_login : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Organizer Signup Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_organizer_signup"
                                        value="<?php echo e($data != null ? $data->meta_keyword_organizer_signup : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Organizer Signup Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_organizer_signup" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_organizer_signup : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Customer Forget Password Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_customer_forget_password"
                                        value="<?php echo e($data != null ? $data->meta_keyword_customer_forget_password : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Customer Forget Password Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_customer_forget_password" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_customer_forget_password : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Meta Keywords For Organizer Forget Password Page')); ?></label>
                                    <input class="form-control" name="meta_keyword_organizer_forget_password"
                                        value="<?php echo e($data != null ? $data->meta_keyword_organizer_forget_password : ''); ?>"
                                        placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Meta Description For Organizer Forget Password Page')); ?></label>
                                    <textarea class="form-control" name="meta_description_organizer_forget_password" rows="5"
                                        placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e($data != null ? $data->meta_description_organizer_forget_password : ''); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success">
                                    <?php echo e(__('Update')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/basic-settings/seo.blade.php ENDPATH**/ ?>
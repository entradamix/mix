<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Page Headings')); ?></h4>
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
        <a href="#"><?php echo e(__('Page Headings')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form
          action="<?php echo e(route('admin.basic_settings.update_page_headings', ['language' => request()->input('language')])); ?>"
          method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-10">
                <div class="card-title"><?php echo e(__('Update Page Headings')); ?></div>
              </div>

              <div class="col-lg-2">
                <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-10 offset-lg-1">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Blog Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="blog_page_title"
                        value="<?php echo e($data != null ? $data->blog_page_title : ''); ?>">
                      <?php if($errors->has('blog_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('blog_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Blog Details Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="blog_details_page_title"
                        value="<?php echo e($data != null ? $data->blog_details_page_title : ''); ?>">
                      <?php if($errors->has('blog_details_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('blog_details_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Contact Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="contact_page_title"
                        value="<?php echo e($data != null ? $data->contact_page_title : ''); ?>">
                      <?php if($errors->has('contact_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('contact_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('About Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="about_page_title"
                        value="<?php echo e($data != null ? $data->about_page_title : ''); ?>">
                      <?php if($errors->has('about_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('about_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Event Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="event_page_title"
                        value="<?php echo e($data != null ? $data->event_page_title : ''); ?>">
                      <?php if($errors->has('event_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('event_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Event Details Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="event_details_page_title"
                        value="<?php echo e($data != null ? $data->event_details_page_title : ''); ?>">
                      <?php if($errors->has('event_details_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('event_details_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Shop Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="shop_page_title"
                        value="<?php echo e($data != null ? $data->shop_page_title : ''); ?>">
                      <?php if($errors->has('shop_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('shop_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Cart Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="cart_page_title"
                        value="<?php echo e($data != null ? $data->cart_page_title : ''); ?>">
                      <?php if($errors->has('cart_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('cart_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('FAQ Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="faq_page_title"
                        value="<?php echo e($data != null ? $data->faq_page_title : ''); ?>">
                      <?php if($errors->has('faq_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('faq_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Forget Password Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_forget_password_page_title"
                        value="<?php echo e($data != null ? $data->customer_forget_password_page_title : ''); ?>">
                      <?php if($errors->has('customer_forget_password_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_forget_password_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Organizer Forget Password Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="organizer_forget_password_page_title"
                        value="<?php echo e($data != null ? $data->organizer_forget_password_page_title : ''); ?>">
                      <?php if($errors->has('organizer_forget_password_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('organizer_forget_password_page_title')); ?>

                        </p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Organizer Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="organizer_page_title"
                        value="<?php echo e($data != null ? $data->organizer_page_title : ''); ?>">
                      <?php if($errors->has('organizer_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('organizer_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Login Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_login_page_title"
                        value="<?php echo e($data != null ? $data->customer_login_page_title : ''); ?>">
                      <?php if($errors->has('customer_login_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_login_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Signup Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_signup_page_title"
                        value="<?php echo e($data != null ? $data->customer_signup_page_title : ''); ?>">
                      <?php if($errors->has('customer_signup_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_signup_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Organizer Login Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="organizer_login_page_title"
                        value="<?php echo e($data != null ? $data->organizer_login_page_title : ''); ?>">
                      <?php if($errors->has('organizer_login_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('organizer_login_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Organizer Signup Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="organizer_signup_page_title"
                        value="<?php echo e($data != null ? $data->organizer_signup_page_title : ''); ?>">
                      <?php if($errors->has('organizer_signup_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('organizer_signup_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Dashboard Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_dashboard_page_title"
                        value="<?php echo e($data != null ? $data->customer_dashboard_page_title : ''); ?>">
                      <?php if($errors->has('customer_dashboard_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_dashboard_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Event Booking Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_booking_page_title"
                        value="<?php echo e($data != null ? $data->customer_booking_page_title : ''); ?>">
                      <?php if($errors->has('customer_booking_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_booking_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Event Booking Details Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_booking_details_page_title"
                        value="<?php echo e($data != null ? $data->customer_booking_details_page_title : ''); ?>">
                      <?php if($errors->has('customer_booking_details_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_booking_details_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Product Order Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_order_page_title"
                        value="<?php echo e($data != null ? $data->customer_order_page_title : ''); ?>">
                      <?php if($errors->has('customer_order_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_order_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Product Order Details Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_order_details_page_title"
                        value="<?php echo e($data != null ? $data->customer_order_details_page_title : ''); ?>">
                      <?php if($errors->has('customer_order_details_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_order_details_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Wishlist Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_wishlist_page_title"
                        value="<?php echo e($data != null ? $data->customer_wishlist_page_title : ''); ?>">
                      <?php if($errors->has('customer_wishlist_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_wishlist_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Support Ticket Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_support_ticket_page_title"
                        value="<?php echo e($data != null ? $data->customer_support_ticket_page_title : ''); ?>">
                      <?php if($errors->has('customer_support_ticket_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_support_ticket_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Support Ticket Create Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="support_ticket_create_page_title"
                        value="<?php echo e($data != null ? $data->support_ticket_create_page_title : ''); ?>">
                      <?php if($errors->has('support_ticket_create_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('support_ticket_create_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Support Ticket Details Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="support_ticket_details_page_title"
                        value="<?php echo e($data != null ? $data->support_ticket_details_page_title : ''); ?>">
                      <?php if($errors->has('support_ticket_details_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('support_ticket_details_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Edit Profile Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_edit_profile_page_title"
                        value="<?php echo e($data != null ? $data->customer_edit_profile_page_title : ''); ?>">
                      <?php if($errors->has('customer_edit_profile_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_edit_profile_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Change Password Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="customer_change_password_page_title"
                        value="<?php echo e($data != null ? $data->customer_change_password_page_title : ''); ?>">
                      <?php if($errors->has('customer_change_password_page_title')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('customer_change_password_page_title')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
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

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/basic-settings/page-headings.blade.php ENDPATH**/ ?>
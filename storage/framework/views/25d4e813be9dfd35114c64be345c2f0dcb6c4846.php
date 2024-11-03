<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->customer_signup_page_title ?? __('Customer Signup')); ?>

  <?php else: ?>
    <?php echo e(__('Customer Signup')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php
  $metaKeywords = !empty($seo->meta_keyword_customer_signup) ? $seo->meta_keyword_customer_signup : '';
  $metaDescription = !empty($seo->meta_description_customer_signup) ? $seo->meta_description_customer_signup : '';
?>
<?php $__env->startSection('meta-keywords', "<?php echo e($metaKeywords); ?>"); ?>
<?php $__env->startSection('meta-description', "$metaDescription"); ?>

<?php $__env->startSection('hero-section'); ?>
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
    data-bg="<?php echo e(asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title">
          <?php if(!empty($pageHeading)): ?>
            <?php echo e($pageHeading->customer_signup_page_title ?? __('Customer Signup')); ?>

          <?php else: ?>
            <?php echo e(__('Customer Signup')); ?>

          <?php endif; ?>
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active">
              <?php if(!empty($pageHeading)): ?>
                <?php echo e($pageHeading->customer_signup_page_title ?? __('Customer Signup')); ?>

              <?php else: ?>
                <?php echo e(__('Customer Signup')); ?>

              <?php endif; ?>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- SignUp Area Start -->
  <div class="signup-area pt-115 rpt-95 pb-120 rpb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <form id="login-form" name="login_form" class="login-form" action="<?php echo e(route('customer.create')); ?>"
            method="POST">
            <?php echo csrf_field(); ?>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="fname"> <?php echo e(__('First Name')); ?> *</label>
                  <input type="text" name="fname" id="fname" value="<?php echo e(old('fname')); ?>" class="form-control"
                    placeholder="<?php echo e(__('Enter Your First Name')); ?>">
                  <?php $__errorArgs = ['fname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="lname"> <?php echo e(__('Last Name')); ?></label>
                  <input type="text" name="lname" id="lname" value="<?php echo e(old('lname')); ?>" class="form-control"
                    placeholder="<?php echo e(__('Enter Your Last Name')); ?>">
                  <?php $__errorArgs = ['lname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="username"><?php echo e(__('Username')); ?> *</label>
                  <input type="text" name="username" value="<?php echo e(old('username')); ?>" id="username" class="form-control"
                    placeholder="<?php echo e(__('Enter Username')); ?>">
                  <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email"><?php echo e(__('Email Address')); ?> *</label>
                  <input type="email" name="email" value="<?php echo e(old('email')); ?>" id="email" class="form-control"
                    placeholder="<?php echo e(__('Enter Your Email Address')); ?>">
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="password"><?php echo e(__('Password')); ?> *</label>
                  <input type="password" name="password" id="password" class="form-control"
                    placeholder="<?php echo e(__('Enter Password')); ?>">
                  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="re-password"><?php echo e(__('Re-enter Password')); ?> *</label>
                  <input type="password" name="password_confirmation" id="re-password" class="form-control"
                    placeholder="<?php echo e(__('Re-enter Password')); ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <?php if($basicInfo->google_recaptcha_status == 1): ?>
                  <div class="form-group">
                    <?php echo NoCaptcha::renderJs(); ?>

                    <?php echo NoCaptcha::display(); ?>

                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-group mb-0">
              <button class="theme-btn br-30 showLoader" type="submit"><?php echo e(__('Signup')); ?></button>
            </div>
            <div class="form-group mt-3 mb-0">
              <p><?php echo e(__('Already have an account')); ?> ?<a class="text-info"
                  href="<?php echo e(route('customer.login')); ?>"><?php echo e(__('Login Now')); ?></a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- SignUp Area End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/customer/signup.blade.php ENDPATH**/ ?>
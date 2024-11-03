<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->organizer_login_page_title ?? __('Login')); ?>

  <?php else: ?>
    <?php echo e(__('Login')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php
  $metaKeywords = !empty($seo->meta_keyword_organizer_login) ? $seo->meta_keyword_organizer_login : '';
  $metaDescription = !empty($seo->meta_description_organizer_login) ? $seo->meta_description_organizer_login : '';
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
            <?php echo e($pageHeading->organizer_login_page_title ?? __('Login')); ?>

          <?php else: ?>
            <?php echo e(__('Login')); ?>

          <?php endif; ?>
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active">
              <?php if(!empty($pageHeading)): ?>
                <?php echo e($pageHeading->organizer_login_page_title ?? __('Login')); ?>

              <?php else: ?>
                <?php echo e(__('Login')); ?>

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
  <!-- LogIn Area Start -->
  <div class="login-area pt-115 rpt-95 pb-120 rpb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <?php if(Session::has('success')): ?>
            <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
          <?php endif; ?>
          <?php if(Session::has('alert')): ?>
            <div class="alert alert-danger"><?php echo e(Session::get('alert')); ?></div>
          <?php endif; ?>
          <form id="login-form" name="login_form" class="login-form" action="<?php echo e(route('organizer.authentication')); ?>"
            method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <label for="email"><?php echo e(__('Email')); ?> *</label>
              <input type="text" name="email" value="" id="email" class="form-control"
                placeholder="<?php echo e(__('Enter Email')); ?>">
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
            <div class="form-group">
              <label for="password"><?php echo e(__('Password')); ?> *</label>
              <input type="password" name="password" id="password" value="" class="form-control"
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

            <div class="form-group mb-0">
              <button class="theme-btn br-30" type="submit"
                data-loading-text="Please wait..."><?php echo e(__('Login')); ?></button>
            </div>
            <div class="form-group mt-3 d-flex justify-content-between mb-0">
              <p><?php echo e(__('Don`t have an account')); ?> ? <a class="text-info"
                  href="<?php echo e(route('organizer.signup')); ?>"><?php echo e(__('Signup Now')); ?></a></p>
              <p><a href="<?php echo e(route('organizer.forget.password')); ?>"><?php echo e(__('Lost your password')); ?> ?</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- LogIn Area End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/organizer/login.blade.php ENDPATH**/ ?>
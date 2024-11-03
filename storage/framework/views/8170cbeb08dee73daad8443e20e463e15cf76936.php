<!DOCTYPE html>
<html lang="zxx" dir="<?php echo e($currentLanguageInfo->direction == 1 ? 'rtl' : 'ltr'); ?>">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="description" content="<?php echo $__env->yieldContent('meta-description'); ?>">
  <meta name="keywords" content="<?php echo $__env->yieldContent('meta-keywords'); ?>">

  <meta property="og:title" content="<?php echo $__env->yieldContent('og-title'); ?>" />
  <meta property="og:description" content="<?php echo $__env->yieldContent('og-description'); ?>" />
  <meta property="og:image" content="<?php echo $__env->yieldContent('og-image'); ?>" />


  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <!-- Title -->
  <title><?php echo $__env->yieldContent('pageHeading'); ?> <?php echo e('| ' . $websiteInfo->website_title); ?></title>
  <!-- Favicon Icon -->
  <link rel="shortcut icon" href="<?php echo e(asset('assets/admin/img/' . $websiteInfo->favicon)); ?>" type="image/x-icon">
  
  <?php if ($__env->exists('frontend.partials.styles')) echo $__env->make('frontend.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldContent('custom-style'); ?>
</head>

<body>
  <div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader" style="background-image:url(<?php echo e(asset('assets/admin/img/' . $websiteInfo->preloader)); ?>)">
    </div>
    <div class="request-loader">
      <img src="<?php echo e(asset('assets/admin/img/loader.gif')); ?>" alt="loader">
    </div>



    <!-- Header Part Start -->
    <?php if ($__env->exists('frontend.partials.header.header-nav')) echo $__env->make('frontend.partials.header.header-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Header Part End -->

    <?php echo $__env->yieldContent('hero-section'); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php if ($__env->exists('frontend.partials.popups')) echo $__env->make('frontend.partials.popups', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <?php if ($__env->exists('frontend.partials.footer.footer')) echo $__env->make('frontend.partials.footer.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  </div>
  <!--End pagewrapper-->

  
  <?php echo $__env->yieldContent('modals'); ?>
  
  <script>
    "use strict";
    var rtl = <?php echo e($currentLanguageInfo->direction); ?>;
  </script>
  <?php if ($__env->exists('frontend.partials.scripts')) echo $__env->make('frontend.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->yieldContent('script'); ?>
  <?php echo $__env->yieldContent('custom-script'); ?>

  
  <?php if(!empty($cookieAlertInfo) && $cookieAlertInfo->cookie_alert_status == 1): ?>
    <div class="cookie">
      <?php echo $__env->make('cookie-consent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  <?php endif; ?>
  

</body>

</html>
<?php /**PATH /var/www/html/resources/views/frontend/layout.blade.php ENDPATH**/ ?>
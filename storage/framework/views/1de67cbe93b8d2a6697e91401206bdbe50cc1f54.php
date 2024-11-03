<!DOCTYPE html>
<html>

<head>
  
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  
  <title>404</title>

  
  <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/admin/img/' . $websiteInfo->favicon)); ?>">

  
  <?php if ($__env->exists('frontend.partials.styles')) echo $__env->make('frontend.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->yieldContent('style'); ?>
</head>

<body>

  <!--====== 404 PART START ======-->
  <section class="error-area">
    <div class="container text-center padding-90">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <img src="<?php echo e(asset('assets/admin/img/404.png')); ?>" alt="error">
        </div>
        <div class="col-md-12">
          <div class="error-content">
            <h4 class="mb-4">
              <?php echo e(__('404') . '!'); ?> <?php echo e(__('Page Not Found')); ?>

            </h4>
            <ul>
              <li><a href="<?php echo e(route('index')); ?>" class="theme-btn"><?php echo e(__('Return Home')); ?></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== 404 PART ENDS ======-->
</body>

</html>
<?php /**PATH /var/www/html/resources/views/errors/404.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html>
  <head>
    
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title><?php echo e(__('Organizer') . ' | ' . $websiteInfo->website_title); ?></title>

    
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/admin/img/' . $websiteInfo->favicon)); ?>">

    
    <?php if ($__env->exists('organizer.partials.styles')) echo $__env->make('organizer.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->yieldContent('style'); ?>
  </head>

  <body data-background-color="<?php echo e(Session::get('organizer_theme_version') == 'light' ? 'white' : 'dark'); ?>">
    
    <div class="request-loader">
      <img src="<?php echo e(asset('assets/admin/img/loader.gif')); ?>" alt="loader">
    </div>
    

    <div class="wrapper">
      
      <?php if ($__env->exists('organizer.partials.top-navbar')) echo $__env->make('organizer.partials.top-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      

      
      <?php if ($__env->exists('organizer.partials.side-navbar')) echo $__env->make('organizer.partials.side-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      

      <div class="main-panel">
        <div class="content">
          <div class="page-inner">
            <?php echo $__env->yieldContent('content'); ?>
          </div>
        </div>

        
        <?php if ($__env->exists('organizer.partials.footer')) echo $__env->make('organizer.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
      </div>
    </div>

    
    <?php if ($__env->exists('organizer.partials.scripts')) echo $__env->make('organizer.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if ($__env->exists('organizer.partials.modal')) echo $__env->make('organizer.partials.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </body>
</html>
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/layout.blade.php ENDPATH**/ ?>
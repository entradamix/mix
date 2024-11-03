<!DOCTYPE html>
<html>

<head>
  
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
  <title><?php echo e(__('Forget Password') . ' | ' . $websiteInfo->website_title); ?></title>

  
  <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/admin/img/' . $websiteInfo->favicon)); ?>">

  
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>">

  
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/atlantis.css')); ?>">

  
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/admin-login.css')); ?>">
</head>

<body>
  
  <div class="forget-page">
    <?php if(!empty($websiteInfo->logo)): ?>
      <div class="text-center mb-4">
        <img class="login-logo" src="<?php echo e(asset('assets/admin/img/' . $websiteInfo->logo)); ?>" alt="logo">
      </div>
    <?php endif; ?>

    <div class="form">
      <form class="forget-password-form" action="<?php echo e(route('admin.mail_for_forget_password')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="email" name="email" placeholder="<?php echo e(__('Enter Your Email')); ?>" value="<?php echo e(old('email')); ?>" />
        <?php if($errors->has('email')): ?>
          <p class="text-danger text-left"><?php echo e($errors->first('email')); ?></p>
        <?php endif; ?>

        <button type="submit"><?php echo e(__('proceed')); ?></button>
      </form>

      <a class="back-to-login" href="<?php echo e(route('admin.login')); ?>">
        &lt;&lt; <?php echo e(__('Back')); ?>

      </a>
    </div>
  </div>
  


  
  <script src="<?php echo e(asset('assets/admin/js/jquery.min.js')); ?>"></script>

  
  <script src="<?php echo e(asset('assets/admin/js/popper.min.js')); ?>"></script>

  
  <script src="<?php echo e(asset('assets/admin/js/bootstrap.min.js')); ?>"></script>

  
  <script src="<?php echo e(asset('assets/admin/js/bootstrap-notify.min.js')); ?>"></script>

  
  <script src="<?php echo e(asset('assets/admin/js/webfont.min.js')); ?>"></script>

  <script>
    "use strict";
    WebFont.load({
      google: {
        "families": ["Lato:300,400,700,900"]
      },
      custom: {
        "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
          "simple-line-icons"
        ],
        urls: ['<?php echo e(asset('assets/admin/css/fonts.min.css')); ?>']
      },
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>

  <?php if(session()->has('success')): ?>
    <script>
      "use strict";
      var content = {};

      content.message = '<?php echo e(session('success')); ?>';
      content.title = 'Success';
      content.icon = 'fa fa-bell';

      $.notify(content, {
        type: 'success',
        placement: {
          from: 'top',
          align: 'right'
        },
        showProgressbar: true,
        time: 1000,
        delay: 4000
      });
    </script>
  <?php endif; ?>

  <?php if(session()->has('warning')): ?>
    <script>
      "use strict";
      var content = {};

      content.message = '<?php echo e(session('warning')); ?>';
      content.title = 'Warning!';
      content.icon = 'fa fa-bell';

      $.notify(content, {
        type: 'warning',
        placement: {
          from: 'top',
          align: 'right'
        },
        showProgressbar: true,
        time: 1000,
        delay: 4000
      });
    </script>
  <?php endif; ?>
</body>

</html>
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/forget-password.blade.php ENDPATH**/ ?>
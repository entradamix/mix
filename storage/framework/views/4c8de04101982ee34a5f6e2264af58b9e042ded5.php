<script>
  'use strict';

  const baseUrl = "<?php echo e(url('/')); ?>";
  var loadImgs = '';
  var ProductloadImgs = '';
</script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/jquery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/popper.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/bootstrap.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/jquery.ui.touch-punch.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/jquery.timepicker.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/jquery.scrollbar.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/bootstrap-notify.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/sweetalert.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/bootstrap-tagsinput.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/bootstrap-datepicker.min.js')); ?>"></script>


<script src="<?php echo e(asset('assets/admin/js/tinymce/js/tinymce/tinymce.min.js')); ?>"></script>


<!-- Select2 JS -->
<script src="<?php echo e(asset('assets/admin/js/select2.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/jscolor.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/fontawesome-iconpicker.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/datatables-1.10.23.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/datatables.bootstrap4.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/dropzone.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/highlight.pack.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/atlantis.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/webfont.min.js')); ?>"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

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

    content.message = '<?php echo e(__(session('success'))); ?>';
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

    content.message = '<?php echo e(__(session('warning'))); ?>';
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

<script>
  'use strict';
  const account_status = 1;
  const secret_login = 1;
</script>


<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/admin-main.js')); ?>"></script>

<?php echo $__env->yieldContent('variables'); ?>

<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->yieldContent('vuescripts'); ?>
<?php /**PATH /var/www/html/resources/views/backend/partials/scripts.blade.php ENDPATH**/ ?>
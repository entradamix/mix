<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->contact_page_title ?? __('Contact')); ?>

  <?php else: ?>
    <?php echo e(__('Contact')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php
  $metaKeywords = !empty($seo->meta_keyword_contact) ? $seo->meta_keyword_contact : '';
  $metaDescription = !empty($seo->meta_description_contact) ? $seo->meta_description_contact : '';
?>
<?php $__env->startSection('meta-keywords', "<?php echo e($metaKeywords); ?>"); ?>
<?php $__env->startSection('meta-description', "$metaDescription"); ?>

<?php $__env->startSection('hero-section'); ?>
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
    data-bg="<?php echo e(asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title"><?php echo e($pageHeading ? $pageHeading->contact_page_title : ''); ?></h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active"><?php echo e($pageHeading ? $pageHeading->contact_page_title : __('Contact')); ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Contact Section Start -->
  <section class="contact-page py-120 rpy-100">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-4">
          <div class="contact-information rpb-20">
            <div class="contact-info-item">
              <i class="far fa-map"></i>
              <div class="info-content">
                <h5><?php echo e(__('Our Address')); ?></h5>
                <span><?php echo e(!empty($info->contact_addresses) ? $info->contact_addresses : ''); ?></span>
              </div>
            </div>
            <div class="contact-info-item">
              <i class="far fa-envelope"></i>
              <div class="info-content">
                <h5><?php echo e(__('Our Email')); ?></h5>
                <span><a href="#"><?php echo e(!empty($info->contact_mails) ? $info->contact_mails : ''); ?></a></span>
              </div>
            </div>
            <div class="contact-info-item">
              <i class="fas fa-phone-alt"></i>
              <div class="info-content">
                <h5><?php echo e(__('Our Phone')); ?></h5>
                <span><a href=""><?php echo e(!empty($info->contact_numbers) ? $info->contact_numbers : ''); ?></a></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="contact-form">
            <h3 class="comment-title mb-15"><?php echo e(__('Send A Message')); ?></h3>
            <?php if(Session::has('success')): ?>
              <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
            <?php endif; ?>
            <?php if(Session::has('error')): ?>
              <div class="alert alert-danger"><?php echo e(Session::get('error')); ?></div>
              <?php
                Session::forget('error');
              ?>
            <?php endif; ?>
            <form id="comment-form" class="comment-form mt-35" name="comment-form"
              action="<?php echo e(route('contact.send_mail')); ?>" method="post">
              <?php echo csrf_field(); ?>
              <div class="row clearfix justify-content-center">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" id="full-name" name="name" class="form-control" value=""
                      placeholder="<?php echo e(__('Enter Your Full Name')); ?>">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control" value=""
                      placeholder="<?php echo e(__('Enter Your Email')); ?>">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <input type="text" name="subject" class="form-control" value=""
                      placeholder="<?php echo e(__('Enter Email Subject')); ?>">
                    <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <textarea name="message" class="form-control" rows="4" placeholder="<?php echo e(__('Write Your Message')); ?>"></textarea>
                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                </div>
                <div class="col-sm-12">
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
                <div class="col-sm-12">
                  <div class="form-group mb-0">
                    <button type="submit" class="theme-btn showLoader"><?php echo e(__('Send Message')); ?></button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php if(!empty(showAd(3))): ?>
      <div class="text-center mt-30">
        <?php echo showAd(3); ?>

      </div>
    <?php endif; ?>
  </section>
  <!-- Contact Section End -->

  <!-- Map -->

  <div class="contact-page-map">
    <div class="our-location">
      <?php if(!empty($contact_info->latitude) && !empty($contact_info->longitude)): ?>
        <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
          src="//maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=<?php echo e($contact_info->latitude); ?>,%20<?php echo e($contact_info->longitude); ?>+(<?php echo e($websiteInfo->website_title); ?>)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
      <?php endif; ?>
    </div>
  </div>
  <!-- Map -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/contact.blade.php ENDPATH**/ ?>
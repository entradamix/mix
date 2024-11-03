<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($pageInfo->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php echo e($pageInfo->meta_keywords); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php echo e($pageInfo->meta_description); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('og-title', "$pageInfo->title"); ?>

<?php $__env->startSection('custom-style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/summernote-content.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('hero-section'); ?>
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
    data-bg="<?php echo e(asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title"><?php echo e($pageInfo->title); ?></h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active"><?php echo e($pageInfo->title); ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!--====== PAGE CONTENT PART START ======-->
  <section class="custom-page-area pt-100 pb-90">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="summernote-content">
            <?php echo $pageInfo->content; ?>

          </div>
        </div>
      </div>

      <?php if(!empty(showAd(3))): ?>
        <div class="text-center mt-30">
          <?php echo showAd(3); ?>

        </div>
      <?php endif; ?>
    </div>
  </section>
  <!--====== PAGE CONTENT PART END ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/custom-page.blade.php ENDPATH**/ ?>
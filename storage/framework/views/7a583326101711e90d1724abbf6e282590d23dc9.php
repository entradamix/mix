<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->faq_page_title ?? __('F.A.Q')); ?>

  <?php else: ?>
    <?php echo e(__('F.A.Q')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php
  $metaKeywords = !empty($seo->meta_keyword_faq) ? $seo->meta_keyword_faq : '';
  $metaDescription = !empty($seo->meta_description_faq) ? $seo->meta_description_faq : '';
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
            <?php echo e($pageHeading->faq_page_title ?? __('F.A.Q')); ?>

          <?php else: ?>
            <?php echo e(__('F.A.Q')); ?>

          <?php endif; ?>
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active">
              <?php if(!empty($pageHeading)): ?>
                <?php echo e($pageHeading->faq_page_title ?? __('F.A.Q')); ?>

              <?php else: ?>
                <?php echo e(__('F.A.Q')); ?>

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


  <!--====== FAQ PART START ======-->
  <section class="faq-area pt-80 pb-80">
    <div class="container">
      <div class="row">
        <div class="col">
          <?php if(count($faqs) == 0): ?>
            <h3 class="text-center"><?php echo e(__('No FAQ Found') . '!'); ?></h3>
          <?php else: ?>
            <div class="faq-accordion">
              <div class="accordion" id="accordionExample">
                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="card">
                    <div class="card-header" id="<?php echo e('heading-' . $faq->id); ?>">
                      <a class="<?php echo e($loop->first ? '' : 'collapsed'); ?>" href="" data-toggle="collapse"
                        data-target="<?php echo e('#collapse-' . $faq->id); ?>"
                        aria-expanded="<?php echo e($loop->first ? 'true' : 'false'); ?>"
                        aria-controls="<?php echo e('collapse-' . $faq->id); ?>">
                        <?php echo e($faq->question); ?>

                      </a>
                    </div>

                    <div id="<?php echo e('collapse-' . $faq->id); ?>" class="collapse <?php echo e($loop->first ? 'show' : ''); ?>"
                      aria-labelledby="<?php echo e('heading-' . $faq->id); ?>" data-parent="#accordionExample">
                      <div class="card-body">
                        <p><?php echo e($faq->answer); ?></p>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <?php if(!empty(showAd(3))): ?>
        <div class="text-center mt-30">
          <?php echo showAd(3); ?>

        </div>
      <?php endif; ?>
    </div>
  </section>
  <!--====== FAQ PART END ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/faqs.blade.php ENDPATH**/ ?>
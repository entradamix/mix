<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->blog_page_title ?? __('Blog')); ?>

  <?php else: ?>
    <?php echo e(__('Blog')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php
  $metaKeywords = !empty($seo->meta_keyword_blog) ? $seo->meta_keyword_blog : '';
  $metaDescription = !empty($seo->meta_description_blog) ? $seo->meta_description_blog : '';
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
            <?php echo e($pageHeading->blog_page_title ?? __('Blog')); ?>

          <?php else: ?>
            <?php echo e(__('Blog')); ?>

          <?php endif; ?>
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active">
              <?php if(!empty($pageHeading)): ?>
                <?php echo e($pageHeading->blog_page_title ?? __('Blog')); ?>

              <?php else: ?>
                <?php echo e(__('Blog')); ?>

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


  <!--====== BLOG STANDARD PART START ======-->
  <section class="blog-page-section py-120 rpy-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="blog-standard">
            <div class="row">
              <?php if(count($blogs) == 0): ?>
                <div class="col">
                  <h3 class="mt-40 text-center"><?php echo e(__('No Blog Found') . '!'); ?></h3>
                </div>
              <?php else: ?>
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-md-6">
                    <div class="blog-item">
                      <div class="blog-image">
                        <a href="<?php echo e(route('blog_details', ['slug' => $blog->slug])); ?>">
                          <img data-src="<?php echo e(asset('assets/admin/img/blogs/' . $blog->image)); ?>" class="lazy" alt="image">
                        </a>
                      </div>
                      <div class="blog-content">
                        <a class="category"
                          href="<?php echo e(route('blogs', ['category' => $blog->categorySlug])); ?>"><?php echo e($blog->categoryName); ?></a>
                        <a class="d-block" href="<?php echo e(route('blog_details', ['slug' => $blog->slug])); ?>">
                          <h4 class="title">
                            <?php echo e(strlen($blog->title) > 30 ? mb_substr($blog->title, 0, 30, 'UTF-8') . '...' : $blog->title); ?>

                          </h4>
                        </a>
                        <p><?php echo strlen(strip_tags($blog->content)) > 100
                            ? mb_substr(strip_tags($blog->content), 0, 100, 'UTF-8') . '...'
                            : strip_tags($blog->content); ?></p>
                        <ul class="blog-footer">
                          <li><i class="fas fa-calendar-alt"></i> <?php echo e(date_format($blog->created_at, 'M d, Y')); ?></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </div>

            <?php if(count($blogs) > 0): ?>
              <?php echo e($blogs->appends([
                      'title' => request()->input('title'),
                      'category' => request()->input('category'),
                  ])->links()); ?>

            <?php endif; ?>

          </div>

          <?php if(!empty(showAd(3))): ?>
            <div class="text-center mt-30">
              <?php echo showAd(3); ?>

            </div>
          <?php endif; ?>
        </div>

        <?php if ($__env->exists('frontend.journal.side-bar')) echo $__env->make('frontend.journal.side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>
  <!--====== BLOG STANDARD PART END ======-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/blog.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/journal/blogs.blade.php ENDPATH**/ ?>
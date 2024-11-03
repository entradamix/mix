<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->blog_details_page_title ?? __('Blog Details')); ?>

  <?php else: ?>
    <?php echo e(__('Blog Details')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?> <?php echo e($details->meta_keywords); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?> <?php echo e($details->meta_description); ?> <?php $__env->stopSection(); ?>

<?php
  $og_title = $details->title;
  $og_description = strip_tags($details->content);
  $og_image = asset('assets/admin/img/blogs/' . $details->image);
?>

<?php $__env->startSection('og-title', "$og_title"); ?>
<?php $__env->startSection('og-description', "$og_description"); ?>
<?php $__env->startSection('og-image', "$og_image"); ?>
<?php $__env->startSection('custom-style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/summernote-content.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('hero-section'); ?>
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
    data-bg="<?php echo e(asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title">
          <?php echo e(strlen($details->title) > 30 ? mb_substr($details->title, 0, 30, 'UTF-8') . '...' : $details->title); ?>

        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active">
              <?php if(!empty($pageHeading)): ?>
                <?php echo e($pageHeading->blog_details_page_title ?? __('Blog Details')); ?>

              <?php else: ?>
                <?php echo e(__('Blog Details')); ?>

              <?php endif; ?>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->
<?php $__env->stopSection(); ?>

<!--====== BLOG DETAILS PART START ======-->
<section class="blog-details py-120 rpy-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="blog-details-content">
          <div class="image mb-30">
            <img data-src="<?php echo e(asset('assets/admin/img/blogs/' . $details->image)); ?>" class="lazy" alt="image">
          </div>

          <div class="blog-details-top">
            <ul class="blog-meta mb-5">
              <li>
                <i class="fa fa-calendar-alt"></i> <?php echo e(date_format($details->created_at, 'M d, Y')); ?>

              </li>
              <li>
                <i class="fa fa-tag"></i>
                <span><a
                    href="<?php echo e(route('blogs', ['category' => $details->blogSlug])); ?>"><?php echo e($details->categoryName); ?></a></span>
              </li>
              <li>
                <i class="fa fa-tag"></i>
                <span><?php echo e($details->author); ?></span>
              </li>
            </ul>
            <h3 class="blog-title mb-20"><?php echo e($details->title); ?></h3>
            <div class="summernote-content">
              <?php echo $details->content; ?>

            </div>
          </div>

          <div class="tag-share pt-20 pb-50">
            <div class="social-style-two pb-15">
              <b>Share:</b>
              <a href="//www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>"><i
                  class="fab fa-facebook-f"></i></a>
              <a href="//twitter.com/intent/tweet?text=my share text&amp;url=<?php echo e(urlencode(url()->current())); ?>"><i
                  class="fab fa-twitter"></i></a>
              <a
                href="//www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>&amp;title=<?php echo e($details->title); ?>"><i
                  class="fab fa-linkedin"></i></a>
            </div>
          </div>

          <?php if(!empty(showAd(3))): ?>
            <div class="text-center">
              <?php echo showAd(3); ?>

            </div>
          <?php endif; ?>

          <div class="blog-details-releted-post mt-45">
            <h3 class="blog-title mb-10"><?php echo e(__('Related Blog')); ?></h3>
            <hr>
            <?php if(count($relatedBlogs) == 0): ?>
              <div class="row text-center">
                <div class="col">
                  <h5 class="mt-40"><?php echo e(__('No Related Blog Found') . '!'); ?></h5>
                </div>
              </div>
            <?php else: ?>
              <div class="row">

                <?php $__currentLoopData = $relatedBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedBlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-md-6">
                    <div class="blog-item">
                      <div class="blog-image">
                        <a href="<?php echo e(route('blog_details', ['slug' => $relatedBlog->slug])); ?>">
                          <img data-src="<?php echo e(asset('assets/admin/img/blogs/' . $relatedBlog->image)); ?>" class="lazy"
                            alt="image">
                        </a>
                      </div>
                      <div class="blog-content">
                        <a class="category"
                          href="<?php echo e(route('blogs', ['category' => $relatedBlog->categorySlug])); ?>"><?php echo e($relatedBlog->categoryName); ?></a>
                        <a class="d-block" href="<?php echo e(route('blog_details', ['slug' => $relatedBlog->slug])); ?>">
                          <h4 class="title">
                            <?php echo e(strlen($relatedBlog->title) > 30 ? mb_substr($relatedBlog->title, 0, 30, 'UTF-8') . '...' : $relatedBlog->title); ?>

                          </h4>
                        </a>
                        <p><?php echo strlen(strip_tags($relatedBlog->content)) > 100
                            ? mb_substr(strip_tags($relatedBlog->content), 0, 100, 'UTF-8') . '...'
                            : strip_tags($relatedBlog->content); ?></p>
                        <ul class="blog-footer">
                          <li><i class="fas fa-calendar-alt"></i> <?php echo e(date_format($relatedBlog->created_at, 'M d, Y')); ?>

                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            <?php endif; ?>
          </div>

          <?php if(!empty(showAd(3))): ?>
            <div class="text-center mt-30">
              <?php echo showAd(3); ?>

            </div>
          <?php endif; ?>

          <?php if($disqusInfo->disqus_status == 1): ?>
            <div id="disqus_thread" class="mt-45"></div>
          <?php endif; ?>
        </div>
      </div>

      <?php if ($__env->exists('frontend.journal.side-bar')) echo $__env->make('frontend.journal.side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</section>
<!--====== BLOG DETAILS PART END ======-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
  "use strict";
  const shortName = '<?php echo e($disqusInfo->disqus_short_name); ?>';
</script>

<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/blog.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/journal/blog-details.blade.php ENDPATH**/ ?>
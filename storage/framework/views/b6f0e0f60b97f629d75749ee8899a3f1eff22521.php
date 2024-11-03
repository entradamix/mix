<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->organizer_page_title ?? __('Organizer')); ?>

  <?php else: ?>
    <?php echo e(__('Organizer')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php
  $metaKeywords = !empty($seo->meta_keyword_organizer) ? $seo->meta_keyword_organizer : '';
  $metaDescription = !empty($seo->meta_description_organizer) ? $seo->meta_description_organizer : '';
?>
<?php $__env->startSection('meta-keywords', "<?php echo e($metaKeywords); ?>"); ?>
<?php $__env->startSection('meta-description', "$metaDescription"); ?>


<?php
  $now_time = \Carbon\Carbon::now();
  $events_caroussel = DB::table('event_contents')
      ->join('events', 'events.id', '=', 'event_contents.event_id')
      ->join('event_images', 'event_images.event_id', '=', 'event_contents.event_id')
      ->where([['event_contents.language_id', '=', $currentLanguageInfo->id], ['events.status', 1], ['events.end_date_time', '>=', $now_time], ['events.is_featured', '!=', 'no']])
      ->orderBy('events.created_at', 'desc')
      ->get();
?>

<?php if(!$events_caroussel): ?>
  <?php $__env->startSection('hero-section'); ?>
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy" data-bg="<?php echo e(asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title">
          <?php if(!empty($pageHeading)): ?>
            <?php echo e($pageHeading->organizer_page_title ?? __('Organizer')); ?>

          <?php else: ?>
            <?php echo e(__('Organizer')); ?>

          <?php endif; ?>
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active">
              <?php if(!empty($pageHeading)): ?>
                <?php echo e($pageHeading->organizer_page_title ?? __('Organizer')); ?>

              <?php else: ?>
                <?php echo e(__('Organizer')); ?>

              <?php endif; ?>
            </li>
          </ol>
        </nav>
        <div class="authors-search-filter mt-30">
          <form <?php echo e(route('frontend.all.organizer')); ?>>
            <div class="search-filter-form">
              <div class="row no-gutters justify-content-center">
                <div class="search-item">
                  <input type="text" class="form_control" name="organizer"
                    placeholder="<?php echo e(__('Enter Organizar Name')); ?>" value="<?php echo e(request()->input('organizer')); ?>">
                </div>

                <div class="search-item">
                  <input type="text" class="form_control" placeholder="<?php echo e(__('Enter Username')); ?>" name="username"
                    value="<?php echo e(request()->input('username')); ?>" />
                </div>
                <div class="search-item">
                  <input type="text" class="form_control" name="location" placeholder="<?php echo e(__('Enter Location')); ?>"
                    value="<?php echo e(request()->input('location')); ?>" />
                </div>

                <div class="search-item">
                  <button type="submit" class="theme-btn rounded-0"><?php echo e(__('Search')); ?></button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->
  <?php $__env->stopSection(); ?>
<?php else: ?>
    <?php $__env->startSection('hero-section'); ?>
        <section class="hero-section">
            <div class="owl-carousel owl-theme mt-3" id="owl-carousel-destaque">
                <?php $__currentLoopData = $events_caroussel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <a href="<?php echo e(route('event.details', [$event->slug, $event->id])); ?>">
                          <img class="d-block w-100 radius" src="<?php echo e(asset('assets/admin/img/event-gallery/' . $event->image)); ?>">
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
        <div class="container">
          <div class="hero-content">
              <form <?php echo e(route('frontend.all.organizer')); ?>>
                <div class="search-filter-form">
                  <div class="row no-gutters justify-content-center">
                    <div class="search-item">
                      <input type="text" class="form_control" name="organizer"
                        placeholder="<?php echo e(__('Enter Organizar Name')); ?>" value="<?php echo e(request()->input('organizer')); ?>">
                    </div>
    
                    <div class="search-item">
                      <input type="text" class="form_control" placeholder="<?php echo e(__('Enter Username')); ?>" name="username"
                        value="<?php echo e(request()->input('username')); ?>" />
                    </div>
                    <div class="search-item">
                      <input type="text" class="form_control" name="location" placeholder="<?php echo e(__('Enter Location')); ?>"
                        value="<?php echo e(request()->input('location')); ?>" />
                    </div>
    
                    <div class="search-item">
                      <button type="submit" class="theme-btn rounded-0"><?php echo e(__('Search')); ?></button>
                    </div>
                  </div>
                </div>
              </form>
          </div>
        </div>
    <?php $__env->stopSection(); ?>
<?php endif; ?>
<?php $__env->startSection('content'); ?>

  <!-- Author-single-area start -->
  <div class="author-area py-120 rpy-100 bg-lighter">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="product-filter">
            <div class="row justify-content-between align-items-center">
              <div class="col-lg-3 col-md-4">
                <h6 class="mb-20"><?php echo e(__('Total organizer showing')); ?>: <?php echo e(count($collection)); ?></h6>
              </div>
            </div>
          </div>
          <div class="row">
            <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card card-center p-2 mb-30">
                  <div class="card-cover lazy" data-bg="<?php echo e($item->cover != null ? asset('assets/admin/img/organizer-cover/' . $item->cover) : asset('assets/front/images/user.png')); ?>" style="background-size: cover;"></div>
                  <figure class="card-img mb-1">
                    <a href="<?php echo e(route('frontend.organizer.details', [$item->id, str_replace(' ', '-', $item->username)])); ?>"
                      target="_self" title="kreativDev">
                      <?php if($item->photo == null): ?>
                        <img class="rounded-lg lazy" data-src="<?php echo e(asset('assets/front/images/user.png')); ?>" alt="image">
                      <?php else: ?>
                        <img class="rounded-lg lazy" data-src="<?php echo e(asset('assets/admin/img/organizer-photo/' . $item->photo)); ?>"
                          alt="image">
                      <?php endif; ?>
                    </a>
                  </figure>
                  <div class="card-content mt-35">
                    <h5 class="card-title mb-1"><a
                        href="<?php echo e(route('frontend.organizer.details', [$item->id, str_replace(' ', '-', $item->username)])); ?>"><?php echo e(@$item->organizer_info->name); ?></a>
                    </h5>
                    <div>
                      <span class="text-muted mb-1"><a
                        href="<?php echo e(route('frontend.organizer.details', [$item->id, str_replace(' ', '-', $item->username)])); ?>"><?php echo e($item->username); ?></a>
                      </span>
                    </div>
                    <div class="mb-15 font-sm">
                      <span><?php echo e(OrganizerEventCount($item->id)); ?>

                        <?php echo e(OrganizerEventCount($item->id) > 1 ? __('Events') : __('Event')); ?></span>
                    </div>
                    <a href="<?php echo e(route('frontend.organizer.details', [$item->id, str_replace(' ', '-', $item->username)])); ?>"
                      target="_self" title="<?php echo e($item->username); ?>" class="btn-text"> <?php echo e(__('View Profile')); ?> </a>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


          </div>
          <?php echo e($collection->links()); ?>


          <?php if(!empty(showAd(3))): ?>
            <div class="text-center mt-4">
              <?php echo showAd(3); ?>

            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Author-single-area start -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/organizer/index.blade.php ENDPATH**/ ?>
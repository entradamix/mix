<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Home')); ?>

<?php $__env->stopSection(); ?>

<?php
  $metaKeywords = !empty($seo->meta_keyword_home) ? $seo->meta_keyword_home : '';
  $metaDescription = !empty($seo->meta_description_home) ? $seo->meta_description_home : '';
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
    <!-- Hero Section Start -->
    <?php if($heroSection): ?>
      <section class="hero-section overlay pt-105 pb-120 lazy" data-bg="<?php echo e(asset('assets/admin/img/hero-section/' . $heroSection->background_image)); ?>">
    <?php else: ?>
      <section class="hero-section overlay pt-105 pb-120 lazy" data-bg="<?php echo e(asset('assets/front/images/hero-bg.jpg')); ?>">
    <?php endif; ?>
    <div class="container">
      <div class="hero-content">
        <h1>
          <?php echo e($heroSection ? $heroSection->first_title : __('Event Ticketing and Booking System')); ?>

        </h1>
        <p>
          <?php echo e($heroSection ? $heroSection->second_title : __('This is an affordable and powerful event ticketing platform for event organisers, promoters, and managers. Easily create, promote and sell tickets to your events of every type and size.')); ?>

        </p>
        <form id="event-search" class="event-search mt-35" name="event-search" action="<?php echo e(route('events')); ?>" method="get">
          <div class="search-item">
            <label for="borwseby"><i class="fas fa-list"></i></label>
            <select name="category" id="borwseby">
              <option value=""><?php echo e(__('All Category')); ?></option>
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="search-item">
            <label for="search"><i class="fas fa-search"></i></label>
            <input type="search" id="search" name="search-input" placeholder="<?php echo e(__('Search Anything')); ?>">
          </div>
          <button type="submit" class="theme-btn"><?php echo e($heroSection ? $heroSection->first_button : __('Search')); ?></button>
        </form>
      </div>
    </div>
    </section>
    <!-- Hero Section End -->
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
            <form id="event-search" class="event-search mt-35" name="event-search" action="<?php echo e(route('events')); ?>" method="get">
              <div class="search-item">
                <label for="borwseby"><i class="fas fa-list"></i></label>
                <select name="category" id="borwseby">
                  <option value=""><?php echo e(__('All Category')); ?></option>
                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="search-item">
                <label for="search"><i class="fas fa-search"></i></label>
                <input type="search" id="search" name="search-input" placeholder="<?php echo e(__('Search Anything')); ?>">
              </div>
              <button type="submit" class="theme-btn"><?php echo e($heroSection ? $heroSection->first_button : __('Search')); ?></button>
            </form>
          </div>
        </div>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
  <!-- Events Section Start -->
  <?php if($secInfo->featured_section_status == 1): ?>
    <section class="events-section pt-110 rpt-90 pb-90 rpb-70 bg-lighter">
      <div class="container">

        <div class="section-title text-center mb-45">
          <h2><?php echo e($secTitleInfo ? $secTitleInfo->event_section_title : __('Featured Events')); ?></h2>
        </div>
        <?php if(count($eventCategories) < 1): ?>
          <p class="text-center"><?php echo e(__('No Events Found')); ?></p>
        <?php else: ?>
          <ul class="events-filter mb-40">
            <li data-filter="*" class="current"><?php echo e(__('All')); ?></li>
            <?php $__currentLoopData = $eventCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li data-filter=".<?php echo e($item->id); ?>"><?php echo e($item->name); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <div class="row events-active">
            <?php $__currentLoopData = $eventCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $now_time = \Carbon\Carbon::now();
                $events = DB::table('event_contents')
                    ->join('events', 'events.id', '=', 'event_contents.event_id')
                    ->where([['event_contents.event_category_id', '=', $item->id], ['event_contents.language_id', '=', $currentLanguageInfo->id], ['events.status', 1], ['events.end_date_time', '>=', $now_time], ['events.is_featured', '=', 'yes']])
                    ->orderBy('events.created_at', 'desc')
                    ->get();
              ?>
              <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 item <?php echo e($item->id); ?> motivational">
                  <div class="event-item">
                    <div class="event-image">
                      <a href="<?php echo e(route('event.details', [$event->slug, $event->id])); ?>">
                        <img src="<?php echo e(asset('assets/admin/img/event/thumbnail/' . $event->thumbnail)); ?>" alt="Event">
                      </a>
                    </div>
                    <div class="event-content">
                      <ul class="time-info">
                        <?php
                          if ($event->date_type == 'multiple') {
                              $event_date = eventLatestDates($event->id);
                              $date = strtotime(@$event_date->start_date);
                          } else {
                              $date = strtotime($event->start_date);
                          }
                        ?>
                        <li>
                          <i class="far fa-calendar-alt"></i>
                          <span>
                            <?php echo e(\Carbon\Carbon::parse($date)->timezone($websiteInfo->timezone)->translatedFormat('d M')); ?>

                          </span>
                        </li>
                        <li>
                          <i class="far fa-hourglass"></i>
                          <span
                            title="<?php echo e(__('Event Duration')); ?>"><?php echo e($event->date_type == 'multiple' ? @$event_date->duration : $event->duration); ?></span>
                        </li>
                        <li>
                          <i class="far fa-clock"></i>
                          <span>
                            <?php
                              $start_time = strtotime($event->start_time);
                            ?>
                            <?php echo e(\Carbon\Carbon::parse($start_time)->timezone($websiteInfo->timezone)->translatedFormat('h:i A')); ?>

                          </span>
                        </li>
                      </ul>
                      <?php if($event->organizer_id != null): ?>
                        <?php
                          $organizer = App\Models\Organizer::where('id', $event->organizer_id)->first();
                        ?>
                        <?php if($organizer): ?>
                          <a href="<?php echo e(route('frontend.organizer.details', [$organizer->id, str_replace(' ', '-', $organizer->username)])); ?>"
                            class="organizer"><?php echo e(__('By')); ?>&nbsp;&nbsp;<?php echo e($organizer->username); ?></a>
                        <?php endif; ?>
                      <?php else: ?>
                        <?php
                          $admin = App\Models\Admin::first();
                        ?>
                        <a href="<?php echo e(route('frontend.organizer.details', [$admin->id, str_replace(' ', '-', $admin->username), 'admin' => 'true'])); ?>"
                          class="organizer"><?php echo e($admin->username); ?></a>
                      <?php endif; ?>
                      <h5>
                        <a href="<?php echo e(route('event.details', [$event->slug, $event->id])); ?>">
                          <?php if(strlen($event->title) > 30): ?>
                            <?php echo e(mb_substr($event->title, 0, 30) . '...'); ?>

                          <?php else: ?>
                            <?php echo e($event->title); ?>

                          <?php endif; ?>
                        </a>
                      </h5>
                      <?php
                        $desc = strip_tags($event->description);
                      ?>

                      <?php if(strlen($desc) > 100): ?>
                        <p class="event-description"><?php echo e(mb_substr($desc, 0, 100) . '....'); ?></p>
                      <?php else: ?>
                        <p class="event-description"><?php echo e($desc); ?></p>
                      <?php endif; ?>
                      <?php
                        if ($event->event_type == 'online') {
                            $ticket = App\Models\Event\Ticket::where('event_id', $event->id)
                                ->orderBy('price', 'asc')
                                ->first();
                        } else {
                            $ticket = App\Models\Event\Ticket::where([['event_id', $event->id], ['price', '!=', null]])
                                ->orderBy('price', 'asc')
                                ->first();
                            if (empty($ticket)) {
                                $ticket = App\Models\Event\Ticket::where([['event_id', $event->id], ['f_price', '!=', null]])
                                    ->orderBy('price', 'asc')
                                    ->first();
                            }
                        }
                        $event_count = DB::table('tickets')
                            ->where('event_id', $event->id)
                            ->get()
                            ->count();
                      ?>
                      <div class="price-remain">
                        <div class="location">
                          <?php if($event->event_type == 'venue'): ?>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>
                              <?php if($event->city != null): ?>
                                <?php echo e($event->city); ?>

                              <?php endif; ?>
                              <?php if($event->country): ?>
                                , <?php echo e($event->country); ?>

                              <?php endif; ?>
                            </span>
                          <?php else: ?>
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo e(__('Online')); ?></span>
                          <?php endif; ?>
                        </div>
                        <span>
                          <?php if($ticket): ?>
                            <?php if($ticket->event_type == 'online'): ?>
                              <?php if($ticket->price != null): ?>
                                <span class="price" dir="ltr">
                                  <?php if($ticket->early_bird_discount == 'enable'): ?>
                                    <?php
                                      $discount_date = Carbon\Carbon::parse($ticket->early_bird_discount_date . $ticket->early_bird_discount_time);
                                    ?>

                                    <?php if($ticket->early_bird_discount_type == 'fixed' && !$discount_date->isPast()): ?>
                                      <?php
                                        $calculate_price = $ticket->price - $ticket->early_bird_discount_amount;
                                      ?>
                                      <?php echo e(symbolPrice($calculate_price)); ?>

                                      <span>
                                        <del>
                                          <?php echo e(symbolPrice($ticket->price)); ?>

                                        </del>
                                      </span>
                                    <?php elseif($ticket->early_bird_discount_type == 'percentage' && !$discount_date->isPast()): ?>
                                      <?php
                                        $p_price = ($ticket->price * $ticket->early_bird_discount_amount) / 100;
                                        $calculate_price = $ticket->price - $p_price;
                                      ?>

                                      <?php echo e(symbolPrice($calculate_price)); ?>

                                      <span>
                                        <del>
                                          <?php echo e(symbolPrice($ticket->price)); ?>

                                        </del>
                                      </span>
                                    <?php else: ?>
                                      <?php
                                        $calculate_price = $ticket->price;
                                      ?>
                                      <?php echo e(symbolPrice($calculate_price)); ?>

                                    <?php endif; ?>
                                  <?php else: ?>
                                    <?php
                                      $calculate_price = $ticket->price;
                                    ?>
                                    <?php echo e(symbolPrice($calculate_price)); ?>

                                  <?php endif; ?>

                                </span>
                              <?php else: ?>
                                <span class="price"><?php echo e(__('Free')); ?></span>
                              <?php endif; ?>
                            <?php endif; ?>
                            <?php if($ticket->event_type == 'venue'): ?>
                              <?php if($ticket->pricing_type == 'variation'): ?>
                                <span class="price" dir="ltr">
                                  <?php
                                    $variation = json_decode($ticket->variations, true);
                                    $v_min_price = array_reduce(
                                        $variation,
                                        function ($a, $b) {
                                            return $a['price'] < $b['price'] ? $a : $b;
                                        },
                                        array_shift($variation),
                                    );
                                    $price = $v_min_price['price'];
                                  ?>
                                  <span class="price">
                                    <?php if($currentLanguageInfo->direction == 1): ?>
                                      <strong><?php echo e($event_count > 1 ? '*' : ''); ?></strong>
                                    <?php endif; ?>
                                    <?php if($ticket->early_bird_discount == 'enable'): ?>
                                      <?php
                                        $discount_date = Carbon\Carbon::parse($ticket->early_bird_discount_date . $ticket->early_bird_discount_time);
                                      ?>
                                      <?php if($ticket->early_bird_discount_type == 'fixed' && !$discount_date->isPast()): ?>
                                        <?php
                                          $calculate_price = $price - $ticket->early_bird_discount_amount;
                                        ?>
                                        <?php echo e(symbolPrice($calculate_price)); ?>

                                        <span><del>
                                            <?php echo e(symbolPrice($price)); ?>

                                          </del></span>
                                      <?php elseif($ticket->early_bird_discount_type == 'percentage' && !$discount_date->isPast()): ?>
                                        <?php
                                          $p_price = ($price * $ticket->early_bird_discount_amount) / 100;
                                          $calculate_price = $p_price - $price;
                                        ?>
                                        <?php echo e(symbolPrice($calculate_price)); ?>


                                        <span>
                                          <del>
                                            <?php echo e(symbolPrice($price)); ?>

                                          </del>
                                        </span>
                                      <?php else: ?>
                                        <?php
                                          $calculate_price = $price;
                                        ?>
                                        <?php echo e(symbolPrice($calculate_price)); ?>

                                      <?php endif; ?>
                                    <?php else: ?>
                                      <?php
                                        $calculate_price = $price;
                                      ?>
                                      <?php echo e(symbolPrice($calculate_price)); ?>

                                    <?php endif; ?>
                                    <?php if($currentLanguageInfo->direction != 1): ?>
                                      <strong><?php echo e($event_count > 1 ? '*' : ''); ?></strong>
                                    <?php endif; ?>
                                  </span>
                                </span>
                              <?php elseif($ticket->pricing_type == 'normal'): ?>
                                <span class="price" dir="ltr">
                                  <?php if($currentLanguageInfo->direction == 1): ?>
                                    <strong><?php echo e($event_count > 1 ? '*' : ''); ?></strong>
                                  <?php endif; ?>
                                  <?php if($ticket->early_bird_discount == 'enable'): ?>
                                    
                                    <?php
                                      $discount_date = Carbon\Carbon::parse($ticket->early_bird_discount_date . $ticket->early_bird_discount_time);
                                    ?>

                                    <?php if($ticket->early_bird_discount_type == 'fixed' && !$discount_date->isPast()): ?>
                                      <?php
                                        $calculate_price = $ticket->price - $ticket->early_bird_discount_amount;
                                      ?>

                                      <?php echo e(symbolPrice($calculate_price)); ?>

                                      <span>
                                        <del>
                                          <?php echo e(symbolPrice($ticket->price)); ?>

                                        </del>
                                      </span>
                                    <?php elseif($ticket->early_bird_discount_type == 'percentage' && !$discount_date->isPast()): ?>
                                      <?php
                                        $p_price = ($ticket->price * $ticket->early_bird_discount_amount) / 100;
                                        $calculate_price = $ticket->price - $p_price;
                                      ?>
                                      <?php echo e(symbolPrice($calculate_price)); ?>


                                      <span>
                                        <del>
                                          <?php echo e(symbolPrice($ticket->price)); ?>

                                        </del>
                                      </span>
                                    <?php else: ?>
                                      <?php
                                        $calculate_price = $ticket->price;
                                      ?>
                                      <?php echo e(symbolPrice($calculate_price)); ?>

                                    <?php endif; ?>
                                  <?php else: ?>
                                    <?php
                                      $calculate_price = $ticket->price;
                                    ?>
                                    <?php echo e(symbolPrice($calculate_price)); ?>

                                  <?php endif; ?>

                                  <?php if($currentLanguageInfo->direction != 1): ?>
                                    <strong><?php echo e($event_count > 1 ? '*' : ''); ?></strong>
                                  <?php endif; ?>
                                </span>
                              <?php else: ?>
                                <span class="price"><?php echo e(__('Free')); ?>

                                  <strong><?php echo e($event_count > 1 ? '*' : ''); ?></strong>
                              <?php endif; ?>
                            <?php endif; ?>
                          <?php endif; ?>
                        </span>
                      </div>

                    </div>
                    <?php if(Auth::guard('customer')->check()): ?>
                      <?php
                        $customer_id = Auth::guard('customer')->user()->id;
                        $event_id = $event->id;
                        $checkWishList = checkWishList($event_id, $customer_id);
                      ?>
                    <?php else: ?>
                      <?php
                        $checkWishList = false;
                      ?>
                    <?php endif; ?>
                    <a href="<?php echo e($checkWishList == false ? route('addto.wishlist', $event->id) : route('remove.wishlist', $event->id)); ?>"
                      class="wishlist-btn <?php echo e($checkWishList == true ? 'bg-success' : ''); ?>">
                      <i class="far fa-bookmark"></i>
                    </a>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </div>
        <?php endif; ?>
      </div>
      <?php if(!empty(showAd(3))): ?>
        <div class="text-center mt-4">
          <?php echo showAd(3); ?>

        </div>
      <?php endif; ?>
    </section>
  <?php endif; ?>
  <!-- Events Section End -->

  <!-- Category Section Start -->
  <?php if($secInfo->categories_section_status == 1): ?>
    <section class="category-section pt-110 rpt-90 pb-80 rpb-60">
      <div class="container">
        <div class="section-title mb-60">
          <h2><?php echo e($secTitleInfo ? $secTitleInfo->category_section_title : __('Categories')); ?></h2>
        </div>
        <div class="category-wrap text-white">
          <?php if(count($eventCategories) > 0): ?>
            <?php $__currentLoopData = $eventCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e(route('events', ['category' => $item->slug])); ?>" class="category-item">
                <img class="lazy" data-src="<?php echo e(asset('assets/admin/img/event-category/' . $item->image)); ?>"
                  alt="Category">
                <div class="category-content">
                  <h5><?php echo e($item->name); ?></h5>
                </div>
              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <h3 class="text-dark"><?php echo e(__('No Category Found')); ?></h3>
          <?php endif; ?>


        </div>
      </div>
    </section>
  <?php endif; ?>
  <!-- Category Section End -->

  <!-- About Section Start -->
  <?php if($secInfo->about_section_status == 1): ?>
    <section class="about-section pb-120 rpb-95">
      <div class="container">
        <?php if(is_null($aboutUsSection)): ?>
          <h2 class="text-center"><?php echo e(__('No data found for about section')); ?></h2>
        <?php endif; ?>
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="about-image-part pt-10 rmb-55">
              <?php if(!is_null($aboutUsSection)): ?>
                <img class="lazy" data-src="<?php echo e(asset('assets/admin/img/about-us-section/' . $aboutUsSection->image)); ?>"
                  alt="About">
              <?php endif; ?>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-content">
              <div class="section-title mb-30">
                <h2><?php echo e($aboutUsSection ? $aboutUsSection->title : ''); ?></h2>
              </div>
              <p><?php echo e($aboutUsSection ? $aboutUsSection->subtitle : ''); ?></p>
              <div>
                <?php echo $aboutUsSection ? $aboutUsSection->text : ''; ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <!-- About Section End -->


  <!-- Feature Section Start -->
  <section class="feature-section pt-110 rpt-90 bg-lighter">
    <?php if($secInfo->features_section_status == 1): ?>
      <div class="container pb-90 rpb-70">
        <div class="section-title text-center mb-55">
          <h2><?php echo e($featureEventSection ? $featureEventSection->title : ''); ?></h2>
          <p><?php echo e($featureEventSection ? $featureEventSection->text : ''); ?></p>
          <?php if(count($featureEventItems) < 1): ?>
            <h2><?php echo e(__('No data found for features section')); ?></h2>
          <?php endif; ?>
        </div>
        <div class="row justify-content-center">
          <?php $__currentLoopData = $featureEventItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-md-6">
              <div class="feature-item">
                <i class="<?php echo e($item->icon); ?>"></i>
                <div class="feature-content">
                  <h5><?php echo e($item->title); ?></h5>
                  <p><?php echo e($item->text); ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

      </div>
    <?php endif; ?>
    <?php if($secInfo->how_work_section_status == 1): ?>
      <?php if($howWork): ?>
        <div class="work-process text-center">
          <div class="container">
            <div class="work-process-inner pt-110 rpt-90 pb-80 rpb-60">

              <div class="section-title mb-60">
                <h2><?php echo e($howWork->title); ?></h2>
                <p><?php echo e($howWork->text); ?></p>
              </div>
              <div class="row justify-content-center">
                <?php $__currentLoopData = $howWorkItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-xl-3 col-md-6">
                    <div class="work-process-item">
                      <div class="icon">
                        <span class="number"><?php echo e($item->serial_number); ?></span>
                        <i class="<?php echo e($item->icon); ?>"></i>
                      </div>
                      <div class="content">
                        <h4><?php echo e($item->title); ?></h4>
                        <p><?php echo e($item->text); ?></p>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="work-process text-center">
          <div class="container">
            <h2><?php echo e(__('No Data Found for how work section')); ?></h2>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </section>
  <!-- Feature Section End -->


  <!-- Testimonial Section Start -->
  <?php if($secInfo->testimonials_section_status == 1): ?>
    <section class="testimonial-section pt-120 rpt-80">
      <div class="container">
        <div class="row pb-75 rpb-55">
          <div class="col-lg-4">
            <div class="testimonial-content pt-10 rmb-55">
              <div class="section-title mb-30">
                <h2><?php echo e($testimonialData ? $testimonialData->title : __('What say our client about us')); ?></h2>
              </div>
              <p><?php echo e($testimonialData ? $testimonialData->text : ''); ?></p>
              <div class="total-client-reviews mt-40 bg-lighter">
                <div class="review-images mb-30">
                  <?php if(!is_null($testimonialData)): ?>
                    <img class="lazy"
                      data-src="<?php echo e(asset('assets/admin/img/testimonial/' . $testimonialData->image)); ?>" alt="Reviewer">
                  <?php else: ?>
                    <img class="lazy" data-src="<?php echo e(asset('assets/admin/img/testimonial/clients.png')); ?>"
                      alt="Reviewer">
                  <?php endif; ?>
                  <span class="pluse"><i class="fas fa-plus"></i></span>
                </div>
                <h6><?php echo e($testimonialData ? $testimonialData->review_text : __('0 Clients Reviews')); ?></h6>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="testimonial-wrap">
              <?php if(count($testimonials) > 0): ?>
                <div class="row">
                  <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6">
                      <div class="testimonial-item">
                        <div class="author">
                          <img class="lazy" data-src="<?php echo e(asset('assets/admin/img/clients/' . $item->image)); ?>"
                            alt="Author">
                          <div class="content">
                            <h5><?php echo e($item->name); ?></h5>
                            <span><?php echo e($item->occupation); ?></span>
                            <div class="ratting">
                              <?php for($i = 1; $i <= $item->rating; $i++): ?>
                                <i class="fas fa-star"></i>
                              <?php endfor; ?>
                            </div>
                          </div>
                        </div>
                        <p><?php echo e($item->comment); ?></p>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              <?php else: ?>
                <h4 class="text-center"><?php echo e(__('No Review Found')); ?></h4>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <hr>
      </div>

    </section>
  <?php endif; ?>
  <!-- Testimonial Section End -->

  <!-- Client Logo Start -->
  <?php if($secInfo->partner_section_status == 1): ?>
    <section class="client-logo-area text-center pt-95 rpt-80 pb-90 rpb-70">
      <div class="container">
        <div class="section-title mb-55">
          <h2><?php echo e($partnerInfo ? $partnerInfo->title : __('Our Partner')); ?></h2>
          <p><?php echo e($partnerInfo ? $partnerInfo->text : ''); ?></p>
        </div>
        <div class="client-logo-wrap">
          <?php if(count($partners) > 0): ?>
            <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="client-logo-item">
                <a href="<?php echo e($item->url); ?>" target="_blank"><img class="lazy"
                    data-src="<?php echo e(asset('assets/admin/img/partner/' . $item->image)); ?>" alt="Client Logo"></a>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <h5><?php echo e(__('No Partner Found')); ?></h5>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <!-- Client Logo End -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/frontend/home/index-v1.blade.php ENDPATH**/ ?>
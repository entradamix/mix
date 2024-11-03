<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->event_page_title ?? __('Events')); ?>

  <?php else: ?>
    <?php echo e(__('Events')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php
  $metaKeywords = !empty($seo->meta_keyword_event) ? $seo->meta_keyword_event : '';
  $metaDescription = !empty($seo->meta_description_event) ? $seo->meta_description_event : '';
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
      <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
        data-bg="<?php echo e(asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
        <div class="container">
          <div class="banner-inner">
            <h2 class="page-title">
              <?php if(!empty($pageHeading)): ?>
                <?php echo e($pageHeading->event_page_title ?? __('Events')); ?>

              <?php else: ?>
                <?php echo e(__('Events')); ?>

              <?php endif; ?>
            </h2>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
                <li class="breadcrumb-item active">
                  <?php if(!empty($pageHeading)): ?>
                    <?php echo e($pageHeading->event_page_title ?? __('Events')); ?>

                  <?php else: ?>
                    <?php echo e(__('Events')); ?>

                  <?php endif; ?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </section>
      <!-- Page Banner End -->
        <div class="container">
          <div class="hero-content">
            <form id="event-search" class="event-search mt-35" name="event-search" action="<?php echo e(route('events')); ?>" method="get">
              <div class="search-item">
                <label for="borwseby"><i class="fas fa-list"></i></label>
                <select name="category" id="borwseby">
                  <option value=""><?php echo e(__('All Category')); ?></option>
                  <?php $__currentLoopData = $information['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="search-item">
                <label for="search"><i class="fas fa-search"></i></label>
                <input type="search" id="search" name="search-input" placeholder="<?php echo e(__('Search Anything')); ?>">
              </div>
              <button type="submit" class="theme-btn"><?php echo e(__('Search')); ?></button>
            </form>
          </div>
        </div>
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
                  <?php $__currentLoopData = $information['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="search-item">
                <label for="search"><i class="fas fa-search"></i></label>
                <input type="search" id="search" name="search-input" placeholder="<?php echo e(__('Search Anything')); ?>">
              </div>
              <button type="submit" class="theme-btn"><?php echo e(__('Search')); ?></button>
            </form>
          </div>
        </div>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
  <!-- Event Page Start -->
  <section class="event-page-section py-20 rpy-100">
    <div class="container container-custom">
      <div class="row">
        
        <div class="col-lg-12">
          <div class="event-page-content">
            <div class="row">
              <?php if(count($information['events']) > 0): ?>
                <?php $__currentLoopData = $information['events']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-sm-6 col-xl-4">
                    <div class="event-item">
                      <div class="event-image">
                        <a href="<?php echo e(route('event.details', [$event->slug, $event->id])); ?>">
                          <img class="lazy"
                            data-src="<?php echo e(asset('assets/admin/img/event/thumbnail/' . $event->thumbnail)); ?>"
                            alt="Event">
                        </a>
                      </div>
                      <div class="event-content">
                        <ul class="time-info" dir="ltr">
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
                            <span title="Event Duration">
                              <?php echo e($event->date_type == 'multiple' ? @$event_date->duration : $event->duration); ?>

                            </span>
                          </li>
                          <li>
                            <i class="far fa-clock"></i>
                            <span>
                              <?php
                                $start_time = strtotime($event->start_time);
                              ?>
                              <?php echo e(\Carbon\Carbon::parse($start_time)->timezone($websiteInfo->timezone)->translatedFormat('h:s A')); ?>

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
                            class="organizer"><?php echo e(__('By')); ?> <?php echo e($admin->username); ?></a>
                        <?php endif; ?>
                        <h5>
                          <a href="<?php echo e(route('event.details', [$event->slug, $event->id])); ?>">
                            <?php if(strlen($event->title) > 70): ?>
                              <?php echo e(mb_substr($event->title, 0, 70) . '...'); ?>

                            <?php else: ?>
                              <?php echo e($event->title); ?>

                            <?php endif; ?>
                          </a>
                        </h5>
                        <?php
                          $desc = strip_tags($event->description);
                        ?>

                        <?php if(strlen($desc) > 100): ?>
                          <p class="event-description"><?php echo e(mb_substr($desc, 0, 100) . '....'); ?>

                          </p>
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
                                <?php if($ticket->pricing_type != 'free'): ?>
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
                                            <?php echo e($ticket->price); ?>

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
                                  <span class="price">
                                    <?php echo e(__('Free')); ?>

                                    <strong><?php echo e($event_count > 1 ? '*' : ''); ?></strong>
                                  </span>
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
              <?php else: ?>
                <div class="col-lg-12">
                  <h3 class="text-center"><?php echo e(__('No Event Found')); ?></h3>
                </div>
              <?php endif; ?>
            </div>
            <ul class="pagination flex-wrap pt-10">
              <?php echo e($information['events']->links()); ?>

            </ul>
            <?php if(!empty(showAd(3))): ?>
              <div class="text-center mt-4">
                <?php echo showAd(3); ?>

              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Event Page End -->

  <form id="filtersForm" class="d-none" action="<?php echo e(route('events')); ?>" method="GET">
    <input type="hidden" id="category-id" name="category"
      value="<?php echo e(!empty(request()->input('category')) ? request()->input('category') : ''); ?>">

    <input type="hidden" id="event" name="event"
      value="<?php echo e(!empty(request()->input('event')) ? request()->input('event') : ''); ?>">

    <input type="hidden" id="min-id" name="min"
      value="<?php echo e(!empty(request()->input('min')) ? request()->input('min') : ''); ?>">

    <input type="hidden" id="max-id" name="max"
      value="<?php echo e(!empty(request()->input('max')) ? request()->input('max') : ''); ?>">

    <input type="hidden" name="search-input"
      value="<?php echo e(!empty(request()->input('search-input')) ? request()->input('search-input') : ''); ?>">
    <input type="hidden" name="location"
      value="<?php echo e(!empty(request()->input('location')) ? request()->input('location') : ''); ?>">

    <input type="hidden" id="dates-id" name="dates"
      value="<?php echo e(!empty(request()->input('dates')) ? request()->input('dates') : ''); ?>">

    <button type="submit" id="submitBtn"></button>
  </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
  <script type="text/javascript" src="<?php echo e(asset('assets/front/js/moment.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('assets/front/js/daterangepicker.min.js')); ?>"></script>

  <script>
    let min_price = <?php echo htmlspecialchars($information['min']); ?>;
    let max_price = <?php echo htmlspecialchars($information['max']); ?>;
    let symbol = "<?php echo htmlspecialchars($basicInfo->base_currency_symbol); ?>";
    let position = "<?php echo htmlspecialchars($basicInfo->base_currency_symbol_position); ?>";
    let curr_min = <?php echo !empty(request()->input('min')) ? htmlspecialchars(request()->input('min')) : 5; ?>;
    let curr_max = <?php echo !empty(request()->input('max')) ? htmlspecialchars(request()->input('max')) : 800; ?>;
  </script>

  <script src="<?php echo e(asset('assets/front/js/custom_script.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/event/event.blade.php ENDPATH**/ ?>
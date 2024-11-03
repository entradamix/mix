<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($content->title); ?>

<?php $__env->stopSection(); ?>

<?php
  $og_title = $content->title;
  $og_description = strip_tags($content->description);
  $og_image = asset('assets/admin/img/event/thumbnail/' . $content->thumbnail);
?>

<?php $__env->startSection('meta-keywords', "<?php echo e($content->meta_keywords); ?>"); ?>
<?php $__env->startSection('meta-description', "$content->meta_description"); ?>
<?php $__env->startSection('og-title', "$og_title"); ?>
<?php $__env->startSection('og-description', "$og_description"); ?>
<?php $__env->startSection('og-image', "$og_image"); ?>

<?php $__env->startSection('custom-style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/summernote-content.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('hero-section'); ?>
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
    data-bg="<?php echo e(asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title">
          <?php echo e(strlen($content->title) > 30 ? mb_substr($content->title, 0, 30, 'UTF-8') . '...' : $content->title); ?>

        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active">
              <?php if(!empty($pageHeading)): ?>
                <?php echo e($pageHeading->event_details_page_title ?? __('Event Details')); ?>

              <?php else: ?>
                <?php echo e(__('Event Details')); ?>

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
  <!-- Event Page Start -->
  <?php
    $map_address = preg_replace('/\s+/u', ' ', trim($content->address));
    $map_address = str_replace('/', ' ', $map_address);
    $map_address = str_replace('?', ' ', $map_address);
    $map_address = str_replace(',', ' ', $map_address);
  ?>
  <section class="event-details-section pt-110 rpt-90 pb-90 rpb-70">
    <div class="container">
      <div class="event-details-content">
        <div class="event-top d-flex flex-wrap-wrap has-gap">
          <?php
            if ($content->date_type == 'multiple') {
                $event_date = eventLatestDates($content->id);
                $date = strtotime(@$event_date->start_date);
            } else {
                $date = strtotime($content->start_date);
            }
          ?>
          <?php if($content->date_type != 'multiple'): ?>
            <div class="event-top-date">
              <div class="event-month">
                <?php echo e(\Carbon\Carbon::parse($date)->timezone($websiteInfo->timezone)->translatedFormat('M')); ?></div>
              <div class="event-date">
                <?php echo e(\Carbon\Carbon::parse($date)->timezone($websiteInfo->timezone)->translatedFormat('d')); ?></div>
            </div>
          <?php endif; ?>
          <div class="event-bottom-content">
            <?php
              if ($content->date_type == 'multiple') {
                  $event_date = eventLatestDates($content->id);
                  $startDateTime = @$event_date->start_date_time;
                  $endDateTime = @$event_date->end_date_time;
                  //for multiple get last end date
                  $last_end_date = eventLastEndDates($content->id);
                  $last_end_date = $last_end_date->end_date_time;

                  $now_time = \Carbon\Carbon::now()
                      ->timezone($websiteInfo->timezone)
                      ->translatedFormat('Y-m-d H:i:s');
              } else {
                  $now_time = \Carbon\Carbon::now()
                      ->timezone($websiteInfo->timezone)
                      ->translatedFormat('Y-m-d H:i:s');
                  $startDateTime = $content->start_date . ' ' . $content->start_time;
                  $endDateTime = $content->end_date . ' ' . $content->end_time;
              }
              $over = false;

            ?>
            <?php if($content->date_type == 'single' && $content->countdown_status == 1): ?>
              <div class="event-details-top">
                <?php if($startDateTime >= $now_time): ?>
                  <h2 class="title"><?php echo e($content->title); ?> <span class="badge badge-info"><?php echo e(__('Upcoming')); ?></span>
                  </h2>
                <?php elseif($startDateTime <= $endDateTime && $endDateTime >= $now_time): ?>
                  <h2 class="title">
                    <?php echo e($content->title); ?>

                    <span class="badge badge-success"><?php echo e(__('Running')); ?></span>
                  </h2>
                <?php else: ?>
                  <?php
                    $over = true;
                  ?>
                  <h2 class="title">
                    <?php echo e($content->title); ?>

                    <span class="badge badge-danger"><?php echo e(__('Over')); ?></span>
                  </h2>
                <?php endif; ?>
              </div>
            <?php elseif($content->date_type == 'multiple'): ?>
              <div class="event-details-top">
                <h2 class="title"><?php echo e($content->title); ?>

                  <?php if($startDateTime >= $now_time): ?>
                    <span class="badge badge-info"><?php echo e(__('Upcoming')); ?></span>
                  <?php elseif($startDateTime <= $last_end_date && $last_end_date >= $now_time): ?>
                    <span class="badge badge-success"><?php echo e(__('Running')); ?></span>
                  <?php else: ?>
                    <?php
                      $over = true;
                    ?>
                    <span class="badge badge-danger"><?php echo e(__('Over')); ?></span>
                  <?php endif; ?>
                </h2>
              </div>
            <?php else: ?>
              <div class="event-details-top">
                <h2 class="title"><?php echo e($content->title); ?></h2>
              </div>

            <?php endif; ?>

            <div class="event-details-header mb-25">
              <ul>
                <li><i class="far fa-calendar-alt"></i>
                  <?php echo e(\Carbon\Carbon::parse($date)->timezone($websiteInfo->timezone)->translatedFormat('D, dS M Y')); ?>

                </li>

                <li><i class="far fa-clock"></i>
                  <?php echo e($content->date_type == 'multiple' ? @$event_date->duration : $content->duration); ?>

                </li>
                <?php if($content->event_type == 'venue'): ?>
                  <li><i class="fas fa-map-marker-alt"></i>
                    <?php if($content->city != null): ?>
                      <?php echo e($content->city); ?>

                    <?php endif; ?>
                    <?php if($content->state): ?>
                      , <?php echo e($content->state); ?>

                    <?php endif; ?>
                    <?php if($content->country): ?>
                      , <?php echo e($content->country); ?>

                    <?php endif; ?>
                  </li>
                <?php else: ?>
                  <li><i class="fas fa-map-marker-alt"></i> <?php echo e(__('Online')); ?></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="event-details-image mb-50">
          <div class="event-details-images">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e(asset('assets/admin/img/event-gallery/' . $item->image)); ?>"><img class="lazy"
                  data-src="<?php echo e(asset('assets/admin/img/event-gallery/' . $item->image)); ?>" alt="Event Details"></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <div class="buttons">
            <?php if(Auth::guard('customer')->check()): ?>
              <?php
                $customer_id = Auth::guard('customer')->user()->id;
                $event_id = $content->id;
                $checkWishList = checkWishList($event_id, $customer_id);
              ?>
            <?php else: ?>
              <?php
                $checkWishList = false;
              ?>
            <?php endif; ?>
            <?php if($content->event_type != 'online'): ?>
              <a href="javascript:void(0)" data-toggle="modal" data-target=".bd-example-modal-lg">
                <i class="fas fa-map-marker-alt m-0"></i>
              </a>
            <?php endif; ?>
            <a href="<?php echo e($checkWishList == false ? route('addto.wishlist', $content->id) : route('remove.wishlist', $content->id)); ?>"
              class="<?php echo e($checkWishList == true ? 'text-success' : ''); ?>"><i class="fas fa-bookmark"></i></a>
            <a href="javascript:void(0)" data-toggle="modal" data-target=".share-event">
              <i class="fas fa-share-alt"></i></a>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-7">
            <div class="event-details-content-inner">
              <div class="event-info d-flex align-items-center mb-1">
                <span>
                  <a href="<?php echo e(route('events', ['category' => $content->slug])); ?>"><?php echo e($content->name); ?></a>
                </span>
              </div>
              <?php if(Session::has('paypal_error')): ?>
                <div class="alert alert-danger"><?php echo e(Session::get('paypal_error')); ?></div>
              <?php endif; ?>
              <?php
                Session::put('paypal_error', null);
              ?>
              <h3 class="inner-title mb-25"><?php echo e(__('Description')); ?></h3>

              <div class="summernote-content">
                <?php echo $content->description; ?>

              </div>

              <?php if($content->event_type != 'online'): ?>
                <h3 class="inner-title mb-30"><?php echo e(__('Map')); ?></h3>
                <div class="our-location mb-50">
                  <iframe
                    src="//maps.google.com/maps?width=100%25&amp;height=385&amp;hl=en&amp;q=<?php echo e($map_address); ?>&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                    height="385" class="map-h" allowfullscreen="" loading="lazy"></iframe>
                </div>
              <?php endif; ?>

              <?php if(!empty($content->refund_policy)): ?>
                <h3><?php echo e(__('Return Policy')); ?></h3>
                <p><?php echo e(@$content->refund_policy); ?></p>
              <?php endif; ?>

            </div>
          </div>
          <div class="col-lg-5">
            <div class="sidebar-sticky">
              <form action="<?php echo e(route('check-out2')); ?>" method="post"
                <?php if($over == true): ?> onsubmit="return false" <?php endif; ?>>
                <?php echo csrf_field(); ?>
                <input type="hidden" name="event_id" value="<?php echo e($content->id); ?>" id="">
                <input type="hidden" name="pricing_type" value="<?php echo e($content->pricing_type); ?>" id="">
                <div class="event-details-information">
                  <input type="hidden" name="date_type" value="<?php echo e($content->date_type); ?>">
                  <?php if($content->date_type == 'multiple'): ?>
                    <?php
                      $dates = eventDates($content->id);
                      $exp_dates = eventExpDates($content->id);
                    ?>

                    <div class="form-group">
                      <label for=""><?php echo e(__('Select Date')); ?></label>
                      <select name="event_date" id="" class="form-control">
                        <?php if(count($dates) > 0): ?>
                          <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e(FullDateTime($date->start_date_time)); ?>">
                              <?php echo e(FullDateTime($date->start_date_time)); ?>

                              (<?php echo e(timeZoneOffset($websiteInfo->timezone)); ?>

                              <?php echo e(__('GMT')); ?>)
                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(count($exp_dates) > 0): ?>
                          <?php $__currentLoopData = $exp_dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp_date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option disabled value="">
                              <?php echo e(FullDateTime($exp_date->start_date_time)); ?>

                              (<?php echo e(timeZoneOffset($websiteInfo->timezone)); ?>

                              <?php echo e(__('GMT')); ?>)
                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </select>
                      <?php $__errorArgs = ['event_date'];
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
                  <?php else: ?>
                    <input type="hidden" name="event_date"
                      value="<?php echo e(FullDateTime($content->start_date . $content->start_time)); ?>">
                  <?php endif; ?>

                  
                  <?php if($content->date_type == 'single' && $content->countdown_status == 1): ?>
                    <div class="event-details-top">
                      <?php if($startDateTime >= $now_time): ?>
                        <b><?php echo e(__('Event Starts In')); ?></b>
                        <hr>
                        <?php
                          $dt = Carbon\Carbon::parse($startDateTime);
                          $year = $dt->year;
                          $month = $dt->month;
                          $day = $dt->day;
                          $end_time = Carbon\Carbon::parse($startDateTime);
                          $hour = $end_time->hour;
                          $minute = $end_time->minute;
                          $now = str_replace('+00:00', '.000' . timeZoneOffset($websiteInfo->timezone) . '00:00', gmdate('c'));
                        ?>
                        <div class="count-down mb-3" dir="ltr">
                          <div class="event-countdown" data-now="<?php echo e($now); ?>" data-year="<?php echo e($year); ?>"
                            data-month="<?php echo e($month); ?>" data-day="<?php echo e($day); ?>"
                            data-hour="<?php echo e($hour); ?>" data-minute="<?php echo e($minute); ?>"
                            data-timezone="<?php echo e(timeZoneOffset($websiteInfo->timezone)); ?>">
                          </div>
                        </div>
                      <?php elseif($startDateTime <= $endDateTime && $endDateTime >= $now_time): ?>
                        <p><?php echo e(__('The Event is Running')); ?></p>
                      <?php else: ?>
                        <p><?php echo e(__('The Event is Over')); ?></p>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                  
                  <b><?php echo e(__('Organised By')); ?></b>
                  <hr>
                  <?php if($organizer == ''): ?>
                    <?php
                      $admin = App\Models\Admin::first();
                    ?>
                    <div class="author">
                      <a
                        href="<?php echo e(route('frontend.organizer.details', [$admin->id, str_replace(' ', '-', $admin->username), 'admin' => 'true'])); ?>"><img
                          class="lazy" data-src="<?php echo e(asset('assets/admin/img/admins/' . $admin->image)); ?>"
                          alt="Author"></a>
                      <div class="content">
                        <h6><a
                            href="<?php echo e(route('frontend.organizer.details', [$admin->id, str_replace(' ', '-', $admin->username), 'admin' => 'true'])); ?>"><?php echo e($admin->username); ?></a>
                        </h6>
                      </div>
                    </div>
                  <?php else: ?>
                    <div class="author">
                      <a
                        href="<?php echo e(route('frontend.organizer.details', [$organizer->id, str_replace(' ', '-', $organizer->username)])); ?>">
                        <?php if($organizer->photo != null): ?>
                          <img class="lazy"
                            data-src="<?php echo e(asset('assets/admin/img/organizer-photo/' . $organizer->photo)); ?>"
                            alt="Author">
                        <?php else: ?>
                          <img class="lazy" data-src="<?php echo e(asset('assets/front/images/user.png')); ?>" alt="Author">
                        <?php endif; ?>

                      </a>

                      <div class="content">
                        <h6><a
                            href="<?php echo e(route('frontend.organizer.details', [$organizer->id, str_replace(' ', '-', $organizer->username)])); ?>"><?php echo e($organizer->username); ?></a>
                        </h6>
                        <a
                          href="<?php echo e(route('frontend.organizer.details', [$organizer->id, str_replace(' ', '-', $organizer->username)])); ?>"><?php echo e(__('View  Profile')); ?></a>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if($content->address != null): ?>
                    <b><i class="fas fa-map-marker-alt"></i> <?php echo e($content->address); ?></b>
                    <hr>
                  <?php endif; ?>

                  
                  <?php
                    $start_date = str_replace('-', '', $content->start_date);
                    $start_time = str_replace(':', '', $content->start_time);
                    $end_date = str_replace('-', '', $content->end_date);
                    $end_time = str_replace(':', '', $content->end_time);
                  ?>
                  <div class="dropdown show pt-4 pb-4">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-calendar-alt"></i> <?php echo e(__('Add to Calendar')); ?>

                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a target="_blank" class="dropdown-item"
                        href="//calendar.google.com/calendar/u/0/r/eventedit?text=<?php echo e($content->title); ?>&dates=<?php echo e($start_date); ?>T<?php echo e($start_time); ?>/<?php echo e($end_date); ?>T<?php echo e($end_time); ?>&ctz=<?php echo e($websiteInfo->timezone); ?>&details=For+details,+click+here:+<?php echo e(route('event.details', [$content->eventSlug, $content->id])); ?>&location=<?php echo e($content->event_type == 'online' ? 'Online' : $content->address); ?>&sf=true"><?php echo e(__('Google Calendar')); ?></a>
                      <a target="_blank" class="dropdown-item"
                        href="//calendar.yahoo.com/?v=60&view=d&type=20&TITLE=<?php echo e($content->title); ?>&ST=<?php echo e($start_date); ?>T<?php echo e($start_time); ?>&ET=<?php echo e($end_date); ?>T<?php echo e($end_time); ?>&DUR=9959&DESC=For%20details%2C%20click%20here%3A%20<?php echo e(route('event.details', [$content->eventSlug, $content->id])); ?>&in_loc=<?php echo e($content->event_type == 'online' ? 'Online' : $content->address); ?>"><?php echo e(__('Yahoo')); ?></a>
                    </div>
                  </div>


                  <?php if($content->event_type == 'online' && $content->pricing_type == 'normal'): ?>

                    <?php
                      $ticket = App\Models\Event\Ticket::where('event_id', $content->id)->first();
                      $event_count = App\Models\Event\Ticket::where('event_id', $content->id)
                          ->get()
                          ->count();
                      if ($ticket->ticket_available_type == 'limited') {
                          $stock = $ticket->ticket_available;
                      } else {
                          $stock = 'unlimited';
                      }
                      //ticket purchase or not check
                      if (Auth::guard('customer')->user() && $ticket->max_ticket_buy_type == 'limited') {
                          $purchase = isTicketPurchaseOnline($ticket->event_id, $ticket->max_buy_ticket);
                      } else {
                          $purchase = ['status' => 'false', 'p_qty' => 0];
                      }
                    ?>
                    <?php if($ticket): ?>

                      <b><?php echo e(__('Select Tickets')); ?></b>
                      <hr>
                      <div class="price-count">
                        <h6 dir="ltr">

                          <?php if($ticket->early_bird_discount == 'enable'): ?>
                            <?php
                              $discount_date = Carbon\Carbon::parse($ticket->early_bird_discount_date . $ticket->early_bird_discount_time);
                            ?>

                            <?php if($ticket->early_bird_discount_type == 'fixed' && !$discount_date->isPast()): ?>
                              <?php
                                $calculate_price = $ticket->price - $ticket->early_bird_discount_amount;
                              ?>
                              <?php echo e(symbolPrice($calculate_price)); ?>

                              <del>
                                <?php echo e(symbolPrice($ticket->price)); ?>

                              </del>
                            <?php elseif($ticket->early_bird_discount_type == 'percentage' && !$discount_date->isPast()): ?>
                              <?php
                                $c_price = ($ticket->price * $ticket->early_bird_discount_amount) / 100;
                                $calculate_price = $ticket->price - $c_price;
                              ?>
                              <?php echo e(symbolPrice($calculate_price)); ?>

                              <del>
                                <?php echo e(symbolPrice($ticket->price)); ?>

                              </del>
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


                        </h6>
                        <div class="quantity-input">
                          <button class="quantity-down" type="button" id="quantityDown">
                            -
                          </button>
                          <input class="quantity" type="number" readonly value="0"
                            data-price="<?php echo e($calculate_price); ?>" data-max_buy_ticket="<?php echo e($ticket->max_buy_ticket); ?>"
                            name="quantity" data-ticket_id="<?php echo e($ticket->id); ?>" data-stock="<?php echo e($stock); ?>"
                            data-purchase="<?php echo e($purchase['status']); ?>" data-p_qty="<?php echo e($purchase['p_qty']); ?>">
                          <button class="quantity-up" type="button" id="quantityUP">
                            +
                          </button>
                        </div>



                        <?php if($ticket->early_bird_discount == 'enable'): ?>
                          <?php
                            $discount_date = Carbon\Carbon::parse($ticket->early_bird_discount_date . $ticket->early_bird_discount_time);
                          ?>
                          <?php if(!$discount_date->isPast()): ?>
                            <p><?php echo e(__('Discount available') . ' '); ?> :
                              (<?php echo e(__('till') . ' '); ?> :
                              <span
                                dir="ltr"><?php echo e(\Carbon\Carbon::parse($discount_date)->timezone($websiteInfo->timezone)->translatedFormat('Y/m/d h:i a')); ?></span>)
                            </p>
                          <?php endif; ?>
                        <?php endif; ?>


                      </div>
                      <p
                        class="text-warning max_error_<?php echo e($ticket->id); ?><?php echo e($ticket->max_ticket_buy_type == 'limited' ? $ticket->max_buy_ticket : ''); ?> ">
                      </p>

                    <?php endif; ?>
                  <?php elseif($content->event_type == 'online' && $content->pricing_type == 'free'): ?>
                    <b><?php echo e(__('Select Tickets')); ?></b>
                    <hr>
                    <?php
                      $ticket = App\Models\Event\Ticket::where('event_id', $content->id)->first();
                      $event_count = App\Models\Event\Ticket::where('event_id', $content->id)
                          ->get()
                          ->count();

                      if ($ticket->ticket_available_type == 'limited') {
                          $stock = $ticket->ticket_available;
                      } else {
                          $stock = 'unlimited';
                      }

                      //ticket purchase or not check
                      if (Auth::guard('customer')->user() && $ticket->max_ticket_buy_type == 'limited') {
                          $purchase = isTicketPurchaseOnline($ticket->event_id, $ticket->max_buy_ticket);
                          $max_buy_ticket = $ticket->max_buy_ticket;
                      } else {
                          $purchase = ['status' => 'false', 'p_qty' => 0];
                          $max_buy_ticket = 999999;
                      }
                    ?>
                    <div class="price-count">
                      <h6>
                        <?php echo e(__('Free')); ?>

                      </h6>
                      <div class="quantity-input">
                        <button class="quantity-down" type="button" id="quantityDown">
                          -
                        </button>
                        <input class="quantity" readonly type="number" value="0"
                          data-price="<?php echo e($content->price); ?>" data-max_buy_ticket="<?php echo e($max_buy_ticket); ?>"
                          name="quantity" data-ticket_id="<?php echo e($ticket->id); ?>" data-stock="<?php echo e($stock); ?>"
                          data-purchase="<?php echo e($purchase['status']); ?>" data-p_qty="<?php echo e($purchase['p_qty']); ?>">
                        <button class="quantity-up" type="button" id="quantityUP">
                          +
                        </button>
                      </div>

                    </div>
                    <p
                      class="text-warning max_error_<?php echo e($ticket->id); ?><?php echo e($ticket->max_ticket_buy_type == 'limited' ? $ticket->max_buy_ticket : ''); ?> ">
                    </p>
                  <?php elseif($content->event_type == 'venue'): ?>
                    <?php
                      $tickets = DB::table('tickets')
                          ->where('event_id', $content->id)
                          ->get();
                    ?>
                    <?php if(count($tickets) > 0): ?>
                      <b><?php echo e(__('Select Tickets')); ?></b>
                      <hr>
                      <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($ticket->pricing_type == 'normal'): ?>
                          <?php
                            if ($ticket->ticket_available_type == 'limited') {
                                $stock = $ticket->ticket_available;
                            } else {
                                $stock = 'unlimited';
                            }

                            //ticket purchase or not check
                            $ticket_content = App\Models\Event\TicketContent::where([['language_id', $currentLanguageInfo->id], ['ticket_id', $ticket->id]])->first();

                            if (Auth::guard('customer')->user() && $ticket->max_ticket_buy_type == 'limited') {
                                $purchase = isTicketPurchaseVenue($ticket->event_id, $ticket->max_buy_ticket, $ticket->id, @$ticket_content->title);
                            } else {
                                $purchase = ['status' => 'false', 'p_qty' => 0];
                            }

                          ?>
                          <p class="mb-0"><strong><?php echo e(@$ticket_content->title); ?></strong></p>
                          <div class="click-show">
                            <div class="show-content">
                              <?php echo @$ticket_content->description; ?>

                            </div>
                            <?php if(strlen(@$ticket_content->description) > 50): ?>
                              <div class="read-more-btn">
                                <span><?php echo e(__('Read more')); ?></span>
                                <span><?php echo e(__('Read less')); ?></span>
                              </div>
                            <?php endif; ?>
                          </div>
                          <div class="price-count">
                            <h6 dir="ltr">
                              <?php if($ticket->early_bird_discount == 'enable'): ?>
                                <?php
                                  $discount_date = Carbon\Carbon::parse($ticket->early_bird_discount_date . $ticket->early_bird_discount_time);
                                ?>

                                <?php if($ticket->early_bird_discount_type == 'fixed' && !$discount_date->isPast()): ?>
                                  <?php
                                    $calculate_price = $ticket->price - $ticket->early_bird_discount_amount;
                                  ?>
                                  <?php echo e(symbolPrice($calculate_price)); ?>

                                  <del>

                                    <?php echo e(symbolPrice($ticket->price)); ?>

                                  </del>
                                <?php elseif($ticket->early_bird_discount_type == 'percentage' && !$discount_date->isPast()): ?>
                                  <?php
                                    $c_price = ($ticket->price * $ticket->early_bird_discount_amount) / 100;
                                    $calculate_price = $ticket->price - $c_price;
                                  ?>
                                  <?php echo e(symbolPrice($calculate_price)); ?>


                                  <del>
                                    <?php echo e(symbolPrice($ticket->price)); ?>

                                  </del>
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


                            </h6>
                            <div class="quantity-input">
                              <button class="quantity-down" type="button" id="quantityDown">
                                -
                              </button>
                              <input class="quantity" readonly type="number" value="0"
                                data-price="<?php echo e($calculate_price); ?>"
                                data-max_buy_ticket="<?php echo e($ticket->max_buy_ticket); ?>" name="quantity[]"
                                data-ticket_id="<?php echo e($ticket->id); ?>" data-stock="<?php echo e($stock); ?>"
                                data-purchase="<?php echo e($purchase['status']); ?>" data-p_qty="<?php echo e($purchase['p_qty']); ?>">
                              <button class="quantity-up" type="button" id="quantityUP">
                                +
                              </button>
                            </div>


                            <?php if($ticket->early_bird_discount == 'enable'): ?>
                              <?php
                                $discount_date = Carbon\Carbon::parse($ticket->early_bird_discount_date . $ticket->early_bird_discount_time);
                              ?>
                              <?php if(!$discount_date->isPast()): ?>
                                <p><?php echo e(__('Discount available') . ' '); ?> :
                                  (<?php echo e(__('till') . ' '); ?> :
                                  <span
                                    dir="ltr"><?php echo e(\Carbon\Carbon::parse($discount_date)->timezone($websiteInfo->timezone)->translatedFormat('Y/m/d h:i a')); ?></span>)
                                </p>
                              <?php endif; ?>
                            <?php endif; ?>

                          </div>
                          <p
                            class="text-warning max_error_<?php echo e($ticket->id); ?><?php echo e($ticket->max_ticket_buy_type == 'limited' ? $ticket->max_buy_ticket : ''); ?> ">
                          </p>
                        <?php elseif($ticket->pricing_type == 'variation'): ?>
                          <?php
                            $variations = json_decode($ticket->variations);

                            $varition_names = App\Models\Event\VariationContent::where([['ticket_id', $ticket->id], ['language_id', $currentLanguageInfo->id]])->get();
                            if (empty($varition_names)) {
                                $varition_names = App\Models\Event\VariationContent::where('ticket_id', $ticket->id)->get();
                            }

                            $de_lang = App\Models\Language::where('is_default', 1)->first();
                            $de_varition_names = App\Models\Event\VariationContent::where([['ticket_id', $ticket->id], ['language_id', $de_lang->id]])->get();
                            if (empty($de_varition_names)) {
                                $de_varition_names = App\Models\Event\VariationContent::where([['ticket_id', $ticket->id]])->get();
                            }
                          ?>
                          <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                              //ticket purchase or not check
                              if (Auth::guard('customer')->user()) {
                                  if (count($de_varition_names) > 0) {
                                      $purchase = isTicketPurchaseVenue($ticket->event_id, $item->v_max_ticket_buy, $ticket->id, $de_varition_names[$key]['name']);
                                  }
                              } else {
                                  $purchase = ['status' => 'false', 'p_qty' => 0];
                              }
                              $ticket_content = App\Models\Event\TicketContent::where([['language_id', $currentLanguageInfo->id], ['ticket_id', $ticket->id]])->first();
                              if (empty($ticket_content)) {
                                  $ticket_content = App\Models\Event\TicketContent::where([['ticket_id', $ticket->id]])->first();
                              }
                            ?>
                            <p class="mb-0"><strong><?php echo e(@$ticket_content->title); ?> -
                                <?php echo e(@$varition_names[$key]['name']); ?></strong>
                            </p>
                            <div class="click-show">
                              <div class="show-content">
                                <?php echo @$ticket_content->description; ?>

                              </div>
                              <?php if(strlen(@$ticket_content->description) > 50): ?>
                                <div class="read-more-btn">
                                  <span><?php echo e(__('Read more')); ?></span>
                                  <span><?php echo e(__('Read less')); ?></span>
                                </div>
                              <?php endif; ?>
                            </div>
                            <div class="price-count">
                              <h6 dir="ltr">
                                <?php if($ticket->early_bird_discount == 'enable'): ?>
                                  <?php
                                    $discount_date = Carbon\Carbon::parse($ticket->early_bird_discount_date . $ticket->early_bird_discount_time);
                                  ?>
                                  <?php if($ticket->early_bird_discount_type == 'fixed' && !$discount_date->isPast()): ?>
                                    <?php
                                      $calculate_price = $item->price - $ticket->early_bird_discount_amount;
                                    ?>
                                    <?php echo e(symbolPrice($calculate_price)); ?>


                                    <del>
                                      <?php echo e(symbolPrice($item->price)); ?>

                                    </del>
                                  <?php elseif($ticket->early_bird_discount_type == 'percentage' && !$discount_date->isPast()): ?>
                                    <?php
                                      $c_price = ($item->price * $ticket->early_bird_discount_amount) / 100;
                                      $calculate_price = $item->price - $c_price;
                                    ?>
                                    <?php echo e(symbolPrice($calculate_price)); ?>


                                    <del>
                                      <?php echo e(symbolPrice($item->price)); ?>

                                    </del>
                                  <?php else: ?>
                                    <?php
                                      $calculate_price = $item->price;
                                    ?>
                                    <?php echo e(symbolPrice($calculate_price)); ?>

                                  <?php endif; ?>
                                <?php else: ?>
                                  <?php
                                    $calculate_price = $item->price;
                                  ?>
                                  <?php echo e(symbolPrice($calculate_price)); ?>

                                <?php endif; ?>

                              </h6>

                              <div class="quantity-input">
                                <button class="quantity-down_variation" type="button" id="quantityDown">
                                  -
                                </button>
                                <input type="hidden" name="v_name[]" value="<?php echo e($item->name); ?>">
                                <?php
                                  if ($item->ticket_available_type == 'limited') {
                                      $stock = $item->ticket_available;
                                  } else {
                                      $stock = 'unlimited';
                                  }
                                  if ($item->max_ticket_buy_type == 'limited') {
                                      $max_buy = $item->v_max_ticket_buy;
                                  } else {
                                      $max_buy = 'unlimited';
                                  }
                                ?>
                                <input type="number" value="0" class="quantity"
                                  data-price="<?php echo e($calculate_price); ?>" data-max_buy_ticket="<?php echo e($max_buy); ?>"
                                  data-name="<?php echo e($item->name); ?>" name="quantity[]"
                                  data-ticket_id="<?php echo e($ticket->id); ?>" readonly data-stock="<?php echo e($stock); ?>"
                                  data-purchase="<?php echo e($purchase['status']); ?>" data-p_qty="<?php echo e($purchase['p_qty']); ?>">
                                <button class="quantity-up" type="button" id="quantityUP">
                                  +
                                </button>
                              </div>
                              <?php if($ticket->early_bird_discount == 'enable'): ?>
                                <?php
                                  $discount_date = Carbon\Carbon::parse($ticket->early_bird_discount_date . $ticket->early_bird_discount_time);
                                ?>
                                <?php if(!$discount_date->isPast()): ?>
                                  <p><?php echo e(__('Discount available') . ' '); ?> :
                                    (<?php echo e(__('till') . ' '); ?> :
                                    <span
                                      dir="ltr"><?php echo e(\Carbon\Carbon::parse($discount_date)->timezone($websiteInfo->timezone)->translatedFormat('Y/m/d h:i a')); ?></span>)
                                  </p>
                                <?php endif; ?>
                              <?php endif; ?>
                            </div>
                            <p class="text-warning max_error_<?php echo e($ticket->id); ?><?php echo e($item->v_max_ticket_buy); ?> ">
                            </p>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php elseif($ticket->pricing_type == 'free'): ?>
                          <?php
                            if ($ticket->ticket_available_type == 'limited') {
                                $stock = $ticket->ticket_available;
                            } else {
                                $stock = 'unlimited';
                            }

                            //ticket purchase or not check
                            $de_lang = App\Models\Language::where('is_default', 1)->first();
                            $ticket_content_default = App\Models\Event\TicketContent::where([['language_id', $de_lang->id], ['ticket_id', $ticket->id]])->first();
                            if (Auth::guard('customer')->user() && $ticket->max_ticket_buy_type == 'limited') {
                                $purchase = isTicketPurchaseVenue($ticket->event_id, $ticket->max_buy_ticket, $ticket->id, @$ticket_content_default->title);
                            } else {
                                $purchase = ['status' => 'false', 'p_qty' => 1];
                            }
                            $ticket_content = App\Models\Event\TicketContent::where([['language_id', $currentLanguageInfo->id], ['ticket_id', $ticket->id]])->first();
                          ?>
                          <p class="mb-0"><strong><?php echo e(@$ticket_content->title); ?></strong></p>
                          <div class="click-show">
                            <div class="show-content">
                              <?php echo @$ticket_content->description; ?>

                            </div>
                            <?php if(strlen(@$ticket_content->description) > 50): ?>
                              <div class="read-more-btn">
                                <span><?php echo e(__('Read more')); ?></span>
                                <span><?php echo e(__('Read less')); ?></span>
                              </div>
                            <?php endif; ?>
                          </div>
                          <div class="price-count">
                            <h6>
                              <span class=""><?php echo e(__('free')); ?></span>
                            </h6>
                            <div class="quantity-input">
                              <button class="quantity-down" type="button" id="quantityDown">
                                -
                              </button>
                              <input class="quantity" data-max_buy_ticket="<?php echo e($ticket->max_buy_ticket); ?>"
                                type="number" value="0" data-price="<?php echo e($ticket->price); ?>" name="quantity[]"
                                data-ticket_id="<?php echo e($ticket->id); ?>" readonly data-stock="<?php echo e($stock); ?>"
                                data-purchase="<?php echo e($purchase['status']); ?>" data-p_qty="<?php echo e($purchase['p_qty']); ?>">
                              <button class="quantity-up" type="button" id="quantityUP">
                                +
                              </button>
                            </div>
                          </div>
                          <p
                            class="text-warning max_error_<?php echo e($ticket->id); ?><?php echo e($ticket->max_ticket_buy_type == 'limited' ? $ticket->max_buy_ticket : ''); ?> ">
                          </p>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if($tickets_count > 0): ?>
                    <div class="total">
                      <b><?php echo e(__('Total Price') . ' :'); ?> </b>
                      <span class="h4" dir="ltr">
                        <span><?php echo e($basicInfo->base_currency_symbol_position == 'left' ? $basicInfo->base_currency_symbol : ''); ?></span>
                        <span id="total_price">0</span>
                        <span><?php echo e($basicInfo->base_currency_symbol_position == 'right' ? $basicInfo->base_currency_symbol : ''); ?></span>

                      </span>
                      <input type="hidden" name="total" id="total">
                    </div>
                    <button class="theme-btn w-100 mt-20" type="submit"><?php echo e(__('Book Now')); ?></button>
                  <?php endif; ?>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php if(!empty(showAd(3))): ?>
          <div class="text-center mt-4">
            <?php echo showAd(3); ?>

          </div>
        <?php endif; ?>
      </div>
      <?php if(count($related_events) > 0): ?>
        <hr>
        <div class="releted-event-header mt-50">
          <h3><?php echo e(__('Related Events')); ?></h3>
          <div class="slick-next-prev mb-10">
            <button class="prev"><i class="fas fa-chevron-left"></i></button>
            <button class="next"><i class="fas fa-chevron-right"></i></button>
          </div>
        </div>
        <div class="related-event-wrap">
          <?php $__currentLoopData = $related_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="event-item">
              <div class="event-image">
                <a href="<?php echo e(route('event.details', [$event->slug, $event->id])); ?>">
                  <img class="lazy" data-src="<?php echo e(asset('assets/admin/img/event/thumbnail/' . $event->thumbnail)); ?>"
                    alt="Event">
                </a>
              </div>
              <div class="event-content">
                <ul class="time-info">
                  <li>
                    <i class="far fa-calendar-alt"></i>
                    <span>
                      <?php
                        $date = strtotime($event->start_date);
                      ?>
                      <?php echo e(\Carbon\Carbon::parse($date)->timezone($websiteInfo->timezone)->translatedFormat('d M')); ?>

                    </span>
                  </li>
                  <?php
                    if ($event->date_type == 'multiple') {
                        $event_date = eventLatestDates($event->id);
                        $date = strtotime(@$event_date->start_date);
                    } else {
                        $date = strtotime($event->start_date);
                    }
                  ?>
                  <li>
                    <i class="far fa-hourglass"></i>
                    <span
                      title="Event Duration"><?php echo e($event->date_type == 'multiple' ? @$event_date->duration : $event->duration); ?></span>
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

                <?php if(strlen($desc) > 45): ?>
                  <p><?php echo e(mb_substr($desc, 0, 50) . '....'); ?></p>
                <?php else: ?>
                  <p><?php echo e($desc); ?></p>
                <?php endif; ?>
                <?php
                  $ticket = DB::table('tickets')
                      ->where('event_id', $event->id)
                      ->first();
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
                              $price = $variation[0]['price'];
                            ?>
                            <span class="price">

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
                              <strong><?php echo e($event_count > 1 ? '*' : ''); ?></strong>
                            </span>
                          </span>
                        <?php elseif($ticket->pricing_type == 'normal'): ?>
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
                            <strong><?php echo e($event_count > 1 ? '*' : ''); ?></strong>
                          </span>
                        <?php else: ?>
                          <span class="price"><?php echo e(__('Free')); ?></span>
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
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

      <?php endif; ?>
    </div>
  </section>
  <!-- Event Page End -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
  <?php if ($__env->exists('frontend.partials.modals')) echo $__env->make('frontend.partials.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/frontend/event/event-details.blade.php ENDPATH**/ ?>
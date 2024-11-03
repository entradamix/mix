<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($admin == true ? $organizer->username : $organizer->username); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', "<?php echo e($organizer->username); ?>"); ?>
<?php $__env->startSection('meta-description', "$organizer->details"); ?>

<?php $__env->startSection('hero-section'); ?>
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy" data-bg="<?php echo e($organizer->cover != null ? asset('assets/admin/img/organizer-cover/' . $organizer->cover) : asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="banner-inner banner-author">
            <div class="author mb-3">
              <figure class="author-img mb-0">
                <a href="javaScript:void(0)">
                  <?php if($admin == true): ?>
                    <img class="rounded-lg lazy" data-src="<?php echo e(asset('assets/admin/img/admins/' . $organizer->image)); ?>"
                      alt="Author">
                  <?php else: ?>
                    <?php if($organizer->photo == null): ?>
                      <img class="rounded-lg lazy" data-src="<?php echo e(asset('assets/front/images/user.png')); ?>" alt="image">
                    <?php else: ?>
                      <img class="rounded-lg lazy"
                        data-src="<?php echo e(asset('assets/admin/img/organizer-photo/' . $organizer->photo)); ?>" alt="image">
                    <?php endif; ?>
                  <?php endif; ?>
                </a>
              </figure>
              <div class="author-info">
                <h3 class="mb-1 text-white"><?php echo e(@$organizer_info->name); ?></h3>
                <h6 class="mb-1 text-white"><?php echo e($organizer->username); ?></h6>
                <span><?php echo e(__('Member since')); ?> <?php echo e(date('M Y', strtotime($organizer->created_at))); ?></span>
              </div>
            </div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
                <li class="breadcrumb-item active"><?php echo e(__('Organizer Details')); ?></li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="col-lg-4 text-white">
          <div class="social-style-one">
            <h5 class="mb-0"><?php echo e(__('Follow Me')); ?></h5>
            <a target="_blank" href="<?php echo e($organizer->facebook); ?>"><i class="fab fa-facebook-f"></i></a>
            <a target="_blank" href="<?php echo e($organizer->linkedin); ?>"><i class="fab fa-linkedin-in"></i></a>
            <a target="_blank" href="<?php echo e($organizer->twitter); ?>"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- Page Banner End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Author-single-area start -->
  <div class="author-area py-120 rpy-100 ">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <h3 class="mb-20"><?php echo e(__('All Events')); ?></h3>
          <div class="author-tabs mb-30">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <button class="nav-link active" type="button" data-toggle="tab" data-target="#all"
                  aria-selected="true"><?php echo e(__('All')); ?></button>
              </li>
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item">
                  <button class="nav-link" type="button" data-toggle="tab" data-target="#<?php echo e($category->slug); ?>"
                    aria-selected="false" tabindex="-1"><?php echo e($category->name); ?></button>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </ul>
          </div>
          <div class="tab-content mb-50">
            <div class="tab-pane fade show active" id="all">
              <div class="row">
                <?php if(count($events) > 0): ?>
                  <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($event->information)): ?>
                      <div class="col-md-6">
                        <div class="event-item">
                          <div class="event-image">
                            <a href="<?php echo e(route('event.details', [$event->information->slug, $event->id])); ?>">
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
                                    $date = strtotime(@$event->start_date);
                                }
                              ?>
                              <li>
                                <i class="far fa-calendar-alt"></i>
                                <span>
                                  <?php echo e(\Carbon\Carbon::parse($date)->timezone($websiteInfo->timezone)->timezone($websiteInfo->timezone)->translatedFormat('d M')); ?>

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
                              <a href="<?php echo e(route('event.details', [$event->information->slug, $event->id])); ?>">
                                <?php if(strlen($event->information->title) > 45): ?>
                                  <?php echo e(mb_substr($event->information->title, 0, 50) . '....'); ?>

                                <?php else: ?>
                                  <?php echo e($event->information->title); ?>

                                <?php endif; ?>
                              </a>
                            </h5>
                            <?php
                              $desc = strip_tags(@$event->information->description);
                            ?>

                            <?php if(strlen($desc) > 100): ?>
                              <p class="event-description"><?php echo e(mb_substr($desc, 0, 100) . '....'); ?></p>
                            <?php else: ?>
                              <p class="event-description"><?php echo e($desc); ?></p>
                            <?php endif; ?>
                            <?php
                              $ticket = DB::table('tickets')
                                  ->where('event_id', $event->id)
                                  ->first();
                            ?>
                            <div class="price-remain">
                              <div class="location">
                                <?php if($event->event_type == 'venue'): ?>
                                  <i class="fas fa-map-marker-alt"></i>
                                  <span>
                                    <?php if($event->information->city != null): ?>
                                      <?php echo e($event->information->city); ?>

                                    <?php endif; ?>
                                    <?php if($event->information->country): ?>
                                      , <?php echo e($event->information->country); ?>

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

                                        <?php if($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'fixed'): ?>
                                          <?php
                                            $calculate_price = $ticket->price - $ticket->early_bird_discount_amount;
                                          ?>
                                          <?php echo e(symbolPrice($calculate_price)); ?>

                                          <del>
                                            <?php echo e(symbolPrice($ticket->price)); ?>

                                          </del>
                                        <?php elseif($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'percentage'): ?>
                                          <?php
                                            $p_price = ($ticket->price * $ticket->early_bird_discount_amount) / 100;
                                            $calculate_price = $ticket->price - $p_price;
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

                                          <?php if($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'fixed'): ?>
                                            <?php
                                              $calculate_price = $price - $ticket->early_bird_discount_amount;
                                            ?>
                                            <?php echo e(symbolPrice($calculate_price)); ?>

                                            <del>
                                              <?php echo e(symbolPrice($price)); ?>

                                            </del>
                                          <?php elseif($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'percentage'): ?>
                                            <del>
                                              <?php echo e(symbolPrice($price)); ?>

                                            </del>
                                            <?php
                                              $p_price = ($ticket->price * $ticket->early_bird_discount_amount) / 100;
                                              $calculate_price = $price - $p_price;
                                            ?>
                                            <?php echo e(symbolPrice($calculate_price)); ?>

                                          <?php else: ?>
                                            <?php
                                              $calculate_price = $price;
                                            ?>
                                            <?php echo e(symbolPrice($calculate_price)); ?>

                                          <?php endif; ?>
                                          <strong>*</strong>
                                        </span>
                                      </span>
                                    <?php elseif($ticket->pricing_type == 'normal'): ?>
                                      <span class="price" dir="ltr">

                                        <?php if($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'fixed'): ?>
                                          <?php
                                            $calculate_price = $ticket->price - $ticket->early_bird_discount_amount;
                                          ?>
                                          <?php echo e(symbolPrice($calculate_price)); ?>

                                          <del>
                                            <?php echo e(symbolPrice($ticket->price)); ?>

                                          </del>
                                        <?php elseif($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'percentage'): ?>
                                          <?php
                                            $p_price = ($ticket->price * $ticket->early_bird_discount_amount) / 100;
                                            $calculate_price = $ticket->price - $p_price;
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
                            <i class="<?php echo e($checkWishList == true ? 'fas ' : 'far '); ?> fa-bookmark"></i>
                          </a>
                        </div>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <div class="col-md-12">
                    <h5 class="text-center"><?php echo e(__('No Event Found')); ?></h5>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="tab-pane fade" id="<?php echo e($category->slug); ?>">
                <div class="row">
                  <?php
                    $language_id = $currentLanguageInfo->id;
                    if (request()->filled('admin') && request()->input('admin') == 'true') {
                        $c_events = adminCategoryWiseEvents($category->id, $language_id, $organizer->id);
                    } else {
                        $c_events = categoryWiseEvents($category->id, $language_id, $organizer->id);
                    }
                  ?>
                  <?php if(count($c_events) > 0): ?>
                    <?php $__currentLoopData = $c_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(!empty($event->information)): ?>
                        <div class="col-md-6">
                          <div class="event-item">
                            <div class="event-image">
                              <a href="<?php echo e(route('event.details', [$event->information->slug, $event->id])); ?>">
                                <img class="lazy"
                                  data-src="<?php echo e(asset('assets/admin/img/event/thumbnail/' . $event->thumbnail)); ?>"
                                  alt="Event">
                              </a>
                            </div>
                            <div class="event-content">
                              <ul class="time-info" dir="ltr">
                                <li>
                                  <i class="far fa-calendar-alt"></i>
                                  <span>
                                    <?php
                                      $date = strtotime($event->start_date);
                                    ?> 
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
                                  class="organizer"><?php echo e($admin->username); ?></a>
                              <?php endif; ?>
                              <h5>
                                <a href="<?php echo e(route('event.details', [$event->information->slug, $event->id])); ?>">
                                  <?php if(strlen($event->information->title) > 45): ?>
                                    <?php echo e(mb_substr($event->information->title, 0, 50) . '....'); ?>

                                  <?php else: ?>
                                    <?php echo e($event->information->title); ?>

                                  <?php endif; ?>
                                </a>
                              </h5>
                              <?php
                                $desc = strip_tags(@$event->information->description);
                              ?>

                              <?php if(strlen($desc) > 100): ?>
                                <p class="event-description"><?php echo e(mb_substr($desc, 0, 100) . '....'); ?></p>
                              <?php else: ?>
                                <p class="event-description"><?php echo e($desc); ?></p>
                              <?php endif; ?>
                              <?php
                                $ticket = DB::table('tickets')
                                    ->where('event_id', $event->id)
                                    ->first();
                              ?>
                              <div class="price-remain">
                                <div class="location">
                                  <?php if($event->event_type == 'venue'): ?>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>
                                      <?php if($event->information->city != null): ?>
                                        <?php echo e($event->information->city); ?>

                                      <?php endif; ?>
                                      <?php if($event->information->country): ?>
                                        , <?php echo e($event->information->country); ?>

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

                                          <?php if($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'fixed'): ?>
                                            <?php
                                              $calculate_price = $ticket->price - $ticket->early_bird_discount_amount;
                                            ?>
                                            <?php echo e(symbolPrice($calculate_price)); ?>

                                            <del>
                                              <?php echo e(symbolPrice($ticket->price)); ?>

                                            </del>
                                          <?php elseif($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'percentage'): ?>
                                            <?php
                                              $p_price = ($ticket->price * $ticket->early_bird_discount_amount) / 100;
                                              $calculate_price = $ticket->price - $p_price;
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

                                            <?php if($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'fixed'): ?>
                                              <?php
                                                $calculate_price = $price - $ticket->early_bird_discount_amount;
                                              ?>
                                              <?php echo e(symbolPrice($calculate_price)); ?>

                                              <del>
                                                <?php echo e(symbolPrice($price)); ?>

                                              </del>
                                            <?php elseif($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'percentage'): ?>
                                              <?php
                                                $p_price = ($ticket->price * $ticket->early_bird_discount_amount) / 100;
                                              ?>
                                              <?php
                                                $calculate_price = $price - $p_price;
                                              ?>
                                              <?php echo e(symbolPrice($calculate_price)); ?>

                                              <del>
                                                <?php echo e(symbolPrice($price)); ?>

                                              </del>
                                            <?php else: ?>
                                              <?php
                                                $calculate_price = $price;
                                              ?>
                                              <?php echo e(symbolPrice($calculate_price)); ?>

                                            <?php endif; ?>
                                            <strong>*</strong>
                                          </span>
                                        </span>
                                      <?php elseif($ticket->pricing_type == 'normal'): ?>
                                        <span class="price" dir="ltr">

                                          <?php if($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'fixed'): ?>
                                            <?php
                                              $calculate_price = $ticket->price - $ticket->early_bird_discount_amount;
                                            ?>
                                            <?php echo e(symbolPrice($calculate_price)); ?>

                                            <del>
                                              <?php echo e(symbolPrice($ticket->price)); ?>

                                            </del>
                                          <?php elseif($ticket->early_bird_discount == 'enable' && $ticket->early_bird_discount_type == 'percentage'): ?>
                                            <?php
                                              $p_price = ($ticket->price * $ticket->early_bird_discount_amount) / 100;
                                              $calculate_price = $ticket->price - $p_price;
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
                        </div>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <div class="col-md-12">
                      <h5 class="text-center"><?php echo e(__('No Event Found')); ?></h5>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <?php if(!empty(showAd(3))): ?>
            <div class="text-center mt-4">
              <?php echo showAd(3); ?>

            </div>
          <?php endif; ?>
        </div>

        <div class="col-lg-4">
          <aside class="sidebar-widget-area">
            <div class="widget widget-author-details border mb-30">
              <div class="author mb-20">
                <figure class="author-img">
                  <?php if($admin == true): ?>
                    <img class="rounded-lg lazy" data-src="<?php echo e(asset('assets/admin/img/admins/' . $organizer->image)); ?>"
                      alt="Author">
                  <?php else: ?>
                    <?php if($organizer->photo == null): ?>
                      <img class="rounded-lg lazy" data-src="<?php echo e(asset('assets/front/images/user.png')); ?>"
                        alt="image">
                    <?php else: ?>
                      <img class="rounded-lg lazy"
                        data-src="<?php echo e(asset('assets/admin/img/organizer-photo/' . $organizer->photo)); ?>"
                        alt="image">
                    <?php endif; ?>
                  <?php endif; ?>
                </figure>
                <div class="author-info">
                  <h6 class="mb-1"><?php echo e(@$organizer_info->name); ?></h6>
                  <span class="icon-start"><?php echo e($organizer->username); ?></span>
                </div>
              </div>
              <?php if($admin == true && $organizer_info): ?>
                <?php if($organizer_info->details != null): ?>
                  <div class="font-sm">
                    <div class="click-show">
                      <div class="show-content">
                        <b><?php echo e(__('About')); ?> : </b><?php echo e($organizer_info->details); ?>

                      </div>
                      <div class="read-more-btn">
                        <span><?php echo e(__('Read more')); ?></span>
                        <span><?php echo e(__('Read less')); ?></span>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

              <?php endif; ?>
              <?php if(@$organizer_info->details != null): ?>
                <div class="font-sm">
                  <div class="click-show">
                    <div class="show-content">
                      <b><?php echo e(__('About')); ?> : </b><?php echo e(@$organizer_info->details); ?>

                    </div>
                    <div class="read-more-btn">
                      <span><?php echo e(__('Read more')); ?></span>
                      <span><?php echo e(__('Read less')); ?></span>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              <ul class="toggle-list list-unstyled mt-15 font-sm">
                <li>
                  <span class="first"><?php echo e(__('Total Events')); ?></span>
                  <span class="last font-sm">
                    <?php if($admin == true): ?>
                      <?php echo e(OrganizerEventCount($organizer->id, true)); ?>

                    <?php else: ?>
                      <?php echo e(OrganizerEventCount($organizer->id)); ?>

                    <?php endif; ?>
                  </span>
                </li>
                <?php if($organizer->email != null): ?>
                  <li>
                    <span class="first"><?php echo e(__('Email')); ?></span>
                    <span class="last font-sm"><a href="mailto:<?php echo e($organizer->email); ?>"
                        title="<?php echo e($organizer->email); ?>"><?php echo e($organizer->email); ?></a></span>
                  </li>
                <?php endif; ?>

                <?php if($organizer->phone != null): ?>
                  <li>
                    <span class="first"><?php echo e(__('Phone')); ?></span>
                    <span class="last font-sm"><a href="tel:<?php echo e($organizer->phone); ?>"
                        title="<?php echo e($organizer->phone); ?>"><?php echo e($organizer->phone); ?></a></span>
                  </li>
                <?php endif; ?>
                <?php if(@$organizer_info->city != null): ?>
                  <li>
                    <span class="first"><?php echo e(__('City')); ?></span>
                    <span class="last font-sm"><a href="tel:<?php echo e(@$organizer_info->city); ?>"
                        title="<?php echo e(@$organizer_info->city); ?>"><?php echo e(@$organizer_info->city); ?></a></span>
                  </li>
                <?php endif; ?>

                <?php if(@$organizer_info->state != null): ?>
                  <li>
                    <span class="first"><?php echo e(__('State')); ?></span>
                    <span class="last font-sm"><a href="tel:<?php echo e(@$organizer_info->state); ?>"
                        title="<?php echo e(@$organizer_info->state); ?>"><?php echo e(@$organizer_info->state); ?></a></span>
                  </li>
                <?php endif; ?>
                <?php if(@$organizer_info->country != null): ?>
                  <li>
                    <span class="first"><?php echo e(__('Country')); ?></span>
                    <span class="last font-sm"><a href="tel:<?php echo e(@$organizer_info->country); ?>"
                        title="<?php echo e(@$organizer_info->country); ?>"><?php echo e(@$organizer_info->country); ?></a></span>
                  </li>
                <?php endif; ?>

                <?php if(@$organizer_info->address != null): ?>
                  <li>
                    <span class="first"><?php echo e(__('Address')); ?></span>
                    <span class="last font-sm"><?php echo e(@$organizer_info->address); ?></span>
                  </li>
                <?php endif; ?>

                <?php if($admin == true && $organizer->address != null): ?>
                  <li>
                    <span class="first"><?php echo e(__('Address')); ?></span>
                    <span class="last font-sm"><?php echo e($organizer->address); ?></span>
                  </li>
                <?php endif; ?>

              </ul>
              <div class="btn-groups text-center mt-20">
                <button type="button" class="theme-btn w-100 mb-10" title="Title" data-toggle="modal"
                  data-target="#contactModal"><?php echo e(__('Contact Now')); ?></button>
              </div>
            </div>

            <div class="widget widget-business-days mb-30">
              <?php if(!empty(showAd(1))): ?>
                <div class="text-center mt-4">
                  <?php echo showAd(1); ?>

                </div>
              <?php endif; ?>
              <?php if(!empty(showAd(2))): ?>
                <div class="text-center mt-4">
                  <?php echo showAd(2); ?>

                </div>
              <?php endif; ?>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </div>
  <!-- Author-single-area start -->

  <!-- Contact Modal -->
  <div class="contact-modal modal fade" id="contactModal" tabindex="-1" role="dialog"
    aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="contactModalLabel"><?php echo e(__('Contact Now')); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contact-wrapper">
            <div class="contact-form m-0">
              <form action="<?php echo e(route('organizer.contact.send_mail')); ?>" method="POST" id="vendorContactForm">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($organizer->id); ?>">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form_group mb-20">
                      <input type="text" class="form_control" placeholder="<?php echo e(__('Enter Your Full Name')); ?>"
                        name="name">
                      <p class="text-danger em mt_1" id="Error_name"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form_group mb-20">
                      <input type="email" class="form_control" placeholder="<?php echo e(__('Enter Your Email')); ?>"
                        name="email">
                      <p class="text-danger em mt_1" id="Error_email"></p>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form_group mb-20">
                      <input type="text" class="form_control" placeholder="<?php echo e(__('Enter Subject')); ?>"
                        name="subject">
                      <p class="text-danger em mt_1" id="Error_subject"></p>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form_group mb-20">
                      <textarea name="message" class="form_control" placeholder="<?php echo e(__('Comment')); ?>"></textarea>
                      <p class="text-danger em mt_1" id="Error_message"></p>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <?php if($basicInfos->google_recaptcha_status == 1): ?>
                      <div class="form_group">
                        <?php echo NoCaptcha::renderJs(); ?>

                        <?php echo NoCaptcha::display(); ?>


                        <p class="text-danger em" id="Error_g-recaptcha-response"></p>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="col-lg-12 text-center">
                    <button class="theme-btn" type="submit" title="Submit"><?php echo e(__('Submit')); ?></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Contact Modal -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/organizer/details.blade.php ENDPATH**/ ?>
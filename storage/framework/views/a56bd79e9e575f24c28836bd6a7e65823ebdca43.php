<div class="sidebar sidebar-style-2"
  data-background-color="<?php echo e(Session::get('organizer_theme_version') == 'light' ? 'white' : 'dark2'); ?>">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <?php if(Auth::guard('organizer')->user()->photo != null): ?>
            <img src="<?php echo e(asset('assets/admin/img/organizer-photo/' . Auth::guard('organizer')->user()->photo)); ?>"
              alt="Admin Image" class="avatar-img rounded-circle">
          <?php else: ?>
            <img src="<?php echo e(asset('assets/admin/img/blank_user.jpg')); ?>" alt="" class="avatar-img rounded-circle">
          <?php endif; ?>
        </div>


        <div class="info">
          <a>
            <span>
              <?php echo e(Auth::guard('organizer')->user()->username); ?>


              <span class="user-level"><?php echo e(__('Organizer')); ?></span>
            </span>
          </a>

          <div class="clearfix"></div>
        </div>
      </div>
      <ul class="nav nav-primary">
        
        <div class="row mb-3">
          <div class="col-12">
            <form action="" onsubmit="return false">
              <div class="form-group py-0">
                <input name="term" type="text" class="form-control sidebar-search ltr"
                  placeholder="Search Menu Here...">
              </div>
            </form>
          </div>
        </div>

        
        <li class="nav-item <?php if(request()->routeIs('organizer.dashboard')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('organizer.dashboard')); ?>">
            <i class="la flaticon-paint-palette"></i>
            <p><?php echo e(__('Dashboard')); ?></p>
          </a>
        </li>

        <li
          class="nav-item 
          <?php if(request()->routeIs('organizer.event_management.event')): ?> active 
          <?php elseif(request()->routeIs('choose-event-type')): ?> active 
          <?php elseif(request()->routeIs('organizer.add.event.event')): ?> active 
          <?php elseif(request()->routeIs('organizer.event_management.edit_event')): ?> active 
          <?php elseif(request()->routeIs('organizer.event.ticket')): ?> active
              <?php elseif(request()->routeIs('organizer.event.add.ticket')): ?> active
              <?php elseif(request()->routeIs('organizer.event.edit.ticket')): ?> active <?php endif; ?>">
          <a data-toggle="collapse" href="#course">
            <i class="fal fa-book"></i>
            <p><?php echo e(__('Event Management')); ?></p>
            <span class="caret"></span>
          </a>

          <div id="course"
            class="collapse
            <?php if(request()->routeIs('organizer.event_management.event')): ?> show
            <?php elseif(request()->routeIs('choose-event-type')): ?> show 
            <?php elseif(request()->routeIs('organizer.add.event.event')): ?> show 
            <?php elseif(request()->routeIs('organizer.event_management.edit_event')): ?> show 
            <?php elseif(request()->routeIs('organizer.event.ticket')): ?> show
              <?php elseif(request()->routeIs('organizer.event.add.ticket')): ?> show
              <?php elseif(request()->routeIs('organizer.event.edit.ticket')): ?> show <?php endif; ?>">
            <ul class="nav nav-collapse">

              <li
                class="

              <?php if(request()->routeIs('choose-event-type')): ?> active
              <?php elseif(request()->routeIs('organizer.add.event.event') && request()->input('type') == 'online'): ?> active 
              <?php elseif(request()->routeIs('organizer.add.event.event') && request()->input('type') == 'venue'): ?> active <?php endif; ?>
              ">
                <a href="<?php echo e(route('choose-event-type', ['language' => $defaultLang->code])); ?>">
                  <span class="sub-item"><?php echo e(__('Add Event')); ?></span>
                </a>
              </li>

              <li
                class="<?php if(request()->routeIs('organizer.event_management.event') && request()->input('event_type') == ''): ?> active
                  <?php elseif(request()->routeIs('organizer.event_management.edit_event') && request()->input('event_type') == ''): ?> active 
                  <?php elseif(request()->routeIs('organizer.event.ticket') && request()->input('event_type') == ''): ?> active
              <?php elseif(request()->routeIs('organizer.event.add.ticket') && request()->input('event_type') == ''): ?> active
              <?php elseif(request()->routeIs('organizer.event.edit.ticket') && request()->input('event_type') == ''): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('organizer.event_management.event', ['language' => $defaultLang->code])); ?>">
                  <span class="sub-item"><?php echo e(__('All Events')); ?></span>
                </a>
              </li>

              <li
                class="
              <?php if(request()->routeIs('organizer.event_management.event') && request()->input('event_type') == 'venue'): ?> active 
              <?php elseif(request()->routeIs('organizer.event.ticket') && request()->input('event_type') == 'venue'): ?> active 
              <?php elseif(request()->routeIs('organizer.event.add.ticket') && request()->input('event_type') == 'venue'): ?> active
              <?php elseif(request()->routeIs('organizer.event.edit.ticket') && request()->input('event_type') == 'venue'): ?> active <?php endif; ?>">
                <a
                  href="<?php echo e(route('organizer.event_management.event', ['language' => $defaultLang->code, 'event_type' => 'venue'])); ?>">
                  <span class="sub-item"><?php echo e(__('Venue Events')); ?></span>
                </a>
              </li>

              <li class="

              <?php if(request()->routeIs('organizer.event_management.event') && request()->input('event_type') == 'online'): ?> active <?php endif; ?>
              ">
                <a
                  href="<?php echo e(route('organizer.event_management.event', ['language' => $defaultLang->code, 'event_type' => 'online'])); ?>">
                  <span class="sub-item"><?php echo e(__('Online Events')); ?></span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        
        <li class="nav-item <?php if(request()->routeIs('organizer.device.dashboard')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('organizer.device.dashboard')); ?>">
            <i class="fab fa-whatsapp"></i>
            <p><?php echo e(__('WhatsappConnect')); ?></p>
          </a>
        </li>

        <li
          class="nav-item
          <?php if(request()->routeIs('organizer.event.booking')): ?> active
          <?php elseif(request()->routeIs('organizer.event_booking.details')): ?> active
          <?php elseif(request()->routeIs('organizer.event_booking.report')): ?> active <?php endif; ?>">
          <a data-toggle="collapse" href="#bookings">
            <i class="fal fa-users-class"></i>
            <p><?php echo e(__('Event Bookings')); ?></p>
            <span class="caret"></span>
          </a>

          <div id="bookings"
            class="collapse
          <?php if(request()->routeIs('organizer.event.booking')): ?> show
          <?php elseif(request()->routeIs('organizer.event_booking.details')): ?> show
          <?php elseif(request()->routeIs('organizer.event_booking.report')): ?> show <?php endif; ?>">
            <ul class="nav nav-collapse">
              <li
                class="
              <?php if(request()->routeIs('organizer.event.booking') && empty(request()->input('status'))): ?> active  
              <?php elseif(request()->routeIs('organizer.event_booking.details')): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('organizer.event.booking')); ?>">
                  <span class="sub-item"><?php echo e(__('All Bookings')); ?></span>
                </a>
              </li>

              <li
                class="<?php echo e(request()->routeIs('organizer.event.booking') && request()->input('status') == 'completed' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('organizer.event.booking', ['status' => 'completed'])); ?>">
                  <span class="sub-item"><?php echo e(__('Completed Bookings')); ?></span>
                </a>
              </li>

              <li
                class="<?php echo e(request()->routeIs('organizer.event.booking') && request()->input('status') == 'pending' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('organizer.event.booking', ['status' => 'pending'])); ?>">
                  <span class="sub-item"><?php echo e(__('Pending Bookings')); ?></span>
                </a>
              </li>

              <li
                class="<?php echo e(request()->routeIs('organizer.event.booking') && request()->input('status') == 'rejected' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('organizer.event.booking', ['status' => 'rejected'])); ?>">
                  <span class="sub-item"><?php echo e(__('Rejected Bookings')); ?></span>
                </a>
              </li>

              <li class="<?php echo e(request()->routeIs('organizer.event_booking.report') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('organizer.event_booking.report')); ?>">
                  <span class="sub-item"><?php echo e(__('Report')); ?></span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li
          class="nav-item 
        <?php if(request()->routeIs('organizer.withdraw')): ?> active 
        <?php elseif(request()->routeIs('organizer.withdraw.create')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('organizer.withdraw', ['language' => $defaultLang->code])); ?>">
            <i class="fal fa-donate"></i>
            <p><?php echo e(__('Withdraw')); ?></p>
          </a>
        </li>
        <li class="nav-item <?php if(request()->routeIs('organizer.transcation')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('organizer.transcation')); ?>">
            <i class="fal fa-exchange-alt"></i>
            <p><?php echo e(__('Transactions')); ?></p>
          </a>
        </li>
        
        <li class="nav-item <?php if(request()->routeIs('organizer.scanner_management.registered_scanner')): ?> active
        <?php elseif(request()->routeIs('organizer.scanner_management.add_scanner')): ?> active
        <?php elseif(request()->routeIs('organizer.scanner_management.scanner_details')): ?> active
        <?php elseif(request()->routeIs('organizer.edit_management.scanner_edit')): ?> active
        <?php elseif(request()->routeIs('organizer.scanner_management.scanner.change_password')): ?> active 
        <?php elseif(request()->routeIs('organizer.scanner_management.settings')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#scanner">
                <i class="la flaticon-users"></i>
                <p><?php echo e(__('Scanner Management')); ?></p>
                <span class="caret"></span>
            </a>

            <div id="scanner" class="collapse
            <?php if(request()->routeIs('organizer.scanner_management.registered_scanner')): ?> show
            <?php elseif(request()->routeIs('organizer.scanner_management.scanner_details')): ?> show
            <?php elseif(request()->routeIs('organizer.edit_management.scanner_edit')): ?> show
            <?php elseif(request()->routeIs('organizer.scanner_management.add_scanner')): ?> show
            <?php elseif(request()->routeIs('organizer.scanner_management.scanner.change_password')): ?> show 
            <?php elseif(request()->routeIs('organizer.scanner_management.settings')): ?> show <?php endif; ?>">
                <ul class="nav nav-collapse">
                    <li class="<?php if(request()->routeIs('organizer.scanner_management.settings')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('organizer.scanner_management.settings')); ?>">
                            <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                        </a>
                    </li>
                    <li class="<?php if(request()->routeIs('organizer.scanner_management.registered_scanner')): ?> active
                    <?php elseif(request()->routeIs('organizer.scanner_management.scanner_details')): ?> active
                    <?php elseif(request()->routeIs('organizer.edit_management.scanner_edit')): ?> active
                    <?php elseif(request()->routeIs('organizer.scanner_management.scanner.change_password')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('organizer.scanner_management.registered_scanner')); ?>">
                            <span class="sub-item"><?php echo e(__('Registered Scanners')); ?></span>
                        </a>
                    </li>
                    <li class="<?php if(request()->routeIs('organizer.scanner_management.add_scanner')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('organizer.scanner_management.add_scanner')); ?>">
                            <span class="sub-item"><?php echo e(__('Add Scanner')); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo e(route('organizer.pwa')); ?>" target="_blank">
                        <i class="fas fa-scanner"></i>
                        <p><?php echo e(__('Pwa Scanner')); ?></p>
                      </a>
                    </li>
                </ul>
            </div>
        </li>
        
        
        <li class="nav-item <?php if(request()->routeIs('organizer.promoter_management.registered_promoter')): ?> active
        <?php elseif(request()->routeIs('organizer.promoter_management.add_promoter')): ?> active
        <?php elseif(request()->routeIs('organizer.promoter_management.promoter_details')): ?> active
        <?php elseif(request()->routeIs('organizer.edit_management.promoter_edit')): ?> active
        <?php elseif(request()->routeIs('organizer.promoter_management.promoter.change_password')): ?> active 
        <?php elseif(request()->routeIs('organizer.promoter_management.settings')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#promoter">
                <i class="la flaticon-users"></i>
                <p><?php echo e(__('Promoter Management')); ?></p>
                <span class="caret"></span>
            </a>

            <div id="promoter" class="collapse
            <?php if(request()->routeIs('organizer.promoter_management.registered_promoter')): ?> show
            <?php elseif(request()->routeIs('organizer.promoter_management.promoter_details')): ?> show
            <?php elseif(request()->routeIs('organizer.edit_management.promoter_edit')): ?> show
            <?php elseif(request()->routeIs('organizer.promoter_management.add_promoter')): ?> show
            <?php elseif(request()->routeIs('organizer.promoter_management.promoter.change_password')): ?> show 
            <?php elseif(request()->routeIs('organizer.promoter_management.settings')): ?> show <?php endif; ?>">
                <ul class="nav nav-collapse">
                    <li class="<?php if(request()->routeIs('organizer.promoter_management.settings')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('organizer.promoter_management.settings')); ?>">
                            <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                        </a>
                    </li>
                    <li class="<?php if(request()->routeIs('organizer.promoter_management.registered_promoter')): ?> active
                    <?php elseif(request()->routeIs('organizer.promoter_management.promoter_details')): ?> active
                    <?php elseif(request()->routeIs('organizer.edit_management.promoter_edit')): ?> active
                    <?php elseif(request()->routeIs('organizer.promoter_management.promoter.change_password')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('organizer.promoter_management.registered_promoter')); ?>">
                            <span class="sub-item"><?php echo e(__('Registered Promoters')); ?></span>
                        </a>
                    </li>
                    <li class="<?php if(request()->routeIs('organizer.promoter_management.add_promoter')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('organizer.promoter_management.add_promoter')); ?>">
                            <span class="sub-item"><?php echo e(__('Add Promoter')); ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <?php
          $support_status = DB::table('support_ticket_statuses')->first();
        ?>
        <?php if($support_status->support_ticket_status == 'active'): ?>
          
          <li
            class="nav-item <?php if(request()->routeIs('organizer.support_tickets')): ?> active
            <?php elseif(request()->routeIs('organizer.support_tickets.message')): ?> active
            <?php elseif(request()->routeIs('organizer.support_ticket.create')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#support_ticket">
              <i class="la flaticon-web-1"></i>
              <p><?php echo e(__('Support Tickets')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="support_ticket"
              class="collapse
              <?php if(request()->routeIs('organizer.support_tickets')): ?> show
              <?php elseif(request()->routeIs('organizer.support_tickets.message')): ?> show
              <?php elseif(request()->routeIs('organizer.support_ticket.create')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">

                <li
                  class="<?php if(request()->routeIs('organizer.support_tickets')): ?> active
              <?php elseif(request()->routeIs('organizer.support_tickets.message')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('organizer.support_tickets')); ?>">
                    <span class="sub-item"><?php echo e(__('All Tickets')); ?></span>
                  </a>
                </li>
                <li class="<?php echo e(request()->routeIs('organizer.support_ticket.create') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('organizer.support_ticket.create')); ?>">
                    <span class="sub-item"><?php echo e(__('Add Ticket')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>
        
        
        <li class="nav-item <?php if(request()->routeIs('organizer.shop_management.category')): ?> active
        <?php elseif(request()->routeIs('organizer.shop_management.coupon')): ?> active
        <?php elseif(request()->routeIs('organizer.shop_management.product_type')): ?> active
        <?php elseif(request()->routeIs('organizer.shop_management.product.create')): ?> active
        <?php elseif(request()->routeIs('organizer.shop_management.products')): ?> active
        <?php elseif(request()->routeIs('organizer.shop_management.product.edit')): ?> active
        <?php elseif(request()->routeIs('organizer.product.order')): ?> active
        <?php elseif(request()->routeIs('organizer.product_order.details')): ?> active
        <?php elseif(request()->routeIs('organizer.product_order.report')): ?> active <?php endif; ?>">
                <a data-toggle="collapse" href="#shop_management">
                    <i class="fas fa-store-alt"></i>
                    <p><?php echo e(__('Shop Management')); ?></p>
                    <span class="caret"></span>
                </a>
                <div id="shop_management"class="collapse
                <?php if(request()->routeIs('organizer.shop_management.category')): ?> show
                <?php elseif(request()->routeIs('organizer.shop_management.coupon')): ?> show
                <?php elseif(request()->routeIs('organizer.shop_management.product_type')): ?> show
                <?php elseif(request()->routeIs('organizer.shop_management.product.create')): ?> show
                <?php elseif(request()->routeIs('organizer.shop_management.product.edit')): ?> show
                <?php elseif(request()->routeIs('organizer.shop_management.products')): ?> show
                <?php elseif(request()->routeIs('organizer.product.order')): ?> show
                <?php elseif(request()->routeIs('organizer.product_order.details')): ?> show
                <?php elseif(request()->routeIs('organizer.product_order.report')): ?> show <?php endif; ?>">
                    <ul class="nav nav-collapse">
                        <li class="<?php echo e(request()->routeIs('organizer.shop_management.coupon') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('organizer.shop_management.coupon', ['status' => 1])); ?>">
                                <span class="sub-item"><?php echo e(__('Coupon')); ?></span>
                            </a>
                        </li>

                        <li class="submenu">
                            <a data-toggle="collapse" href="#productManagement"
                                aria-expanded="<?php echo e(request()->routeIs('organizer.shop_management.category') || request()->routeIs('organizer.shop_management.product_type') || request()->routeIs('organizer.shop_management.product.create') || request()->routeIs('organizer.shop_management.products') || request()->routeIs('organizer.product_order.report') ? 'true' : 'false'); ?>">
                                <span class="sub-item"><?php echo e(__('Manage Products')); ?></span>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse
                            <?php if(request()->routeIs('organizer.shop_management.category')): ?> show
                            <?php elseif(request()->routeIs('organizer.shop_management.product_type')): ?> show
                            <?php elseif(request()->routeIs('organizer.shop_management.product.create')): ?> show
                            <?php elseif(request()->routeIs('organizer.shop_management.product.edit')): ?> show
                            <?php elseif(request()->routeIs('organizer.shop_management.products')): ?> show
                            <?php elseif(request()->routeIs('organizer.product_order.report')): ?> show <?php endif; ?>" id="productManagement">
                                <ul class="nav nav-collapse subnav">
                                    <li class="<?php if(request()->routeIs('organizer.shop_management.category')): ?> active <?php endif; ?>">
                                        <a href="<?php echo e(route('organizer.shop_management.category', ['language' => $defaultLang->code])); ?>">
                                            <span class="sub-item"><?php echo e(__('Category')); ?></span>
                                        </a>
                                    </li>
                                    <li class="
                                    <?php if(request()->routeIs('organizer.shop_management.product_type')): ?> active
                                    <?php elseif(request()->routeIs('organizer.shop_management.product.create')): ?> active <?php endif; ?>">
                                        <a href="<?php echo e(route('organizer.shop_management.product_type')); ?>">
                                            <span class="sub-item"><?php echo e(__('Add Product')); ?></span>
                                        </a>
                                    </li>
                                    <liclass="
                                    <?php if(request()->routeIs('organizer.shop_management.products')): ?> active
                                    <?php elseif(request()->routeIs('organizer.shop_management.product.edit')): ?> active <?php endif; ?>">
                                        <a
                                            href="<?php echo e(route('organizer.shop_management.products', ['language' => $defaultLang->code])); ?>">
                                            <span class="sub-item"><?php echo e(__('Products')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="submenu">
                            <a data-toggle="collapse" href="#orderManagement"
                                aria-expanded="<?php echo e(request()->routeIs('organizer.product.order') || request()->routeIs('organizer.product_order.report') || request()->routeIs('organizer.product_order.details') ? 'true' : 'false'); ?>">
                                <span class="sub-item"><?php echo e(__('Manage Orders')); ?></span>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse
                            <?php if(request()->routeIs('organizer.product.order')): ?> show
                            <?php elseif(request()->routeIs('organizer.product_order.details')): ?> show
                            <?php elseif(request()->routeIs('organizer.product_order.report')): ?> show <?php endif; ?>" id="orderManagement">
                                <ul class="nav nav-collapse subnav">
                                    <li class="
                                    <?php if(request()->routeIs('organizer.product.order') && empty(request()->input('type'))): ?> active 
                                    <?php elseif(request()->routeIs('organizer.product_order.details')): ?> active <?php endif; ?>">
                                        <a href="<?php echo e(route('organizer.product.order')); ?>">
                                            <span class="sub-item"><?php echo e(__('All Orders')); ?></span>
                                        </a>
                                    </li>
                                    <li class="
                                    <?php if(request()->routeIs('organizer.product.order') && request()->input('type') == 'pending'): ?> active <?php endif; ?>">
                                        <a href="<?php echo e(route('organizer.product.order', ['type' => 'pending'])); ?>">
                                            <span class="sub-item"><?php echo e(__('Pending Orders')); ?></span>
                                        </a>
                                    </li>
                                    <li class="
                                    <?php if(request()->routeIs('organizer.product.order') && request()->input('type') == 'processing'): ?> active <?php endif; ?>">
                                        <a
                                            href="<?php echo e(route('organizer.product.order', ['type' => 'processing'])); ?>">
                                            <span class="sub-item"><?php echo e(__('Processing Orders')); ?></span>
                                        </a>
                                    </li>
                                    <li class="
                                    <?php if(request()->routeIs('organizer.product.order') && request()->input('type') == 'completed'): ?> active <?php endif; ?>">
                                        <a
                                            href="<?php echo e(route('organizer.product.order', ['type' => 'completed'])); ?>">
                                            <span class="sub-item"><?php echo e(__('Completed Orders')); ?></span>
                                        </a>
                                    </li>
                                    <li class="
                                    <?php if(request()->routeIs('organizer.product.order') && request()->input('type') == 'rejected'): ?> active <?php endif; ?>">
                                        <a href="<?php echo e(route('organizer.product.order', ['type' => 'rejected'])); ?>">
                                            <span class="sub-item"><?php echo e(__('Rejected Orders')); ?></span>
                                        </a>
                                    </li>
                                    <li class="
                                    <?php if(request()->routeIs('organizer.product_order.report')): ?> active <?php endif; ?>">
                                        <a
                                            href="<?php echo e(route('organizer.product_order.report', ['language' => $defaultLang->code])); ?>">
                                            <span class="sub-item"><?php echo e(__('Report')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

        <li class="nav-item
                  <?php if(request()->routeIs('organizer.edit.profile')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('organizer.edit.profile')); ?>">
            <i class="fal fa-user-edit"></i>
            <p><?php echo e(__('Edit Profile')); ?></p>
          </a>
        </li>
        <li class="nav-item <?php if(request()->routeIs('organizer.change.password')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('organizer.change.password')); ?>">
            <i class="fal fa-key"></i>
            <p><?php echo e(__('Change Password')); ?></p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route('organizer.logout')); ?>">
            <i class="fal fa-sign-out "></i>
            <p><?php echo e(__('Logout')); ?></p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/partials/side-navbar.blade.php ENDPATH**/ ?>
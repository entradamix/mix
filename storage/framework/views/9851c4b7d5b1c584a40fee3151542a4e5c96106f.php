<div class="sidebar sidebar-style-2"
    data-background-color="<?php echo e($settings->admin_theme_version == 'light' ? 'white' : 'dark2'); ?>">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <?php if(Auth::guard('admin')->user()->image != null): ?>
                        <img src="<?php echo e(asset('assets/admin/img/admins/' . Auth::guard('admin')->user()->image)); ?>"
                            alt="Admin Image" class="avatar-img rounded-circle">
                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/admin/img/blank_user.jpg')); ?>" alt=""
                            class="avatar-img rounded-circle">
                    <?php endif; ?>
                </div>

                <div class="info">
                    <a data-toggle="collapse" href="#adminProfileMenu" aria-expanded="true">
                        <span>
                            <?php echo e(Auth::guard('admin')->user()->first_name); ?>


                            <?php if(is_null($roleInfo)): ?>
                                <span class="user-level"><?php echo e(__('Super Admin')); ?></span>
                            <?php else: ?>
                                <span class="user-level"><?php echo e($roleInfo->name); ?></span>
                            <?php endif; ?>

                            <span class="caret"></span>
                        </span>
                    </a>

                    <div class="clearfix"></div>

                    <div class="collapse in" id="adminProfileMenu">
                        <ul class="nav">
                            <li>
                                <a href="<?php echo e(route('admin.edit_profile')); ?>">
                                    <span class="link-collapse"><?php echo e(__('Edit Profile')); ?></span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo e(route('admin.change_password')); ?>">
                                    <span class="link-collapse"><?php echo e(__('Change Password')); ?></span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo e(route('admin.logout')); ?>">
                                    <span class="link-collapse"><?php echo e(__('Logout')); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php
                if (!is_null($roleInfo)) {
                    $rolePermissions = json_decode($roleInfo->permissions);
                }
            ?>

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

                
                <li class="nav-item <?php if(request()->routeIs('admin.dashboard')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="la flaticon-paint-palette"></i>
                        <p><?php echo e(__('Dashboard')); ?></p>
                    </a>
                </li>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Menu Builder', $rolePermissions))): ?>
                    <li class="nav-item <?php if(request()->routeIs('admin.menu_builder')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.menu_builder', ['language' => $defaultLang->code])); ?>">
                            <i class="fal fa-bars"></i>
                            <p><?php echo e(__('Menu Builder')); ?></p>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Event Management', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.event_management.categories')): ?> active
            <?php elseif(request()->routeIs('add.event.event')): ?> active
            <?php elseif(request()->routeIs('admin.choose-event-type')): ?> active
            <?php elseif(request()->routeIs('admin.event_management.event')): ?> active
            <?php elseif(request()->routeIs('admin.event_management.edit_event')): ?> active
            <?php elseif(request()->routeIs('admin.event.ticket')): ?> active
            <?php elseif(request()->routeIs('admin.event.add.ticket')): ?> active
            <?php elseif(request()->routeIs('admin.event.edit.ticket')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#event">
                            <i class="fal fa-book"></i>
                            <p><?php echo e(__('Event Management')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="event"
                            class="collapse
              <?php if(request()->routeIs('admin.event_management.categories')): ?> show
              <?php elseif(request()->routeIs('admin.choose-event-type')): ?> show
              <?php elseif(request()->routeIs('add.event.event')): ?> show
              <?php elseif(request()->routeIs('admin.event_management.event')): ?> show
              <?php elseif(request()->routeIs('admin.event_management.edit_event')): ?> show
              <?php elseif(request()->routeIs('admin.event.ticket')): ?> show
              <?php elseif(request()->routeIs('admin.event.add.ticket')): ?> show
              <?php elseif(request()->routeIs('admin.event.edit.ticket')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li
                                    class="<?php echo e(request()->routeIs('admin.event_management.categories') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.event_management.categories', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Event Categories')); ?></span>
                                    </a>
                                </li>

                                <li class="submenu">
                                    <a data-toggle="collapse" href="#EventsManagement"
                                        aria-expanded="<?php echo e(request()->routeIs('admin.choose-event-type') ||
                                        request()->routeIs('add.event.event') ||
                                        request()->routeIs('admin.event_management.event') ||
                                        request()->routeIs('admin.event_management.edit_event') ||
                                        request()->routeIs('admin.event.ticket') ||
                                        request()->routeIs('admin.event.add.ticket') ||
                                        request()->routeIs('admin.event.edit.ticket')
                                            ? 'true'
                                            : 'false'); ?>">
                                        <span class="sub-item"><?php echo e(__('Event Management')); ?></span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse
                    <?php if(request()->routeIs('admin.choose-event-type')): ?> show
                    <?php elseif(request()->routeIs('add.event.event')): ?> show
                    <?php elseif(request()->routeIs('admin.event_management.event')): ?> show
                    <?php elseif(request()->routeIs('admin.event_management.edit_event')): ?> show
                    <?php elseif(request()->routeIs('admin.event.ticket')): ?> show
                    <?php elseif(request()->routeIs('admin.event.add.ticket')): ?> show
                    <?php elseif(request()->routeIs('admin.event.edit.ticket')): ?> show <?php endif; ?>"
                                        id="EventsManagement">
                                        <ul class="nav nav-collapse subnav">
                                            <li
                                                class=" <?php if(request()->routeIs('admin.choose-event-type')): ?> active
                        <?php elseif(request()->routeIs('add.event.event')): ?> active <?php endif; ?> ">
                                                <a
                                                    href="<?php echo e(route('admin.choose-event-type', ['language' => $defaultLang->code])); ?>">
                                                    <span class="sub-item"><?php echo e(__('Add Event')); ?></span>
                                                </a>
                                            </li>

                                            <li
                                                class="<?php if(request()->routeIs('admin.event_management.event') && request()->input('event_type') == ''): ?> active
                        <?php elseif(request()->routeIs('admin.event_management.edit_event') && request()->input('event_type') == ''): ?> active 
                        <?php elseif(request()->routeIs('admin.event.ticket') && request()->input('event_type') == ''): ?> active
                        <?php elseif(request()->routeIs('admin.event.add.ticket') && request()->input('event_type') == ''): ?> active
                        <?php elseif(request()->routeIs('admin.event.edit.ticket') && request()->input('event_type') == ''): ?> active <?php endif; ?>">
                                                <a
                                                    href="<?php echo e(route('admin.event_management.event', ['language' => $defaultLang->code])); ?>">
                                                    <span class="sub-item"><?php echo e(__('All Events')); ?></span>
                                                </a>
                                            </li>

                                            <li
                                                class="<?php if(request()->routeIs('admin.event_management.event') && request()->input('event_type') == 'venue'): ?> active 
                        <?php elseif(request()->routeIs('admin.add.event.event') && request()->input('type') == 'venue'): ?> active
                        <?php elseif(request()->routeIs('admin.event.ticket') && request()->input('event_type') == 'venue'): ?> active 
                        <?php elseif(request()->routeIs('admin.event.add.ticket') && request()->input('event_type') == 'venue'): ?> active
                        <?php elseif(request()->routeIs('admin.event.edit.ticket') && request()->input('event_type') == 'venue'): ?> active <?php endif; ?>">
                                                <a
                                                    href="<?php echo e(route('admin.event_management.event', ['language' => $defaultLang->code, 'event_type' => 'venue'])); ?>">
                                                    <span class="sub-item"><?php echo e(__('Venue Events')); ?></span>
                                                </a>
                                            </li>

                                            <li
                                                class="<?php if(request()->routeIs('admin.event_management.event') && request()->input('event_type') == 'online'): ?> active 
                        <?php elseif(request()->routeIs('admin.add.event.event') && request()->input('type') == 'online'): ?> active <?php endif; ?> ">
                                                <a
                                                    href="<?php echo e(route('admin.event_management.event', ['language' => $defaultLang->code, 'event_type' => 'online'])); ?>">
                                                    <span class="sub-item"><?php echo e(__('Online Events')); ?></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Event Bookings', $rolePermissions))): ?>
                    <li
                        class="nav-item
          <?php if(request()->routeIs('admin.event.booking')): ?> active
          <?php elseif(request()->routeIs('admin.event_booking.details')): ?> active  
          <?php elseif(request()->routeIs('admin.event_management.coupons')): ?> active  
          <?php elseif(request()->routeIs('admin.event_booking.settings.guest_checkout')): ?> active  
          <?php elseif(request()->routeIs('admin.event_booking.settings.tax_commission')): ?> active  
          <?php elseif(request()->routeIs('admin.event_booking.report')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#event_bookings">
                            <i class="fal fa-users-class"></i>
                            <p><?php echo e(__('Event Bookings')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="event_bookings"
                            class="collapse
            <?php if(request()->routeIs('admin.event_management.coupons')): ?> show 
            <?php elseif(request()->routeIs('admin.event_booking.settings.guest_checkout')): ?> show 
            <?php elseif(request()->routeIs('admin.event.booking')): ?> show 
            <?php elseif(request()->routeIs('admin.event_booking.details')): ?> show 
            <?php elseif(request()->routeIs('admin.event_booking.report')): ?> show 
            <?php elseif(request()->routeIs('admin.event_booking.settings.tax_commission')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">

                                <li class="submenu">
                                    <a data-toggle="collapse" href="#EventsSettings"
                                        aria-expanded="<?php echo e(request()->routeIs('admin.event_management.coupons') || request()->routeIs('admin.event_booking.settings.tax_commission') || request()->routeIs('admin.event_booking.settings.guest_checkout') ? 'true' : 'false'); ?>">
                                        <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse
                    <?php if(request()->routeIs('admin.event_management.coupons')): ?> show 
                    <?php elseif(request()->routeIs('admin.event_booking.settings.guest_checkout')): ?> show 
                    <?php elseif(request()->routeIs('admin.event_booking.settings.tax_commission')): ?> show <?php endif; ?>"
                                        id="EventsSettings">
                                        <ul class="nav nav-collapse subnav">
                                            <li
                                                class="<?php echo e(request()->routeIs('admin.event_booking.settings.guest_checkout') ? 'active' : ''); ?>">
                                                <a href="<?php echo e(route('admin.event_booking.settings.guest_checkout')); ?>">
                                                    <span class="sub-item"><?php echo e(__('Guest Checkout')); ?></span>
                                                </a>
                                            </li>
                                            <li
                                                class="<?php echo e(request()->routeIs('admin.event_management.coupons') ? 'active' : ''); ?>">
                                                <a href="<?php echo e(route('admin.event_management.coupons')); ?>">
                                                    <span class="sub-item"><?php echo e(__('Coupons')); ?></span>
                                                </a>
                                            </li>
                                            <li
                                                class="<?php echo e(request()->routeIs('admin.event_booking.settings.tax_commission') ? 'active' : ''); ?>">
                                                <a href="<?php echo e(route('admin.event_booking.settings.tax_commission')); ?>">
                                                    <span class="sub-item"><?php echo e(__('Tax & Commission')); ?></span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>

                                <li
                                    class="
                  <?php if(request()->routeIs('admin.event.booking') && empty(request()->input('status'))): ?> active
                  <?php elseif(request()->routeIs('admin.event_booking.details')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.event.booking')); ?>">
                                        <span class="sub-item"><?php echo e(__('All Bookings')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.event.booking') && request()->input('status') == 'completed' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.event.booking', ['status' => 'completed'])); ?>">
                                        <span class="sub-item"><?php echo e(__('Completed Bookings')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.event.booking') && request()->input('status') == 'pending' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.event.booking', ['status' => 'pending'])); ?>">
                                        <span class="sub-item"><?php echo e(__('Pending Bookings')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.event.booking') && request()->input('status') == 'rejected' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.event.booking', ['status' => 'rejected'])); ?>">
                                        <span class="sub-item"><?php echo e(__('Rejected Bookings')); ?></span>
                                    </a>
                                </li>

                                <li class="<?php echo e(request()->routeIs('admin.event_booking.report') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.event_booking.report')); ?>">
                                        <span class="sub-item"><?php echo e(__('Report')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Withdraw Method', $rolePermissions))): ?>
                    <li
                        class="nav-item
          <?php if(request()->routeIs('admin.withdraw.payment_method')): ?> active
          <?php elseif(request()->routeIs('admin.withdraw.payment_method')): ?> active
          <?php elseif(request()->routeIs('admin.withdraw_payment_method.mange_input')): ?> active
          <?php elseif(request()->routeIs('admin.withdraw_payment_method.edit_input')): ?> active
          <?php elseif(request()->routeIs('admin.withdraw.withdraw_request')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#withdraw_method">
                            <i class="fas fa-credit-card"></i>
                            <p><?php echo e(__('Withdraw Method')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="withdraw_method"
                            class="collapse
            <?php if(request()->routeIs('admin.withdraw.payment_method')): ?> show
            <?php elseif(request()->routeIs('admin.withdraw.payment_method')): ?> show
            <?php elseif(request()->routeIs('admin.withdraw_payment_method.mange_input')): ?> show 
            <?php elseif(request()->routeIs('admin.withdraw_payment_method.edit_input')): ?> show 
            <?php elseif(request()->routeIs('admin.withdraw.withdraw_request')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li
                                    class="<?php if(request()->routeIs('admin.withdraw.payment_method')): ?> active 
                  <?php elseif(request()->routeIs('admin.withdraw_payment_method.mange_input')): ?> active 
                  <?php elseif(request()->routeIs('admin.withdraw_payment_method.edit_input')): ?> active <?php endif; ?>">
                                    <a
                                        href="<?php echo e(route('admin.withdraw.payment_method', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Payment Methods')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.withdraw.withdraw_request') && empty(request()->input('status')) ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.withdraw.withdraw_request', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Withdraw Requests')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Transaction', $rolePermissions))): ?>
                    <li class="nav-item <?php if(request()->routeIs('admin.transcation')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.transcation')); ?>">
                            <i class="fal fa-exchange-alt"></i>
                            <p><?php echo e(__('Transactions')); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Organizer Mangement', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.organizer_management.registered_organizer')): ?> active
            <?php elseif(request()->routeIs('admin.organizer_management.add_organizer')): ?> active
            <?php elseif(request()->routeIs('admin.organizer_management.organizer_details')): ?> active
            <?php elseif(request()->routeIs('admin.edit_management.organizer_edit')): ?> active
            <?php elseif(request()->routeIs('admin.organizer_management.organizer.change_password')): ?> active 
            <?php elseif(request()->routeIs('admin.organizer_management.settings')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#organizer">
                            <i class="la flaticon-users"></i>
                            <p><?php echo e(__('Organizers Management')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="organizer"
                            class="collapse
              <?php if(request()->routeIs('admin.organizer_management.registered_organizer')): ?> show
              <?php elseif(request()->routeIs('admin.organizer_management.organizer_details')): ?> show
              <?php elseif(request()->routeIs('admin.edit_management.organizer_edit')): ?> show
              <?php elseif(request()->routeIs('admin.organizer_management.add_organizer')): ?> show
              <?php elseif(request()->routeIs('admin.organizer_management.organizer.change_password')): ?> show 
              <?php elseif(request()->routeIs('admin.organizer_management.settings')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li class="<?php if(request()->routeIs('admin.organizer_management.settings')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.organizer_management.settings')); ?>">
                                        <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                                    </a>
                                </li>
                                <li
                                    class="<?php if(request()->routeIs('admin.organizer_management.registered_organizer')): ?> active
                  <?php elseif(request()->routeIs('admin.organizer_management.organizer_details')): ?> active
                  <?php elseif(request()->routeIs('admin.edit_management.organizer_edit')): ?> active
                  <?php elseif(request()->routeIs('admin.organizer_management.organizer.change_password')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.organizer_management.registered_organizer')); ?>">
                                        <span class="sub-item"><?php echo e(__('Registered Organizers')); ?></span>
                                    </a>
                                </li>
                                <li class="<?php if(request()->routeIs('admin.organizer_management.add_organizer')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.organizer_management.add_organizer')); ?>">
                                        <span class="sub-item"><?php echo e(__('Add Organizer')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Customer Management', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.organizer_management.registered_customer')): ?> active
            <?php elseif(request()->routeIs('admin.customer_management.customer_edit')): ?> active
            <?php elseif(request()->routeIs('admin.customer_management.customer_details')): ?> active
            <?php elseif(request()->routeIs('admin.customer_management.customer.change_password')): ?> active 
            <?php elseif(request()->routeIs('admin.organizer_management.add_customer')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#customer">
                            <i class="fas fa-users"></i>
                            <p><?php echo e(__('Customers Management')); ?></p>
                            <span class="caret"></span>
                        </a>
                        <div id="customer"
                            class="collapse
              <?php if(request()->routeIs('admin.organizer_management.registered_customer')): ?> show
              <?php elseif(request()->routeIs('admin.customer_management.customer_details')): ?> show
              <?php elseif(request()->routeIs('admin.customer_management.customer_edit')): ?> show
              <?php elseif(request()->routeIs('admin.customer_management.customer.change_password')): ?> show 
              <?php elseif(request()->routeIs('admin.organizer_management.add_customer')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li
                                    class="<?php if(request()->routeIs('admin.organizer_management.registered_customer')): ?> active
                  <?php elseif(request()->routeIs('admin.customer_management.customer_details')): ?> active
                  <?php elseif(request()->routeIs('admin.customer_management.customer_edit')): ?> active
                  <?php elseif(request()->routeIs('admin.customer_management.customer.change_password')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.organizer_management.registered_customer')); ?>">
                                        <span class="sub-item"><?php echo e(__('Registered Customers')); ?></span>
                                    </a>
                                </li>
                                <li class="<?php if(request()->routeIs('admin.organizer_management.add_customer')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.organizer_management.add_customer')); ?>">
                                        <span class="sub-item"><?php echo e(__('Add Customer')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Support Ticket', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.support_ticket.setting')): ?> active
            <?php elseif(request()->routeIs('admin.support_tickets')): ?> active
            <?php elseif(request()->routeIs('admin.support_tickets.message')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#support_ticket">
                            <i class="la flaticon-web-1"></i>
                            <p><?php echo e(__('Support Tickets')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="support_ticket"
                            class="collapse
              <?php if(request()->routeIs('admin.support_ticket.setting')): ?> show
              <?php elseif(request()->routeIs('admin.support_tickets')): ?> show
              <?php elseif(request()->routeIs('admin.support_tickets.message')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li class="<?php if(request()->routeIs('admin.support_ticket.setting')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.support_ticket.setting')); ?>">
                                        <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                                    </a>
                                </li>
                                <li
                                    class="
                  <?php if(request()->routeIs('admin.support_tickets') && empty(request()->input('status'))): ?> active
                  <?php elseif(request()->routeIs('admin.support_tickets.message')): ?> active <?php endif; ?> ">
                                    <a href="<?php echo e(route('admin.support_tickets')); ?>">
                                        <span class="sub-item"><?php echo e(__('All Tickets')); ?></span>
                                    </a>
                                </li>
                                <li
                                    class="<?php echo e(request()->routeIs('admin.support_tickets') && request()->input('status') == 1 ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.support_tickets', ['status' => 1])); ?>">
                                        <span class="sub-item"><?php echo e(__('Pending Tickets')); ?></span>
                                    </a>
                                </li>
                                <li
                                    class="<?php echo e(request()->routeIs('admin.support_tickets') && request()->input('status') == 2 ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.support_tickets', ['status' => 2])); ?>">
                                        <span class="sub-item"><?php echo e(__('Open Tickets')); ?></span>
                                    </a>
                                </li>
                                <li
                                    class="<?php echo e(request()->routeIs('admin.support_tickets') && request()->input('status') == 3 ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.support_tickets', ['status' => 3])); ?>">
                                        <span class="sub-item"><?php echo e(__('Closed Tickets')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Shop Management', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.product.setting')): ?> active
            <?php elseif(request()->routeIs('admin.shop_management.shipping_charge')): ?> active
            <?php elseif(request()->routeIs('admin.shop_management.category')): ?> active
            <?php elseif(request()->routeIs('admin.shop_management.coupon')): ?> active
            <?php elseif(request()->routeIs('admin.shop_management.product_type')): ?> active
            <?php elseif(request()->routeIs('admin.shop_management.product.create')): ?> active
            <?php elseif(request()->routeIs('admin.shop_management.products')): ?> active
            <?php elseif(request()->routeIs('admin.shop_management.product.edit')): ?> active
            <?php elseif(request()->routeIs('admin.product.order')): ?> active
            <?php elseif(request()->routeIs('admin.product_order.details')): ?> active
            <?php elseif(request()->routeIs('admin.product_order.report')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#shop_management">
                            <i class="fas fa-store-alt"></i>
                            <p><?php echo e(__('Shop Management')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="shop_management"
                            class="collapse
              <?php if(request()->routeIs('admin.product.setting')): ?> show
              <?php elseif(request()->routeIs('admin.shop_management.shipping_charge')): ?> show
              <?php elseif(request()->routeIs('admin.shop_management.category')): ?> show
              <?php elseif(request()->routeIs('admin.shop_management.coupon')): ?> show
              <?php elseif(request()->routeIs('admin.shop_management.product_type')): ?> show
              <?php elseif(request()->routeIs('admin.shop_management.product.create')): ?> show
              <?php elseif(request()->routeIs('admin.shop_management.product.edit')): ?> show
              <?php elseif(request()->routeIs('admin.shop_management.products')): ?> show
              <?php elseif(request()->routeIs('admin.product.order')): ?> show
              <?php elseif(request()->routeIs('admin.product_order.details')): ?> show
              <?php elseif(request()->routeIs('admin.product_order.report')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li class="<?php if(request()->routeIs('admin.product.setting')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.product.setting')); ?>">
                                        <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                                    </a>
                                </li>
                                <li
                                    class="<?php echo e(request()->routeIs('admin.shop_management.shipping_charge') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.shop_management.shipping_charge', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Shipping Charges')); ?></span>
                                    </a>
                                </li>
                                <li class="<?php echo e(request()->routeIs('admin.shop_management.coupon') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.shop_management.coupon', ['status' => 1])); ?>">
                                        <span class="sub-item"><?php echo e(__('Coupon')); ?></span>
                                    </a>
                                </li>

                                <li class="submenu">
                                    <a data-toggle="collapse" href="#productManagement"
                                        aria-expanded="<?php echo e(request()->routeIs('admin.shop_management.category') || request()->routeIs('admin.shop_management.product_type') || request()->routeIs('admin.shop_management.product.create') || request()->routeIs('admin.shop_management.products') || request()->routeIs('admin.product_order.report') ? 'true' : 'false'); ?>">
                                        <span class="sub-item"><?php echo e(__('Manage Products')); ?></span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse
                    <?php if(request()->routeIs('admin.shop_management.category')): ?> show
                    <?php elseif(request()->routeIs('admin.shop_management.product_type')): ?> show
                    <?php elseif(request()->routeIs('admin.shop_management.product.create')): ?> show
                    <?php elseif(request()->routeIs('admin.shop_management.product.edit')): ?> show
                    <?php elseif(request()->routeIs('admin.shop_management.products')): ?> show
                    <?php elseif(request()->routeIs('admin.product_order.report')): ?> show <?php endif; ?>"
                                        id="productManagement">
                                        <ul class="nav nav-collapse subnav">
                                            <li
                                                class="
                        <?php if(request()->routeIs('admin.shop_management.category')): ?> active <?php endif; ?>">
                                                <a
                                                    href="<?php echo e(route('admin.shop_management.category', ['language' => $defaultLang->code])); ?>">
                                                    <span class="sub-item"><?php echo e(__('Category')); ?></span>
                                                </a>
                                            </li>
                                            <li
                                                class="
                        <?php if(request()->routeIs('admin.shop_management.product_type')): ?> active
                        <?php elseif(request()->routeIs('admin.shop_management.product.create')): ?> active <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.shop_management.product_type')); ?>">
                                                    <span class="sub-item"><?php echo e(__('Add Product')); ?></span>
                                                </a>
                                            </li>
                                            <li
                                                class="
                        <?php if(request()->routeIs('admin.shop_management.products')): ?> active
                        <?php elseif(request()->routeIs('admin.shop_management.product.edit')): ?> active <?php endif; ?>">
                                                <a
                                                    href="<?php echo e(route('admin.shop_management.products', ['language' => $defaultLang->code])); ?>">
                                                    <span class="sub-item"><?php echo e(__('Products')); ?></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="submenu">
                                    <a data-toggle="collapse" href="#orderManagement"
                                        aria-expanded="<?php echo e(request()->routeIs('admin.product.order') || request()->routeIs('admin.product_order.report') || request()->routeIs('admin.product_order.details') ? 'true' : 'false'); ?>">
                                        <span class="sub-item"><?php echo e(__('Manage Orders')); ?></span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse
                    <?php if(request()->routeIs('admin.product.order')): ?> show
                    <?php elseif(request()->routeIs('admin.product_order.details')): ?> show
                    <?php elseif(request()->routeIs('admin.product_order.report')): ?> show <?php endif; ?>"
                                        id="orderManagement">
                                        <ul class="nav nav-collapse subnav">

                                            <li
                                                class="
                        <?php if(request()->routeIs('admin.product.order') && empty(request()->input('type'))): ?> active 
                        <?php elseif(request()->routeIs('admin.product_order.details')): ?> active <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.product.order')); ?>">
                                                    <span class="sub-item"><?php echo e(__('All Orders')); ?></span>
                                                </a>
                                            </li>
                                            <li
                                                class="
                        <?php if(request()->routeIs('admin.product.order') && request()->input('type') == 'pending'): ?> active <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.product.order', ['type' => 'pending'])); ?>">
                                                    <span class="sub-item"><?php echo e(__('Pending Orders')); ?></span>
                                                </a>
                                            </li>
                                            <li
                                                class="
                        <?php if(request()->routeIs('admin.product.order') && request()->input('type') == 'processing'): ?> active <?php endif; ?>">
                                                <a
                                                    href="<?php echo e(route('admin.product.order', ['type' => 'processing'])); ?>">
                                                    <span class="sub-item"><?php echo e(__('Processing Orders')); ?></span>
                                                </a>
                                            </li>
                                            <li
                                                class="
                        <?php if(request()->routeIs('admin.product.order') && request()->input('type') == 'completed'): ?> active <?php endif; ?>">
                                                <a
                                                    href="<?php echo e(route('admin.product.order', ['type' => 'completed'])); ?>">
                                                    <span class="sub-item"><?php echo e(__('Completed Orders')); ?></span>
                                                </a>
                                            </li>
                                            <li
                                                class="
                        <?php if(request()->routeIs('admin.product.order') && request()->input('type') == 'rejected'): ?> active <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.product.order', ['type' => 'rejected'])); ?>">
                                                    <span class="sub-item"><?php echo e(__('Rejected Orders')); ?></span>
                                                </a>
                                            </li>
                                            <li
                                                class="
                        <?php if(request()->routeIs('admin.product_order.report')): ?> active <?php endif; ?>">
                                                <a
                                                    href="<?php echo e(route('admin.product_order.report', ['language' => $defaultLang->code])); ?>">
                                                    <span class="sub-item"><?php echo e(__('Report')); ?></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Home Page', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.home_page.hero_section')): ?> active
            <?php elseif(request()->routeIs('admin.home_page.section_titles')): ?> active
            <?php elseif(request()->routeIs('admin.home_page.features_section')): ?> active
            <?php elseif(request()->routeIs('admin.home_page.event_features_section')): ?> active
            <?php elseif(request()->routeIs('admin.home_page.how.work')): ?> active
            <?php elseif(request()->routeIs('admin.home_page.partner')): ?> active
            <?php elseif(request()->routeIs('admin.home_page.testimonials_section')): ?> active
            <?php elseif(request()->routeIs('admin.home_page.about_us_section')): ?> active
            <?php elseif(request()->routeIs('admin.home_page.section_customization')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#home_page">
                            <i class="fal fa-layer-group"></i>
                            <p><?php echo e(__('Home Page')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="home_page"
                            class="collapse
              <?php if(request()->routeIs('admin.home_page.hero_section')): ?> show
              <?php elseif(request()->routeIs('admin.home_page.section_titles')): ?> show
              <?php elseif(request()->routeIs('admin.home_page.features_section')): ?> show
              <?php elseif(request()->routeIs('admin.home_page.event_features_section')): ?> show
              <?php elseif(request()->routeIs('admin.home_page.how.work')): ?> show
              <?php elseif(request()->routeIs('admin.home_page.partner')): ?> show
              <?php elseif(request()->routeIs('admin.home_page.testimonials_section')): ?> show
              <?php elseif(request()->routeIs('admin.home_page.about_us_section')): ?> show
              <?php elseif(request()->routeIs('admin.home_page.section_customization')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li class="<?php echo e(request()->routeIs('admin.home_page.hero_section') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.home_page.hero_section', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Hero Section')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.home_page.section_titles') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.home_page.section_titles', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Section Titles')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.home_page.event_features_section') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.home_page.event_features_section', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Event Features Section')); ?></span>
                                    </a>
                                </li>
                                <li class="<?php echo e(request()->routeIs('admin.home_page.how.work') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.home_page.how.work', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('How it Work Section')); ?></span>
                                    </a>
                                </li>
                                <li class="<?php echo e(request()->routeIs('admin.home_page.partner') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.home_page.partner', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Partner Section')); ?></span>
                                    </a>
                                </li>


                                <li
                                    class="<?php echo e(request()->routeIs('admin.home_page.testimonials_section') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.home_page.testimonials_section', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Testimonials Section')); ?></span>
                                    </a>
                                </li>


                                <li
                                    class="<?php echo e(request()->routeIs('admin.home_page.about_us_section') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.home_page.about_us_section', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('About Us Section')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.home_page.section_customization') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.home_page.section_customization')); ?>">
                                        <span class="sub-item"><?php echo e(__('Section Hide/Show')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Footer', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.footer.content')): ?> active
            <?php elseif(request()->routeIs('admin.footer.quick_links')): ?> active
            <?php elseif(request()->routeIs('admin.contact.page')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#footer">
                            <i class="fal fa-shoe-prints"></i>
                            <p><?php echo e(__('Footer')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="footer"
                            class="collapse <?php if(request()->routeIs('admin.footer.content')): ?> show
              <?php elseif(request()->routeIs('admin.footer.quick_links')): ?> show
              <?php elseif(request()->routeIs('admin.contact.page')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li class="<?php echo e(request()->routeIs('admin.footer.content') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.footer.content', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Content & Color')); ?></span>
                                    </a>
                                </li>

                                <li class="<?php echo e(request()->routeIs('admin.footer.quick_links') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.footer.quick_links', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Quick Links')); ?></span>
                                    </a>
                                </li>
                                <li class="<?php echo e(request()->routeIs('admin.contact.page') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.contact.page', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Contact Page')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Custom Pages', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.custom_pages')): ?> active
            <?php elseif(request()->routeIs('admin.custom_pages.create_page')): ?> active
            <?php elseif(request()->routeIs('admin.custom_pages.edit_page')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.custom_pages', ['language' => $defaultLang->code])); ?>">
                            <i class="la flaticon-file"></i>
                            <p><?php echo e(__('Custom Pages')); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Blog Management', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.blog_management.categories')): ?> active
            <?php elseif(request()->routeIs('admin.blog_management.blogs')): ?> active
            <?php elseif(request()->routeIs('admin.blog_management.create_blog')): ?> active
            <?php elseif(request()->routeIs('admin.blog_management.edit_blog')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#blog">
                            <i class="fal fa-blog"></i>
                            <p><?php echo e(__('Blog Management')); ?></p>
                            <span class="caret"></span>
                        </a>
                        <div id="blog"
                            class="collapse
              <?php if(request()->routeIs('admin.blog_management.categories')): ?> show
              <?php elseif(request()->routeIs('admin.blog_management.blogs')): ?> show
              <?php elseif(request()->routeIs('admin.blog_management.create_blog')): ?> show
              <?php elseif(request()->routeIs('admin.blog_management.edit_blog')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li
                                    class="<?php echo e(request()->routeIs('admin.blog_management.categories') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.blog_management.categories', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Categories')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php if(request()->routeIs('admin.blog_management.blogs')): ?> active
                  <?php elseif(request()->routeIs('admin.blog_management.create_blog')): ?> active
                  <?php elseif(request()->routeIs('admin.blog_management.edit_blog')): ?> active <?php endif; ?>">
                                    <a
                                        href="<?php echo e(route('admin.blog_management.blogs', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Blog')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('FAQ Management', $rolePermissions))): ?>
                    <li class="nav-item <?php echo e(request()->routeIs('admin.faq_management') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.faq_management', ['language' => $defaultLang->code])); ?>">
                            <i class="la flaticon-round"></i>
                            <p><?php echo e(__('FAQ Management')); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Contact Page', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php echo e(request()->routeIs('admin.basic_settings.contact_page') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.basic_settings.contact_page')); ?>">
                            <i class="fas fa-address-book"></i>
                            <p><?php echo e(__('Contact Page')); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Advertise', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.advertise.settings')): ?> active
            <?php elseif(request()->routeIs('admin.advertise.advertisements')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#workingId">
                            <i class="fab fa-buysellads"></i>
                            <p><?php echo e(__('Ads')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="workingId"
                            class="collapse <?php if(request()->routeIs('admin.advertise.settings')): ?> show
              <?php elseif(request()->routeIs('admin.advertise.advertisements')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li class="<?php echo e(request()->routeIs('admin.advertise.settings') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.advertise.settings')); ?>">
                                        <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.advertise.advertisements') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.advertise.advertisements')); ?>">
                                        <span class="sub-item"><?php echo e(__('Advertisements')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Announcement Popups', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.announcement_popups')): ?> active
            <?php elseif(request()->routeIs('admin.announcement_popups.select_popup_type')): ?> active
            <?php elseif(request()->routeIs('admin.announcement_popups.create_popup')): ?> active
            <?php elseif(request()->routeIs('admin.announcement_popups.edit_popup')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.announcement_popups', ['language' => $defaultLang->code])); ?>">
                            <i class="fal fa-bullhorn"></i>
                            <p><?php echo e(__('Announcement Popups')); ?></p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Subscribers', $rolePermissions))): ?>
                    <li
                        class="nav-item
          <?php if(request()->routeIs('admin.user_management.subscribers')): ?> active
          <?php elseif(request()->routeIs('admin.user_management.mail_for_subscribers')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#subscribers">
                            <i class="la flaticon-envelope"></i>
                            <p><?php echo e(__('Subscribers')); ?></p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
            <?php if(request()->routeIs('admin.user_management.subscribers')): ?> show
            <?php elseif(request()->routeIs('admin.user_management.mail_for_subscribers')): ?> show <?php endif; ?>"
                            id="subscribers">
                            <ul class="nav nav-collapse">
                                <li class="<?php if(request()->routeIs('admin.user_management.subscribers')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.user_management.subscribers')); ?>">
                                        <span class="sub-item"><?php echo e(__('Subscribers')); ?></span>
                                    </a>
                                </li>
                                <li class="<?php if(request()->routeIs('admin.user_management.mail_for_subscribers')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.user_management.mail_for_subscribers')); ?>">
                                        <span class="sub-item"><?php echo e(__('Mail to Subscribers')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Push Notification', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.user_management.push_notification.settings')): ?> active 
                    <?php elseif(request()->routeIs('admin.user_management.push_notification.notification_for_visitors')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#push_notification">
                            <i class="fal fa-bell"></i>
                            <p><?php echo e(__('Push Notification')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="push_notification"
                            class="collapse 
              <?php if(request()->routeIs('admin.user_management.push_notification.settings')): ?> show 
                    <?php elseif(request()->routeIs('admin.user_management.push_notification.notification_for_visitors')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li
                                    class="<?php echo e(request()->routeIs('admin.user_management.push_notification.settings') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.user_management.push_notification.settings')); ?>">
                                        <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.user_management.push_notification.notification_for_visitors') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.user_management.push_notification.notification_for_visitors')); ?>">
                                        <span class="sub-item"><?php echo e(__('Send Notification')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Payment Gateways', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.payment_gateways.online_gateways')): ?> active
            <?php elseif(request()->routeIs('admin.payment_gateways.offline_gateways')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#payment_gateways">
                            <i class="la flaticon-paypal"></i>
                            <p><?php echo e(__('Payment Gateways')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="payment_gateways"
                            class="collapse
              <?php if(request()->routeIs('admin.payment_gateways.online_gateways')): ?> show
              <?php elseif(request()->routeIs('admin.payment_gateways.offline_gateways')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li
                                    class="<?php echo e(request()->routeIs('admin.payment_gateways.online_gateways') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.payment_gateways.online_gateways')); ?>">
                                        <span class="sub-item"><?php echo e(__('Online Gateways')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.payment_gateways.offline_gateways') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.payment_gateways.offline_gateways')); ?>">
                                        <span class="sub-item"><?php echo e(__('Offline Gateways')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Basic Settings', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.basic_settings.general_settings')): ?> active 
            <?php elseif(request()->routeIs('admin.basic_settings.mail_from_admin')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.mail_to_admin')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.mail_templates')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.breadcrumb')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.page_headings')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.plugins')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.seo')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.maintenance_mode')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.cookie_alert')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.footer_logo')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.social_medias')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#basic_settings">
                            <i class="la flaticon-settings"></i>
                            <p><?php echo e(__('Basic Settings')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="basic_settings"
                            class="collapse
              <?php if(request()->routeIs('admin.basic_settings.general_settings')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.mail_from_admin')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.mail_to_admin')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.mail_templates')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.breadcrumb')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.page_headings')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.plugins')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.seo')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.maintenance_mode')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.cookie_alert')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.footer_logo')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.social_medias')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li
                                    class="<?php echo e(request()->routeIs('admin.basic_settings.general_settings') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.basic_settings.general_settings')); ?>">
                                        <span class="sub-item"><?php echo e(__('General Settings')); ?></span>
                                    </a>
                                </li>

                                <li class="submenu">
                                    <a data-toggle="collapse" href="#mail_settings"
                                        aria-expanded="<?php echo e(request()->routeIs('admin.basic_settings.mail_from_admin') || request()->routeIs('admin.basic_settings.mail_to_admin') || request()->routeIs('admin.basic_settings.mail_templates') || request()->routeIs('admin.basic_settings.edit_mail_template') ? 'true' : 'false'); ?>">
                                        <span class="sub-item"><?php echo e(__('Email Settings')); ?></span>
                                        <span class="caret"></span>
                                    </a>

                                    <div id="mail_settings"
                                        class="collapse
                    <?php if(request()->routeIs('admin.basic_settings.mail_from_admin')): ?> show
                    <?php elseif(request()->routeIs('admin.basic_settings.mail_to_admin')): ?> show
                    <?php elseif(request()->routeIs('admin.basic_settings.mail_templates')): ?> show
                    <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> show <?php endif; ?>">
                                        <ul class="nav nav-collapse subnav">
                                            <li
                                                class="<?php echo e(request()->routeIs('admin.basic_settings.mail_from_admin') ? 'active' : ''); ?>">
                                                <a href="<?php echo e(route('admin.basic_settings.mail_from_admin')); ?>">
                                                    <span class="sub-item"><?php echo e(__('Mail From Admin')); ?></span>
                                                </a>
                                            </li>

                                            <li
                                                class="<?php echo e(request()->routeIs('admin.basic_settings.mail_to_admin') ? 'active' : ''); ?>">
                                                <a href="<?php echo e(route('admin.basic_settings.mail_to_admin')); ?>">
                                                    <span class="sub-item"><?php echo e(__('Mail To Admin')); ?></span>
                                                </a>
                                            </li>

                                            <li
                                                class="<?php if(request()->routeIs('admin.basic_settings.mail_templates')): ?> active
                        <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> active <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.basic_settings.mail_templates')); ?>">
                                                    <span class="sub-item"><?php echo e(__('Mail Templates')); ?></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.basic_settings.breadcrumb') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.basic_settings.breadcrumb')); ?>">
                                        <span class="sub-item"><?php echo e(__('Breadcrumb')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.basic_settings.page_headings') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.basic_settings.page_headings', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Page Headings')); ?></span>
                                    </a>
                                </li>

                                <li class="<?php echo e(request()->routeIs('admin.basic_settings.plugins') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.basic_settings.plugins')); ?>">
                                        <span class="sub-item"><?php echo e(__('Plugins')); ?></span>
                                    </a>
                                </li>

                                <li class="<?php echo e(request()->routeIs('admin.basic_settings.seo') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.basic_settings.seo', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('SEO Informations')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.basic_settings.maintenance_mode') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.basic_settings.maintenance_mode')); ?>">
                                        <span class="sub-item"><?php echo e(__('Maintenance Mode')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.basic_settings.cookie_alert') ? 'active' : ''); ?>">
                                    <a
                                        href="<?php echo e(route('admin.basic_settings.cookie_alert', ['language' => $defaultLang->code])); ?>">
                                        <span class="sub-item"><?php echo e(__('Cookie Alert')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.basic_settings.footer_logo') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.basic_settings.footer_logo')); ?>">
                                        <span class="sub-item"><?php echo e(__('Footer Logo')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.basic_settings.social_medias') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.basic_settings.social_medias')); ?>">
                                        <span class="sub-item"><?php echo e(__('Social Medias')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('PWA Settings', $rolePermissions))): ?>
                    <li
                        class="nav-item
          <?php if(request()->routeIs('admin.pwa')): ?> active 
          <?php elseif(request()->routeIs('admin.pwa.scanner')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#pwa_setting">
                            <i class="fab fa-app-store-ios"></i>
                            <p><?php echo e(__('PWA Settings')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="pwa_setting"
                            class="collapse
            <?php if(request()->routeIs('admin.pwa')): ?> show
            <?php elseif(request()->routeIs('admin.pwa.scanner')): ?> show <?php endif; ?>
            ">
                            <ul class="nav nav-collapse">
                                <li class="<?php echo e(request()->routeIs('admin.pwa.scanner') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.pwa.scanner')); ?>">
                                        <span class="sub-item"><?php echo e(__('PWA Scanner Setting')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Admin Management', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.admin_management.role_permissions')): ?> active
            <?php elseif(request()->routeIs('admin.admin_management.role.permissions')): ?> active
            <?php elseif(request()->routeIs('admin.admin_management.registered_admins')): ?> active <?php endif; ?>">
                        <a data-toggle="collapse" href="#admin">
                            <i class="fal fa-users-cog"></i>
                            <p><?php echo e(__('Admin Management')); ?></p>
                            <span class="caret"></span>
                        </a>

                        <div id="admin"
                            class="collapse
              <?php if(request()->routeIs('admin.admin_management.role_permissions')): ?> show
              <?php elseif(request()->routeIs('admin.admin_management.role.permissions')): ?> show
              <?php elseif(request()->routeIs('admin.admin_management.registered_admins')): ?> show <?php endif; ?>">
                            <ul class="nav nav-collapse">
                                <li
                                    class="<?php if(request()->routeIs('admin.admin_management.role_permissions')): ?> active
                  <?php elseif(request()->routeIs('admin.admin_management.role.permissions')): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.admin_management.role_permissions')); ?>">
                                        <span class="sub-item"><?php echo e(__('Role & Permissions')); ?></span>
                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(request()->routeIs('admin.admin_management.registered_admins') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.admin_management.registered_admins')); ?>">
                                        <span class="sub-item"><?php echo e(__('Registered Admins')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                
                <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Language Management', $rolePermissions))): ?>
                    <li
                        class="nav-item <?php if(request()->routeIs('admin.language_management')): ?> active
            <?php elseif(request()->routeIs('admin.language_management.edit_keyword')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.language_management')); ?>">
                            <i class="fal fa-language"></i>
                            <p><?php echo e(__('Language Management')); ?></p>
                        </a>
                    </li>


                    <li
                        class="nav-item <?php if(request()->routeIs('admin.edit_admin_keywords')): ?> active
            <?php elseif(request()->routeIs('admin.edit_admin_keywords')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.edit_admin_keywords')); ?>">
                            <i class="fal fa-language"></i>
                            <p><?php echo e(__('Admin Language Keywords')); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/backend/partials/side-navbar.blade.php ENDPATH**/ ?>
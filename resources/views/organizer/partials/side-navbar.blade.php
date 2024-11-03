<div class="sidebar sidebar-style-2"
  data-background-color="{{ Session::get('organizer_theme_version') == 'light' ? 'white' : 'dark2' }}">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          @if (Auth::guard('organizer')->user()->photo != null)
            <img src="{{ asset('assets/admin/img/organizer-photo/' . Auth::guard('organizer')->user()->photo) }}"
              alt="Admin Image" class="avatar-img rounded-circle">
          @else
            <img src="{{ asset('assets/admin/img/blank_user.jpg') }}" alt="" class="avatar-img rounded-circle">
          @endif
        </div>


        <div class="info">
          <a>
            <span>
              {{ Auth::guard('organizer')->user()->username }}

              <span class="user-level">{{ __('Organizer') }}</span>
            </span>
          </a>

          <div class="clearfix"></div>
        </div>
      </div>
      <ul class="nav nav-primary">
        {{-- search --}}
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

        {{-- dashboard --}}
        <li class="nav-item @if (request()->routeIs('organizer.dashboard')) active @endif">
          <a href="{{ route('organizer.dashboard') }}">
            <i class="la flaticon-paint-palette"></i>
            <p>{{ __('Dashboard') }}</p>
          </a>
        </li>

        <li
          class="nav-item 
          @if (request()->routeIs('organizer.event_management.event')) active 
          @elseif (request()->routeIs('choose-event-type')) active 
          @elseif (request()->routeIs('organizer.add.event.event')) active 
          @elseif (request()->routeIs('organizer.event_management.edit_event')) active 
          @elseif (request()->routeIs('organizer.event.ticket')) active
              @elseif (request()->routeIs('organizer.event.add.ticket')) active
              @elseif (request()->routeIs('organizer.event.edit.ticket')) active @endif">
          <a data-toggle="collapse" href="#course">
            <i class="fal fa-book"></i>
            <p>{{ __('Event Management') }}</p>
            <span class="caret"></span>
          </a>

          <div id="course"
            class="collapse
            @if (request()->routeIs('organizer.event_management.event')) show
            @elseif (request()->routeIs('choose-event-type')) show 
            @elseif (request()->routeIs('organizer.add.event.event')) show 
            @elseif (request()->routeIs('organizer.event_management.edit_event')) show 
            @elseif (request()->routeIs('organizer.event.ticket')) show
              @elseif (request()->routeIs('organizer.event.add.ticket')) show
              @elseif (request()->routeIs('organizer.event.edit.ticket')) show @endif">
            <ul class="nav nav-collapse">

              <li
                class="

              @if (request()->routeIs('choose-event-type')) active
              @elseif (request()->routeIs('organizer.add.event.event') && request()->input('type') == 'online') active 
              @elseif (request()->routeIs('organizer.add.event.event') && request()->input('type') == 'venue') active @endif
              ">
                <a href="{{ route('choose-event-type', ['language' => $defaultLang->code]) }}">
                  <span class="sub-item">{{ __('Add Event') }}</span>
                </a>
              </li>

              <li
                class="@if (request()->routeIs('organizer.event_management.event') && request()->input('event_type') == '') active
                  @elseif (request()->routeIs('organizer.event_management.edit_event') && request()->input('event_type') == '') active 
                  @elseif (request()->routeIs('organizer.event.ticket') && request()->input('event_type') == '') active
              @elseif (request()->routeIs('organizer.event.add.ticket') && request()->input('event_type') == '') active
              @elseif (request()->routeIs('organizer.event.edit.ticket') && request()->input('event_type') == '') active @endif">
                <a href="{{ route('organizer.event_management.event', ['language' => $defaultLang->code]) }}">
                  <span class="sub-item">{{ __('All Events') }}</span>
                </a>
              </li>

              <li
                class="
              @if (request()->routeIs('organizer.event_management.event') && request()->input('event_type') == 'venue') active 
              @elseif (request()->routeIs('organizer.event.ticket') && request()->input('event_type') == 'venue') active 
              @elseif (request()->routeIs('organizer.event.add.ticket') && request()->input('event_type') == 'venue') active
              @elseif (request()->routeIs('organizer.event.edit.ticket') && request()->input('event_type') == 'venue') active @endif">
                <a
                  href="{{ route('organizer.event_management.event', ['language' => $defaultLang->code, 'event_type' => 'venue']) }}">
                  <span class="sub-item">{{ __('Venue Events') }}</span>
                </a>
              </li>

              <li class="

              @if (request()->routeIs('organizer.event_management.event') && request()->input('event_type') == 'online') active @endif
              ">
                <a
                  href="{{ route('organizer.event_management.event', ['language' => $defaultLang->code, 'event_type' => 'online']) }}">
                  <span class="sub-item">{{ __('Online Events') }}</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        
        <li class="nav-item @if (request()->routeIs('organizer.device.dashboard')) active @endif">
          <a href="{{ route('organizer.device.dashboard') }}">
            <i class="fab fa-whatsapp"></i>
            <p>{{ __('WhatsappConnect') }}</p>
          </a>
        </li>

        <li
          class="nav-item
          @if (request()->routeIs('organizer.event.booking')) active
          @elseif (request()->routeIs('organizer.event_booking.details')) active
          @elseif (request()->routeIs('organizer.event_booking.report')) active @endif">
          <a data-toggle="collapse" href="#bookings">
            <i class="fal fa-users-class"></i>
            <p>{{ __('Event Bookings') }}</p>
            <span class="caret"></span>
          </a>

          <div id="bookings"
            class="collapse
          @if (request()->routeIs('organizer.event.booking')) show
          @elseif (request()->routeIs('organizer.event_booking.details')) show
          @elseif (request()->routeIs('organizer.event_booking.report')) show @endif">
            <ul class="nav nav-collapse">
              <li
                class="
              @if (request()->routeIs('organizer.event.booking') && empty(request()->input('status'))) active  
              @elseif (request()->routeIs('organizer.event_booking.details')) active @endif">
                <a href="{{ route('organizer.event.booking') }}">
                  <span class="sub-item">{{ __('All Bookings') }}</span>
                </a>
              </li>

              <li
                class="{{ request()->routeIs('organizer.event.booking') && request()->input('status') == 'completed' ? 'active' : '' }}">
                <a href="{{ route('organizer.event.booking', ['status' => 'completed']) }}">
                  <span class="sub-item">{{ __('Completed Bookings') }}</span>
                </a>
              </li>

              <li
                class="{{ request()->routeIs('organizer.event.booking') && request()->input('status') == 'pending' ? 'active' : '' }}">
                <a href="{{ route('organizer.event.booking', ['status' => 'pending']) }}">
                  <span class="sub-item">{{ __('Pending Bookings') }}</span>
                </a>
              </li>

              <li
                class="{{ request()->routeIs('organizer.event.booking') && request()->input('status') == 'rejected' ? 'active' : '' }}">
                <a href="{{ route('organizer.event.booking', ['status' => 'rejected']) }}">
                  <span class="sub-item">{{ __('Rejected Bookings') }}</span>
                </a>
              </li>

              <li class="{{ request()->routeIs('organizer.event_booking.report') ? 'active' : '' }}">
                <a href="{{ route('organizer.event_booking.report') }}">
                  <span class="sub-item">{{ __('Report') }}</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li
          class="nav-item 
        @if (request()->routeIs('organizer.withdraw')) active 
        @elseif (request()->routeIs('organizer.withdraw.create')) active @endif">
          <a href="{{ route('organizer.withdraw', ['language' => $defaultLang->code]) }}">
            <i class="fal fa-donate"></i>
            <p>{{ __('Withdraw') }}</p>
          </a>
        </li>
        <li class="nav-item @if (request()->routeIs('organizer.transcation')) active @endif">
          <a href="{{ route('organizer.transcation') }}">
            <i class="fal fa-exchange-alt"></i>
            <p>{{ __('Transactions') }}</p>
          </a>
        </li>
        {{-- scanner --}}
        <li class="nav-item @if (request()->routeIs('organizer.scanner_management.registered_scanner')) active
        @elseif (request()->routeIs('organizer.scanner_management.add_scanner')) active
        @elseif (request()->routeIs('organizer.scanner_management.scanner_details')) active
        @elseif (request()->routeIs('organizer.edit_management.scanner_edit')) active
        @elseif (request()->routeIs('organizer.scanner_management.scanner.change_password')) active 
        @elseif (request()->routeIs('organizer.scanner_management.settings')) active @endif">
            <a data-toggle="collapse" href="#scanner">
                <i class="la flaticon-users"></i>
                <p>{{ __('Scanner Management') }}</p>
                <span class="caret"></span>
            </a>

            <div id="scanner" class="collapse
            @if (request()->routeIs('organizer.scanner_management.registered_scanner')) show
            @elseif (request()->routeIs('organizer.scanner_management.scanner_details')) show
            @elseif (request()->routeIs('organizer.edit_management.scanner_edit')) show
            @elseif (request()->routeIs('organizer.scanner_management.add_scanner')) show
            @elseif (request()->routeIs('organizer.scanner_management.scanner.change_password')) show 
            @elseif (request()->routeIs('organizer.scanner_management.settings')) show @endif">
                <ul class="nav nav-collapse">
                    <li class="@if (request()->routeIs('organizer.scanner_management.settings')) active @endif">
                        <a href="{{ route('organizer.scanner_management.settings') }}">
                            <span class="sub-item">{{ __('Settings') }}</span>
                        </a>
                    </li>
                    <li class="@if (request()->routeIs('organizer.scanner_management.registered_scanner')) active
                    @elseif (request()->routeIs('organizer.scanner_management.scanner_details')) active
                    @elseif (request()->routeIs('organizer.edit_management.scanner_edit')) active
                    @elseif (request()->routeIs('organizer.scanner_management.scanner.change_password')) active @endif">
                        <a href="{{ route('organizer.scanner_management.registered_scanner') }}">
                            <span class="sub-item">{{ __('Registered Scanners') }}</span>
                        </a>
                    </li>
                    <li class="@if (request()->routeIs('organizer.scanner_management.add_scanner')) active @endif">
                        <a href="{{ route('organizer.scanner_management.add_scanner') }}">
                            <span class="sub-item">{{ __('Add Scanner') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('organizer.pwa') }}" target="_blank">
                        <i class="fas fa-scanner"></i>
                        <p>{{ __('Pwa Scanner') }}</p>
                      </a>
                    </li>
                </ul>
            </div>
        </li>
        
        {{-- promoter --}}
        <li class="nav-item @if (request()->routeIs('organizer.promoter_management.registered_promoter')) active
        @elseif (request()->routeIs('organizer.promoter_management.add_promoter')) active
        @elseif (request()->routeIs('organizer.promoter_management.promoter_details')) active
        @elseif (request()->routeIs('organizer.edit_management.promoter_edit')) active
        @elseif (request()->routeIs('organizer.promoter_management.promoter.change_password')) active 
        @elseif (request()->routeIs('organizer.promoter_management.settings')) active @endif">
            <a data-toggle="collapse" href="#promoter">
                <i class="la flaticon-users"></i>
                <p>{{ __('Promoter Management') }}</p>
                <span class="caret"></span>
            </a>

            <div id="promoter" class="collapse
            @if (request()->routeIs('organizer.promoter_management.registered_promoter')) show
            @elseif (request()->routeIs('organizer.promoter_management.promoter_details')) show
            @elseif (request()->routeIs('organizer.edit_management.promoter_edit')) show
            @elseif (request()->routeIs('organizer.promoter_management.add_promoter')) show
            @elseif (request()->routeIs('organizer.promoter_management.promoter.change_password')) show 
            @elseif (request()->routeIs('organizer.promoter_management.settings')) show @endif">
                <ul class="nav nav-collapse">
                    <li class="@if (request()->routeIs('organizer.promoter_management.settings')) active @endif">
                        <a href="{{ route('organizer.promoter_management.settings') }}">
                            <span class="sub-item">{{ __('Settings') }}</span>
                        </a>
                    </li>
                    <li class="@if (request()->routeIs('organizer.promoter_management.registered_promoter')) active
                    @elseif (request()->routeIs('organizer.promoter_management.promoter_details')) active
                    @elseif (request()->routeIs('organizer.edit_management.promoter_edit')) active
                    @elseif (request()->routeIs('organizer.promoter_management.promoter.change_password')) active @endif">
                        <a href="{{ route('organizer.promoter_management.registered_promoter') }}">
                            <span class="sub-item">{{ __('Registered Promoters') }}</span>
                        </a>
                    </li>
                    <li class="@if (request()->routeIs('organizer.promoter_management.add_promoter')) active @endif">
                        <a href="{{ route('organizer.promoter_management.add_promoter') }}">
                            <span class="sub-item">{{ __('Add Promoter') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        @php
          $support_status = DB::table('support_ticket_statuses')->first();
        @endphp
        @if ($support_status->support_ticket_status == 'active')
          {{-- Support Ticket --}}
          <li
            class="nav-item @if (request()->routeIs('organizer.support_tickets')) active
            @elseif (request()->routeIs('organizer.support_tickets.message')) active
            @elseif (request()->routeIs('organizer.support_ticket.create')) active @endif">
            <a data-toggle="collapse" href="#support_ticket">
              <i class="la flaticon-web-1"></i>
              <p>{{ __('Support Tickets') }}</p>
              <span class="caret"></span>
            </a>

            <div id="support_ticket"
              class="collapse
              @if (request()->routeIs('organizer.support_tickets')) show
              @elseif (request()->routeIs('organizer.support_tickets.message')) show
              @elseif (request()->routeIs('organizer.support_ticket.create')) show @endif">
              <ul class="nav nav-collapse">

                <li
                  class="@if (request()->routeIs('organizer.support_tickets')) active
              @elseif (request()->routeIs('organizer.support_tickets.message')) active @endif">
                  <a href="{{ route('organizer.support_tickets') }}">
                    <span class="sub-item">{{ __('All Tickets') }}</span>
                  </a>
                </li>
                <li class="{{ request()->routeIs('organizer.support_ticket.create') ? 'active' : '' }}">
                  <a href="{{ route('organizer.support_ticket.create') }}">
                    <span class="sub-item">{{ __('Add Ticket') }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif
        
        {{-- customer --}}
        <li class="nav-item @if (request()->routeIs('organizer.shop_management.category')) active
        @elseif (request()->routeIs('organizer.shop_management.coupon')) active
        @elseif (request()->routeIs('organizer.shop_management.product_type')) active
        @elseif (request()->routeIs('organizer.shop_management.product.create')) active
        @elseif (request()->routeIs('organizer.shop_management.products')) active
        @elseif (request()->routeIs('organizer.shop_management.product.edit')) active
        @elseif (request()->routeIs('organizer.product.order')) active
        @elseif (request()->routeIs('organizer.product_order.details')) active
        @elseif (request()->routeIs('organizer.product_order.report')) active @endif">
                <a data-toggle="collapse" href="#shop_management">
                    <i class="fas fa-store-alt"></i>
                    <p>{{ __('Shop Management') }}</p>
                    <span class="caret"></span>
                </a>
                <div id="shop_management"class="collapse
                @if (request()->routeIs('organizer.shop_management.category')) show
                @elseif (request()->routeIs('organizer.shop_management.coupon')) show
                @elseif (request()->routeIs('organizer.shop_management.product_type')) show
                @elseif (request()->routeIs('organizer.shop_management.product.create')) show
                @elseif (request()->routeIs('organizer.shop_management.product.edit')) show
                @elseif (request()->routeIs('organizer.shop_management.products')) show
                @elseif (request()->routeIs('organizer.product.order')) show
                @elseif (request()->routeIs('organizer.product_order.details')) show
                @elseif (request()->routeIs('organizer.product_order.report')) show @endif">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->routeIs('organizer.shop_management.coupon') ? 'active' : '' }}">
                            <a href="{{ route('organizer.shop_management.coupon', ['status' => 1]) }}">
                                <span class="sub-item">{{ __('Coupon') }}</span>
                            </a>
                        </li>

                        <li class="submenu">
                            <a data-toggle="collapse" href="#productManagement"
                                aria-expanded="{{ request()->routeIs('organizer.shop_management.category') || request()->routeIs('organizer.shop_management.product_type') || request()->routeIs('organizer.shop_management.product.create') || request()->routeIs('organizer.shop_management.products') || request()->routeIs('organizer.product_order.report') ? 'true' : 'false' }}">
                                <span class="sub-item">{{ __('Manage Products') }}</span>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse
                            @if (request()->routeIs('organizer.shop_management.category')) show
                            @elseif(request()->routeIs('organizer.shop_management.product_type')) show
                            @elseif(request()->routeIs('organizer.shop_management.product.create')) show
                            @elseif(request()->routeIs('organizer.shop_management.product.edit')) show
                            @elseif(request()->routeIs('organizer.shop_management.products')) show
                            @elseif(request()->routeIs('organizer.product_order.report')) show @endif" id="productManagement">
                                <ul class="nav nav-collapse subnav">
                                    <li class="@if (request()->routeIs('organizer.shop_management.category')) active @endif">
                                        <a href="{{ route('organizer.shop_management.category', ['language' => $defaultLang->code]) }}">
                                            <span class="sub-item">{{ __('Category') }}</span>
                                        </a>
                                    </li>
                                    <li class="
                                    @if (request()->routeIs('organizer.shop_management.product_type')) active
                                    @elseif(request()->routeIs('organizer.shop_management.product.create')) active @endif">
                                        <a href="{{ route('organizer.shop_management.product_type') }}">
                                            <span class="sub-item">{{ __('Add Product') }}</span>
                                        </a>
                                    </li>
                                    <liclass="
                                    @if (request()->routeIs('organizer.shop_management.products')) active
                                    @elseif(request()->routeIs('organizer.shop_management.product.edit')) active @endif">
                                        <a
                                            href="{{ route('organizer.shop_management.products', ['language' => $defaultLang->code]) }}">
                                            <span class="sub-item">{{ __('Products') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="submenu">
                            <a data-toggle="collapse" href="#orderManagement"
                                aria-expanded="{{ request()->routeIs('organizer.product.order') || request()->routeIs('organizer.product_order.report') || request()->routeIs('organizer.product_order.details') ? 'true' : 'false' }}">
                                <span class="sub-item">{{ __('Manage Orders') }}</span>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse
                            @if (request()->routeIs('organizer.product.order')) show
                            @elseif(request()->routeIs('organizer.product_order.details')) show
                            @elseif(request()->routeIs('organizer.product_order.report')) show @endif" id="orderManagement">
                                <ul class="nav nav-collapse subnav">
                                    <li class="
                                    @if (request()->routeIs('organizer.product.order') && empty(request()->input('type'))) active 
                                    @elseif (request()->routeIs('organizer.product_order.details')) active @endif">
                                        <a href="{{ route('organizer.product.order') }}">
                                            <span class="sub-item">{{ __('All Orders') }}</span>
                                        </a>
                                    </li>
                                    <li class="
                                    @if (request()->routeIs('organizer.product.order') && request()->input('type') == 'pending') active @endif">
                                        <a href="{{ route('organizer.product.order', ['type' => 'pending']) }}">
                                            <span class="sub-item">{{ __('Pending Orders') }}</span>
                                        </a>
                                    </li>
                                    <li class="
                                    @if (request()->routeIs('organizer.product.order') && request()->input('type') == 'processing') active @endif">
                                        <a
                                            href="{{ route('organizer.product.order', ['type' => 'processing']) }}">
                                            <span class="sub-item">{{ __('Processing Orders') }}</span>
                                        </a>
                                    </li>
                                    <li class="
                                    @if (request()->routeIs('organizer.product.order') && request()->input('type') == 'completed') active @endif">
                                        <a
                                            href="{{ route('organizer.product.order', ['type' => 'completed']) }}">
                                            <span class="sub-item">{{ __('Completed Orders') }}</span>
                                        </a>
                                    </li>
                                    <li class="
                                    @if (request()->routeIs('organizer.product.order') && request()->input('type') == 'rejected') active @endif">
                                        <a href="{{ route('organizer.product.order', ['type' => 'rejected']) }}">
                                            <span class="sub-item">{{ __('Rejected Orders') }}</span>
                                        </a>
                                    </li>
                                    <li class="
                                    @if (request()->routeIs('organizer.product_order.report')) active @endif">
                                        <a
                                            href="{{ route('organizer.product_order.report', ['language' => $defaultLang->code]) }}">
                                            <span class="sub-item">{{ __('Report') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

        <li class="nav-item
                  @if (request()->routeIs('organizer.edit.profile')) active @endif">
          <a href="{{ route('organizer.edit.profile') }}">
            <i class="fal fa-user-edit"></i>
            <p>{{ __('Edit Profile') }}</p>
          </a>
        </li>
        <li class="nav-item @if (request()->routeIs('organizer.change.password')) active @endif">
          <a href="{{ route('organizer.change.password') }}">
            <i class="fal fa-key"></i>
            <p>{{ __('Change Password') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('organizer.logout') }}">
            <i class="fal fa-sign-out "></i>
            <p>{{ __('Logout') }}</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="sidebar sidebar-style-2"
  data-background-color="{{ Session::get('scanner_theme_version') == 'light' ? 'white' : 'dark2' }}">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          @if (Auth::guard('scanner')->user()->photo != null)
            <img src="{{ asset('assets/admin/img/scanner-photo/' . Auth::guard('scanner')->user()->photo) }}"
              alt="Admin Image" class="avatar-img rounded-circle">
          @else
            <img src="{{ asset('assets/admin/img/blank_user.jpg') }}" alt="" class="avatar-img rounded-circle">
          @endif
        </div>


        <div class="info">
          <a>
            <span>
              {{ Auth::guard('scanner')->user()->username }}

              <span class="user-level">{{ __('Scanner') }}</span>
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
        <li class="nav-item @if (request()->routeIs('scanner.dashboard')) active @endif">
          <a href="{{ route('scanner.dashboard') }}">
            <i class="la flaticon-paint-palette"></i>
            <p>{{ __('Dashboard') }}</p>
          </a>
        </li>

        <li
          class="nav-item
          @if (request()->routeIs('scanner.event.booking')) active
          @elseif (request()->routeIs('scanner.event_booking.details')) active
          @elseif (request()->routeIs('scanner.event_booking.report')) active @endif">
          <a data-toggle="collapse" href="#bookings">
            <i class="fal fa-users-class"></i>
            <p>{{ __('Event Bookings') }}</p>
            <span class="caret"></span>
          </a>

          <div id="bookings"
            class="collapse
          @if (request()->routeIs('scanner.event.booking')) show
          @elseif (request()->routeIs('scanner.event_booking.details')) show
          @elseif (request()->routeIs('scanner.event_booking.report')) show @endif">
            <ul class="nav nav-collapse">
              <li
                class="
              @if (request()->routeIs('scanner.event.booking') && empty(request()->input('status'))) active  
              @elseif (request()->routeIs('scanner.event_booking.details')) active @endif">
                <a href="{{ route('scanner.event.booking') }}">
                  <span class="sub-item">{{ __('All Bookings') }}</span>
                </a>
              </li>

              <li
                class="{{ request()->routeIs('scanner.event.booking') && request()->input('status') == 'completed' ? 'active' : '' }}">
                <a href="{{ route('scanner.event.booking', ['status' => 'completed']) }}">
                  <span class="sub-item">{{ __('Completed Bookings') }}</span>
                </a>
              </li>

              <li
                class="{{ request()->routeIs('scanner.event.booking') && request()->input('status') == 'pending' ? 'active' : '' }}">
                <a href="{{ route('scanner.event.booking', ['status' => 'pending']) }}">
                  <span class="sub-item">{{ __('Pending Bookings') }}</span>
                </a>
              </li>

              <li
                class="{{ request()->routeIs('scanner.event.booking') && request()->input('status') == 'rejected' ? 'active' : '' }}">
                <a href="{{ route('scanner.event.booking', ['status' => 'rejected']) }}">
                  <span class="sub-item">{{ __('Rejected Bookings') }}</span>
                </a>
              </li>

              <li class="{{ request()->routeIs('scanner.event_booking.report') ? 'active' : '' }}">
                <a href="{{ route('scanner.event_booking.report') }}">
                  <span class="sub-item">{{ __('Report') }}</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item @if (request()->routeIs('scanner.transcation')) active @endif">
          <a href="{{ route('scanner.transcation') }}">
            <i class="fal fa-exchange-alt"></i>
            <p>{{ __('Transactions') }}</p>
          </a>
        </li>
        {{-- scanner --}}
        <li class="nav-item">
          <a href="{{ route('scanner.pwa') }}" target="_blank">
            <i class="fas fa-scanner"></i>
            <p>{{ __('Pwa Scanner') }}</p>
          </a>
        </li>

        @php
          $support_status = DB::table('support_ticket_statuses')->first();
        @endphp
        @if ($support_status->support_ticket_status == 'active')
          {{-- Support Ticket --}}
          <li
            class="nav-item @if (request()->routeIs('scanner.support_tickets')) active
            @elseif (request()->routeIs('scanner.support_tickets.message')) active
            @elseif (request()->routeIs('scanner.support_ticket.create')) active @endif">
            <a data-toggle="collapse" href="#support_ticket">
              <i class="la flaticon-web-1"></i>
              <p>{{ __('Support Tickets') }}</p>
              <span class="caret"></span>
            </a>

            <div id="support_ticket"
              class="collapse
              @if (request()->routeIs('scanner.support_tickets')) show
              @elseif (request()->routeIs('scanner.support_tickets.message')) show
              @elseif (request()->routeIs('scanner.support_ticket.create')) show @endif">
              <ul class="nav nav-collapse">

                <li
                  class="@if (request()->routeIs('scanner.support_tickets')) active
              @elseif (request()->routeIs('scanner.support_tickets.message')) active @endif">
                  <a href="{{ route('scanner.support_tickets') }}">
                    <span class="sub-item">{{ __('All Tickets') }}</span>
                  </a>
                </li>
                <li class="{{ request()->routeIs('scanner.support_ticket.create') ? 'active' : '' }}">
                  <a href="{{ route('scanner.support_ticket.create') }}">
                    <span class="sub-item">{{ __('Add Ticket') }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif

        <li class="nav-item
                  @if (request()->routeIs('scanner.edit.profile')) active @endif">
          <a href="{{ route('scanner.edit.profile') }}">
            <i class="fal fa-user-edit"></i>
            <p>{{ __('Edit Profile') }}</p>
          </a>
        </li>
        <li class="nav-item @if (request()->routeIs('scanner.change.password')) active @endif">
          <a href="{{ route('scanner.change.password') }}">
            <i class="fal fa-key"></i>
            <p>{{ __('Change Password') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('scanner.logout') }}">
            <i class="fal fa-sign-out "></i>
            <p>{{ __('Logout') }}</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

@extends('backend.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Scanner Details') }}</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{ route('organizer.dashboard') }}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Scanners Management') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="{{ route('organizer.scanner_management.registered_scanner') }}">{{ __('Registered Scanner') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Scanner Details') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-lg-8">
                  <div class="author">
                    @if ($scanner->photo == null)
                      <img class="uploaded-img rounded-circle mh70" src="{{ asset('assets/front/images/user.png') }}"
                        alt="image">
                    @else
                      <img class="uploaded-img rounded-circle mh70"
                        src="{{ asset('assets/admin/img/scanner-photo/' . $scanner->photo) }}" alt="image">
                    @endif
                    <div class="h6 card-title">{{ __('Scanner Information') }}</div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <a class="btn btn-info btn-sm float-right d-inline-block mr-2"
                    href="{{ route('organizer.scanner_management.registered_scanner') }}">
                    <span class="btn-label">
                      <i class="fas fa-backward"></i>
                    </span>
                    {{ __('Back') }}
                  </a>
                </div>
              </div>

            </div>

            <div class="card-body">
              <div class="payment-information">
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('Name') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ optional($scanner->scanner_info)->name }}
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('Designation') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ optional($scanner->scanner_info)->designation }}
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('Username') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ $scanner->username }}
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('Email') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ $scanner->email }}
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('Phone') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ $scanner->phone }}
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('Balance') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ symbolPrice($scanner->amount) }}
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('Country') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ optional($scanner->scanner_info)->country }}
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('City') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ optional($scanner->scanner_info)->city }}
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('State') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ optional($scanner->scanner_info)->state }}
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('Zip Code') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ optional($scanner->scanner_info)->zip_code }}
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('Address') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ optional($scanner->scanner_info)->address }}
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong>{{ __('Details') . ' :' }}</strong>
                  </div>
                  <div class="col-lg-8">
                    {{ optional($scanner->scanner_info)->details }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-lg-5">
                  <div class="card-title d-inline-block">
                    {{ __('Events') . ' (' . $language->name . ' ' . __('Language') . ')' }}
                  </div>
                </div>

                <div class="col-lg-4">
                  @includeIf('backend.partials.languages')
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  @if (session()->has('course_status_warning'))
                    <div class="alert alert-warning">
                      <p class="text-dark mb-0">{{ session()->get('course_status_warning') }}</p>
                    </div>
                  @endif

                  @if (count($events) == 0)
                    <h3 class="text-center mt-2">{{ __('NO EVENT CONTENT FOUND FOR ') . $language->name . '!' }}</h3>
                  @else
                    <div class="table-responsive">
                      <table class="table table-striped mt-3" id="basic-datatables">
                        <thead>
                          <tr>
                            <th scope="col">
                              <input type="checkbox" class="bulk-check" data-val="all">
                            </th>
                            <th scope="col">{{ __('Title') }}</th>
                            <th scope="col">{{ __('Category') }}</th>
                            <th scope="col">{{ __('Ticket') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($events as $event)
                            <tr>
                              <td>
                                <input type="checkbox" class="bulk-check" data-val="{{ $event->id }}">
                              </td>
                              <td width="20%">
                                <a target="_blank"
                                  href="{{ route('event.details', ['slug' => $event->slug, 'id' => $event->id]) }}">{{ strlen($event->title) > 30 ? mb_substr($event->title, 0, 30, 'UTF-8') . '....' : $event->title }}</a>
                              </td>
                              <td>
                                {{ $event->category }}
                              </td>
                              <td>
                                @if ($event->event_type == 'venue')
                                  <a href="{{ route('admin.event.ticket', ['language' => $defaultLang->code, 'event_id' => $event->id, 'event_type' => $event->event_type]) }}"
                                    class="btn btn-success btn-sm">{{ __('Manage') }}</a>
                                @endif
                              </td>
                              <td>
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{ __('Select') }}
                                  </button>

                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('organizer.event_management.edit_event', ['id' => $event->id]) }}"
                                      class="dropdown-item">
                                      {{ __('Edit') }}
                                    </a>

                                    <form class="deleteForm d-block"
                                      action="{{ route('organizer.event_management.delete_event', ['id' => $event->id]) }}"
                                      method="post">

                                      @csrf
                                      <button type="submit" class="btn btn-sm deleteBtn">
                                        {{ __('Delete') }}
                                      </button>
                                    </form>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

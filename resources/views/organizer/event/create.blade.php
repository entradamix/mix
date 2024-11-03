@extends('organizer.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Add Event') }}</h4>
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
        <a href="#">{{ __('Event Management') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="{{ route('choose-event-type', ['language' => $defaultLang->code]) }}">{{ __('Choose Event Type') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Add Event') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">{{ __('Add Event') }}</div>
          <a class="btn btn-info btn-sm float-right d-inline-block"
            href="{{ route('organizer.event_management.event', ['language' => $defaultLang->code]) }}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            {{ __('Back') }}
          </a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="alert alert-danger pb-1 dis-none" id="eventErrors">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul></ul>
              </div>
              <div class="col-lg-12">
                <label for="" class="mb-2"><strong>{{ __('Gallery Images') }} **</strong></label>
                <form action="{{ route('organizer.event.imagesstore') }}" id="my-dropzone" enctype="multipart/formdata"
                  class="dropzone create">
                  @csrf
                  <div class="fallback">
                    <input name="file" type="file" multiple />
                  </div>
                </form>
                <div class=" mb-0" id="errpreimg">

                </div>
                <p class="text-warning">{{ __('Image Size') . ' 1170x570' }}</p>
              </div>
              <form id="eventForm" action="{{ route('organizer.event_management.store_event') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="event_type" value="{{ request()->input('type') }}">
                <div class="form-group">
                  <label for="">{{ __('Thumbnail Image') . '*' }}</label>
                  <br>
                  <div class="thumb-preview">
                    <img src="{{ asset('assets/admin/img/noimage.jpg') }}" alt="..." class="uploaded-img">
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      {{ __('Choose Image') }}
                      <input type="file" class="img-input" id="img-input" name="thumbnail">
                    </div>
                  </div>
                  <p class="text-warning">{{ __('Image Size') . ' : 320x230' }}</p>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group mt-1">
                      <label for="">{{ __('Date Type') . '*' }}</label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="date_type" value="single" class="selectgroup-input eventDateType"
                            checked>
                          <span class="selectgroup-button">{{ __('Single') }}</span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="date_type" value="multiple" class="selectgroup-input eventDateType">
                          <span class="selectgroup-button">{{ __('Multiple') }}</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row countDownStatus">
                  <div class="col-lg-12">
                    <div class="form-group mt-1">
                      <label for="">{{ __('Countdown Status') . '*' }}</label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="countdown_status" value="1" class="selectgroup-input" checked>
                          <span class="selectgroup-button">{{ __('Active') }}</span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="countdown_status" value="0" class="selectgroup-input">
                          <span class="selectgroup-button">{{ __('Deactive') }}</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row" id="single_dates">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>{{ __('Start Date') . '*' }}</label>
                      <input type="date" name="start_date" placeholder="Enter Start Date" class="form-control">
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="">{{ __('Start Time') . '*' }}</label>
                      <input type="time" name="start_time" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>{{ __('End Date') . '*' }}</label>
                      <input type="date" name="end_date" placeholder="Enter End Date" class="form-control">
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="">{{ __('End Time') . '*' }}</label>
                      <input type="time" name="end_time" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12 d-none" id="multiple_dates">
                    <div class="form-group">
                      <table class="table table-bordered ">
                        <thead>
                          <tr>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('Start Time') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('End Time') }}</th>
                            <th><a href="javascrit:void(0)" class="btn btn-success addDateRow"><i
                                  class="fas fa-plus-circle"></i></a></th>
                          </tr>
                        <tbody>
                          <tr>
                            <td>
                              <div class="form-group">
                                <label for="">{{ __('Start Date') . '*' }}</label>
                                <input type="date" name="m_start_date[]" class="form-control">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <label for="">{{ __('Start Time') . '*' }}</label>
                                <input type="time" name="m_start_time[]" class="form-control">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <label for="">{{ __('End Date') . '*' }} </label>
                                <input type="date" name="m_end_date[]" class="form-control">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <label for="">{{ __('End Time') . '*' }} </label>
                                <input type="time" name="m_end_time[]" class="form-control">
                              </div>
                            </td>
                            <td>
                              <a href="javascript:void(0)" class="btn btn-danger deleteDateRow">
                                <i class="fas fa-minus"></i></a>
                            </td>
                          </tr>
                        </tbody>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="row ">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">{{ __('Status') . '*' }}</label>
                      <select name="status" class="form-control">
                        <option selected disabled>{{ __('Select a Status') }}</option>
                        <option value="1">{{ __('Active') }}</option>
                        <option value="0">{{ __('Deactive') }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">{{ __('Is Feature') . '*' }}</label>
                      <select name="is_featured" class="form-control">
                        <option selected disabled>{{ __('Select') }}</option>
                        <option value="yes">{{ __('Yes') }}</option>
                        <option value="no">{{ __('No') }}</option>
                      </select>
                    </div>
                  </div>
                  {{--
                      @if (request()->input('type') == 'venue')
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="">{{ __('Latitude') }}</label>
                            <input type="text" name="latitude" placeholder="{{ __('Latitude') }}"
                              class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="">{{ __('Longitude') }}</label>
                            <input type="text" placeholder="{{ __('Longitude') }}" name="longitude"
                              class="form-control">
                          </div>
                        </div>
                      @endif
                    --}}
                </div>
                @if (request()->input('type') == 'online')
                  {{-- /*****--Ticekt limtit & ticket for each customer start--****** --}}

                  <div class="row">

                    <div class="col-lg-6">
                      <div class="form-group mt-1">
                        <label for="">{{ __('Total Number of Available Tickets') . '*' }}</label>
                        <div class="selectgroup w-100">
                          <label class="selectgroup-item">
                            <input type="radio" name="ticket_available_type" value="unlimited"
                              class="selectgroup-input" checked>
                            <span class="selectgroup-button">{{ __('Unlimited') }}</span>
                          </label>

                          <label class="selectgroup-item">
                            <input type="radio" name="ticket_available_type" value="limited"
                              class="selectgroup-input">
                            <span class="selectgroup-button">{{ __('Limited') }}</span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 d-none" id="ticket_available">
                      <div class="form-group">
                        <label>{{ __('Enter total number of available tickets') . '*' }}</label>
                        <input type="number" name="ticket_available"
                          placeholder="{{ __('Enter total number of available tickets') }}" class="form-control">
                      </div>
                    </div>
                    @if ($websiteInfo->event_guest_checkout_status != 1)
                      <div class="col-lg-6">
                        <div class="form-group mt-1">
                          <label for="">{{ __('Maximum number of tickets for each customer') . '*' }}</label>
                          <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                              <input type="radio" name="max_ticket_buy_type" value="unlimited"
                                class="selectgroup-input" checked>
                              <span class="selectgroup-button">{{ __('Unlimited') }}</span>
                            </label>

                            <label class="selectgroup-item">
                              <input type="radio" name="max_ticket_buy_type" value="limited"
                                class="selectgroup-input">
                              <span class="selectgroup-button">{{ __('Limited') }}</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    @else
                      <input type="hidden" name="max_ticket_buy_type" value="unlimited">
                    @endif
                    <div class="col-lg-6 d-none" id="max_buy_ticket">
                      <div class="form-group">
                        <label>{{ __('Enter Maximum number of tickets for each customer') . '*' }}</label>
                        <input type="number" name="max_buy_ticket"
                          placeholder="{{ __('Enter Maximum number of tickets for each customer') }}"
                          class="form-control">
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="">
                        <div class="form-group">
                          <label for="">{{ __('Price') }}
                            ({{ $getCurrencyInfo->base_currency_text }}) *
                          </label>
                          <input type="number" name="price" id="ticket-pricing" class="form-control"
                            placeholder="{{ __('Enter Ticket Price') }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="checkbox" name="pricing_type" value="free" class="" id="free_ticket">
                        <label for="free_ticket">{{ __('Tickets are Free') }}</label>
                      </div>
                    </div>
                  </div>
                  <div class="row" id="early_bird_discount_free">
                    <div class="col-lg-12">
                      <div class="form-group mt-1">
                        <label for="">{{ __('Early Bird Discount') . '*' }}</label>
                        <div class="selectgroup w-100">
                          <label class="selectgroup-item">
                            <input type="radio" name="early_bird_discount_type" value="disable"
                              class="selectgroup-input" checked>
                            <span class="selectgroup-button">{{ __('Disable') }}</span>
                          </label>

                          <label class="selectgroup-item">
                            <input type="radio" name="early_bird_discount_type" value="enable"
                              class="selectgroup-input">
                            <span class="selectgroup-button">{{ __('Enable') }}</span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12 d-none" id="early_bird_dicount">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="">{{ __('Discount') }} * </label>
                            <select name="discount_type" class="form-control">
                              <option disabled>{{ __('Select Discount Type') }}</option>
                              <option value="fixed">{{ __('Fixed') }}</option>
                              <option value="percentage">{{ __('Percentage') }}</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="">{{ __('Amount') }} * </label>
                            <input type="number" name="early_bird_discount_amount" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="">{{ __('Discount End Date') }} *</label>
                            <input type="date" name="early_bird_discount_date" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="">{{ __('Discount End Time') }} *</label>
                            <input type="time" name="early_bird_discount_time" class="form-control">
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                @endif


                <div id="accordion" class="mt-3">
                  @foreach ($languages as $language)
                    <div class="version">
                        {{-- <div class="version-header" id="heading{{ $language->id }}">
                                <h5 class="mb-0">
                                  <button type="button" class="btn btn-link" data-toggle="collapse"
                                    data-target="#collapse{{ $language->id }}"
                                    aria-expanded="{{ $language->is_default == 1 ? 'true' : 'false' }}"
                                    aria-controls="collapse{{ $language->id }}">
                                    {{ $language->name . ' ' . __('Language') }}
                                    {{ $language->is_default == 1 ? '(' . __('Default') . ')' : '' }}
                                  </button>
                                </h5>
                            </div>
                        --}}
                      <div id="collapse{{ $language->id }}" class="collapse {{ $language->is_default == 1 ? 'show' : '' }}"
                        aria-labelledby="heading{{ $language->id }}" data-parent="#accordion">
                        <div class="version-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                <label>{{ __('Event Title') . '*' }}</label>
                                <input type="text" class="form-control" name="{{ $language->code }}_title"
                                  placeholder="{{ __('Enter Event Name') }}">
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                @php
                                  $categories = DB::table('event_categories')
                                      ->where('language_id', $language->id)
                                      ->where('status', 1)
                                      ->orderBy('serial_number', 'asc')
                                      ->get();
                                @endphp

                                <label for="">{{ __('Category') . '*' }}</label>
                                <select name="{{ $language->code }}_category_id" class="form-control">
                                  <option selected disabled>{{ __('Select Category') }}
                                  </option>

                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                      {{ $category->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          @if (request()->input('type') == 'venue')
                            <div class="row">
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for="">{{ __('Zip/Post Code ') }}</label>
                                  <input type="text" placeholder="{{ __('Zip/Post Code ') }}"
                                    name="{{ $language->code }}_zip_code" id="zip_code" data-language="{{ $language->code }}"
                                    class="form-control {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                </div>
                              </div>
                              <div class="col-lg-8">
                                <div class="form-group">
                                  <label for="">{{ __('Address') . '*' }}</label>
                                  <input type="text" name="{{ $language->code }}_address" id="address_{{ $language->code }}"
                                    class="form-control {{ $language->direction == 1 ? 'rtl text-right' : '' }}"
                                    placeholder="{{ __('Address') }}">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for="">{{ __('County') . '*' }}</label>
                                  <input type="text" name="{{ $language->code }}_country" id="country_{{ $language->code }}"
                                    placeholder="{{ __('Country') }}"
                                    class="form-control {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for="">{{ __('State') }}</label>
                                  <input type="text" name="{{ $language->code }}_state" id="state_{{ $language->code }}"
                                    class="form-control {{ $language->direction == 1 ? 'rtl text-right' : '' }}"
                                    placeholder="{{ __('State') }}">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for="">{{ __('City') . '*' }}</label>
                                  <input type="text" name="{{ $language->code }}_city" id="city_{{ $language->code }}"
                                    class="form-control {{ $language->direction == 1 ? 'rtl text-right' : '' }}"
                                    placeholder="{{ __('City') }}">
                                </div>
                              </div>
                            </div>
                          @endif

                          <div class="row">
                            <div class="col">
                              <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                <label>{{ __('Description') . '*' }}</label>
                                <textarea id="descriptionTmce{{ $language->id }}" class="form-control summernote"
                                  name="{{ $language->code }}_description" placeholder="{{ __('Enter Event Description') }}" data-height="300"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                <label>{{ __('Refund Policy') }} *</label>
                                <textarea class="form-control" name="{{ $language->code }}_refund_policy" rows="5"
                                  placeholder="{{ __('Enter Refund Policy') }}"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                <label>{{ __('Meta Keywords') }}</label>
                                <input class="form-control" name="{{ $language->code }}_meta_keywords"
                                  placeholder="{{ __('Enter Meta Keywords') }}" data-role="tagsinput">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                <label>{{ __('Meta Description') }}</label>
                                <textarea class="form-control" name="{{ $language->code }}_meta_description" rows="5"
                                  placeholder="{{ __('Enter Meta Description') }}"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              @php $currLang = $language; @endphp

                              @foreach ($languages as $language)
                                @continue($language->id == $currLang->id)

                                <div class="form-check py-0">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"
                                      onchange="cloneInput('collapse{{ $currLang->id }}', 'collapse{{ $language->id }}', event)">
                                    <span class="form-check-sign">{{ __('Clone for') }}
                                      <strong class="text-capitalize text-secondary">{{ $language->name }}</strong>
                                      {{ __('language') }}</span>
                                  </label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div id="sliders"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-4">
                                      <div class="card-title d-inline-block">
                                        Ingressos
                                      </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if (request()->input('type') == 'venue')
                                              <div class="row ">
                                                <!-- ======--variationwise ticket & early bird discount--====== -->

                                                <div class="col-lg-12" id="variation_pricing">
                                                  <div class="form-group">
                                                    <div class="table-responsive">
                                                      <table class="table table-bordered ">
                                                        <thead>
                                                        <tr>
                                                        <th colspan="4" style="text-align: right;">
                                                        <a href="javascript:void(0)" class="btn btn-success btn-sm addRow">
                                                        Adicionar ingresso  <i class="fas fa-plus-circle"></i>
                                                            </a>
                                                        </th>
                                                    </tr>
                                                        <tbody>
                                                          <tr>
                                                            <!-- <td>
                                                              @foreach ($languages as $language)
                                                                <div class="form-group">
                                                                  <label for="">Titulo do ingresso
                                                                    
                                                                  </label>
                                                                  <input type="text" name="ticket[{{ $language->code }}_variation_name][]"
                                                                    class="form-control">
                                                                </div>
                                                              @endforeach
                                                            </td>
                                                            <td>
                                                              <div class="form-group">
                                                                <label for="">Preço
                                                                  </label>
                                                                <input type="text" name="ticket[variation_price][]" class="form-control">
                                                              </div>
                                                            </td>
                                                            <td>
                                                              <div class="from-group mt-1">
                                
                                                                <input type="checkbox" name="ticket[v_ticket_available_type][]" value="unlimited"
                                                                  class="ticket_available_type d-none" id="unlimited_1" data-id="1">
                                                                <label for="unlimited_1" class="unlimited_1 d-none">{{ __('Unlimited') }}</label>
                                                              </div>
                            
                                                              <div class="form-group" id="input_1">
                                                                <label for="">Quantidaded</label>
                                                                <input type="text" name="ticket[v_ticket_available][]" value=""
                                                                  class="form-control">
                                                              </div>
                                                            </td> -->
                            
                                                            @if ($websiteInfo->event_guest_checkout_status != 1)
                                                              <td>
                                                                <div class="from-group mt-1">
                                                                  <input type="checkbox" checked name="ticket[v_max_ticket_buy_type][]" value="limited"
                                                                    class="max_ticket_buy_type" id="buy_limited_1" data-id="1">
                                                                  <label for="buy_limited_1" class="buy_limited_1 ">{{ __('Limited') }}</label>
                            
                                                                  <input type="checkbox" name="ticket[v_max_ticket_buy_type][]" value="unlimited"
                                                                    class="max_ticket_buy_type d-none" id="buy_unlimited_1" data-id="1">
                                                                  <label for="buy_unlimited_1"
                                                                    class="buy_unlimited_1 d-none">{{ __('Unlimited') }}</label>
                                                                </div>
                            
                                                                <div class="form-group" id="input2_1">
                                                                  <label for="">{{ __('Max ticket for each customer') . '*' }} </label>
                                                                  <input type="text" name="ticket[v_max_ticket_buy][]" class="form-control">
                                                                </div>
                                                              </td>
                                                            @else
                                                              <input type="hidden" name="ticket[v_max_ticket_buy_type][]" value="unlimited">
                                                              <input type="hidden" name="ticket[v_max_ticket_buy][]" class="form-control">
                                                            @endif
                                                            <!-- <td>
                                                              <a href="javascript:void(0)" class="btn btn-danger btn-sm deleteRow">
                                                                <i class="fas fa-minus"></i></a>
                                                            </td> -->
                                                          </tr>
                                                        </tbody>
                                                        </thead>
                                                      </table>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-lg-6 d-none" id="normal_pricing">
                                                  <div class="form-group">
                                                    <label for="">{{ __('Price') }} ({{ $getCurrencyInfo->base_currency_text }})
                                                      *</label>
                                                    <input type="number" name="ticket[price]" class="form-control" placeholder="Enter Price">
                                                  </div>
                                                </div>
                            
                                                <div class="col-lg-12 d-none" id="early_bird_discount_free">
                                                  <div class="form-group mt-1">
                                                    <label for="">{{ __('Early Bird Discount') . '*' }}</label>
                                                    <div class="selectgroup w-100">
                                                      <label class="selectgroup-item">
                                                        <input type="radio" name="ticket[early_bird_discount_type]" value="disable"
                                                          class="selectgroup-input" checked>
                                                        <span class="selectgroup-button">{{ __('Disable') }}</span>
                                                      </label>
                            
                                                      <label class="selectgroup-item">
                                                        <input type="radio" name="ticket[early_bird_discount_type]" value="enable"
                                                          class="selectgroup-input">
                                                        <span class="selectgroup-button">{{ __('Enable') }}</span>
                                                      </label>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-lg-12 d-none" id="early_bird_dicount">
                                                  <div class="row">
                                                    <div class="col-lg-3">
                                                      <div class="form-group">
                                                        <label for="">{{ __('Discount') . '*' }}</label>
                                                        <select name="ticket[discount_type]" class="form-control">
                                                          <option disabled>{{ __('Select Discount Type') }}</option>
                                                          <option value="fixed">{{ __('Fixed') }}</option>
                                                          <option value="percentage">{{ __('Percentage') }}</option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                      <div class="form-group">
                                                        <label for="">{{ __('Amount') . '*' }}</label>
                                                        <input type="number" name="ticket[early_bird_discount_amount]" class="form-control">
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                      <div class="form-group">
                                                        <label for="">{{ __('Discount End Date') . '*' }}</label>
                                                        <input type="date" name="ticket[early_bird_discount_date]" class="form-control">
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                      <div class="form-group">
                                                        <label for="">{{ __('Discount End Time') . '*' }}</label>
                                                        <input type="time" name="ticket[early_bird_discount_time]" class="form-control">
                                                      </div>
                                                    </div>
                            
                                                  </div>
                                                </div>
                                                <!-- ======---variationwise ticket & early bird discount--======- --->
                            
                            
                                                <!--- /======---Ticekt limtit & ticket for each customer start--======- --->
                                                <div class="hideInvariatinwiseTicket col-lg-12">
                                                  <div class="row">
                                                    <div class="col-lg-6">
                                                      <div class="form-group mt-1">
                                                        <label for="">{{ __('Total Number of Available Tickets') . '*' }}</label>
                                                        <div class="selectgroup w-100">
                                                          <label class="selectgroup-item">
                                                            <input type="radio" name="ticket[ticket_available_type]" value="unlimited"
                                                              class="selectgroup-input" checked>
                                                            <span class="selectgroup-button">{{ __('Unlimited') }}</span>
                                                          </label>
                            
                                                          <label class="selectgroup-item">
                                                            <input type="radio" name="ticket[ticket_available_type]" value="limited"
                                                              class="selectgroup-input">
                                                            <span class="selectgroup-button">{{ __('Limited') }}</span>
                                                          </label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-6 d-none" id="ticket_available">
                                                      <div class="form-group">
                                                        <label>{{ __('Enter total number of available tickets') . '*' }}</label>
                                                        <input type="number" name="ticket[ticket_available]"
                                                          placeholder="Enter total number of available tickets" class="form-control">
                                                      </div>
                                                    </div>
                            
                                                    @if ($websiteInfo->event_guest_checkout_status != 1)
                                                      <div class="col-lg-6">
                                                        <div class="form-group mt-1">
                                                          <label
                                                            for="">{{ __('Maximum number of tickets for each customer') . '*' }}</label>
                                                          <div class="selectgroup w-100">
                                                            <label class="selectgroup-item">
                                                              <input type="radio" name="ticket[max_ticket_buy_type]" value="unlimited"
                                                                class="selectgroup-input" checked>
                                                              <span class="selectgroup-button">{{ __('Unlimited') }}</span>
                                                            </label>
                            
                                                            <label class="selectgroup-item">
                                                              <input type="radio" name="ticket[max_ticket_buy_type]" value="limited"
                                                                class="selectgroup-input">
                                                              <span class="selectgroup-button">{{ __('Limited') }}</span>
                                                            </label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    @else
                                                      <input type="hidden" name="ticket[max_ticket_buy_type]" value="unlimited">
                                                    @endif
                            
                                                    <div class="col-lg-6 d-none" id="max_buy_ticket">
                                                      <div class="form-group">
                                                        <label>{{ __('Enter Maximum number of tickets for each customer') . '*' }}</label>
                                                        <input type="number" name="ticket[max_buy_ticket]"
                                                          placeholder="{{ __('Enter Maximum number of tickets for each customer') }}"
                                                          class="form-control">
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <!----Ticekt limtit & ticket for each customer start----->
                            
                                              </div>
                                            @endif
                                            @if (request()->input('type') == 'online')
                                              <div class="row">
                                                <div class="col-lg-6">
                                                  <div class="">
                                                    <div class="form-group">
                                                      <label for="">{{ __('Price') }} {{ $getCurrencyInfo->base_currency_text }}</label>
                                                      <input type="number" name="price" id="ticket[ticket-pricing]" class="form-control">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <input type="checkbox" name="ticket[pricing_type]" value="free" class="" id="free_ticket">
                                                    <label for="free_ticket">{{ __('Tickets are Free') }}</label>
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                    <label for="">{{ __('Ticket Available') }}</label>
                                                    <input type="number" name="ticket[ticket_available]" class="form-control">
                                                  </div>
                                                </div>
                                                <div class="row" id="early_bird_discount_free">
                                                  <div class="col-lg-12">
                                                    <div class="form-group mt-1">
                                                      <label for="">{{ __('Early Bird Discount') . '*' }}</label>
                                                      <div class="selectgroup w-100">
                                                        <label class="selectgroup-item">
                                                          <input type="radio" name="ticket[[early_bird_discount_type]" value="disable"
                                                            class="selectgroup-input" checked>
                                                          <span class="selectgroup-button">{{ __('Disable') }}</span>
                                                        </label>
                            
                                                        <label class="selectgroup-item">
                                                          <input type="radio" name="ticket[early_bird_discount_type]" value="enable"
                                                            class="selectgroup-input">
                                                          <span class="selectgroup-button">{{ __('Enable') }}</span>
                                                        </label>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-12 d-none" id="early_bird_dicount">
                                                    <div class="row">
                                                      <div class="col-lg-3">
                                                        <div class="form-group">
                                                          <label for="">{{ __('Discount') }}</label>
                                                          <select name="ticket[discont_type]" class="form-control">
                                                            <option disabled>{{ __('Select Discount Type') }}</option>
                                                            <option value="fixed">{{ __('Fixed') }}</option>
                                                            <option value="percentage">{{ __('Percentage') }}</option>
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-3">
                                                        <div class="form-group">
                                                          <label for="">{{ __('Amount') }}</label>
                                                          <input type="number" name="ticket[early_bird_discount_amount]" class="form-control">
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-3">
                                                        <div class="form-group">
                                                          <label for="">{{ __('Discount End Date') }}</label>
                                                          <input type="date" name="ticket[early_bird_discount_date]" class="form-control">
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-3">
                                                        <div class="form-group">
                                                          <label for="">{{ __('Discount End Time') }}</label>
                                                          <input type="time" name="ticket[early_bird_discount_time]" class="form-control">
                                                        </div>
                                                      </div>
                            
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            @endif
                            
                                            <div id="accordion" class="mt-3">
                                              @foreach ($languages as $language)
                                                <div class="version">
                                                    {{--
                                                      <div class="version-header" id="heading{{ $language->id }}">
                                                        <h5 class="mb-0">
                                                          <button type="button" class="btn btn-link" data-toggle="collapse"
                                                            data-target="#collapse{{ $language->id }}"
                                                            aria-expanded="{{ $language->is_default == 1 ? 'true' : 'false' }}"
                                                            aria-controls="collapse{{ $language->id }}">
                                                            {{ $language->name . ' ' . __('Language') }}
                                                            {{ $language->is_default == 1 ? '(' . __('Default') . ')' : '' }}
                                                          </button>
                                                        </h5>
                                                      </div>
                                                    --}}
                            
                                                  <div id="collapse{{ $language->id }}"
                                                    class="collapse {{ $language->is_default == 1 ? 'show' : '' }}"
                                                    aria-labelledby="heading{{ $language->id }}" data-parent="#accordion">
                                                    <div class="version-body">
                                                      <div class="row">
                                                        <div class="col-lg-12">
                                                          <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                                            <label>{{ __('Ticket Name') . '*' }}</label>
                                                            <input type="text" name="ticket[{{ $language->code }}_title]"
                                                              placeholder="{{ __('Enter Ticket Name') }}" class="form-control">
                                                          </div>
                                                        </div>
                                                      </div>
                            
                                                      <div class="row">
                                                        <div class="col">
                                                          <div class="form-group {{ $language->direction == 1 ? 'rtl text-right' : '' }}">
                                                            <label>{{ __('Description') }}</label>
                                                            <textarea class="form-control" name="ticket[{{ $language->code }}_description]"
                                                              placeholder="{{ __('Enter Description') }}"></textarea>
                                                          </div>
                                                        </div>
                                                      </div>
                            
                                                      <div class="row">
                                                        <div class="col">
                                                          @php $currLang = $language; @endphp
                            
                                                          @foreach ($languages as $language)
                                                            @continue($language->id == $currLang->id)
                            
                                                            <div class="form-check py-0">
                                                              <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox"
                                                                  onchange="cloneInput('collapse{{ $currLang->id }}', 'collapse{{ $language->id }}', event)">
                                                                <span class="form-check-sign">{{ __('Clone for') }} <strong
                                                                    class="text-capitalize text-secondary">{{ $language->name }}</strong>
                                                                  {{ __('language') }}</span>
                                                              </label>
                                                            </div>
                                                          @endforeach
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="EventSubmit" class="btn btn-success">
                {{ __('Save') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="cropModal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">Recorte de Imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <div class="image-container">
                        <!--<img id="cropperImage" src="" alt="Cortar"-->
                        <!--    style="max-width: 100%;">-->
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary">
                        Fechar
                    </a>
                    <button type="button" class="btn btn-primary"
                        id="saveCroppedImage">Salvar</button>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

@section('script')
    <script>
        @php
            $names = '';
            foreach ($languages as $language) {
                $varitaion_name = $language->code . '_variation_name[]';
                $names .= "<div class='form-group'><label for=''>Titulo do ingresso</label><input type='text' name='$varitaion_name' class='form-control'></div>";
            }
        @endphp
        let BaseCTxt = "{{ $getCurrencyInfo->base_currency_text }}";
        var names = "{!! $names !!}";
        var guest_checkout_status = "{{ $websiteInfo->event_guest_checkout_status }}";
        let languages = "{{ $languages }}";
    </script>
  <script type="text/javascript" src="{{ asset('assets/admin/js/admin-partial.js') }}"></script>
  <script src="{{ asset('assets/admin/js/admin_dropzone.js') }}"></script>
  <script type="text/javascript">
    $(document).on('blur', "#zip_code", function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');
        
        var language = $(this).attr('data-language');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $(`#address_${language}`).val("...");
                $(`#city_${language}`).val("...");
                $(`#state_${language}`).val("...");
                $(`#country_${language}`).val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
                    
                    console.log(dados)

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $(`#address_${language}`).val(dados.logradouro);
                        $(`#city_${language}`).val(dados.localidade);
                        $(`#state_${language}`).val(dados.uf);
                        $(`#country_${language}`).val("Brasil");
                        $(this).val(cep);
                    } else {
                        //CEP pesquisado não foi encontrado.
                        alert("CEP não encontrado.");
                    }
                });
            } else {
                //cep é inválido.
                $(`#address_${language}`).val("");
                $(`#city_${language}`).val("");
                $(`#state_${language}`).val("");
                $(`#country_${language}`).val("");
                alert("Formato de CEP inválido.");
            }
        }
    });
  </script>
@endsection

@section('variables')
  <script>
    "use strict";
    var storeUrl = "{{ route('organizer.event.imagesstore') }}";
    var removeUrl = "{{ route('organizer.event.imagermv') }}";
    var loadImgs = 0;
  </script>
@endsection

@section('vuescripts')
  <script>
    let app = new Vue({
      el: '#app',
      data() {
        return {
          variants: ['],
          addons: [']
        }
      },
      methods: {
        addVariant() {
          let n = Math.floor(Math.random() * 11);
          let k = Math.floor(Math.random() * 1000000);
          let m = String.fromCharCode(n) + k;
          this.variants.push({
            uniqid: m,
            options: [']
          });
        },
        addOption(vKey) {
          let n = Math.floor(Math.random() * 11);
          let k = Math.floor(Math.random() * 1000000);
          let m = String.fromCharCode(n) + k;
          this.variants[vKey].options.push({
            uniqid: m,
            name: '',
            price: 0
          });
        },
        removeVariant(index) {
          this.variants.splice(index, 1);
        },
        removeOption(vIndex, oIndex) {
          this.variants[vIndex].options.splice(oIndex, 1);
        },
        addAddOn() {
          let n = Math.floor(Math.random() * 11);
          let k = Math.floor(Math.random() * 1000000);
          let m = String.fromCharCode(n) + k;
          this.addons.push({
            uniqid: m
          });
        },
        removeAddOn(index) {
          this.addons.splice(index, 1);
        }
      }
    });
  </script>
@endsection

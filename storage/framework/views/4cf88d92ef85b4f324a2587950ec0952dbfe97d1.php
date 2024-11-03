<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Add Event')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('organizer.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Event Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('choose-event-type', ['language' => $defaultLang->code])); ?>"><?php echo e(__('Choose Event Type')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Add Event')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Add Event')); ?></div>
          <a class="btn btn-info btn-sm float-right d-inline-block"
            href="<?php echo e(route('organizer.event_management.event', ['language' => $defaultLang->code])); ?>">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            <?php echo e(__('Back')); ?>

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
                <label for="" class="mb-2"><strong><?php echo e(__('Gallery Images')); ?> **</strong></label>
                <form action="<?php echo e(route('organizer.event.imagesstore')); ?>" id="my-dropzone" enctype="multipart/formdata"
                  class="dropzone create">
                  <?php echo csrf_field(); ?>
                  <div class="fallback">
                    <input name="file" type="file" multiple />
                  </div>
                </form>
                <div class=" mb-0" id="errpreimg">

                </div>
                <p class="text-warning"><?php echo e(__('Image Size') . ' 1170x570'); ?></p>
              </div>
              <form id="eventForm" action="<?php echo e(route('organizer.event_management.store_event')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="event_type" value="<?php echo e(request()->input('type')); ?>">
                <div class="form-group">
                  <label for=""><?php echo e(__('Thumbnail Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="img-input" id="img-input" name="thumbnail">
                    </div>
                  </div>
                  <p class="text-warning"><?php echo e(__('Image Size') . ' : 320x230'); ?></p>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group mt-1">
                      <label for=""><?php echo e(__('Date Type') . '*'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="date_type" value="single" class="selectgroup-input eventDateType"
                            checked>
                          <span class="selectgroup-button"><?php echo e(__('Single')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="date_type" value="multiple" class="selectgroup-input eventDateType">
                          <span class="selectgroup-button"><?php echo e(__('Multiple')); ?></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row countDownStatus">
                  <div class="col-lg-12">
                    <div class="form-group mt-1">
                      <label for=""><?php echo e(__('Countdown Status') . '*'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="countdown_status" value="1" class="selectgroup-input" checked>
                          <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="countdown_status" value="0" class="selectgroup-input">
                          <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row" id="single_dates">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Start Date') . '*'); ?></label>
                      <input type="date" name="start_date" placeholder="Enter Start Date" class="form-control">
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Start Time') . '*'); ?></label>
                      <input type="time" name="start_time" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('End Date') . '*'); ?></label>
                      <input type="date" name="end_date" placeholder="Enter End Date" class="form-control">
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for=""><?php echo e(__('End Time') . '*'); ?></label>
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
                            <th><?php echo e(__('Start Date')); ?></th>
                            <th><?php echo e(__('Start Time')); ?></th>
                            <th><?php echo e(__('End Date')); ?></th>
                            <th><?php echo e(__('End Time')); ?></th>
                            <th><a href="javascrit:void(0)" class="btn btn-success addDateRow"><i
                                  class="fas fa-plus-circle"></i></a></th>
                          </tr>
                        <tbody>
                          <tr>
                            <td>
                              <div class="form-group">
                                <label for=""><?php echo e(__('Start Date') . '*'); ?></label>
                                <input type="date" name="m_start_date[]" class="form-control">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <label for=""><?php echo e(__('Start Time') . '*'); ?></label>
                                <input type="time" name="m_start_time[]" class="form-control">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <label for=""><?php echo e(__('End Date') . '*'); ?> </label>
                                <input type="date" name="m_end_date[]" class="form-control">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <label for=""><?php echo e(__('End Time') . '*'); ?> </label>
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
                      <label for=""><?php echo e(__('Status') . '*'); ?></label>
                      <select name="status" class="form-control">
                        <option selected disabled><?php echo e(__('Select a Status')); ?></option>
                        <option value="1"><?php echo e(__('Active')); ?></option>
                        <option value="0"><?php echo e(__('Deactive')); ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Is Feature') . '*'); ?></label>
                      <select name="is_featured" class="form-control">
                        <option selected disabled><?php echo e(__('Select')); ?></option>
                        <option value="yes"><?php echo e(__('Yes')); ?></option>
                        <option value="no"><?php echo e(__('No')); ?></option>
                      </select>
                    </div>
                  </div>
                  
                </div>
                <?php if(request()->input('type') == 'online'): ?>
                  

                  <div class="row">

                    <div class="col-lg-6">
                      <div class="form-group mt-1">
                        <label for=""><?php echo e(__('Total Number of Available Tickets') . '*'); ?></label>
                        <div class="selectgroup w-100">
                          <label class="selectgroup-item">
                            <input type="radio" name="ticket_available_type" value="unlimited"
                              class="selectgroup-input" checked>
                            <span class="selectgroup-button"><?php echo e(__('Unlimited')); ?></span>
                          </label>

                          <label class="selectgroup-item">
                            <input type="radio" name="ticket_available_type" value="limited"
                              class="selectgroup-input">
                            <span class="selectgroup-button"><?php echo e(__('Limited')); ?></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 d-none" id="ticket_available">
                      <div class="form-group">
                        <label><?php echo e(__('Enter total number of available tickets') . '*'); ?></label>
                        <input type="number" name="ticket_available"
                          placeholder="<?php echo e(__('Enter total number of available tickets')); ?>" class="form-control">
                      </div>
                    </div>
                    <?php if($websiteInfo->event_guest_checkout_status != 1): ?>
                      <div class="col-lg-6">
                        <div class="form-group mt-1">
                          <label for=""><?php echo e(__('Maximum number of tickets for each customer') . '*'); ?></label>
                          <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                              <input type="radio" name="max_ticket_buy_type" value="unlimited"
                                class="selectgroup-input" checked>
                              <span class="selectgroup-button"><?php echo e(__('Unlimited')); ?></span>
                            </label>

                            <label class="selectgroup-item">
                              <input type="radio" name="max_ticket_buy_type" value="limited"
                                class="selectgroup-input">
                              <span class="selectgroup-button"><?php echo e(__('Limited')); ?></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    <?php else: ?>
                      <input type="hidden" name="max_ticket_buy_type" value="unlimited">
                    <?php endif; ?>
                    <div class="col-lg-6 d-none" id="max_buy_ticket">
                      <div class="form-group">
                        <label><?php echo e(__('Enter Maximum number of tickets for each customer') . '*'); ?></label>
                        <input type="number" name="max_buy_ticket"
                          placeholder="<?php echo e(__('Enter Maximum number of tickets for each customer')); ?>"
                          class="form-control">
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="">
                        <div class="form-group">
                          <label for=""><?php echo e(__('Price')); ?>

                            (<?php echo e($getCurrencyInfo->base_currency_text); ?>) *
                          </label>
                          <input type="number" name="price" id="ticket-pricing" class="form-control"
                            placeholder="<?php echo e(__('Enter Ticket Price')); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="checkbox" name="pricing_type" value="free" class="" id="free_ticket">
                        <label for="free_ticket"><?php echo e(__('Tickets are Free')); ?></label>
                      </div>
                    </div>
                  </div>
                  <div class="row" id="early_bird_discount_free">
                    <div class="col-lg-12">
                      <div class="form-group mt-1">
                        <label for=""><?php echo e(__('Early Bird Discount') . '*'); ?></label>
                        <div class="selectgroup w-100">
                          <label class="selectgroup-item">
                            <input type="radio" name="early_bird_discount_type" value="disable"
                              class="selectgroup-input" checked>
                            <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                          </label>

                          <label class="selectgroup-item">
                            <input type="radio" name="early_bird_discount_type" value="enable"
                              class="selectgroup-input">
                            <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12 d-none" id="early_bird_dicount">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Discount')); ?> * </label>
                            <select name="discount_type" class="form-control">
                              <option disabled><?php echo e(__('Select Discount Type')); ?></option>
                              <option value="fixed"><?php echo e(__('Fixed')); ?></option>
                              <option value="percentage"><?php echo e(__('Percentage')); ?></option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Amount')); ?> * </label>
                            <input type="number" name="early_bird_discount_amount" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Discount End Date')); ?> *</label>
                            <input type="date" name="early_bird_discount_date" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Discount End Time')); ?> *</label>
                            <input type="time" name="early_bird_discount_time" class="form-control">
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                <?php endif; ?>


                <div id="accordion" class="mt-3">
                  <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="version">
                        
                      <div id="collapse<?php echo e($language->id); ?>" class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                        aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                        <div class="version-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Event Title') . '*'); ?></label>
                                <input type="text" class="form-control" name="<?php echo e($language->code); ?>_title"
                                  placeholder="<?php echo e(__('Enter Event Name')); ?>">
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <?php
                                  $categories = DB::table('event_categories')
                                      ->where('language_id', $language->id)
                                      ->where('status', 1)
                                      ->orderBy('serial_number', 'asc')
                                      ->get();
                                ?>

                                <label for=""><?php echo e(__('Category') . '*'); ?></label>
                                <select name="<?php echo e($language->code); ?>_category_id" class="form-control">
                                  <option selected disabled><?php echo e(__('Select Category')); ?>

                                  </option>

                                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>">
                                      <?php echo e($category->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                            </div>
                          </div>

                          <?php if(request()->input('type') == 'venue'): ?>
                            <div class="row">
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for=""><?php echo e(__('Zip/Post Code ')); ?></label>
                                  <input type="text" placeholder="<?php echo e(__('Zip/Post Code ')); ?>"
                                    name="<?php echo e($language->code); ?>_zip_code" id="zip_code" data-language="<?php echo e($language->code); ?>"
                                    class="form-control <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                </div>
                              </div>
                              <div class="col-lg-8">
                                <div class="form-group">
                                  <label for=""><?php echo e(__('Address') . '*'); ?></label>
                                  <input type="text" name="<?php echo e($language->code); ?>_address" id="address_<?php echo e($language->code); ?>"
                                    class="form-control <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>"
                                    placeholder="<?php echo e(__('Address')); ?>">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for=""><?php echo e(__('County') . '*'); ?></label>
                                  <input type="text" name="<?php echo e($language->code); ?>_country" id="country_<?php echo e($language->code); ?>"
                                    placeholder="<?php echo e(__('Country')); ?>"
                                    class="form-control <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for=""><?php echo e(__('State')); ?></label>
                                  <input type="text" name="<?php echo e($language->code); ?>_state" id="state_<?php echo e($language->code); ?>"
                                    class="form-control <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>"
                                    placeholder="<?php echo e(__('State')); ?>">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for=""><?php echo e(__('City') . '*'); ?></label>
                                  <input type="text" name="<?php echo e($language->code); ?>_city" id="city_<?php echo e($language->code); ?>"
                                    class="form-control <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>"
                                    placeholder="<?php echo e(__('City')); ?>">
                                </div>
                              </div>
                            </div>
                          <?php endif; ?>

                          <div class="row">
                            <div class="col">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Description') . '*'); ?></label>
                                <textarea id="descriptionTmce<?php echo e($language->id); ?>" class="form-control summernote"
                                  name="<?php echo e($language->code); ?>_description" placeholder="<?php echo e(__('Enter Event Description')); ?>" data-height="300"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Refund Policy')); ?> *</label>
                                <textarea class="form-control" name="<?php echo e($language->code); ?>_refund_policy" rows="5"
                                  placeholder="<?php echo e(__('Enter Refund Policy')); ?>"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Keywords')); ?></label>
                                <input class="form-control" name="<?php echo e($language->code); ?>_meta_keywords"
                                  placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Description')); ?></label>
                                <textarea class="form-control" name="<?php echo e($language->code); ?>_meta_description" rows="5"
                                  placeholder="<?php echo e(__('Enter Meta Description')); ?>"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <?php $currLang = $language; ?>

                              <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($language->id == $currLang->id) continue; ?>

                                <div class="form-check py-0">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"
                                      onchange="cloneInput('collapse<?php echo e($currLang->id); ?>', 'collapse<?php echo e($language->id); ?>', event)">
                                    <span class="form-check-sign"><?php echo e(__('Clone for')); ?>

                                      <strong class="text-capitalize text-secondary"><?php echo e($language->name); ?></strong>
                                      <?php echo e(__('language')); ?></span>
                                  </label>
                                </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                            <?php if(request()->input('type') == 'venue'): ?>
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
                                                              <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="form-group">
                                                                  <label for="">Titulo do ingresso
                                                                    
                                                                  </label>
                                                                  <input type="text" name="ticket[<?php echo e($language->code); ?>_variation_name][]"
                                                                    class="form-control">
                                                                </div>
                                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                                                <label for="unlimited_1" class="unlimited_1 d-none"><?php echo e(__('Unlimited')); ?></label>
                                                              </div>
                            
                                                              <div class="form-group" id="input_1">
                                                                <label for="">Quantidaded</label>
                                                                <input type="text" name="ticket[v_ticket_available][]" value=""
                                                                  class="form-control">
                                                              </div>
                                                            </td> -->
                            
                                                            <?php if($websiteInfo->event_guest_checkout_status != 1): ?>
                                                              <td>
                                                                <div class="from-group mt-1">
                                                                  <input type="checkbox" checked name="ticket[v_max_ticket_buy_type][]" value="limited"
                                                                    class="max_ticket_buy_type" id="buy_limited_1" data-id="1">
                                                                  <label for="buy_limited_1" class="buy_limited_1 "><?php echo e(__('Limited')); ?></label>
                            
                                                                  <input type="checkbox" name="ticket[v_max_ticket_buy_type][]" value="unlimited"
                                                                    class="max_ticket_buy_type d-none" id="buy_unlimited_1" data-id="1">
                                                                  <label for="buy_unlimited_1"
                                                                    class="buy_unlimited_1 d-none"><?php echo e(__('Unlimited')); ?></label>
                                                                </div>
                            
                                                                <div class="form-group" id="input2_1">
                                                                  <label for=""><?php echo e(__('Max ticket for each customer') . '*'); ?> </label>
                                                                  <input type="text" name="ticket[v_max_ticket_buy][]" class="form-control">
                                                                </div>
                                                              </td>
                                                            <?php else: ?>
                                                              <input type="hidden" name="ticket[v_max_ticket_buy_type][]" value="unlimited">
                                                              <input type="hidden" name="ticket[v_max_ticket_buy][]" class="form-control">
                                                            <?php endif; ?>
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
                                                    <label for=""><?php echo e(__('Price')); ?> (<?php echo e($getCurrencyInfo->base_currency_text); ?>)
                                                      *</label>
                                                    <input type="number" name="ticket[price]" class="form-control" placeholder="Enter Price">
                                                  </div>
                                                </div>
                            
                                                <div class="col-lg-12 d-none" id="early_bird_discount_free">
                                                  <div class="form-group mt-1">
                                                    <label for=""><?php echo e(__('Early Bird Discount') . '*'); ?></label>
                                                    <div class="selectgroup w-100">
                                                      <label class="selectgroup-item">
                                                        <input type="radio" name="ticket[early_bird_discount_type]" value="disable"
                                                          class="selectgroup-input" checked>
                                                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                                                      </label>
                            
                                                      <label class="selectgroup-item">
                                                        <input type="radio" name="ticket[early_bird_discount_type]" value="enable"
                                                          class="selectgroup-input">
                                                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                                                      </label>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-lg-12 d-none" id="early_bird_dicount">
                                                  <div class="row">
                                                    <div class="col-lg-3">
                                                      <div class="form-group">
                                                        <label for=""><?php echo e(__('Discount') . '*'); ?></label>
                                                        <select name="ticket[discount_type]" class="form-control">
                                                          <option disabled><?php echo e(__('Select Discount Type')); ?></option>
                                                          <option value="fixed"><?php echo e(__('Fixed')); ?></option>
                                                          <option value="percentage"><?php echo e(__('Percentage')); ?></option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                      <div class="form-group">
                                                        <label for=""><?php echo e(__('Amount') . '*'); ?></label>
                                                        <input type="number" name="ticket[early_bird_discount_amount]" class="form-control">
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                      <div class="form-group">
                                                        <label for=""><?php echo e(__('Discount End Date') . '*'); ?></label>
                                                        <input type="date" name="ticket[early_bird_discount_date]" class="form-control">
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                      <div class="form-group">
                                                        <label for=""><?php echo e(__('Discount End Time') . '*'); ?></label>
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
                                                        <label for=""><?php echo e(__('Total Number of Available Tickets') . '*'); ?></label>
                                                        <div class="selectgroup w-100">
                                                          <label class="selectgroup-item">
                                                            <input type="radio" name="ticket[ticket_available_type]" value="unlimited"
                                                              class="selectgroup-input" checked>
                                                            <span class="selectgroup-button"><?php echo e(__('Unlimited')); ?></span>
                                                          </label>
                            
                                                          <label class="selectgroup-item">
                                                            <input type="radio" name="ticket[ticket_available_type]" value="limited"
                                                              class="selectgroup-input">
                                                            <span class="selectgroup-button"><?php echo e(__('Limited')); ?></span>
                                                          </label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-6 d-none" id="ticket_available">
                                                      <div class="form-group">
                                                        <label><?php echo e(__('Enter total number of available tickets') . '*'); ?></label>
                                                        <input type="number" name="ticket[ticket_available]"
                                                          placeholder="Enter total number of available tickets" class="form-control">
                                                      </div>
                                                    </div>
                            
                                                    <?php if($websiteInfo->event_guest_checkout_status != 1): ?>
                                                      <div class="col-lg-6">
                                                        <div class="form-group mt-1">
                                                          <label
                                                            for=""><?php echo e(__('Maximum number of tickets for each customer') . '*'); ?></label>
                                                          <div class="selectgroup w-100">
                                                            <label class="selectgroup-item">
                                                              <input type="radio" name="ticket[max_ticket_buy_type]" value="unlimited"
                                                                class="selectgroup-input" checked>
                                                              <span class="selectgroup-button"><?php echo e(__('Unlimited')); ?></span>
                                                            </label>
                            
                                                            <label class="selectgroup-item">
                                                              <input type="radio" name="ticket[max_ticket_buy_type]" value="limited"
                                                                class="selectgroup-input">
                                                              <span class="selectgroup-button"><?php echo e(__('Limited')); ?></span>
                                                            </label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    <?php else: ?>
                                                      <input type="hidden" name="ticket[max_ticket_buy_type]" value="unlimited">
                                                    <?php endif; ?>
                            
                                                    <div class="col-lg-6 d-none" id="max_buy_ticket">
                                                      <div class="form-group">
                                                        <label><?php echo e(__('Enter Maximum number of tickets for each customer') . '*'); ?></label>
                                                        <input type="number" name="ticket[max_buy_ticket]"
                                                          placeholder="<?php echo e(__('Enter Maximum number of tickets for each customer')); ?>"
                                                          class="form-control">
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <!----Ticekt limtit & ticket for each customer start----->
                            
                                              </div>
                                            <?php endif; ?>
                                            <?php if(request()->input('type') == 'online'): ?>
                                              <div class="row">
                                                <div class="col-lg-6">
                                                  <div class="">
                                                    <div class="form-group">
                                                      <label for=""><?php echo e(__('Price')); ?> <?php echo e($getCurrencyInfo->base_currency_text); ?></label>
                                                      <input type="number" name="price" id="ticket[ticket-pricing]" class="form-control">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <input type="checkbox" name="ticket[pricing_type]" value="free" class="" id="free_ticket">
                                                    <label for="free_ticket"><?php echo e(__('Tickets are Free')); ?></label>
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="form-group">
                                                    <label for=""><?php echo e(__('Ticket Available')); ?></label>
                                                    <input type="number" name="ticket[ticket_available]" class="form-control">
                                                  </div>
                                                </div>
                                                <div class="row" id="early_bird_discount_free">
                                                  <div class="col-lg-12">
                                                    <div class="form-group mt-1">
                                                      <label for=""><?php echo e(__('Early Bird Discount') . '*'); ?></label>
                                                      <div class="selectgroup w-100">
                                                        <label class="selectgroup-item">
                                                          <input type="radio" name="ticket[[early_bird_discount_type]" value="disable"
                                                            class="selectgroup-input" checked>
                                                          <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                                                        </label>
                            
                                                        <label class="selectgroup-item">
                                                          <input type="radio" name="ticket[early_bird_discount_type]" value="enable"
                                                            class="selectgroup-input">
                                                          <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                                                        </label>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-12 d-none" id="early_bird_dicount">
                                                    <div class="row">
                                                      <div class="col-lg-3">
                                                        <div class="form-group">
                                                          <label for=""><?php echo e(__('Discount')); ?></label>
                                                          <select name="ticket[discont_type]" class="form-control">
                                                            <option disabled><?php echo e(__('Select Discount Type')); ?></option>
                                                            <option value="fixed"><?php echo e(__('Fixed')); ?></option>
                                                            <option value="percentage"><?php echo e(__('Percentage')); ?></option>
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-3">
                                                        <div class="form-group">
                                                          <label for=""><?php echo e(__('Amount')); ?></label>
                                                          <input type="number" name="ticket[early_bird_discount_amount]" class="form-control">
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-3">
                                                        <div class="form-group">
                                                          <label for=""><?php echo e(__('Discount End Date')); ?></label>
                                                          <input type="date" name="ticket[early_bird_discount_date]" class="form-control">
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-3">
                                                        <div class="form-group">
                                                          <label for=""><?php echo e(__('Discount End Time')); ?></label>
                                                          <input type="time" name="ticket[early_bird_discount_time]" class="form-control">
                                                        </div>
                                                      </div>
                            
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            <?php endif; ?>
                            
                                            <div id="accordion" class="mt-3">
                                              <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="version">
                                                    
                            
                                                  <div id="collapse<?php echo e($language->id); ?>"
                                                    class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                                                    aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                                                    <div class="version-body">
                                                      <div class="row">
                                                        <div class="col-lg-12">
                                                          <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                                            <label><?php echo e(__('Ticket Name') . '*'); ?></label>
                                                            <input type="text" name="ticket[<?php echo e($language->code); ?>_title]"
                                                              placeholder="<?php echo e(__('Enter Ticket Name')); ?>" class="form-control">
                                                          </div>
                                                        </div>
                                                      </div>
                            
                                                      <div class="row">
                                                        <div class="col">
                                                          <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                                            <label><?php echo e(__('Description')); ?></label>
                                                            <textarea class="form-control" name="ticket[<?php echo e($language->code); ?>_description]"
                                                              placeholder="<?php echo e(__('Enter Description')); ?>"></textarea>
                                                          </div>
                                                        </div>
                                                      </div>
                            
                                                      <div class="row">
                                                        <div class="col">
                                                          <?php $currLang = $language; ?>
                            
                                                          <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($language->id == $currLang->id) continue; ?>
                            
                                                            <div class="form-check py-0">
                                                              <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox"
                                                                  onchange="cloneInput('collapse<?php echo e($currLang->id); ?>', 'collapse<?php echo e($language->id); ?>', event)">
                                                                <span class="form-check-sign"><?php echo e(__('Clone for')); ?> <strong
                                                                    class="text-capitalize text-secondary"><?php echo e($language->name); ?></strong>
                                                                  <?php echo e(__('language')); ?></span>
                                                              </label>
                                                            </div>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php echo e(__('Save')); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        <?php
            $names = '';
            foreach ($languages as $language) {
                $varitaion_name = $language->code . '_variation_name[]';
                $names .= "<div class='form-group'><label for=''>Titulo do ingresso</label><input type='text' name='$varitaion_name' class='form-control'></div>";
            }
        ?>
        let BaseCTxt = "<?php echo e($getCurrencyInfo->base_currency_text); ?>";
        var names = "<?php echo $names; ?>";
        var guest_checkout_status = "<?php echo e($websiteInfo->event_guest_checkout_status); ?>";
        let languages = "<?php echo e($languages); ?>";
    </script>
  <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/admin-partial.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/admin_dropzone.js')); ?>"></script>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('variables'); ?>
  <script>
    "use strict";
    var storeUrl = "<?php echo e(route('organizer.event.imagesstore')); ?>";
    var removeUrl = "<?php echo e(route('organizer.event.imagermv')); ?>";
    var loadImgs = 0;
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vuescripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('organizer.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/organizer/event/create.blade.php ENDPATH**/ ?>
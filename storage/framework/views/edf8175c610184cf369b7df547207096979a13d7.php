

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Edit Event')); ?></h4>
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
        <a
          href="<?php echo e(route('organizer.event_management.event', ['language' => $defaultLang->code])); ?>"><?php echo e(__('All Events')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <?php
        $event_title = DB::table('event_contents')
            ->where('language_id', $defaultLang->id)
            ->where('event_id', $event->id)
            ->select('title')
            ->first();
        if (empty($event_title)) {
            $event_title = DB::table('event_contents')
                ->where('event_id', $event->id)
                ->select('title')
                ->first();
        }

      ?>
      <li class="nav-item">
        <a href="#">
          <?php echo e(strlen($event_title->title) > 35 ? mb_substr($event_title->title, 0, 35, 'UTF-8') . '...' : $event_title->title); ?>

        </a>

      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Event')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Edit Event')); ?></div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(url()->previous()); ?>">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
          <a class="mr-2 btn btn-success btn-sm float-right d-inline-block"
            href="<?php echo e(route('event.details', ['slug' => eventSlug($defaultLang->id, $event->id), 'id' => $event->id])); ?>"
            target="_blank">
            <span class="btn-label">
              <i class="fas fa-eye"></i>
            </span>
            <?php echo e(__('Preview')); ?>

          </a>
          <?php if($event->event_type == 'venue'): ?>
            <a class="mr-2 btn btn-secondary btn-sm float-right d-inline-block"
              href="<?php echo e(route('organizer.event.ticket', ['language' => $defaultLang->code, 'event_id' => $event->id, 'event_type' => $event->event_type])); ?>"
              target="_blank">
              <span class="btn-label">
                <i class="far fa-ticket"></i>
              </span>
              <?php echo e(__('Tickets')); ?>

            </a>
          <?php endif; ?>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="alert alert-danger pb-1 dis-none" id="eventErrors">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <ul></ul>
              </div>
              <div class="col-lg-12">
                <label for="" class="mb-2"><strong><?php echo e(__('Gallery Images')); ?> **</strong></label>
                <div id="reload-slider-div">
                  <div class="row mt-2">
                    <div class="col">
                      <table class="table" id="img-table">

                      </table>
                    </div>
                  </div>
                </div>
                <form action="<?php echo e(route('organizer.event.imagesstore')); ?>" id="my-dropzone" enctype="multipart/formdata"
                  class="dropzone create">
                  <?php echo csrf_field(); ?>
                  <div class="fallback">
                    <input name="file" type="file" />
                  </div>
                  <input type="hidden" value="<?php echo e($event->id); ?>" name="event_id">
                </form>
                <div class=" mb-0" id="errpreimg">

                </div>
                <p class="text-warning"><?php echo e(__('Image Size') . ' : 1170x570'); ?></p>
              </div>

              <form id="eventForm" action="<?php echo e(route('organizer.event.update')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="event_id" value="<?php echo e($event->id); ?>">
                <input type="hidden" name="event_type" value="<?php echo e($event->event_type); ?>">
                <input type="hidden" name="gallery_images" value="0">
                <div class="form-group">
                  <label for=""><?php echo e(__('Thumbnail Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <img
                      src="<?php echo e($event->thumbnail ? asset('assets/admin/img/event/thumbnail/' . $event->thumbnail) : asset('assets/admin/img/noimage.jpg')); ?>"
                      alt="..." class="uploaded-img">
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
                          <input type="radio" name="date_type" <?php echo e($event->date_type == 'single' ? 'checked' : ''); ?>

                            value="single" class="selectgroup-input eventDateType" checked>
                          <span class="selectgroup-button"><?php echo e(__('Single')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="date_type" <?php echo e($event->date_type == 'multiple' ? 'checked' : ''); ?>

                            value="multiple" class="selectgroup-input eventDateType">
                          <span class="selectgroup-button"><?php echo e(__('Multiple')); ?></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row countDownStatus <?php echo e($event->date_type == 'multiple' ? 'd-none' : ''); ?> ">
                  <div class="col-lg-12">
                    <div class="form-group mt-1">
                      <label for=""><?php echo e(__('Countdown Status') . '*'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="countdown_status" value="1" class="selectgroup-input"
                            <?php echo e($event->countdown_status == 1 ? 'checked' : ''); ?>>
                          <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="countdown_status" value="0" class="selectgroup-input"
                            <?php echo e($event->countdown_status == 0 ? 'checked' : ''); ?>>
                          <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                
                <div class="row <?php echo e($event->date_type == 'multiple' ? 'd-none' : ''); ?>" id="single_dates">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Start Date') . '*'); ?></label>
                      <input type="date" name="start_date" value="<?php echo e($event->start_date); ?>"
                        placeholder="Enter Start Date" class="form-control">
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Start Time') . '*'); ?></label>
                      <input type="time" name="start_time" value="<?php echo e($event->start_time); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('End Date"') . '*'); ?></label>
                      <input type="date" name="end_date" value="<?php echo e($event->end_date); ?>"
                        placeholder="Enter End Date" class="form-control">
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for=""><?php echo e(__('End Time') . '*'); ?></label>
                      <input type="time" name="end_time" value="<?php echo e($event->end_time); ?>" class="form-control">
                    </div>
                  </div>
                </div>

                
                <div class="row">
                  <div class="col-lg-12 <?php echo e($event->date_type == 'single' ? 'd-none' : ''); ?>" id="multiple_dates">
                    <?php if($event->date_type == 'multiple'): ?>
                      <?php
                        $event_dates = $event->dates()->get();
                      ?>
                    <?php else: ?>
                      <?php
                        $event_dates = [];
                      ?>
                    <?php endif; ?>
                    <div class="form-group">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th><?php echo e(__('Start Date')); ?></th>
                              <th><?php echo e(__('Start Time')); ?></th>
                              <th><?php echo e(__('End Date')); ?></th>
                              <th><?php echo e(__('End Time')); ?></th>
                              <th><a href="javascrit:void(0)" class="btn btn-success addDateRow"><i
                                    class="fas fa-plus-circle"></i></a></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(count($event_dates) > 0): ?>
                              <?php $__currentLoopData = $event_dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td>
                                    <div class="form-group">
                                      <label for=""><?php echo e(__('Start Date') . '*'); ?></label>
                                      <input type="date" name="m_start_date[]" class="form-control"
                                        value="<?php echo e($date->start_date); ?>">
                                    </div>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                      <label for=""><?php echo e(__('Start Time') . '*'); ?></label>
                                      <input type="time" name="m_start_time[]" class="form-control"
                                        value="<?php echo e($date->start_time); ?>">
                                    </div>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                      <label for=""><?php echo e(__('End Date') . '*'); ?>

                                      </label>
                                      <input type="date" name="m_end_date[]" class="form-control"
                                        value="<?php echo e($date->end_date); ?>">
                                    </div>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                      <label for=""><?php echo e(__('End Time') . '*'); ?>

                                      </label>
                                      <input type="time" name="m_end_time[]" class="form-control"
                                        value="<?php echo e($date->end_time); ?>">
                                    </div>
                                  </td>
                                  <input type="hidden" name="date_ids[]" value="<?php echo e($date->id); ?>">
                                  <td>
                                    <a href="javascript:void(0)"
                                      data-url="<?php echo e(route('admin.event.delete.date', $date->id)); ?>"
                                      class="btn btn-danger deleteDateDbRow">
                                      <i class="fas fa-minus"></i></a>
                                  </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
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
                                    <label for=""><?php echo e(__('End Date') . '*'); ?>

                                    </label>
                                    <input type="date" name="m_end_date[]" class="form-control">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <label for=""><?php echo e(__('End Time') . '*'); ?>

                                    </label>
                                    <input type="time" name="m_end_time[]" class="form-control">
                                  </div>
                                </td>
                                <td>
                                  <a href="javascript:void(0)" class="btn btn-danger deleteDateRow">
                                    <i class="fas fa-minus"></i></a>
                                </td>
                              </tr>
                            <?php endif; ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>



                <div class="row ">

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Status') . '*'); ?></label>
                      <select name="status" class="form-control">
                        <option selected disabled><?php echo e(__('Select a Status')); ?></option>
                        <option <?php echo e($event->status == '1' ? 'selected' : ''); ?> value="1">
                          <?php echo e(__('Active')); ?>

                        </option>
                        <option <?php echo e($event->status == '0' ? 'selected' : ''); ?> value="0">
                          <?php echo e(__('Deactive')); ?>

                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Is Feature') . '*'); ?></label>
                      <select name="is_featured" class="form-control">
                        <option selected disabled><?php echo e(__('Select')); ?></option>
                        <option value="yes" <?php echo e($event->is_featured == 'yes' ? 'selected' : ''); ?>>
                          <?php echo e(__('Yes')); ?>

                        </option>
                        <option value="no" <?php echo e($event->is_featured == 'no' ? 'selected' : ''); ?>>
                          <?php echo e(__('No')); ?>

                        </option>
                      </select>
                    </div>
                  </div>

                  
                </div>
                <?php if($event->event_type == 'online'): ?>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group mt-1">
                        <label for=""><?php echo e(__('Total Number of Available Tickets') . '*'); ?></label>
                        <div class="selectgroup w-100">
                          <label class="selectgroup-item">
                            <input type="radio" name="ticket_available_type" value="unlimited"
                              class="selectgroup-input"
                              <?php echo e(@$event->ticket->ticket_available_type == 'unlimited' ? 'checked' : ''); ?>>
                            <span class="selectgroup-button"><?php echo e(__('Unlimited')); ?></span>
                          </label>

                          <label class="selectgroup-item">
                            <input type="radio" name="ticket_available_type" value="limited"
                              class="selectgroup-input"
                              <?php echo e(@$event->ticket->ticket_available_type == 'limited' ? 'checked' : ''); ?>>
                            <span class="selectgroup-button"><?php echo e(__('Limited')); ?></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 <?php echo e(@$event->ticket->ticket_available_type == 'limited' ? '' : 'd-none'); ?>"
                      id="ticket_available">
                      <div class="form-group">
                        <label><?php echo e(__('Enter total number of available tickets') . '*'); ?></label>
                        <input type="number" name="ticket_available"
                          placeholder="<?php echo e(__('Enter total number of available tickets')); ?>" class="form-control"
                          value="<?php echo e(@$event->ticket->ticket_available); ?>">
                      </div>
                    </div>
                    <?php if($websiteInfo->event_guest_checkout_status != 1): ?>
                      <div class="col-lg-6">
                        <div class="form-group mt-1">
                          <label for=""><?php echo e(__('Maximum number of tickets for each customer') . '*'); ?></label>
                          <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                              <input type="radio" name="max_ticket_buy_type" value="unlimited"
                                class="selectgroup-input"
                                <?php echo e(@$event->ticket->max_ticket_buy_type == 'unlimited' ? 'checked' : ''); ?>>
                              <span class="selectgroup-button"><?php echo e(__('Unlimited')); ?></span>
                            </label>

                            <label class="selectgroup-item">
                              <input type="radio" name="max_ticket_buy_type" value="limited"
                                class="selectgroup-input"
                                <?php echo e(@$event->ticket->max_ticket_buy_type == 'limited' ? 'checked' : ''); ?>>
                              <span class="selectgroup-button"><?php echo e(__('Limited')); ?></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 <?php echo e(@$event->ticket->max_ticket_buy_type == 'limited' ? '' : 'd-none'); ?>"
                        id="max_buy_ticket">
                        <div class="form-group">
                          <label><?php echo e(__('Enter Maximum number of tickets for each customer') . '*'); ?></label>
                          <input type="number" name="max_buy_ticket"
                            placeholder="<?php echo e(__('Enter Maximum number of tickets for each customer')); ?>"
                            class="form-control" value="<?php echo e(@$event->ticket->max_buy_ticket); ?>">
                        </div>
                      </div>
                    <?php else: ?>
                      <input type="hidden" name="max_ticket_buy_type" value="unlimited">
                    <?php endif; ?>

                    <div class="col-lg-4">
                      <div class="">
                        <div class="form-group">
                          <label for=""><?php echo e(__('Price')); ?>

                            (<?php echo e($getCurrencyInfo->base_currency_text); ?>)
                            *</label>
                          <input type="number" name="price" id="ticket-pricing"
                            value="<?php echo e($event->ticket->price); ?>" placeholder="<?php echo e(__('Enter Price')); ?>"
                            class="form-control <?php echo e(optional($event->ticket)->pricing_type == 'free' ? 'd-none' : ''); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="checkbox" name="pricing_type"
                          <?php echo e(optional($event->ticket)->pricing_type == 'free' ? 'checked' : ''); ?> value="free"
                          class="" id="free_ticket"> <label
                          for="free_ticket"><?php echo e(__('Tickets are Free')); ?></label>
                      </div>
                    </div>
                  </div>



                  <div class="row <?php echo e(optional($event->ticket)->pricing_type == 'free' ? 'd-none' : ''); ?>"
                    id="early_bird_discount_free">
                    <div class="col-lg-12">
                      <div class="form-group mt-1">
                        <label for=""><?php echo e(__('Early Bird Discount') . '*'); ?></label>
                        <div class="selectgroup w-100">
                          <label class="selectgroup-item">
                            <input type="radio" name="early_bird_discount_type"
                              <?php echo e(optional($event->ticket)->early_bird_discount == 'disable' ? 'checked' : ''); ?>

                              value="disable" class="selectgroup-input" checked>
                            <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                          </label>

                          <label class="selectgroup-item">
                            <input type="radio" name="early_bird_discount_type"
                              <?php echo e(optional($event->ticket)->early_bird_discount == 'enable' ? 'checked' : ''); ?>

                              value="enable" class="selectgroup-input">
                            <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div
                      class="col-lg-12 <?php echo e(optional($event->ticket)->early_bird_discount == 'disable' ? 'd-none' : ''); ?>"
                      id="early_bird_dicount">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Discount')); ?> *</label>
                            <select name="discount_type" class="form-control discount_type">
                              <option disabled><?php echo e(__('Select Discount Type')); ?></option>
                              <option
                                <?php echo e(optional($event->ticket)->early_bird_discount_type == 'fixed' ? 'selected' : ''); ?>

                                value="fixed"><?php echo e(__('Fixed')); ?></option>
                              <option
                                <?php echo e(optional($event->ticket)->early_bird_discount_type == 'percentage' ? 'selected' : ''); ?>

                                value="percentage"><?php echo e(__('Percentage')); ?></option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Amount')); ?> *</label>
                            <input type="number" name="early_bird_discount_amount"
                              value="<?php echo e(optional($event->ticket)->early_bird_discount_amount); ?>"
                              class="form-control early_bird_discount_amount">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Discount End Date')); ?> *</label>
                            <input type="date" name="early_bird_discount_date"
                              value="<?php echo e(optional($event->ticket)->early_bird_discount_date); ?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Discount End Time')); ?> *</label>
                            <input type="time" name="early_bird_discount_time"
                              value="<?php echo e(optional($event->ticket)->early_bird_discount_time); ?>" class="form-control">
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                <?php endif; ?>


                <div id="accordion" class="mt-3">
                  <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="version">
                      <div class="version-header" id="heading<?php echo e($language->id); ?>">
                        <h5 class="mb-0">
                          <button type="button" class="btn btn-link" data-toggle="collapse"
                            data-target="#collapse<?php echo e($language->id); ?>"
                            aria-expanded="<?php echo e($language->is_default == 1 ? 'true' : 'false'); ?>"
                            aria-controls="collapse<?php echo e($language->id); ?>">
                            <?php echo e($language->name . ' ' . __('Language')); ?>

                            <?php echo e($language->is_default == 1 ? '(' . __('Default') . ')' : ''); ?>

                          </button>
                        </h5>
                      </div>
                      <?php
                        $event_content = DB::table('event_contents')
                            ->where('language_id', $language->id)
                            ->where('event_id', $event->id)
                            ->first();
                      ?>
                      <div id="collapse<?php echo e($language->id); ?>"
                        class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                        aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                        <div class="version-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Event Title') . '*'); ?></label>
                                <input type="text" class="form-control" name="<?php echo e($language->code); ?>_title"
                                  value="<?php echo e(@$event_content->title); ?>" placeholder="<?php echo e(__('Enter Event Name')); ?>">
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
                                    <option value="<?php echo e($category->id); ?>"
                                      <?php echo e(@$event_content->event_category_id == $category->id ? 'selected' : ''); ?>>
                                      <?php echo e($category->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                            </div>
                          </div>

                          <?php if($event->event_type == 'venue'): ?>
                            <div class="row">
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for=""><?php echo e(__('Zip/Post Code ')); ?></label>
                                  <input type="text" placeholder="<?php echo e(__('Enter Zip/Post Code')); ?>"
                                    name="<?php echo e($language->code); ?>_zip_code" id="zip_code" data-language="<?php echo e($language->code); ?>"
                                    class="form-control <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>"
                                    value="<?php echo e(@$event_content->zip_code); ?>">
                                </div>
                              </div>
                              <div class="col-lg-8">
                                <div class="form-group">
                                  <label for=""><?php echo e(__('Address') . '*'); ?></label>
                                  <input type="text" name="<?php echo e($language->code); ?>_address" id="address_<?php echo e($language->code); ?>"
                                    class="form-control <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>"
                                    placeholder="<?php echo e(__('Enter Address')); ?>" value="<?php echo e(@$event_content->address); ?>">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for=""><?php echo e(__('County') . '*'); ?></label>
                                  <input type="text" name="<?php echo e($language->code); ?>_country" id="country_<?php echo e($language->code); ?>"
                                    placeholder="<?php echo e(__('Enter Country')); ?>"
                                    class="form-control <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>"
                                    value="<?php echo e(@$event_content->country); ?>">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for=""><?php echo e(__('State')); ?></label>
                                  <input type="text" name="<?php echo e($language->code); ?>_state" id="state_<?php echo e($language->code); ?>"
                                    class="form-control <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>"
                                    placeholder="<?php echo e(__('Enter State')); ?>" value="<?php echo e(@$event_content->state); ?>">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label for=""><?php echo e(__('City') . '*'); ?></label>
                                  <input type="text" name="<?php echo e($language->code); ?>_city" id="city_<?php echo e($language->code); ?>"
                                    class="form-control <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>"
                                    placeholder="<?php echo e(__('Enter City')); ?>" value="<?php echo e(@$event_content->city); ?>">
                                </div>
                              </div>
                            </div>
                          <?php endif; ?>

                          <div class="row">
                            <div class="col">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Description') . '*'); ?></label>
                                <textarea id="descriptionTmce<?php echo e($language->id); ?>" class="form-control summernote"
                                  name="<?php echo e($language->code); ?>_description" placeholder="<?php echo e(__('Enter Event Description')); ?>" data-height="300"><?php echo @$event_content->description; ?></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Refund Policy')); ?> *</label>
                                <textarea class="form-control" name="<?php echo e($language->code); ?>_refund_policy" rows="5"
                                  placeholder="<?php echo e(__('Enter Refund Policy')); ?>"><?php echo e(@$event_content->refund_policy); ?></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Keywords')); ?></label>
                                <input class="form-control" name="<?php echo e($language->code); ?>_meta_keywords"
                                  value="<?php echo e(@$event_content->meta_keywords); ?>"
                                  placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Description')); ?></label>
                                <textarea class="form-control" name="<?php echo e($language->code); ?>_meta_description" rows="5"
                                  placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e(@$event_content->meta_description); ?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <?php
                              $information = App\Models\Event\Ticket::where('event_id', $event->id)->get();
                            ?>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-4">
                                              <div class="card-title d-inline-block">
                                                <?php echo e(__('Tickets')); ?>

                                              </div>
                                            </div>
                                            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                                              <a href="<?php echo e(route('organizer.event.add.ticket', ['language' => $defaultLang->code, 'event_id' => request()->input('event_id'), 'event_type' => request()->input('event_type')])); ?>"
                                                class="btn btn-secondary btn-sm float-right mr-2"><i class="fas fa-plus-circle"></i>
                                                <?php echo e(__('Add Ticket')); ?></a>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-lg-12">
    
                                          <?php if(session()->has('course_status_warning')): ?>
                                            <div class="alert alert-warning">
                                              <p class="text-dark mb-0"><?php echo e(session()->get('course_status_warning')); ?></p>
                                            </div>
                                          <?php endif; ?>
    
                                          <?php if(count($information) == 0): ?>
                                            <h3 class="text-center mt-2"><?php echo e(__('NO TICKET FOUND') . '!'); ?></h3>
                                          <?php else: ?>
                                            <div class="table-responsive">
                                              <table class="table table-striped mt-3" id="basic-datatables">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">
                                                      <input type="checkbox" class="bulk-check" data-val="all">
                                                    </th>
                                                    <th scope="col"><?php echo e(__('Title')); ?></th>
                                                    <th scope="col"><?php echo e(__('Ticket Available')); ?></th>
                                                    <th scope="col"><?php echo e(__('Price')); ?></th>
                                                    <th scope="col"><?php echo e(__('Actions')); ?></th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php $__currentLoopData = $information; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                      <td width="5%">
                                                        <input type="checkbox" class="bulk-check" data-val="<?php echo e($ticket->id); ?>">
                                                      </td>
                                                      <td width="20%">
                                                        <?php
                                                          $ticket_content = App\Models\Event\TicketContent::where([['language_id', $language->id], ['ticket_id', $ticket->id]])->first();
                                                          if (empty($ticket_content)) {
                                                              $ticket_content = App\Models\Event\TicketContent::where('ticket_id', $ticket->id)->first();
                                                          }
                                                        ?>
                                                        <?php echo e(@$ticket_content->title); ?>

                                                      </td>
                                                      <td width="20%">
                                                        <?php if($ticket->pricing_type == 'variation'): ?>
                                                          <?php
                                                            $variation = json_decode($ticket->variations, true);
                                                          ?>
                                                          <?php $__currentLoopData = $variation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($v['ticket_available_type'] == 'unlimited'): ?>
                                                              <?php echo e(__('Unlimited')); ?>

                                                            <?php else: ?>
                                                              <?php echo e($v['ticket_available']); ?>

                                                            <?php endif; ?>
                                                            <?php if(!$loop->last): ?>
                                                              ,
                                                            <?php endif; ?>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                          <?php if($ticket->ticket_available_type == 'unlimited'): ?>
                                                            <span class="badge badge-info"><?php echo e($ticket->ticket_available_type); ?></span>
                                                          <?php else: ?>
                                                            <?php echo e($ticket->ticket_available); ?>

                                                          <?php endif; ?>
                                                        <?php endif; ?>
    
                                                      </td>
                                                      <td>
                                                        <?php if($ticket->pricing_type == 'normal'): ?>
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
                                                            <?php echo e(symbolPrice($ticket->price)); ?>

                                                          <?php endif; ?>
                                                        <?php elseif($ticket->pricing_type == 'variation'): ?>
                                                          <?php
                                                            $variation = json_decode($ticket->variations, true);
                                                          ?>
                                                          <?php $__currentLoopData = $variation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($ticket->early_bird_discount == 'enable'): ?>
                                                              <?php
                                                                $discount_date = Carbon\Carbon::parse($ticket->early_bird_discount_date . $ticket->early_bird_discount_time);
                                                              ?>
    
                                                              <?php if($ticket->early_bird_discount_type == 'fixed' && !$discount_date->isPast()): ?>
                                                                <?php
                                                                  $calculate_price = $v['price'] - $ticket->early_bird_discount_amount;
                                                                ?>
                                                                <?php echo e(symbolPrice($calculate_price)); ?>

                                                                <del>
    
                                                                  <?php echo e(symbolPrice($v['price'])); ?>

                                                                </del>
                                                              <?php elseif($ticket->early_bird_discount_type == 'percentage' && !$discount_date->isPast()): ?>
                                                                <?php
                                                                  $c_price = ($v['price'] * $ticket->early_bird_discount_amount) / 100;
                                                                  $calculate_price = $v['price'] - $c_price;
                                                                ?>
                                                                <?php echo e(symbolPrice($calculate_price)); ?>

    
                                                                <del>
                                                                  <?php echo e(symbolPrice($v['price'])); ?>

                                                                </del>
                                                              <?php else: ?>
                                                                <?php
                                                                  $calculate_price = $v['price'];
                                                                ?>
                                                                <?php echo e(symbolPrice($calculate_price)); ?>

                                                              <?php endif; ?>
                                                              <?php if(!$loop->last): ?>
                                                                ,
                                                              <?php endif; ?>
                                                            <?php else: ?>
                                                              <?php echo e(symbolPrice($v['price'])); ?>

                                                              <?php if(!$loop->last): ?>
                                                                ,
                                                              <?php endif; ?>
                                                            <?php endif; ?>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php elseif($ticket->pricing_type == 'free'): ?>
                                                          <span class="badge badge-info"><?php echo e(__('Free')); ?></span>
                                                        <?php endif; ?>
    
                                                      </td>
                                                      <td>
                                                        <div class="dropdown">
                                                          <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <?php echo e(__('Select')); ?>

                                                          </button>
    
                                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a href="<?php echo e(route('organizer.event.edit.ticket', ['language' => $defaultLang->code, 'event_id' => $event->id, 'event_type' => $ticket->event_type, 'id' => $ticket->id])); ?>"
                                                              class="dropdown-item">
                                                              <?php echo e(__('Edit')); ?>

                                                            </a>
    
                                                            <form class="deleteForm d-block"
                                                              action="<?php echo e(route('organizer.ticket_management.delete_ticket', ['id' => $ticket->id])); ?>"
                                                              method="post">
    
                                                              <?php echo csrf_field(); ?>
                                                              <button type="submit" class="btn btn-sm deleteBtn">
                                                                <?php echo e(__('Delete')); ?>

                                                              </button>
                                                            </form>
                                                          </div>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                              </table>
                                            </div>
                                          <?php endif; ?>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card-footer"></div>
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
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="EventSubmit" class="btn btn-primary">
                <?php echo e(__('Update')); ?>

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
  <?php
    $languages = App\Models\Language::get();
  ?>
  <script>
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

    var rmvdbUrl = "<?php echo e(route('organizer.event.imgdbrmv')); ?>";
    var loadImgs = "<?php echo e(route('organizer.event.images', $event->id)); ?>";
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('organizer.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/organizer/event/edit.blade.php ENDPATH**/ ?>
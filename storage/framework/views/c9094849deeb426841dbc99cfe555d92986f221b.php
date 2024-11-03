<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Edit Ticket')); ?></h4>
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

      <li class="nav-item">
        <a href="#">
          <?php echo e(strlen($event->title) > 35 ? mb_substr($event->title, 0, 35, 'UTF-8') . '...' : $event->title); ?>

        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a
          href="<?php echo e(route('organizer.event.ticket', ['language' => $defaultLang->code, 'event_id' => request()->input('event_id'), 'event_type' => request()->input('event_type')])); ?>"><?php echo e(__('Tickets')); ?></a>
      </li>

      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Ticket')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-8">
              <div class="card-title d-inline-block"><?php echo e(__('Edit Ticket')); ?></div>
            </div>
            <div class="col-lg-4">
              <a href="<?php echo e(route('organizer.event.ticket', ['language' => $defaultLang->code, 'event_id' => request()->input('event_id'), 'event_type' => request()->input('event_type')])); ?>"
                class="btn btn-info btn-sm float-right"><i class="fas fa-backward"></i>
                <?php echo e(__('Back')); ?></a>

              <a class="mr-2 btn btn-success btn-sm float-right d-inline-block"
                href="<?php echo e(route('event.details', ['slug' => eventSlug($defaultLang->id, request()->input('event_id')), 'id' => request()->input('event_id')])); ?>"
                target="_blank">
                <span class="btn-label">
                  <i class="fas fa-eye"></i>
                </span>
                <?php echo e(__('Preview')); ?>

              </a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="alert alert-danger pb-1 dis-none" id="eventErrors">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul></ul>
              </div>
              <form id="eventForm" action="<?php echo e(route('organizer.ticket_management.update_ticket')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="event_type" value="<?php echo e(request()->input('event_type')); ?>">
                <input type="hidden" name="event_id" value="<?php echo e(request()->input('event_id')); ?>">
                <input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">
                <?php if(request()->input('event_type') == 'venue'): ?>
                  <div class="row ">

                    
                    <div class="col-lg-12">
                      <div class="form-group mt-1">
                        <label for=""><?php echo e(__('Pricing') . '*'); ?></label>
                        <div class="selectgroup w-100">
                          <label class="selectgroup-item">
                            <input type="radio" name="pricing_type_2"
                              <?php echo e($ticket->pricing_type == 'free' ? 'checked' : ''); ?> value="free"
                              class="selectgroup-input" checked>
                            <span class="selectgroup-button"><?php echo e(__('Free Tickets')); ?></span>
                          </label>

                          <label class="selectgroup-item">
                            <input type="radio" name="pricing_type_2" value="variation"
                              <?php echo e($ticket->pricing_type == 'variation' ? 'checked' : ''); ?> class="selectgroup-input">
                            <span class="selectgroup-button"><?php echo e(__('Variation Wise')); ?></span>
                          </label>

                          <label class="selectgroup-item">
                            <input type="radio" name="pricing_type_2" value="normal"
                              <?php echo e($ticket->pricing_type == 'normal' ? 'checked' : ''); ?> class="selectgroup-input">
                            <span class="selectgroup-button"><?php echo e(__('Without Variation')); ?></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12 <?php echo e($ticket->pricing_type == 'variation' ? '' : 'd-none'); ?>"
                      id="variation_pricing">
                      <div class="form-group">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th><?php echo e(__('Variation Name')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('Available Tickets')); ?></th>
                                <?php if($websiteInfo->event_guest_checkout_status != 1): ?>
                                  <th><?php echo e(__('Max ticket for each customer')); ?></th>
                                <?php endif; ?>
                                <th><a href="javascrit:void(0)" class="btn btn-success btn-sm addRow"><i
                                      class="fas fa-plus-circle"></i></a></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if($variations != null): ?>
                                <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td>
                                      <?php
                                        $variation_contents = App\Models\Event\VariationContent::where([['ticket_id', $ticket->id], ['key', $key]])->get();

                                      ?>
                                      <?php $__currentLoopData = $variation_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                          $language = App\Models\Language::where('id', $variation_content->language_id)->first();
                                        ?>
                                        <div class="form-group">
                                          <label for=""><?php echo e(__('Variation Name') . '*'); ?>

                                            (<?php echo e($language->name); ?>)
                                          </label>
                                          <input type="text" name="<?php echo e($language->code); ?>_variation_name[]"
                                            class="form-control" value="<?php echo e($variation_content['name']); ?>">
                                        </div>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                      <div class="form-group">
                                        <label
                                          for=""><?php echo e(__('Price')); ?>(<?php echo e($getCurrencyInfo->base_currency_text); ?>)
                                          *</label>
                                        <input type="text" name="variation_price[]" value="<?php echo e($item['price']); ?>"
                                          class="form-control">
                                      </div>
                                    </td>
                                    <td>
                                      <div class="from-group mt-1">
                                        <input type="checkbox" <?php if($item['ticket_available_type'] == 'limited'): echo 'checked'; endif; ?>
                                          name="v_ticket_available_type[]" value="limited"
                                          class="ticket_available_type <?php echo e($item['ticket_available_type'] == 'unlimited' ? 'd-none' : ''); ?>"
                                          id="limited_<?php echo e($loop->iteration); ?>" data-id="<?php echo e($loop->iteration); ?>">
                                        <label for="limited_<?php echo e($loop->iteration); ?>"
                                          class="limited_<?php echo e($loop->iteration); ?> <?php echo e($item['ticket_available_type'] == 'unlimited' ? 'd-none' : ''); ?>"><?php echo e(__('Limited')); ?></label>

                                        <input type="checkbox" <?php if($item['ticket_available_type'] == 'unlimited'): echo 'checked'; endif; ?>
                                          name="v_ticket_available_type[]" value="unlimited"
                                          class="ticket_available_type <?php echo e($item['ticket_available_type'] == 'limited' ? 'd-none' : ''); ?>"
                                          id="unlimited_<?php echo e($loop->iteration); ?>" data-id="<?php echo e($loop->iteration); ?>">
                                        <label for="unlimited_<?php echo e($loop->iteration); ?>"
                                          class="unlimited_<?php echo e($loop->iteration); ?> <?php echo e($item['ticket_available_type'] == 'limited' ? 'd-none' : ''); ?>"><?php echo e(__('Unlimited')); ?></label>

                                      </div>

                                      <div
                                        class="form-group <?php echo e($item['ticket_available_type'] == 'unlimited' ? 'd-none' : ''); ?>"
                                        id="input_<?php echo e($loop->iteration); ?>">
                                        <label for=""><?php echo e(__('Ticket Available') . '*'); ?> </label>
                                        <input type="text" name="v_ticket_available[]"
                                          value="<?php echo e($item['ticket_available']); ?>" class="form-control">
                                      </div>
                                    </td>
                                    <?php if($websiteInfo->event_guest_checkout_status != 1): ?>
                                      <td>
                                        <div class="from-group mt-1">
                                          <input type="checkbox" <?php if($item['max_ticket_buy_type'] == 'limited'): echo 'checked'; endif; ?>
                                            name="v_max_ticket_buy_type[]" value="limited"
                                            class="max_ticket_buy_type <?php echo e($item['max_ticket_buy_type'] == 'unlimited' ? 'd-none' : ''); ?>"
                                            id="buy_limited_<?php echo e($loop->iteration); ?>" data-id="<?php echo e($loop->iteration); ?>">
                                          <label for="buy_limited_<?php echo e($loop->iteration); ?>"
                                            class="buy_limited_<?php echo e($loop->iteration); ?> <?php echo e($item['max_ticket_buy_type'] == 'unlimited' ? 'd-none' : ''); ?>"><?php echo e(__('Limited')); ?></label>

                                          <input type="checkbox" <?php if($item['max_ticket_buy_type'] == 'unlimited'): echo 'checked'; endif; ?>
                                            name="v_max_ticket_buy_type[]" value="unlimited"
                                            class="max_ticket_buy_type <?php echo e($item['max_ticket_buy_type'] == 'limited' ? 'd-none' : ''); ?>"
                                            id="buy_unlimited_<?php echo e($loop->iteration); ?>"
                                            data-id="<?php echo e($loop->iteration); ?>">
                                          <label for="buy_unlimited_<?php echo e($loop->iteration); ?>"
                                            class="buy_unlimited_<?php echo e($loop->iteration); ?> <?php echo e($item['max_ticket_buy_type'] == 'limited' ? 'd-none' : ''); ?>"><?php echo e(__('Unlimited')); ?></label>
                                        </div>

                                        <div
                                          class="form-group <?php echo e($item['max_ticket_buy_type'] == 'unlimited' ? 'd-none' : ''); ?>"
                                          id="input2_<?php echo e($loop->iteration); ?>">
                                          <label for=""><?php echo e(__('Max ticket for each customer') . '*'); ?> </label>
                                          <input type="text" name="v_max_ticket_buy[]" class="form-control"
                                            value="<?php echo e($item['v_max_ticket_buy']); ?>">
                                        </div>
                                      </td>
                                    <?php else: ?>
                                      <input type="hidden" name="v_max_ticket_buy_type[]" value="unlimited">
                                      <input type="hidden" name="v_max_ticket_buy[]" class="form-control">
                                    <?php endif; ?>
                                    <td>
                                      <a href="javascript:void(0)" class="btn btn-danger btn-sm deleteRow"> <i
                                          class="fas fa-minus"></i></a>
                                    </td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php else: ?>
                                <tr>
                                  <td>
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <div class="form-group">
                                        <label for=""><?php echo e(__('Variation Name') . '*'); ?>

                                          (<?php echo e($language['name']); ?>)
                                        </label>
                                        <input type="text" name="<?php echo e($language['code']); ?>_variation_name[]"
                                          class="form-control">
                                      </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                      <label for=""><?php echo e(__('Price') . '*'); ?>

                                        (<?php echo e($getCurrencyInfo->base_currency_text); ?>) </label>
                                      <input type="text" name="variation_price[]" class="form-control">
                                    </div>
                                  </td>
                                  <td>
                                    <div class="from-group mt-1">
                                      <input type="checkbox" checked name="v_ticket_available_type[]" value="limited"
                                        class="ticket_available_type" id="limited_1" data-id="1">
                                      <label for="limited_1" class="limited_1 "><?php echo e(__('Limited')); ?></label>

                                      <input type="checkbox" name="v_ticket_available_type[]" value="unlimited"
                                        class="ticket_available_type d-none" id="unlimited_1" data-id="1">
                                      <label for="unlimited_1" class="unlimited_1 d-none"><?php echo e(__('Unlimited')); ?></label>
                                    </div>

                                    <div class="form-group" id="input_1">
                                      <label for=""><?php echo e(__('Ticket Available')); ?> * </label>
                                      <input type="text" name="v_ticket_available[]" value=""
                                        class="form-control">
                                    </div>
                                  </td>
                                  <?php if($websiteInfo->event_guest_checkout_status != 1): ?>
                                    <td>
                                      <div class="from-group mt-1">
                                        <input type="checkbox" checked name="v_max_ticket_buy_type[]" value="limited"
                                          class="max_ticket_buy_type" id="buy_limited_1" data-id="1">
                                        <label for="buy_limited_1" class="buy_limited_1 "><?php echo e(__('Limited')); ?></label>

                                        <input type="checkbox" name="v_max_ticket_buy_type[]" value="unlimited"
                                          class="max_ticket_buy_type d-none" id="buy_unlimited_1" data-id="1">
                                        <label for="buy_unlimited_1"
                                          class="buy_unlimited_1 d-none"><?php echo e(__('Unlimited')); ?></label>
                                      </div>

                                      <div class="form-group" id="input2_1">
                                        <label for=""><?php echo e(__('Max ticket for each customer') . '*'); ?> </label>
                                        <input type="text" name="v_max_ticket_buy[]" class="form-control">
                                      </div>
                                    </td>
                                  <?php else: ?>
                                    <input type="hidden" name="v_max_ticket_buy_type[]" value="unlimited">
                                    <input type="hidden" name="v_max_ticket_buy[]" class="form-control">
                                  <?php endif; ?>
                                  <td>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm deleteRow">
                                      <i class="fas fa-minus"></i></a>
                                  </td>
                                </tr>
                              <?php endif; ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 <?php echo e($ticket->pricing_type == 'normal' ? '' : 'd-none'); ?>" id="normal_pricing">
                      <div class="form-group">
                        <label for=""><?php echo e(__('Price')); ?>

                          (<?php echo e($getCurrencyInfo->base_currency_text); ?>) *</label>
                        <input type="number" name="price" value="<?php echo e($ticket->price); ?>" class="form-control"
                          placeholder="Enter Price">
                      </div>
                    </div>

                    <div class="col-lg-12  <?php echo e($ticket->pricing_type == 'free' ? 'd-none' : ''); ?>"
                      id="early_bird_discount_free">
                      <div class="form-group mt-1">
                        <label for=""><?php echo e(__('Early Bird Discount') . '*'); ?></label>
                        <div class="selectgroup w-100">
                          <label class="selectgroup-item">
                            <input type="radio" name="early_bird_discount_type"
                              <?php echo e($ticket->early_bird_discount == 'disable' ? 'checked' : ''); ?> value="disable"
                              class="selectgroup-input" checked>
                            <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                          </label>

                          <label class="selectgroup-item">
                            <input type="radio" name="early_bird_discount_type"
                              <?php echo e($ticket->early_bird_discount == 'enable' ? 'checked' : ''); ?> value="enable"
                              class="selectgroup-input">
                            <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12 <?php echo e($ticket->early_bird_discount == 'enable' ? '' : 'd-none'); ?>"
                      id="early_bird_dicount">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Discount')); ?></label>
                            <select name="discount_type" class="form-control">
                              <option disabled><?php echo e(__('Select Discount Type')); ?></option>
                              <option <?php echo e($ticket->early_bird_discount_type == 'fixed' ? 'selected' : ''); ?>

                                value="fixed"><?php echo e(__('Fixed')); ?></option>
                              <option <?php echo e($ticket->early_bird_discount_type == 'percentage' ? 'selected' : ''); ?>

                                value="percentage"><?php echo e(__('Percentage')); ?></option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Amount')); ?></label>
                            <input type="number" name="early_bird_discount_amount"
                              value="<?php echo e($ticket->early_bird_discount_amount); ?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Discount End Date')); ?></label>
                            <input type="date" name="early_bird_discount_date"
                              value="<?php echo e($ticket->early_bird_discount_date); ?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for=""><?php echo e(__('Discount End Time')); ?></label>
                            <input type="time" name="early_bird_discount_time"
                              value="<?php echo e($ticket->early_bird_discount_time); ?>"class="form-control">
                          </div>
                        </div>

                      </div>
                    </div>
                    <!--=====--variationwise ticket & early bird discount--====== --->

                    <!---=======Ticekt limtit & ticket for each customer start--=====---->
                    <div
                      class="hideInvariatinwiseTicket col-lg-12 <?php echo e($ticket->pricing_type == 'variation' ? 'd-none' : ''); ?>">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group mt-1">
                            <label for=""><?php echo e(__('Total Number of Available Tickets') . '*'); ?></label>
                            <div class="selectgroup w-100">
                              <label class="selectgroup-item">
                                <input type="radio" name="ticket_available_type"
                                  <?php echo e($ticket->ticket_available_type == 'unlimited' ? 'checked' : ''); ?>

                                  value="unlimited" class="selectgroup-input">
                                <span class="selectgroup-button"><?php echo e(__('Unlimited')); ?></span>
                              </label>

                              <label class="selectgroup-item">
                                <input type="radio" name="ticket_available_type"
                                  <?php echo e($ticket->ticket_available_type == 'limited' ? 'checked' : ''); ?> value="limited"
                                  class="selectgroup-input">
                                <span class="selectgroup-button"><?php echo e(__('Limited')); ?></span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 <?php echo e($ticket->ticket_available_type == 'limited' ? '' : 'd-none'); ?>"
                          id="ticket_available">
                          <div class="form-group">
                            <label><?php echo e(__('Enter total number of available tickets') . '*'); ?></label>
                            <input type="number" name="ticket_available" value="<?php echo e($ticket->ticket_available); ?>"
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
                                  <input type="radio" name="max_ticket_buy_type" value="unlimited"
                                    class="selectgroup-input"
                                    <?php echo e($ticket->max_ticket_buy_type == 'unlimited' ? 'checked' : ''); ?>>
                                  <span class="selectgroup-button"><?php echo e(__('Unlimited')); ?></span>
                                </label>

                                <label class="selectgroup-item">
                                  <input type="radio" name="max_ticket_buy_type" value="limited"
                                    class="selectgroup-input"
                                    <?php echo e($ticket->max_ticket_buy_type == 'limited' ? 'checked' : ''); ?>>
                                  <span class="selectgroup-button"><?php echo e(__('Limited')); ?></span>
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 <?php echo e($ticket->max_ticket_buy_type == 'unlimited' ? 'd-none' : ''); ?>"
                            id="max_buy_ticket">
                            <div class="form-group">
                              <label><?php echo e(__('Enter Maximum number of tickets for each customer') . '*'); ?></label>
                              <input type="number" name="max_buy_ticket" value="<?php echo e($ticket->max_buy_ticket); ?>"
                                placeholder="Enter Maximum number of tickets for each customer" class="form-control">
                            </div>
                          </div>
                        <?php else: ?>
                          <input type="hidden" name="max_ticket_buy_type" value="unlimited">
                        <?php endif; ?>
                      </div>
                    </div>
                    <!---======-Ticekt limtit & ticket for each customer end--======= --->

                <?php endif; ?>
                <div class="col-lg-12">
                  <div id="accordion" class="mt-3">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="version">
                        <div class="version-header" id="heading<?php echo e($language->id); ?>">
                          <h5 class="mb-0">
                            <button type="button" class="btn btn-link" data-toggle="collapse"
                              data-target="#collapse<?php echo e($language->id); ?>"
                              aria-expanded="<?php echo e($language->is_default == 1 ? 'true' : 'false'); ?>"
                              aria-controls="collapse<?php echo e($language->id); ?>">
                              <?php echo e($language->name . __(' Language')); ?>

                              <?php echo e($language->is_default == 1 ? '(Default)' : ''); ?>

                            </button>
                          </h5>
                        </div>
                        <?php
                          $ticket_content = App\Models\Event\TicketContent::where([['ticket_id', $ticket->id], ['language_id', $language->id]])->first();
                        ?>

                        <div id="collapse<?php echo e($language->id); ?>"
                          class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                          aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                          <div class="version-body">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                  <label><?php echo e(__('Ticket Name') . '*'); ?></label>
                                  <input type="text" name="<?php echo e($language->code); ?>_title"
                                    placeholder="Enter Ticket Name" value="<?php echo e(@$ticket_content->title); ?>"
                                    class="form-control">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col">
                                <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                  <label><?php echo e(__('Description')); ?></label>
                                  <textarea class="form-control" name="<?php echo e($language->code); ?>_description" placeholder="Enter Description"><?php echo e(@$ticket_content->description); ?></textarea>
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
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="EventSubmit" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <?php
    $languages = App\Models\Language::get();
    $names = '';
    foreach ($languages as $language) {
        $varitaion_name = $language->code . '_variation_name[]';
        $names .= "<div class='form-group'><label for=''>Variation Name *($language->name)</label><input type='text' name='$varitaion_name' class='form-control'></div>";
    }
  ?>
  <script>
    let names = "<?php echo $names; ?>";
    let BaseCTxt = "<?php echo e($getCurrencyInfo->base_currency_text); ?>";
    var guest_checkout_status = "<?php echo e($websiteInfo->event_guest_checkout_status); ?>";
  </script>
  <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/admin-partial.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('variables'); ?>
  <script>
    "use strict";
    var removeUrl = "<?php echo e(route('organizer.event.imagermv')); ?>";
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('organizer.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/event/ticket/edit.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Tickets')); ?></h4>
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
          <?php echo e(strlen($information['event']['title']) > 35 ? mb_substr($information['event']['title'], 0, 35, 'UTF-8') . '...' : $information['event']['title']); ?>

        </a>
      </li>

      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a
          href="<?php echo e(route('organizer.event.ticket', ['language' => $defaultLang->code, 'event_id' => request()->input('event_id'), 'event_type' => request()->input('event_type')])); ?>"><?php echo e(__('Tickets')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block">
                <?php echo e(__('Tickets')); ?>

              </div>
            </div>

            <div class="col-lg-3">
              <form action="" method="get" id="LangFrom">
                <input type="hidden" name="event_id" value="<?php echo e(request()->input('event_id')); ?>">
                <input type="hidden" name="event_type" value="<?php echo e(request()->input('event_type')); ?>">
                <select name="language" class="form-control" onchange="document.getElementById('LangFrom').submit()">
                  <option selected disabled><?php echo e(__('Select a Language')); ?></option>
                  <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($lang->code); ?>"
                      <?php echo e($lang->code == request()->input('language') ? 'selected' : ''); ?>>
                      <?php echo e($lang->name); ?>

                    </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </form>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <button class="btn btn-danger btn-sm float-right ml-2 d-none bulk-delete"
                data-href="<?php echo e(route('organizer.event_management.bulk_delete_event_ticket')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>

              <a href="<?php echo e(route('organizer.event_management.event', ['language' => $defaultLang->code, 'event_type' => request()->input('event_type')])); ?>"
                class="btn btn-info btn-sm float-right"><i class="fas fa-backward"></i>
                <?php echo e(__('Back')); ?></a>

              <a href="<?php echo e(route('organizer.event.add.ticket', ['language' => $defaultLang->code, 'event_id' => request()->input('event_id'), 'event_type' => request()->input('event_type')])); ?>"
                class="btn btn-secondary btn-sm float-right mr-2"><i class="fas fa-plus-circle"></i>
                <?php echo e(__('Add Ticket')); ?></a>

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
            <div class="col-lg-12">

              <?php if(session()->has('course_status_warning')): ?>
                <div class="alert alert-warning">
                  <p class="text-dark mb-0"><?php echo e(session()->get('course_status_warning')); ?></p>
                </div>
              <?php endif; ?>

              <?php if(count($information['tickets']) == 0): ?>
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
                      <?php $__currentLoopData = $information['tickets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td width="5%">
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($ticket->id); ?>">
                          </td>
                          <td width="20%">
                            <?php
                              $ticket_content = App\Models\Event\TicketContent::where([['language_id', $information['language']['id']], ['ticket_id', $ticket->id]])->first();
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
                                <a href="<?php echo e(route('organizer.event.edit.ticket', ['language' => $defaultLang->code, 'event_id' => request()->input('event_id'), 'event_type' => request()->input('event_type'), 'id' => $ticket->id])); ?>"
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('organizer.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/event/ticket/index.blade.php ENDPATH**/ ?>
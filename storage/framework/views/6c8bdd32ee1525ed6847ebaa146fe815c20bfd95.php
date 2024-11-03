<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Event Booking')); ?></h4>
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
        <a href="#"><?php echo e(__('Event Bookings')); ?></a>
      </li>

      <?php if(!request()->filled('status')): ?>
        <li class="separator">
          <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?php echo e(__('All Bookings')); ?></a>
        </li>
      <?php endif; ?>
      <?php if(request()->filled('status') && request()->input('status') == 'completed'): ?>
        <li class="separator">
          <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?php echo e(__('Completed Bookings')); ?></a>
        </li>
      <?php endif; ?>
      <?php if(request()->filled('status') && request()->input('status') == 'pending'): ?>
        <li class="separator">
          <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?php echo e(__('Pending Bookings')); ?></a>
        </li>
      <?php endif; ?>
      <?php if(request()->filled('status') && request()->input('status') == 'rejected'): ?>
        <li class="separator">
          <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?php echo e(__('Rejected Bookings')); ?></a>
        </li>
      <?php endif; ?>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-3">
              <div class="card-title"><?php echo e(__('Event Booking')); ?></div>
            </div>

            <div class="col-lg-9">
              <div class="row justify-content-lg-end justify-content-start">
                <div class="col-lg-1">
                  <button class="btn btn-danger btn-sm d-none bulk-delete ml-3 mt-1"
                    data-href="<?php echo e(route('organizer.event_booking.bulk_delete')); ?>">
                    <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

                  </button>
                </div>
                <div class="col-lg-3">
                  <form class="ml-3" action="<?php echo e(route('organizer.event.booking')); ?>" method="GET">
                    <input name="booking_id" type="text" class="form-control" placeholder="Search By Order ID"
                      value="<?php echo e(!empty(request()->input('booking_id')) ? request()->input('booking_id') : ''); ?>">
                  </form>
                </div>
                <div class="col-lg-3">
                  <form class="ml-3" action="<?php echo e(route('organizer.event.booking')); ?>" method="GET">
                    <input name="event_title" type="text" class="form-control" placeholder="Search By Event Title"
                      value="<?php echo e(!empty(request()->input('event_title')) ? request()->input('event_title') : ''); ?>">
                  </form>
                </div>
                <div class="col-lg-3">
                  <form id="searchByStatusForm" class="d-flex flex-row align-items-center"
                    action="<?php echo e(route('organizer.event.booking')); ?>" method="GET">
                    <label class="mr-2"><?php echo e(__('Payment')); ?></label>
                    <select class="form-control" name="status"
                      onchange="document.getElementById('searchByStatusForm').submit()">
                      <option value="" <?php echo e(empty(request()->input('status')) ? 'selected' : ''); ?>>
                        <?php echo e(__('All')); ?>

                      </option>
                      <option value="completed" <?php echo e(request()->input('status') == 'completed' ? 'selected' : ''); ?>>
                        <?php echo e(__('Completed')); ?>

                      </option>
                      <option value="pending" <?php echo e(request()->input('status') == 'pending' ? 'selected' : ''); ?>>
                        <?php echo e(__('Pending')); ?>

                      </option>
                      <option value="rejected" <?php echo e(request()->input('status') == 'rejected' ? 'selected' : ''); ?>>
                        <?php echo e(__('Rejected')); ?>

                      </option>
                    </select>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($bookings) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO EVENT BOOKING FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Booking ID')); ?></th>
                        <th scope="col" width="25%"><?php echo e(__('Event')); ?></th>
                        <th scope="col"><?php echo e(__('Customer')); ?></th>
                        <th scope="col"><?php echo e(__('Cust. Paid')); ?></th>
                        <th scope="col"><?php echo e(__('Org. Received')); ?></th>
                        <th scope="col"><?php echo e(__('Paid via')); ?></th>
                        <th scope="col"><?php echo e(__('Payment Status')); ?></th>
                        <th scope="col"><?php echo e(__('Tickect Scan Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($booking->id); ?>">
                          </td>
                          <td><?php echo e('#' . $booking->booking_id); ?></td>

                          <?php
                            $eventInfo = \App\Models\Event\EventContent::where('language_id', $defaultLang->id)
                                ->where('event_id', $booking->event_id)
                                ->first();
                            $title = $eventInfo ? $eventInfo->title : '';
                            $slug = $eventInfo ? $eventInfo->slug : '';
                          ?>

                          <td>
                            <?php if($eventInfo): ?>
                              <a href="<?php echo e(route('event.details', ['slug' => $slug, 'id' => $eventInfo ? $eventInfo->event_id : 0])); ?>"
                                target="_blank">
                                <?php echo e(strlen($title) > 30 ? mb_substr($title, 0, 30, 'utf-8') . '...' : $title); ?>

                              </a>
                            <?php else: ?>
                              <?php echo e('-'); ?>

                            <?php endif; ?>

                          </td>

                          <?php
                            $customer = $booking->customerInfo()->first();
                          ?>
                          <td>
                            <?php if($customer): ?>
                              <?php echo e($customer->fname); ?>

                              <?php echo e($customer->lname); ?>

                            <?php else: ?>
                              <?php if(is_null($booking->customer_id)): ?>
                                <?php echo e(__('Guest')); ?>

                              <?php else: ?>
                                <?php echo e('-'); ?>

                              <?php endif; ?>
                            <?php endif; ?>
                          </td>
                          <?php
                            $position = $booking->currencyTextPosition;
                            $symbol = $booking->currencySymbol;
                          ?>

                          <td>
                            <?php echo e($position == 'left' ? $symbol . ' ' : ''); ?><?php echo e($booking->price + $booking->tax); ?><?php echo e($position == 'right' ? ' ' . $symbol : ''); ?>

                          </td>
                          <td>
                            <?php echo e($position == 'left' ? $symbol . ' ' : ''); ?><?php echo e($booking->price - $booking->commission); ?><?php echo e($position == 'right' ? ' ' . $symbol : ''); ?>


                          </td>
                          <td><?php echo e(!is_null($booking->paymentMethod) ? $booking->paymentMethod : '-'); ?></td>
                          <td>
                            <?php if($booking->gatewayType == 'online'): ?>
                              <h2 class="d-inline-block"><span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                              </h2>
                            <?php elseif($booking->gatewayType == 'offline'): ?>
                              <h2 class="d-inline-block">
                                <span
                                  class="badge <?php if($booking->paymentStatus == 'completed'): ?> badge-success <?php elseif($booking->paymentStatus == 'pending'): ?> badge-warning text-dark <?php else: ?> badge-danger <?php endif; ?>">
                                  <?php if($booking->paymentStatus == 'pending'): ?>
                                    <?php echo e(__('Pending')); ?>

                                  <?php elseif($booking->paymentStatus == 'completed'): ?>
                                    <?php echo e(__('Completed')); ?>

                                  <?php elseif($booking->paymentStatus == 'rejected'): ?>
                                    <?php echo e(__('Rejected')); ?>

                                  <?php endif; ?>
                                </span>
                              </h2>
                            <?php else: ?>
                              <?php if($booking->paymentStatus == 'free'): ?>
                                <span class="badge badge-primary"><?php echo e(ucfirst($booking->paymentStatus)); ?></span>
                              <?php else: ?>
                                -
                              <?php endif; ?>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if($booking->scan_status == 1): ?>
                              <span class="badge badge-success"><?php echo e(__('Already Scanned')); ?></span>
                            <?php else: ?>
                              <span class="badge badge-danger"><?php echo e(__('Not Scanned')); ?></span>
                            <?php endif; ?>
                          </td>

                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <?php echo e(__('Select')); ?>

                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="<?php echo e(route('organizer.event_booking.details', ['id' => $booking->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Details')); ?>

                                </a>

                                <?php if(!is_null($booking->attachmentFile)): ?>
                                  <a href="#" class="dropdown-item" target="_blank" data-toggle="modal"
                                    data-target="#attachmentModal-<?php echo e($booking->id); ?>">
                                    <?php echo e(__('Attachment')); ?>

                                  </a>
                                <?php endif; ?>

                                <a href="<?php echo e(asset('assets/admin/file/invoices/' . $booking->invoice)); ?>"
                                  class="dropdown-item" target="_blank">
                                  <?php echo e(__('Invoice')); ?>

                                </a>

                                <form class="deleteForm d-block"
                                  action="<?php echo e(route('organizer.event_booking.delete', ['id' => $booking->id])); ?>"
                                  method="post">
                                  <?php echo csrf_field(); ?>
                                  <button type="submit" class="deleteBtn">
                                    <?php echo e(__('Delete')); ?>

                                  </button>
                                </form>
                              </div>
                            </div>
                          </td>
                        </tr>

                        <?php if ($__env->exists('organizer.event.booking.show-attachment')) echo $__env->make('organizer.event.booking.show-attachment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-footer text-center">
          <div class="d-inline-block mt-3">
            <?php echo e($bookings->appends([
                    'booking_id' => request()->input('booking_id'),
                    'status' => request()->input('status'),
                ])->links()); ?>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('organizer.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/event/booking/index.blade.php ENDPATH**/ ?>
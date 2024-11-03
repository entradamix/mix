<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Transactions')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Transactions')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Transactions')); ?></div>
            </div>

            <div class="col-lg-4">
              <form action="" method="get">
                <input type="text" value="<?php echo e(request()->input('transcation_id')); ?>" name="transcation_id"
                  placeholder="Enter Transaction Id" class="form-control">
              </form>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($transcations) == 0): ?>
                <h3 class="text-center mt-3"><?php echo e(__('NO TRANSACTION FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col"><?php echo e(__('Transaction Id')); ?></th>
                        <th scope="col"><?php echo e(__('Organizer')); ?></th>
                        <th scope="col"><?php echo e(__('Transaction Type')); ?></th>
                        <th scope="col"><?php echo e(__('Payment Method')); ?></th>
                        <th scope="col"><?php echo e(__('Pre Balance')); ?></th>
                        <th scope="col"><?php echo e(__('Amount')); ?></th>
                        <th scope="col"><?php echo e(__('After Balance')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $transcations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transcation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>#<?php echo e($transcation->transcation_id); ?></td>
                          <td>
                            <?php
                              $organizer = $transcation->organizer()->first();
                            ?>
                            <?php if($organizer): ?>
                              <a target="_blank"
                                href="<?php echo e(route('admin.organizer_management.organizer_details', ['id' => $organizer->id, 'language' => $defaultLang->code])); ?>"><?php echo e($organizer->username); ?></a>
                            <?php else: ?>
                              <span class="badge badge-success"><?php echo e(__('Admin')); ?></span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if($transcation->transcation_type == 1): ?>
                              <?php echo e('Event Booking'); ?>

                            <?php elseif($transcation->transcation_type == 2): ?>
                              <?php echo e('Product Order'); ?>

                            <?php elseif($transcation->transcation_type == 3): ?>
                              <?php echo e('Withdraw'); ?>

                            <?php elseif($transcation->transcation_type == 4): ?>
                              <?php echo e('Balance Add'); ?>

                            <?php elseif($transcation->transcation_type == 5): ?>
                              <?php echo e('Balance Subtract'); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if($transcation->transcation_type == 3): ?>
                              <?php
                                $method = $transcation->method()->first();
                              ?>
                              <?php if($method): ?>
                                <?php echo e($method->name); ?>

                              <?php else: ?>
                                <?php echo e('-'); ?>

                              <?php endif; ?>
                            <?php else: ?>
                              <?php echo e($transcation->payment_method != null ? $transcation->payment_method : '-'); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <?php echo e($transcation->currency_symbol_position == 'left' ? $transcation->currency_symbol : ''); ?>

                            <?php echo e($transcation->pre_balance); ?>

                            <?php echo e($transcation->currency_symbol_position == 'right' ? $transcation->currency_symbol : ''); ?>

                          </td>
                          <td>
                            <?php if($transcation->transcation_type == 3 || $transcation->transcation_type == 5): ?>
                              <span class="text-danger"><?php echo e('(-)'); ?></span>
                            <?php else: ?>
                              <span class="text-success"><?php echo e('(+)'); ?></span>
                            <?php endif; ?>

                            <?php echo e($transcation->currency_symbol_position == 'left' ? $transcation->currency_symbol : ''); ?>

                            <?php echo e($transcation->grand_total - $transcation->commission); ?>

                            <?php echo e($transcation->currency_symbol_position == 'right' ? $transcation->currency_symbol : ''); ?>

                          </td>
                          <td>
                            <?php echo e($transcation->currency_symbol_position == 'left' ? $transcation->currency_symbol : ''); ?>

                            <?php echo e($transcation->after_balance); ?>

                            <?php echo e($transcation->currency_symbol_position == 'right' ? $transcation->currency_symbol : ''); ?>

                          </td>
                          <td>
                            <?php if($transcation->payment_status == 1): ?>
                              <span class="badge badge-success"><?php echo e(__('Paid')); ?></span>
                            <?php elseif($transcation->payment_status == 2): ?>
                              <span class="badge badge-warning"><?php echo e(__('Decline')); ?></span>
                            <?php else: ?>
                              <span class="badge badge-danger"><?php echo e(__('Unpaid')); ?></span>
                            <?php endif; ?>
                          </td>

                          <td>
                            <?php if($transcation->transcation_type == 1): ?>
                              <?php
                                $t_invoice = $transcation->event_booking()->first();
                              ?>
                              <?php if($t_invoice): ?>
                                <a target="_blank" class="btn btn-secondary btn-sm mr-1"
                                  href="<?php echo e(asset('assets/admin/file/invoices/' . $t_invoice->invoice)); ?>">
                                  <i class="fas fa-eye"></i>
                                </a>
                              <?php else: ?>
                                <?php echo e('-'); ?>

                              <?php endif; ?>
                            <?php elseif($transcation->transcation_type == 2): ?>
                              <?php
                                $t_invoice = $transcation->product_order()->first();
                              ?>
                              <?php if($t_invoice): ?>
                                <a target="_blank" class="btn btn-secondary btn-sm mr-1"
                                  href="<?php echo e(asset('assets/admin/file/order/invoices/' . $t_invoice->invoice)); ?>">
                                  <i class="fas fa-eye"></i>
                                </a>
                              <?php else: ?>
                                <?php echo e('-'); ?>

                              <?php endif; ?>
                            <?php else: ?>
                              <?php echo e('-'); ?>

                            <?php endif; ?>
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

        <div class="card-footer text-center">
          <div class="d-inline-block mt-3">
            <?php echo e($transcations->appends([
                    'transcation_id' => request()->input('transcation_id'),
                ])->links()); ?>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/admin/transaction.blade.php ENDPATH**/ ?>
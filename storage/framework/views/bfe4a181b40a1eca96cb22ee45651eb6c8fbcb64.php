<?php $__env->startSection('content'); ?>
  <div class="mt-2 mb-4">
    <h2 class=" pb-2 "><?php echo e(__('Welcome back') .','); ?> <?php echo e(Auth::guard('organizer')->user()->username . '!'); ?></h2>
  </div>

  <?php if(Session::get('secret_login') != true): ?>
    <?php if(Auth::guard('organizer')->user()->status == 0 && $admin_setting->organizer_admin_approval == 1): ?>
      <div class="mt-2 mb-4">
        <div class="alert alert-danger text-dark">
          <?php echo e($admin_setting->admin_approval_notice != null ? $admin_setting->admin_approval_notice : __( 'Your account is deactive')); ?>

        </div>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <div class="row dashboard-items">
    <div class="col-xl-3 col-lg-6">
      <a href="<?php echo e(route('organizer.monthly_income')); ?>">
        <div class="card card-stats card-info card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fas fa-sack-dollar"></i>
                </div>
              </div>

              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category"><?php echo e(__('My Balance')); ?></p>
                  <h4 class="card-title">
                    <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                    <?php echo e(round(Auth::guard('organizer')->user()->amount, 2)); ?>

                    <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>

                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-3 col-lg-6">
      <a href="<?php echo e(route('organizer.event_management.event', ['language' => $defaultLang->code])); ?>">
        <div class="card card-stats card-success card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fas fa-calendar-alt"></i>
                </div>
              </div>

              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category"><?php echo e(__('Events')); ?></p>
                  <h4 class="card-title"><?php echo e($total_events); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-3 col-lg-6">
      <a href="<?php echo e(route('organizer.event.booking')); ?>">
        <div class="card card-stats card-danger card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fas fa-presentation"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category"><?php echo e(__('Total Event Bookings')); ?></p>
                  <h4 class="card-title"><?php echo e($total_event_bookings); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-3 col-lg-6">
      <a href="<?php echo e(route('organizer.transcation')); ?>">
        <div class="card card-stats card-secondary card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fal fa-exchange-alt"></i>
                </div>
              </div>

              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category"><?php echo e(__('Total Transcation')); ?></p>
                  <h4 class="card-title"><?php echo e($transcation_count); ?>

                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Event Booking Monthly Income')); ?> (<?php echo e(date('Y')); ?>)</div>
        </div>

        <div class="card-body">
          <div class="chart-container">
            <canvas id="incomeChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Monthly Event Bookings')); ?> (<?php echo e(date('Y')); ?>)</div>
        </div>

        <div class="card-body">
          <div class="chart-container">
            <canvas id="TotalEventBookingChart"></canvas>
          </div>
        </div>
      </div>
    </div>

  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  
  <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/chart.min.js')); ?>"></script>

  <script>
    "use strict";
    const monthArr = <?php echo json_encode($eventMonths) ?>;
    const incomeArr = <?php echo json_encode($eventIncomes) ?>;
    const totalBookings = <?php echo json_encode($totalBookings) ?>;
  </script>

  <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/chart-init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('organizer.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/index.blade.php ENDPATH**/ ?>
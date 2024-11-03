<?php $__env->startSection('content'); ?>
  <div class="mt-2 mb-4">
    <h2 class="<?php echo e($settings->admin_theme_version == 'light' ? 'text-dark' : 'text-light'); ?> pb-2"><?php echo e(__('Welcome back,')); ?>

      <?php echo e(Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name . '!'); ?></h2>
  </div>

  
  <?php
    if (!is_null($roleInfo)) {
        $rolePermissions = json_decode($roleInfo->permissions);
    }
  ?>

  <div class="row dashboard-items">

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Lifetime Earning', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.monthly_earning')); ?>">
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
                    <p class="card-category"><?php echo e(__('Life Time Earning')); ?></p>
                    <h4 class="card-title">
                      <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                      <?php echo e($total_earning->total_revenue); ?>

                      <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>


                    </h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Total Profit', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.monthly_profit')); ?>">
          <div class="card card-stats card-earning card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fas fa-usd-square"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Total Profit')); ?></p>
                    <h4 class="card-title">
                      <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                      <?php echo e($total_earning->total_earning); ?>

                      <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>


                    </h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>
    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Event Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.event_management.event', ['language' => $defaultLang->code])); ?>">
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
                    <h4 class="card-title"><?php echo e($totalEvents); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Event Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.event_management.categories', ['language' => $defaultLang->code])); ?>">
          <div class="card card-stats card-danger card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-sitemap"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Event Categories')); ?></p>
                    <h4 class="card-title"><?php echo e($totalEventCategories); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>


    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Transaction', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.transcation')); ?>">
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
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Event Bookings', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.event.booking')); ?>">
          <div class="card card-stats card-primary card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fas fa-hotel"></i>
                  </div>
                </div>
                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Total Event Booking')); ?></p>
                    <h4 class="card-title"><?php echo e($totalEventBookings); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Organizer Mangement', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.organizer_management.registered_organizer', ['language' => $defaultLang->code])); ?>">
          <div class="card card-stats card-warning card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-chalkboard-teacher"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Organizers')); ?></p>
                    <h4 class="card-title"><?php echo e($totalOrganizers); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Blog Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.blog_management.blogs', ['language' => $defaultLang->code])); ?>">
          <div class="card card-stats card-info card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fal fa-blog"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Blog')); ?></p>
                    <h4 class="card-title"><?php echo e($totalBlog); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Customer Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.organizer_management.registered_customer')); ?>">
          <div class="card card-stats card-secondary card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="la flaticon-users"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Registered Customers')); ?></p>
                    <h4 class="card-title"><?php echo e($totalRegisteredUsers); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Shop Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.shop_management.products', ['language' => $defaultLang->code])); ?>">
          <div class="card card-stats card-danger card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fas fa-shopping-basket"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Products')); ?></p>
                    <h4 class="card-title"><?php echo e($totalProducts); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>
    <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Shop Management', $rolePermissions))): ?>
      <div class="col-sm-6 col-md-4">
        <a href="<?php echo e(route('admin.product.order')); ?>">
          <div class="card card-stats card-success card-round">
            <div class="card-body">
              <div class="row">
                <div class="col-5">
                  <div class="icon-big text-center">
                    <i class="fas fa-receipt"></i>
                  </div>
                </div>

                <div class="col-7 col-stats">
                  <div class="numbers">
                    <p class="card-category"><?php echo e(__('Orders')); ?></p>
                    <h4 class="card-title"><?php echo e($totalOrders); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endif; ?>

  </div>

  <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Event Management', $rolePermissions))): ?>
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <div class="card-title"><?php echo e(__('Event Booking Monthly Earning')); ?> (<?php echo e(date('Y')); ?>)</div>
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
  <?php endif; ?>

  
  <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Shop Management', $rolePermissions))): ?>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Product Order Monthly Income')); ?> (<?php echo e(date('Y')); ?>)</div>
        </div>

        <div class="card-body">
          <div class="chart-container">
            <canvas id="ProductOrderChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Shop Management', $rolePermissions))): ?>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Monthly Product Orders')); ?> (<?php echo e(date('Y')); ?>)</div>
        </div>

        <div class="card-body">
          <div class="chart-container">
            <canvas id="TotalProductOrderChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
  </div>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  
  <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/chart.min.js')); ?>"></script>

  <script>
    "use strict";
    const monthArr = <?php echo json_encode($eventMonths) ?>;
    const incomeArr = <?php echo json_encode($eventIncomes) ?>;
    const totalBookings = <?php echo json_encode($totalBookings) ?>;

    const productIncome = <?php echo json_encode($productIncome) ?>;
    const totalOders = <?php echo json_encode($totalOders) ?>;
  </script>

  <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/chart-init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/dashboard.blade.php ENDPATH**/ ?>
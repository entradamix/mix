<div class="col-lg-3">
  <div class="user-sidebar">
    <ul class="links">
      <li><a href="<?php echo e(route('customer.dashboard')); ?>"
          class="<?php if(request()->routeIs('customer.dashboard')): ?> active <?php endif; ?>"><?php echo e(__('Dashboard')); ?></a></li>
      <li><a href="<?php echo e(route('customer.booking.my_booking')); ?>" class="<?php if(request()->routeIs('customer.booking.my_booking') || request()->routeIs('customer.booking_details')): ?> active <?php endif; ?>">
          <?php echo e(__('Event Bookings')); ?> </a></li>
      <li><a href="<?php echo e(route('customer.my_orders')); ?>"
          class="
            <?php if(request()->routeIs('customer.my_orders')): ?> active
            <?php elseif(request()->routeIs('customer.order_details')): ?> active <?php endif; ?>
            ">
          <?php echo e(__('Product Orders')); ?> </a></li>

      <li><a href="<?php echo e(route('customer.wishlist')); ?>"
          class="<?php if(request()->routeIs('customer.wishlist')): ?> active <?php endif; ?>"><?php echo e(__('Wishlist')); ?></a></li>

      <li><a href="<?php echo e(route('customer.support_tickert')); ?>"
          class="<?php if(request()->routeIs('customer.support_tickert')): ?> active
            <?php elseif(request()->routeIs('customer.support_tickert.create')): ?> active
            <?php elseif(request()->routeIs('customer.support_ticket.message')): ?> active <?php endif; ?>">
          <?php echo e(__('Support Tickets')); ?></a></li>
      <li><a href="<?php echo e(route('customer.edit.profile')); ?>"
          class="<?php if(request()->routeIs('customer.edit.profile')): ?> active <?php endif; ?>"><?php echo e(__('Edit Profile')); ?> </a></li>
      <li><a href="<?php echo e(route('customer.change.password')); ?>"
          class="<?php if(request()->routeIs('customer.change.password')): ?> active <?php endif; ?>"><?php echo e(__('Change Password')); ?></a></li>

      <li><a href="<?php echo e(route('customer.logout')); ?>" class=""><?php echo e(__('Logout')); ?> </a></li>
    </ul>
  </div>
</div>
<?php /**PATH /var/www/html/resources/views/frontend/customer/partials/sidebar.blade.php ENDPATH**/ ?>
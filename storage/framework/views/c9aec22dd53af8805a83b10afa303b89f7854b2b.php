<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->cart_page_title ?? __('Cart')); ?>

  <?php else: ?>
    <?php echo e(__('Cart')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('hero-section'); ?>
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
    data-bg="<?php echo e(asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title">
          <?php if(!empty($pageHeading)): ?>
            <?php echo e($pageHeading->cart_page_title ?? __('Cart')); ?>

          <?php else: ?>
            <?php echo e(__('Cart')); ?>

          <?php endif; ?>
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active">
              <?php if(!empty($pageHeading)): ?>
                <?php echo e($pageHeading->cart_page_title ?? __('Cart')); ?>

              <?php else: ?>
                <?php echo e(__('Cart')); ?>

              <?php endif; ?>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <section class="cart-page py-120 rpy-100">
    <div class="container">
      <div class="cart-total-product">
        <?php if($cart_items != null): ?>
          <?php
            $cartTotal = 0;
            $countitem = 0;
            if ($cart_items) {
                foreach ($cart_items as $p) {
                    $cartTotal += $p['price'] * $p['qty'];
                    $countitem += $p['qty'];
                }
            }
          ?>

          <div class="total-cart-price">
            <h6><?php echo e(__('Total Items')); ?>: <span class="cart-item-view"
                dir="ltr"><?php echo e($cart_items ? $countitem : 0); ?></span> </h6>
            <h6>
              <strong><?php echo e(__('Cart Total')); ?> :</strong> <strong class="cart-total-view"
                dir="ltr"><?php echo e($basicInfo->base_currency_symbol_position == 'left' ? $basicInfo->base_currency_symbol : ''); ?>

                <?php echo e($cartTotal); ?>

                <?php echo e($basicInfo->base_currency_symbol_position == 'right' ? $basicInfo->base_currency_symbol : ''); ?></strong>
            </h6>
          </div>
        <?php endif; ?>
        <?php if($cart_items != null): ?>
          <div class="cart-title">
            <span class="product-title"><?php echo e(__('Product')); ?></span>
            <span class="quantity-title"><?php echo e(__('Quantity')); ?></span>
            <span class="avilable-title"><?php echo e(__('Availability')); ?></span>
            <span class="price-title"><?php echo e(__('Price')); ?></span>
            <span class="total-title"><?php echo e(__('Total')); ?></span>
            <span class="remove-title"><?php echo e(__('Remove')); ?></span>
          </div>
          <div class="cart-item-wrap pt-15">
            <?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $product = App\Models\ShopManagement\Product::where('id', $id)->first();
              ?>
              <div class="alert fade show cart-single-item">
                <h6 class="product-name">
                  <?php echo e(\Illuminate\Support\Str::limit($item['name'], 35, $end = '...')); ?></h6>
                <div class="quantity-input">
                  <button class="quantity-down" id="quantityDown">
                    -
                  </button>
                  <input id="quantity" class="cart_qty" type="number" value="<?php echo e($item['qty']); ?>" name="quantity">
                  <button class="quantity-up" id="quantityUP">
                    +
                  </button>
                </div>
                <input type="hidden" value="<?php echo e($id); ?>" class="product_id">
                <?php if($product->type == 'digital'): ?>
                  <span class="avilable"><i class="fas fa-check"></i> <?php echo e(__('Available Now')); ?></span>
                <?php else: ?>
                  <?php if($product->stock >= $item['qty']): ?>
                    <span class="avilable"><i class="fas fa-check"></i> <?php echo e(__('Available Now')); ?></span>
                  <?php else: ?>
                    <span class="avilable text-danger"><i class="text-danger fas fa-times"></i>
                      <?php echo e(__('Out Of Stock Now')); ?></span>
                  <?php endif; ?>
                <?php endif; ?>

                <span class="product-price"
                  dir="ltr"><?php echo e($basicInfo->base_currency_symbol_position == 'left' ? $basicInfo->base_currency_symbol : ''); ?>

                  <span><?php echo e($item['price']); ?></span>
                  <?php echo e($basicInfo->base_currency_symbol_position == 'right' ? $basicInfo->base_currency_symbol : ''); ?></span>
                <span class="product-total-price" dir="ltr">
                  <?php echo e($basicInfo->base_currency_symbol_position == 'left' ? $basicInfo->base_currency_symbol : ''); ?>

                  <span><?php echo e($item['qty'] * $item['price']); ?></span>
                  <?php echo e($basicInfo->base_currency_symbol_position == 'right' ? $basicInfo->base_currency_symbol : ''); ?>

                </span>
                <button type="button" class="close item-remove" data-dismiss="alert" rel="<?php echo e($id); ?>"
                  data-href="<?php echo e(route('cart.item.remove', $id)); ?>"><span aria-hidden="true">&times;</span></button>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>

      </div>

      <div class="table-outer"></div>

      <?php if($cart_items == null): ?>
        <div class="bg-light py-5 text-center">
          <h3 class="text-uppercase"><?php echo e(__('Cart is empty') . ' !'); ?></h3>
        </div>
      <?php endif; ?>
      <?php if($cart_items != null): ?>
        <div class="cart-total-price mt-40">
          <div class="row justify-content-end text-center text-lg-left">
            <div class="col-lg-6">
              <div class="update-shopping text-lg-right">
                <?php echo csrf_field(); ?>
                <a id="cartUpdate" data-href="<?php echo e(route('cart.update')); ?>"
                  class="theme-btn mt-10"><?php echo e(__('update cart')); ?></a>
                <a href="<?php echo e(route('shop.checkout')); ?>" class="theme-btn mt-10"><?php echo e(__('checkout')); ?></a>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script>
    var symbol = "<?php echo e($basicInfo->base_currency_symbol); ?>";
    var position = "<?php echo e($basicInfo->base_currency_symbol_position); ?>";
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/shop/cart.blade.php ENDPATH**/ ?>
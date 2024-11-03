<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Setting')); ?></h4>
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
        <a href="#"><?php echo e(__('Shop Management')); ?></a>
      </li>

      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Setting')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Setting')); ?></div>

        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="eventForm" action="<?php echo e(route('admin.product.setting.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="col-lg-10 mx-auto">
                    <div class="form-group mt-1">
                      <label for=""><?php echo e(__('Shop') . '*'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="shop_status" <?php echo e($abex->shop_status == 1 ? 'checked':''); ?> value="1" class="selectgroup-input" >
                          <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="shop_status" <?php echo e($abex->shop_status == 0 ? 'checked':''); ?> value="0" class="selectgroup-input">
                          <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                        </label>
                      </div>
                      <p class="text-warning mb-0"><?php echo e(__('By enabling / disabling, you can completely enable / disable the relevant pages of your shop in this system')); ?></p>
                    </div>

                    <div class="form-group mt-1">
                      <label for=""><?php echo e(__('Catalog Mode') . '*'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="catalog_mode" <?php echo e($abex->catalog_mode == 1 ? 'checked':''); ?> value="1" class="selectgroup-input" >
                          <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="catalog_mode" <?php echo e($abex->catalog_mode == 0 ? 'checked':''); ?> value="0" class="selectgroup-input">
                          <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                        </label>
                      </div>
                      <p class="text-warning mb-0"><?php echo e(__('If you enable catalog mode, then pricing, cart, checkout option of products will be removed. But product & product details page will remain')); ?></p>
                    </div>

                    <div class="form-group mt-1">
                      <label for=""><?php echo e(__('Rating System') . ' *'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="is_shop_rating" <?php echo e($abex->is_shop_rating == 1 ? 'checked':''); ?> value="1" class="selectgroup-input" >
                          <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="is_shop_rating" <?php echo e($abex->is_shop_rating == 0 ? 'checked':''); ?> value="0" class="selectgroup-input">
                          <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                        </label>
                      </div>
                    </div>

                    <div class="form-group mt-1">
                      <label for=""><?php echo e(__('Guest Checkout') . ' *'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="shop_guest_checkout" <?php echo e($abex->shop_guest_checkout == 1 ? 'checked':''); ?> value="1" class="selectgroup-input" >
                          <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                        </label>

                        <label class="selectgroup-item">
                          <input type="radio" name="shop_guest_checkout" <?php echo e($abex->shop_guest_checkout == 0 ? 'checked':''); ?> value="0" class="selectgroup-input">
                          <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                        </label>
                      </div>
                    </div>

                    <div class="form-group mt-1">
                      <label for=""><?php echo e(__('Tax') . '*'); ?></label>
                      <input type="text" name="shop_tax" value="<?php echo e($abex->shop_tax); ?>" placeholder="<?php echo e(__('Enter Tax')); ?>" class="form-control">
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
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/product/settings.blade.php ENDPATH**/ ?>
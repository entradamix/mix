<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Products')); ?></h4>
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
        <a href="#"><?php echo e(__('Shop Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Manage Products')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Products')); ?></a>
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
                <?php echo e(__('Products') . ' (' . $language->name . ' ' . __('Language') . ')'); ?>

              </div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="<?php echo e(route('organizer.shop_management.product_type')); ?>" class="btn btn-secondary btn-sm float-right"> <i
                  class="fas fa-plus"></i>
                <?php echo e(__('Add Product')); ?>

              </a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                data-href="<?php echo e(route('organizer.shop_management.product.bulk_delete')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
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

              <?php if(count($products) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO PRODUCTS FOUND FOR') .' '. $language->name . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Title')); ?></th>
                        <th scope="col"><?php echo e(__('Price')); ?></th>
                        <th scope="col"><?php echo e(__('Type')); ?></th>
                        <th scope="col"><?php echo e(__('Category')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Featured')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($product->id); ?>">
                          </td>
                          <td width="20%">
                            <?php echo e($product->title); ?>

                          </td>
                          <td><?php echo e($product->current_price); ?></td>
                          <td><?php echo e($product->type); ?></td>
                          <td>
                            <?php echo e($product->category); ?>

                          </td>

                          <td>
                            <form id="statusForm-<?php echo e($product->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('organizer.shop_management.product.status_update', ['id' => $product->id, 'language' => request()->input('language')])); ?>"
                              method="post">

                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php echo e($product->status == 0 ? 'bg-warning text-dark' : 'bg-primary'); ?>"
                                name="status"
                                onchange="document.getElementById('statusForm-<?php echo e($product->id); ?>').submit()">
                                <option value="1" <?php echo e($product->status == 1 ? 'selected' : ''); ?>>
                                  <?php echo e(__('Active')); ?>

                                </option>
                                <option value="0" <?php echo e($product->status == 0 ? 'selected' : ''); ?>>
                                  <?php echo e(__('DeActive')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>

                            <form id="featuredForm-<?php echo e($product->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('organizer.shop_management.product.update_feature', ['id' => $product->id])); ?>"
                              method="post">

                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php echo e($product->is_feature == 'yes' ? 'bg-success' : 'bg-danger'); ?>"
                                name="is_feature"
                                onchange="document.getElementById('featuredForm-<?php echo e($product->id); ?>').submit()">
                                <option value="yes" <?php echo e($product->is_feature == 'yes' ? 'selected' : ''); ?>>
                                  <?php echo e(__('Yes')); ?>

                                </option>
                                <option value="no" <?php echo e($product->is_feature == 'no' ? 'selected' : ''); ?>>
                                  <?php echo e(__('No')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <a href="<?php echo e(route('organizer.shop_management.product.edit', ['id' => $product->id])); ?>"
                              class="btn btn-primary mt-1 btn-sm">
                              <i class="fas fa-edit"></i>
                            </a>
                            <form class="deleteForm d-block"
                              action="<?php echo e(route('organizer.shop_management.product.destroy', ['id' => $product->id])); ?>"
                              method="post">

                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn mt-1">
                                <i class="fas fa-trash"></i>
                              </button>
                            </form>
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
            <?php echo e($products->appends(['language' => request()->input('language')])->links()); ?>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('organizer.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/product/show.blade.php ENDPATH**/ ?>
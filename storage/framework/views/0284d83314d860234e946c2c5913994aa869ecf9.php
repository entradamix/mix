<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Categories')); ?></h4>
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
        <a href="#"><?php echo e(__('Events Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Categories')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Event Categories')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal"
                class="btn btn-primary btn-sm float-lg-right float-left"><i class="fas fa-plus"></i>
                <?php echo e(__('Add Category')); ?></a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                data-href="<?php echo e(route('admin.event_management.bulk_delete_category')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($categories) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO EVENT CATEGORY FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Image')); ?></th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Serial Number')); ?></th>

                        <th scope="col"><?php echo e(__('Featured')); ?></th>

                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($category->id); ?>">
                          </td>
                          <td>
                            <img src="<?php echo e(asset('assets/admin/img/event-category/' . $category->image)); ?>"
                              class="img-fluid mh60" alt="">
                          </td>
                          <td>
                            <?php echo e(strlen($category->name) > 50 ? mb_substr($category->name, 0, 50, 'UTF-8') . '...' : $category->name); ?>

                          </td>
                          <td>
                            <?php if($category->status == 1): ?>
                              <h2 class="d-inline-block"><span class="badge badge-success"><?php echo e(__('Active')); ?></span>
                              </h2>
                            <?php else: ?>
                              <h2 class="d-inline-block"><span class="badge badge-danger"><?php echo e(__('Deactive')); ?></span>
                              </h2>
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($category->serial_number); ?></td>

                          <td>
                            <?php if($category->is_featured == 'yes'): ?>
                              <h2 class="d-inline-block"><span class="badge badge-success"><?php echo e(__('Yes')); ?></span>
                              </h2>
                            <?php else: ?>
                              <h2 class="d-inline-block"><span class="badge badge-danger"><?php echo e(__('No')); ?></span></h2>
                            <?php endif; ?>
                          </td>

                          <td>
                            <a class="btn btn-secondary btn-xs mr-1 mt-1 editBtn" href="#"
                              data-toggle="modal" data-target="#editEventCategoryModal" data-id="<?php echo e($category->id); ?>"
                              data-icon="<?php echo e($category->icon); ?>" data-color="<?php echo e($category->color); ?>"
                              data-name="<?php echo e($category->name); ?>" data-status="<?php echo e($category->status); ?>"
                              data-serial_number="<?php echo e($category->serial_number); ?>"
                              data-is_featured="<?php echo e($category->is_featured); ?>"
                              data-image="<?php echo e(asset('assets/admin/img/event-category/' . $category->image)); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                            </a>

                            <form class="deleteForm d-inline-block"
                              action="<?php echo e(route('admin.event_management.delete_category', ['id' => $category->id])); ?>"
                              method="post">

                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger mt-1 btn-xs deleteBtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
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

        <div class="card-footer"></div>
      </div>
    </div>
  </div>

  
  <?php echo $__env->make('backend.event.category.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('backend.event.category.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/event/category/index.blade.php ENDPATH**/ ?>
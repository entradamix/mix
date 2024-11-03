<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Registered Customers')); ?></h4>
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
        <a href="#"><?php echo e(__('Customers Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Registered Customers')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title"><?php echo e(__('All Customers')); ?></div>
            </div>

            <div class="col-lg-6 offset-lg-2">
              <button class="btn btn-danger btn-sm float-right d-none bulk-delete mr-2 ml-3 mt-1"
                data-href="<?php echo e(route('admin.customer_management.bulk_delete_customer')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>

              <form class="float-right" action="" method="GET">
                <input name="info" type="text" class="form-control min-230"
                  placeholder="Search By Username or Email ID"
                  value="<?php echo e(!empty(request()->input('info')) ? request()->input('info') : ''); ?>">
              </form>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($customers) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO CUSTOMER FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Email ')); ?></th>
                        <th scope="col"><?php echo e(__('Phone')); ?></th>
                        <th scope="col"><?php echo e(__('Account Status')); ?></th>
                        <th scope="col"><?php echo e(__('Email Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($customer->id); ?>">
                          </td>
                          <td><?php echo e($customer->fname); ?> <?php echo e($customer->lname); ?></td>
                          <td><?php echo e($customer->email); ?></td>
                          <td><?php echo e(empty($customer->phone) ? '-' : $customer->phone); ?></td>
                          <td>
                            <form id="accountStatusForm-<?php echo e($customer->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('admin.customer_management.customer.update_account_status', ['id' => $customer->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php echo e($customer->status == 1 ? 'bg-success' : 'bg-danger'); ?>"
                                name="account_status"
                                onchange="document.getElementById('accountStatusForm-<?php echo e($customer->id); ?>').submit()">
                                <option value="1" <?php echo e($customer->status == 1 ? 'selected' : ''); ?>>
                                  <?php echo e(__('Active')); ?>

                                </option>
                                <option value="0" <?php echo e($customer->status == 0 ? 'selected' : ''); ?>>
                                  <?php echo e(__('Deactive')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <form id="emailStatusForm-<?php echo e($customer->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('admin.customer_management.customer.update_email_status', ['id' => $customer->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php echo e(!is_null($customer->email_verified_at) ? 'bg-success' : 'bg-danger'); ?>"
                                name="email_status"
                                onchange="document.getElementById('emailStatusForm-<?php echo e($customer->id); ?>').submit()">
                                <option value="1" <?php echo e(!is_null($customer->email_verified_at) ? 'selected' : ''); ?>>
                                  <?php echo e(__('Verified')); ?>

                                </option>
                                <option value="0" <?php echo e(is_null($customer->email_verified_at) ? 'selected' : ''); ?>>
                                  <?php echo e(__('Not Verified')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(__('Select')); ?>

                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="<?php echo e(route('admin.customer_management.customer_details', ['id' => $customer->id, 'language' => $defaultLang->code])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Details')); ?>

                                </a>


                                <a href="<?php echo e(route('admin.customer_management.customer_edit', ['id' => $customer->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Edit')); ?>

                                </a>

                                <a href="<?php echo e(route('admin.customer_management.customer.change_password', ['id' => $customer->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Change Password')); ?>

                                </a>

                                <form class="deleteForm d-block"
                                  action="<?php echo e(route('admin.customer_management.customer_delete', ['id' => $customer->id])); ?>"
                                  method="post">
                                  <?php echo csrf_field(); ?>
                                  <button type="submit" class="deleteBtn">
                                    <?php echo e(__('Delete')); ?>

                                  </button>
                                </form>

                                <a target="_blank"
                                  href="<?php echo e(route('admin.customer_management.secret_login', ['id' => $customer->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Secret Login')); ?>

                                </a>
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

        <div class="card-footer text-center">
          <div class="d-inline-block mt-3">
            <?php echo e($customers->appends(['info' => request()->input('info')])->links()); ?>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/end-user/customer/index.blade.php ENDPATH**/ ?>
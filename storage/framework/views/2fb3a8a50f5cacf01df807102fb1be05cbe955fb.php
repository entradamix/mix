<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Product Order')); ?></h4>
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
        <a href="#"><?php echo e(__('Manage Orders')); ?></a>
      </li>
      <?php if(!request()->filled('type')): ?>
        <li class="separator">
          <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?php echo e(__('All Orders')); ?></a>
        </li>
      <?php endif; ?>
      <?php if(request()->filled('type') && request()->input('type') == 'pending'): ?>
        <li class="separator">
          <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?php echo e(__('Pending Orders')); ?></a>
        </li>
      <?php endif; ?>
      <?php if(request()->filled('type') && request()->input('type') == 'processing'): ?>
        <li class="separator">
          <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?php echo e(__('Processing Orders')); ?></a>
        </li>
      <?php endif; ?>
      <?php if(request()->filled('type') && request()->input('type') == 'completed'): ?>
        <li class="separator">
          <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?php echo e(__('Completed Orders')); ?></a>
        </li>
      <?php endif; ?>
      <?php if(request()->filled('type') && request()->input('type') == 'rejected'): ?>
        <li class="separator">
          <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?php echo e(__('Rejected Orders')); ?></a>
        </li>
      <?php endif; ?>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title"><?php echo e(__('Product Order')); ?></div>
            </div>

            <div class="col-lg-6 offset-lg-2">
              <button class="btn btn-danger btn-sm float-right d-none bulk-delete ml-3 mt-1"
                data-href="<?php echo e(route('admin.product.order.bulk_delete')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>

              <form class="float-right ml-3" action="<?php echo e(route('admin.product.order')); ?>" method="GET">
                <input name="order_id" type="text" class="form-control" placeholder="Search By Order ID"
                  value="<?php echo e(!empty(request()->input('order_id')) ? request()->input('order_id') : ''); ?>">
              </form>

              <form id="searchByStatusForm" class="float-right d-flex flex-row align-items-center"
                action="<?php echo e(route('admin.product.order')); ?>" method="GET">
                <label class="mr-2"><?php echo e(__('Payment')); ?></label>
                <select class="form-control" name="status"
                  onchange="document.getElementById('searchByStatusForm').submit()">
                  <option value="" <?php echo e(empty(request()->input('status')) ? 'selected' : ''); ?>>
                    <?php echo e(__('All')); ?>

                  </option>
                  <option value="completed" <?php echo e(request()->input('status') == 'completed' ? 'selected' : ''); ?>>
                    <?php echo e(__('Completed')); ?>

                  </option>
                  <option value="processing" <?php echo e(request()->input('status') == 'processing' ? 'selected' : ''); ?>>
                    <?php echo e(__('Processing')); ?>

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

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($orders) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO PRODUCT ORDERS ARE FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Order ID')); ?></th>
                        <th scope="col"><?php echo e(__('Product Name')); ?></th>
                        <th scope="col"><?php echo e(__('Customer Name')); ?></th>
                        <th scope="col"><?php echo e(__('Paid via')); ?></th>
                        <th scope="col"><?php echo e(__('Payment Status')); ?></th>
                        <th scope="col"><?php echo e(__('Shipping Status')); ?></th>
                        <th scope="col"><?php echo e(__('Attachment')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($order->id); ?>">
                          </td>
                          <td><?php echo e('#' . $order->order_number); ?></td>
                          <?php
                            $order_item = \App\Models\ShopManagement\OrderItem::where('product_order_id', $order->id)->first();
                            if (!is_null($order_item)) {
                                $product = \App\Models\ShopManagement\ProductContent::where('product_id', $order_item->product_id)
                                    ->where('language_id', $defaultLang->id)
                                    ->first();
                                if (!is_null($product)) {
                                    $title = $product->title;
                                }
                            } else {
                                $product = null;
                            }
                          ?>

                          <td>
                            <?php if(!is_null($product)): ?>
                              <a href="<?php echo e(route('shop.details', ['slug' => $product->slug, 'id' => $product->product_id])); ?>"
                                target="_blank">
                                <?php echo e(strlen($title) > 35 ? mb_substr($title, 0, 35, 'utf-8') . '...' : $title); ?>

                              </a>
                            <?php endif; ?>

                          </td>


                          <td><?php echo e($order->billing_fname); ?> <?php echo e($order->billing_lname); ?></td>
                          <td><?php echo e(!is_null($order->method) ? $order->method : '-'); ?></td>
                          <td>
                            <?php if($order->gateway_type == 'online'): ?>
                              <h2 class="d-inline-block"><span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                              </h2>
                            <?php elseif($order->gateway_type == 'offline'): ?>
                              <?php if($order->payment_status == 'pending'): ?>
                                <form id="paymentStatusForm-<?php echo e($order->id); ?>" class="d-inline-block"
                                  action="<?php echo e(route('admin.order.update_payment_status', $order->id)); ?>" method="post">
                                  <?php echo csrf_field(); ?>
                                  <select
                                    class="form-control form-control-sm <?php if($order->payment_status == 'completed'): ?> bg-success <?php elseif($order->payment_status == 'pending'): ?> bg-warning text-dark <?php else: ?> bg-danger <?php endif; ?>"
                                    name="payment_status"
                                    onchange="document.getElementById('paymentStatusForm-<?php echo e($order->id); ?>').submit()">
                                    <option value="completed"
                                      <?php echo e($order->payment_status == 'completed' ? 'selected' : ''); ?>>
                                      <?php echo e(__('Completed')); ?>

                                    </option>
                                    <option value="pending" <?php echo e($order->payment_status == 'pending' ? 'selected' : ''); ?>>
                                      <?php echo e(__('Pending')); ?>

                                    </option>
                                    <option value="rejected"
                                      <?php echo e($order->payment_status == 'rejected' ? 'selected' : ''); ?>>
                                      <?php echo e(__('Rejected')); ?>

                                    </option>
                                  </select>
                                </form>
                              <?php else: ?>
                                <h2 class="d-inline-block">
                                  <?php if($order->payment_status == 'completed'): ?>
                                    <span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                                  <?php elseif($order->payment_status == 'rejected'): ?>
                                    <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                                  <?php endif; ?>
                                </h2>
                              <?php endif; ?>
                            <?php else: ?>
                              -
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php
                              $order_items = App\Models\ShopManagement\OrderItem::where('product_order_id', $order->id)
                                  ->select('product_id')
                                  ->get();
                              $only_digital = true;
                              foreach ($order_items as $key => $order_item) {
                                  $product = App\Models\ShopManagement\Product::where('id', $order_item->product_id)
                                      ->select('type')
                                      ->first();
                                  if ($product->type == 'physical') {
                                      $only_digital = false;
                                  }
                              }
                            ?>
                            <?php if($only_digital == false && $order->payment_status != 'rejected'): ?>
                              <?php if($order->order_status == 'pending' || $order->order_status == 'processing'): ?>
                                <form id="orderStatusForm-<?php echo e($order->id); ?>" class="d-inline-block"
                                  action="<?php echo e(route('admin.order.update_order_status', $order->id)); ?>" method="post">
                                  <?php echo csrf_field(); ?>
                                  <select
                                    class="form-control form-control-sm <?php if($order->order_status == 'completed'): ?> bg-success <?php elseif($order->order_status == 'pending'): ?> bg-warning text-dark <?php else: ?> bg-danger <?php endif; ?>"
                                    name="order_status"
                                    onchange="document.getElementById('orderStatusForm-<?php echo e($order->id); ?>').submit()">
                                    <option value="pending" <?php echo e($order->order_status == 'pending' ? 'selected' : ''); ?>>
                                      <?php echo e(__('Pending')); ?>

                                    </option>
                                    <option value="processing"
                                      <?php echo e($order->order_status == 'processing' ? 'selected' : ''); ?>>
                                      <?php echo e(__('Processing')); ?>

                                    </option>
                                    <option value="completed"
                                      <?php echo e($order->order_status == 'completed' ? 'selected' : ''); ?>>
                                      <?php echo e(__('Completed')); ?>

                                    </option>

                                    <option value="rejected" <?php echo e($order->order_status == 'rejected' ? 'selected' : ''); ?>>
                                      <?php echo e(__('Rejected')); ?>

                                    </option>
                                  </select>
                                </form>
                              <?php else: ?>
                                <?php if($order->order_status == 'completed'): ?>
                                  <span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                                <?php elseif($order->order_status == 'rejected'): ?>
                                  <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                                <?php endif; ?>
                              <?php endif; ?>
                            <?php else: ?>
                              -
                            <?php endif; ?>

                          </td>
                          <td>
                            <?php if(!is_null($order->receipt)): ?>
                              <a class="btn btn-sm btn-info" href="#" data-toggle="modal"
                                data-target="#attachmentModal-<?php echo e($order->id); ?>">
                                <?php echo e(__('Show')); ?>

                              </a>
                            <?php else: ?>
                              -
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
                                <a href="<?php echo e(route('admin.product_order.details', ['id' => $order->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Details')); ?>

                                </a>
                                <?php if($order->invoice_number != null): ?>
                                  <a href="<?php echo e(asset('assets/admin/file/order/invoices/' . $order->invoice_number)); ?>"
                                    class="dropdown-item" target="_blank">
                                    <?php echo e(__('Invoice')); ?>

                                  </a>
                                <?php endif; ?>

                                <form class="deleteForm d-block"
                                  action="<?php echo e(route('admin.product.order.delete', ['id' => $order->id])); ?>"
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

                        <?php echo $__env->make('backend.product.order.show-attachment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php echo e($orders->appends([
                    'order_id' => request()->input('order_id'),
                    'status' => request()->input('status'),
                ])->links()); ?>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/product/order/index.blade.php ENDPATH**/ ?>
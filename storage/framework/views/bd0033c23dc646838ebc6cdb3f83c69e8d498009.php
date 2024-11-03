<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Organizer Details')); ?></h4>
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
        <a href="#"><?php echo e(__('Organizers Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('admin.organizer_management.registered_organizer')); ?>"><?php echo e(__('Registered Organizer')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Organizer Details')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-lg-8">
                  <div class="author">
                    <?php if($organizer->photo == null): ?>
                      <img class="uploaded-img rounded-circle mh70" src="<?php echo e(asset('assets/front/images/user.png')); ?>"
                        alt="image">
                    <?php else: ?>
                      <img class="uploaded-img rounded-circle mh70"
                        src="<?php echo e(asset('assets/admin/img/organizer-photo/' . $organizer->photo)); ?>" alt="image">
                    <?php endif; ?>
                    <div class="h6 card-title"><?php echo e(__('Organizer Information')); ?></div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <a class="btn btn-info btn-sm float-right d-inline-block mr-2"
                    href="<?php echo e(route('admin.organizer_management.registered_organizer')); ?>">
                    <span class="btn-label">
                      <i class="fas fa-backward"></i>
                    </span>
                    <?php echo e(__('Back')); ?>

                  </a>
                </div>
              </div>

            </div>

            <div class="card-body">
              <div class="payment-information">
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Name') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(optional($organizer->organizer_info)->name); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Designation') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(optional($organizer->organizer_info)->designation); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Username') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e($organizer->username); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Email') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e($organizer->email); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Phone') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e($organizer->phone); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Balance') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(symbolPrice($organizer->amount)); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Country') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(optional($organizer->organizer_info)->country); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('City') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(optional($organizer->organizer_info)->city); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('State') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(optional($organizer->organizer_info)->state); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Zip Code') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(optional($organizer->organizer_info)->zip_code); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Address') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(optional($organizer->organizer_info)->address); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Details') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(optional($organizer->organizer_info)->details); ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-lg-5">
                  <div class="card-title d-inline-block">
                    <?php echo e(__('Events') . ' (' . $language->name . ' ' . __('Language') . ')'); ?>

                  </div>
                </div>

                <div class="col-lg-4">
                  <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="col-lg-2 offset-lg-1 mt-2 mt-lg-0">
                  <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                    data-href="<?php echo e(route('admin.event_management.bulk_delete_event')); ?>">
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

                  <?php if(count($events) == 0): ?>
                    <h3 class="text-center mt-2"><?php echo e(__('NO EVENT CONTENT FOUND FOR ') . $language->name . '!'); ?></h3>
                  <?php else: ?>
                    <div class="table-responsive">
                      <table class="table table-striped mt-3" id="basic-datatables">
                        <thead>
                          <tr>
                            <th scope="col">
                              <input type="checkbox" class="bulk-check" data-val="all">
                            </th>
                            <th scope="col"><?php echo e(__('Title')); ?></th>
                            <th scope="col"><?php echo e(__('Category')); ?></th>
                            <th scope="col"><?php echo e(__('Ticket')); ?></th>
                            <th scope="col"><?php echo e(__('Actions')); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td>
                                <input type="checkbox" class="bulk-check" data-val="<?php echo e($event->id); ?>">
                              </td>
                              <td width="20%">
                                <a target="_blank"
                                  href="<?php echo e(route('event.details', ['slug' => $event->slug, 'id' => $event->id])); ?>"><?php echo e(strlen($event->title) > 30 ? mb_substr($event->title, 0, 30, 'UTF-8') . '....' : $event->title); ?></a>
                              </td>
                              <td>
                                <?php echo e($event->category); ?>

                              </td>
                              <td>
                                <?php if($event->event_type == 'venue'): ?>
                                  <a href="<?php echo e(route('admin.event.ticket', ['language' => $defaultLang->code, 'event_id' => $event->id, 'event_type' => $event->event_type])); ?>"
                                    class="btn btn-success btn-sm"><?php echo e(__('Manage')); ?></a>
                                <?php endif; ?>
                              </td>
                              <td>
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <?php echo e(__('Select')); ?>

                                  </button>

                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a href="<?php echo e(route('admin.event_management.edit_event', ['id' => $event->id])); ?>"
                                      class="dropdown-item">
                                      <?php echo e(__('Edit')); ?>

                                    </a>

                                    <form class="deleteForm d-block"
                                      action="<?php echo e(route('admin.event_management.delete_event', ['id' => $event->id])); ?>"
                                      method="post">

                                      <?php echo csrf_field(); ?>
                                      <button type="submit" class="btn btn-sm deleteBtn">
                                        <?php echo e(__('Delete')); ?>

                                      </button>
                                    </form>
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
            <div class="card-footer"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/end-user/organizer/details.blade.php ENDPATH**/ ?>
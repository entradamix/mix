<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(__('Events')); ?></h4>
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
                <a href="#"><?php echo e(__('Event Management')); ?></a>
            </li>
            <?php if(!request()->filled('event_type')): ?>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a
                        href="<?php echo e(route('admin.event_management.event', ['language' => $defaultLang->code])); ?>"><?php echo e(__('All Events')); ?></a>
                </li>
            <?php endif; ?>
            <?php if(request()->filled('event_type') && request()->input('event_type') == 'venue'): ?>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a
                        href="<?php echo e(route('organizer.event_management.event', ['language' => $defaultLang->code, 'event_type' => 'venue'])); ?>"><?php echo e(__('Venue Events')); ?></a>
                </li>
            <?php endif; ?>
            <?php if(request()->filled('event_type') && request()->input('event_type') == 'online'): ?>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?php echo e(__('Online Events')); ?></a>
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
                            <div class="card-title d-inline-block">
                                <?php echo e(__('Events') . ' (' . $language->name . ' ' . __('Language') . ')'); ?>

                            </div>
                        </div>

                        <div class="col-lg-3">
                            <?php if(!empty($langs)): ?>
                                <select name="language" class="form-control"
                                    onchange="window.location='<?php echo e(url()->current() . '?language='); ?>' + this.value+'&event_type='+'<?php echo e(request()->input('event_type')); ?>'">
                                    <option selected disabled><?php echo e(__('Select a Language')); ?></option>
                                    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lang->code); ?>"
                                            <?php echo e($lang->code == request()->input('language') ? 'selected' : ''); ?>>
                                            <?php echo e($lang->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">

                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-sm float-right" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <?php echo e(__('Add Event')); ?>

                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a href="<?php echo e(route('organizer.add.event.event', ['type' => 'online'])); ?>"
                                        class="dropdown-item">
                                        <?php echo e(__('Online Event')); ?>

                                    </a>

                                    <a href="<?php echo e(route('organizer.add.event.event', ['type' => 'venue'])); ?>"
                                        class="dropdown-item">
                                        <?php echo e(__('Venue Event')); ?>

                                    </a>
                                </div>
                            </div>

                            <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                                data-href="<?php echo e(route('organizer.event_management.bulk_delete_event')); ?>">
                                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="float-right">
                                <div class="form-group">
                                    <form action="" method="get">
                                        <input type="hidden" name="language" value="<?php echo e(request()->input('language')); ?>"
                                            class="hidden">
                                        <input type="text" name="title" value="<?php echo e(request()->input('title')); ?>"
                                            name="name" placeholder="Enter Event Name" class="form-control">
                                    </form>
                                </div>
                            </div>

                            <?php if(count($events) == 0): ?>
                                <h3 class="text-center mt-2">
                                    <?php echo e(__('NO EVENT CONTENT FOUND FOR ') . $language->name . '!'); ?></h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3" id="">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <input type="checkbox" class="bulk-check" data-val="all">
                                                </th>
                                                <th scope="col" width="30%"><?php echo e(__('Title')); ?></th>
                                                <th scope="col"><?php echo e(__('Type')); ?></th>
                                                <th scope="col"><?php echo e(__('Category')); ?></th>
                                                <th scope="col"><?php echo e(__('Ticket')); ?></th>
                                                <th scope="col"><?php echo e(__('Status')); ?></th>
                                                <th scope="col"><?php echo e(__('Featured')); ?></th>
                                                <th scope="col"><?php echo e(__('Actions')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="bulk-check"
                                                            data-val="<?php echo e($event->id); ?>">
                                                    </td>
                                                    <td width="20%">
                                                        <a target="_blank"
                                                            href="<?php echo e(route('event.details', ['slug' => $event->slug, 'id' => $event->id])); ?>"><?php echo e(strlen($event->title) > 30 ? mb_substr($event->title, 0, 30, 'UTF-8') . '....' : $event->title); ?></a>
                                                    </td>
                                                    <td>
                                                        <?php echo e(ucfirst($event->event_type)); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e($event->category); ?>

                                                    </td>
                                                    <td>
                                                        <?php if($event->event_type == 'venue'): ?>
                                                            <a href="<?php echo e(route('organizer.event.ticket', ['language' => request()->input('language'), 'event_id' => $event->id, 'event_type' => $event->event_type])); ?>"
                                                                class="btn btn-success btn-sm"><?php echo e(__('Manage')); ?></a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <form id="statusForm-<?php echo e($event->id); ?>" class="d-inline-block"
                                                            action="<?php echo e(route('organizer.event_management.event.event_status', ['id' => $event->id, 'language' => request()->input('language')])); ?>"
                                                            method="post">

                                                            <?php echo csrf_field(); ?>
                                                            <select
                                                                class="form-control form-control-sm <?php echo e($event->status == 0 ? 'bg-warning text-dark' : 'bg-primary'); ?>"
                                                                name="status"
                                                                onchange="document.getElementById('statusForm-<?php echo e($event->id); ?>').submit()">
                                                                <option value="1"
                                                                    <?php echo e($event->status == 1 ? 'selected' : ''); ?>>
                                                                    <?php echo e(__('Active')); ?>

                                                                </option>
                                                                <option value="0"
                                                                    <?php echo e($event->status == 0 ? 'selected' : ''); ?>>
                                                                    <?php echo e(__('Deactive')); ?>

                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>

                                                        <form id="featuredForm-<?php echo e($event->id); ?>"
                                                            class="d-inline-block"
                                                            action="<?php echo e(route('organizer.event_management.event.update_featured', ['id' => $event->id])); ?>"
                                                            method="post">

                                                            <?php echo csrf_field(); ?>
                                                            <select
                                                                class="form-control form-control-sm <?php echo e($event->is_featured == 'yes' ? 'bg-success' : 'bg-danger'); ?>"
                                                                name="is_featured"
                                                                onchange="document.getElementById('featuredForm-<?php echo e($event->id); ?>').submit()">
                                                                <option value="yes"
                                                                    <?php echo e($event->is_featured == 'yes' ? 'selected' : ''); ?>>
                                                                    <?php echo e(__('Yes')); ?>

                                                                </option>
                                                                <option value="no"
                                                                    <?php echo e($event->is_featured == 'no' ? 'selected' : ''); ?>>
                                                                    <?php echo e(__('No')); ?>

                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle btn-sm"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <?php echo e(__('Select')); ?>

                                                            </button>

                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton">
                                                                <a href="<?php echo e(route('organizer.event_management.edit_event', ['id' => $event->id])); ?>"
                                                                    class="dropdown-item">
                                                                    <?php echo e(__('Edit')); ?>

                                                                </a>

                                                                <form class="deleteForm d-block"
                                                                    action="<?php echo e(route('organizer.event_management.delete_event', ['id' => $event->id])); ?>"
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

                <div class="card-footer text-center">
                    <div class="d-inline-block mt-3">
                        <?php echo e($events->appends([
                                'language' => request()->input('language'),
                                'title' => request()->input('title'),
                            ])->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('organizer.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/organizer/event/index.blade.php ENDPATH**/ ?>
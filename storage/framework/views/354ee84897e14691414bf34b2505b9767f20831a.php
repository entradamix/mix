<?php $__env->startSection('pageHeading'); ?>
    <?php if(!empty($pageHeading)): ?>
        <?php echo e($pageHeading->customer_dashboard_page_title ?? __('Dashboard')); ?>

    <?php else: ?>
        <?php echo e(__('Dashboard')); ?>

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
                        <?php echo e($pageHeading->customer_dashboard_page_title ?? __('Dashboard')); ?>

                    <?php else: ?>
                        <?php echo e(__('Dashboard')); ?>

                    <?php endif; ?>
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
                        <li class="breadcrumb-item active">
                            <?php if(!empty($pageHeading)): ?>
                                <?php echo e($pageHeading->customer_dashboard_page_title ?? __('Dashboard')); ?>

                            <?php else: ?>
                                <?php echo e(__('Dashboard')); ?>

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
    <!--====== Start Dashboard Section ======-->
    <section class="user-dashbord">
        <div class="container">
            <div class="row">
                <?php if ($__env->exists('frontend.customer.partials.sidebar')) echo $__env->make('frontend.customer.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-lg-9">
                    <div class="row mb-5">
                        <div class="col-lg-12">
                            <div class="user-profile-details">
                                <div class="account-info">
                                    <div class="title">
                                        <h4><?php echo e(__('Account Information')); ?></h4>
                                    </div>
                                    <div class="main-info">
                                        <h5><?php echo e(__('User')); ?></h5>
                                        <ul class="list">
                                            <?php if(Auth::guard('customer')->user()->email != null): ?>
                                                <li><b><?php echo e(__('Email') . ' : '); ?></b></li>
                                            <?php endif; ?>
                                            <?php if(Auth::guard('customer')->user()->username != null): ?>
                                                <li><b><?php echo e(__('Username') . ' : '); ?></b></li>
                                            <?php endif; ?>
                                            <?php if(Auth::guard('customer')->user()->phone != null): ?>
                                                <li><b><?php echo e(__('Phone') . ' : '); ?></b></li>
                                            <?php endif; ?>
                                            <?php if(Auth::guard('customer')->user()->address != null): ?>
                                                <li><b><?php echo e(__('Address') . ' : '); ?></b></li>
                                            <?php endif; ?>
                                            <?php if(Auth::guard('customer')->user()->country != null): ?>
                                                <li><b><?php echo e(__('Country') . ' : '); ?></b></li>
                                            <?php endif; ?>
                                            <?php if(Auth::guard('customer')->user()->city != null): ?>
                                                <li><b><?php echo e(__('City') . ' : '); ?></b></li>
                                            <?php endif; ?>
                                            <?php if(Auth::guard('customer')->user()->state != null): ?>
                                                <li><b><?php echo e(__('State') . ' : '); ?></b></li>
                                            <?php endif; ?>
                                            <?php if(Auth::guard('customer')->user()->zip_code != null): ?>
                                                <li><b><?php echo e(__('Zip-code') . ' : '); ?> </b></li>
                                            <?php endif; ?>
                                        </ul>
                                        <ul class="list w-60p">
                                            <li><?php echo e(Auth::guard('customer')->user()->email); ?></li>
                                            <li><?php echo e(Auth::guard('customer')->user()->username); ?></li>
                                            <li><?php echo e(Auth::guard('customer')->user()->phone); ?></li>
                                            <li><?php echo e(Auth::guard('customer')->user()->address); ?></li>
                                            <li><?php echo e(Auth::guard('customer')->user()->country); ?></li>
                                            <li><?php echo e(Auth::guard('customer')->user()->city); ?></li>
                                            <li><?php echo e(Auth::guard('customer')->user()->state); ?></li>
                                            <li><?php echo e(Auth::guard('customer')->user()->zip_code); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="account-info">
                                <div class="title">
                                    <h4><?php echo e(__('Recent Bookings')); ?></h4>
                                </div>
                                <div class="main-info">
                                    <div class="main-table">
                                        <div class="table-responsiv">
                                            <table id="example"
                                                class="dataTables_wrapper dt-responsive table-striped dt-bootstrap4 w-100">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Event Title')); ?></th>
                                                        <th><?php echo e(__('Organizer')); ?></th>
                                                        <th><?php echo e(__('Event Date')); ?></th>
                                                        <th><?php echo e(__('Booking Date')); ?></th>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $event = $item
                                                                ->event()
                                                                ->where('language_id', $currentLanguageInfo->id)
                                                                ->select('title', 'slug', 'event_id')
                                                                ->first();
                                                            if (empty($event)) {
                                                                $language = App\Models\Language::where('is_default', 1)->first();
                                                                $event = $item
                                                                    ->event()
                                                                    ->where('language_id', $language->id)
                                                                    ->select('title', 'slug', 'event_id')
                                                                    ->first();
                                                            }
                                                        ?>
                                                        <?php if(!empty($event)): ?>
                                                            <tr>

                                                                <td>
                                                                    <a target="_blank"
                                                                        href="<?php echo e(route('event.details', ['slug' => $event->slug, 'id' => $event->event_id])); ?>"><?php echo e(strlen($event->title) > 30 ? mb_substr($event->title, 0, 30) . '...' : $event->title); ?></a>
                                                                </td>
                                                                <td>
                                                                    <?php if($item->organizer): ?>
                                                                        <a target="_blank"
                                                                            href="<?php echo e(route('frontend.organizer.details', [$item->organizer->id, str_replace(' ', '-', $item->organizer->username)])); ?>"><?php echo e($item->organizer->username); ?></a>
                                                                    <?php else: ?>
                                                                        <span
                                                                            class="badge badge-success"><?php echo e(__('Admin')); ?></span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo e(\Carbon\Carbon::parse($item->event_date)->translatedFormat('D, M d, Y h:i a')); ?>

                                                                </td>
                                                                <td><?php echo e(\Carbon\Carbon::parse($item->created_at)->translatedFormat('D, M d, Y h:i a')); ?>

                                                                </td>
                                                                <td><a href="<?php echo e(route('customer.booking_details', $item->id)); ?>"
                                                                        class="btn"><?php echo e(__('Details')); ?></a></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Dashboard Section ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/frontend/customer/dashboard/index.blade.php ENDPATH**/ ?>
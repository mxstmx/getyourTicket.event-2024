
<li class="nav-item dropdown ">
    <?php
        $data = notifications();
    ?>

    <a class="nav-link dropdown-toggle" href="#" id="blogDropdown" role="button" data-bs-toggle="dropdown"
        aria-expanded="false" v-pre>
        <span class="position-relative btn btn-sm btn-primary badge">
            <i class="fas fa-bell text-white"> </i>
            <?php if($data['total_notify'] > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger rounded-circle"></span>
            <?php endif; ?>
        </span>
        <i class="fas fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="blogDropdown">
        <?php if(!empty($data['notifications'])): ?>
            <?php $__currentLoopData = $data['notifications']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item dropdown">
                    <a class="dropdown-item" href="<?php echo e(route('eventmie.notify_read', [$notification->n_type])); ?>">
                        <?php echo e($notification->total); ?>

                        <?php if($notification->n_type == 'user'): ?>
                            <?php echo app('translator')->get('eventmie-pro::em.user'); ?>
                        <?php elseif($notification->n_type == 'cancel'): ?>
                            <?php echo app('translator')->get('eventmie-pro::em.booking_cancellation'); ?>
                        <?php elseif($notification->n_type == 'review'): ?>
                            <?php echo app('translator')->get('eventmie-pro::em.show_reviews'); ?>
                        <?php elseif($notification->n_type == 'contact'): ?>
                            <?php echo app('translator')->get('eventmie-pro::em.contact'); ?>
                        <?php elseif($notification->n_type == 'events'): ?>
                            <?php echo app('translator')->get('eventmie-pro::em.event'); ?>
                        <?php elseif($notification->n_type == 'Approve-Organizer'): ?>
                            <?php echo app('translator')->get('eventmie-pro::em.requested_to_become_organiser'); ?>
                        <?php elseif($notification->n_type == 'Approved-Organizer'): ?>
                            <?php echo app('translator')->get('eventmie-pro::em.became_organiser_successful'); ?>
                        <?php elseif($notification->n_type == 'bookings'): ?>
                            <?php echo app('translator')->get('eventmie-pro::em.booking'); ?>
                        <?php elseif($notification->n_type == 'forgot_password'): ?>
                            <?php echo app('translator')->get('eventmie-pro::em.reset_password'); ?>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <li class="nav-item dropdown">
                <a class="dropdown-item"> <?php echo app('translator')->get('eventmie-pro::em.no_notifications'); ?></a>
            </li>
        <?php endif; ?>
    </ul>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="blogDropdown" role="button" data-bs-toggle="dropdown"
        aria-expanded="false" v-pre>
        <?php if(Auth::user()->hasRole('customer')): ?>
            <i class="fas fa-user-circle"></i>
        <?php elseif(Auth::user()->hasRole('organiser')): ?>
            <i class="fas fa-person-booth"></i>
        <?php else: ?>
            <i class="fas fa-user-shield"></i>
        <?php endif; ?>

        <?php echo e(Auth::user()->name); ?> <i class="fas fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="blogDropdown">

        
        <?php if(Auth::user()->hasRole('customer')): ?>
            <li class="nav-item dropdown ">
                <a class="dropdown-item" href="<?php echo e(route('eventmie.profile')); ?>"><i class="fas fa-id-card"></i>
                    <?php echo app('translator')->get('eventmie-pro::em.profile'); ?></a>
            </li>
            <li class="nav-item dropdown ">
                <a class="dropdown-item" href="<?php echo e(route('eventmie.mybookings_index')); ?>"><i
                        class="fas fa-money-check-alt"></i> <?php echo app('translator')->get('eventmie-pro::em.mybookings'); ?></a>
            </li>
            <li class="nav-item dropdown ">
                <a class="dropdown-item" href="<?php echo e(route('eventmie.profile')); ?>#/becomeOrganiser"><i
                        class="fas fa-person-booth"></i>
                    <?php echo app('translator')->get('eventmie-pro::em.become_organiser'); ?></a>
            </li>
        <?php endif; ?>

        
        <?php if(Auth::user()->hasRole('organiser')): ?>
            <li class="nav-item dropdown">
                <a class="dropdown-item" href="<?php echo e(route('eventmie.profile')); ?>"><i class="fas fa-id-card"></i>
                    <?php echo app('translator')->get('eventmie-pro::em.profile'); ?></a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-item" href="<?php echo e(route('eventmie.o_dashboard')); ?>"><i
                        class="fas fa-tachometer-alt"></i> <?php echo app('translator')->get('eventmie-pro::em.dashboard'); ?></a>
            </li>
        <?php endif; ?>

        
        <?php if(Auth::user()->hasRole('pos')): ?>
            <li class="nav-item dropdown">
                <a class="dropdown-item" href="<?php echo e(route('pos.o_dashboard')); ?>">
                    <i class="fas fa-money-check-alt"></i> <?php echo app('translator')->get('eventmie-pro::em.pos'); ?> <?php echo app('translator')->get('eventmie-pro::em.dashboard'); ?></a>
            </li>
        <?php endif; ?>

        <?php if(Auth::user()->hasRole('scanner')): ?>
            
            <li class="nav-item dropdown">
                <a class="dropdown-item" href="<?php echo e(route('scanner.o_dashboard')); ?>">
                    <i class="fas fa-money-check-alt"></i> <?php echo app('translator')->get('eventmie-pro::em.scanner'); ?> <?php echo app('translator')->get('eventmie-pro::em.dashboard'); ?></a>
            </li>
        <?php endif; ?>
        


        
        <?php if(Auth::user()->hasRole('admin')): ?>
            <li class="nav-item dropdown">
                <a class="dropdown-item" href="<?php echo e(eventmie_url() . '/' . config('eventmie.route.admin_prefix')); ?>"><i
                        class="fas fa-tachometer-alt"></i> <?php echo app('translator')->get('eventmie-pro::em.admin_panel'); ?></a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-item" href="<?php echo e(route('eventmie.profile')); ?>"><i class="fas fa-id-card"></i>
                    <?php echo app('translator')->get('eventmie-pro::em.profile'); ?></a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-item" href="<?php echo e(route('eventmie.ticket_scan')); ?>"><i class="fas fa-qrcode"></i>
                    <?php echo app('translator')->get('eventmie-pro::em.scan_ticket'); ?></a>
            </li>


            
            <li class="nav-item dropdown">
                <a class="dropdown-item" href="<?php echo e(route('failed-bookings.index')); ?>"
                    title="<?php echo app('translator')->get('eventmie-pro::em.failed'); ?> <?php echo app('translator')->get('eventmie-pro::em.bookings'); ?>">
                    <span class="nav-icon"><i class="fa fa-exclamation-triangle"></i></span>
                    <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.failed'); ?> <?php echo app('translator')->get('eventmie-pro::em.bookings'); ?></span>
                </a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="dropdown-item" href="<?php echo e(route('eventmie.myevents_form')); ?>"><i
                        class="fas fa-calendar-plus"></i> <?php echo app('translator')->get('eventmie-pro::em.create_event'); ?></a>
            </li>
        <?php endif; ?>

        <li class="nav-item dropdown">
            <a class="dropdown-item" href="<?php echo e(route('eventmie.logout')); ?>"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> <?php echo app('translator')->get('eventmie-pro::em.logout'); ?>
            </a>
            <form id="logout-form" action="<?php echo e(route('eventmie.logout')); ?>" method="POST" style="display: none;">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            </form>
        </li>
    </ul>
</li>




<?php if(Auth::user()->hasRole('admin')): ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('eventmie.ticket_scan')); ?>"><i class="fas fa-qrcode"></i>
            <?php echo app('translator')->get('eventmie-pro::em.scan_ticket'); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('eventmie.myevents_form')); ?>"><i class="fas fa-calendar-plus"></i>
            <?php echo app('translator')->get('eventmie-pro::em.create_event'); ?></a>
    </li>
<?php endif; ?>


<?php if(Auth::user()->hasRole('organiser')): ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('eventmie.ticket_scan')); ?>"><i class="fas fa-qrcode"></i>
            <?php echo app('translator')->get('eventmie-pro::em.scan_ticket'); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('eventmie.myevents_form')); ?>"><i class="fas fa-calendar-plus"></i>
            <?php echo app('translator')->get('eventmie-pro::em.create_event'); ?></a>
    </li>
<?php endif; ?>


<?php if(Auth::user()->hasRole('customer')): ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('eventmie.mybookings_index')); ?>"><i class="fas fa-money-check-alt"></i>
            <?php echo app('translator')->get('eventmie-pro::em.mybookings'); ?></a>
    </li>
<?php endif; ?>
<?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/layouts/member_header.blade.php ENDPATH**/ ?>
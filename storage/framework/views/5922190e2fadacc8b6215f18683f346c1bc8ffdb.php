<div id="db-wrapper-two">
    <nav class="navbar-vertical-compact shadow-sm ">
        <div data-simplebar style="" class="vh-100 mt-12">
            <ul class="navbar-nav flex-column" id="sideNavbar">

                <?php if(Auth::user()->hasRole('admin')): ?>
                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'eventmie.myevents_index' || Route::currentRouteName() == 'eventmie.myevents_form' ? 'active' : ''); ?>"
                            href="<?php echo e(route('eventmie.myevents_index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.events'); ?>">
                            <span class="nav-icon"><i class="fas fa-calendar"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.events'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'eventmie.ticket_scan' ? 'active' : ''); ?>"
                            href="<?php echo e(route('eventmie.ticket_scan')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.scan_ticket'); ?>">
                            <span class="nav-icon"><i class="fas fa-qrcode"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.scan_ticket'); ?></span>
                        </a>
                    </li>

                    
                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'failed-bookings.index' ? 'active' : ''); ?>"
                            href="<?php echo e(route('failed-bookings.index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.failed'); ?> <?php echo app('translator')->get('eventmie-pro::em.bookings'); ?>">
                            <span class="nav-icon"><i class="fa fa-exclamation-triangle"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.failed'); ?> <?php echo app('translator')->get('eventmie-pro::em.bookings'); ?></span>
                        </a>
                    </li>
                    
                <?php endif; ?>

                <?php if(Auth::user()->hasRole('organiser')): ?>
                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'eventmie.o_dashboard' ? 'active' : ''); ?>"
                            href="<?php echo e(route('eventmie.o_dashboard')); ?>" data-bs-toggle="tooltip"
                            data-bs-placement="right" title="<?php echo app('translator')->get('eventmie-pro::em.dashboard'); ?>">
                            <span class="nav-icon"><i class="fas fa-gauge"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.dashboard'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'eventmie.myevents_index' || Route::currentRouteName() == 'eventmie.myevents_form' ? 'active' : ''); ?>"
                            href="<?php echo e(route('eventmie.myevents_index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.myevents'); ?>">
                            <span class="nav-icon"><i class="fas fa-calendar"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.myevents'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'eventmie.ticket_scan' ? 'active' : ''); ?>"
                            href="<?php echo e(route('eventmie.ticket_scan')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.scan_ticket'); ?>">
                            <span class="nav-icon"><i class="fas fa-qrcode"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.scan_ticket'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'eventmie.obookings_index' ? 'active' : ''); ?>"
                            href="<?php echo e(route('eventmie.obookings_index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.mybookings'); ?>">
                            <span class="nav-icon"><i class="fas fa-money-check-alt"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.mybookings'); ?></span>
                        </a>
                    </li>


                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'eventmie.event_earning_index' ? 'active' : ''); ?>"
                            href="<?php echo e(route('eventmie.event_earning_index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.myearning'); ?>">
                            <span class="nav-icon"><i class="fas fa-wallet"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.myearning'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'eventmie.tags_form' ? 'active' : ''); ?>"
                            href="<?php echo e(route('eventmie.tags_form')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.mytags'); ?>">
                            <span class="nav-icon"><i class="fas fa-user-tag"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.mytags'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'eventmie.myvenues.index' ? 'active' : ''); ?>"
                            href="<?php echo e(route('eventmie.myvenues.index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.myvenues'); ?>">
                            <span class="nav-icon"><i class="fas fa-map-location"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.myvenues'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'myglists_index' ? 'active' : ''); ?>"
                            href="<?php echo e(route('myglists_index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.manage'); ?> <?php echo app('translator')->get('eventmie-pro::em.guests'); ?>">
                            <span class="nav-icon"><i class="fas fa-people-group"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.guests'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'sub_organizer.index' ? 'active' : ''); ?>"
                            href="<?php echo e(route('sub_organizer.index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.manage'); ?> <?php echo app('translator')->get('eventmie-pro::em.sub_organizers'); ?>">
                            <span class="nav-icon"><i class="fas fa-people-arrows"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.sub_organizers'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'manage_reviews.index' ? 'active' : ''); ?>"
                            href="<?php echo e(route('manage_reviews.index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.manage'); ?> <?php echo app('translator')->get('eventmie-pro::em.review'); ?>">
                            <span class="nav-icon"><i class="fas fa-star-half-stroke"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.reviews'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Auth::user()->hasRole('pos')): ?>
                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'pos.o_dashboard' ? 'active' : ''); ?>"
                            href="<?php echo e(route('pos.o_dashboard')); ?>" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="<?php echo app('translator')->get('eventmie-pro::em.pos'); ?> <?php echo app('translator')->get('eventmie-pro::em.dashboard'); ?>">
                            <span class="nav-icon"><i class="fas fa-gauge"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.pos'); ?> <?php echo app('translator')->get('eventmie-pro::em.dashboard'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'pos.index' ? 'active' : ''); ?>"
                            href="<?php echo e(route('pos.index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.pos'); ?> <?php echo app('translator')->get('eventmie-pro::em.bookings'); ?>">
                            <span class="nav-icon"><i class="fas fa-money-check-alt"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.pos'); ?> <?php echo app('translator')->get('eventmie-pro::em.bookings'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Auth::user()->hasRole('scanner')): ?>
                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'scanner.o_dashboard' ? 'active' : ''); ?>"
                            href="<?php echo e(route('scanner.o_dashboard')); ?>" data-bs-toggle="tooltip"
                            data-bs-placement="right" title="<?php echo app('translator')->get('eventmie-pro::em.scanner'); ?> <?php echo app('translator')->get('eventmie-pro::em.dashboard'); ?>">
                            <span class="nav-icon"><i class="fas fa-gauge"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.scanner'); ?> <?php echo app('translator')->get('eventmie-pro::em.dashboard'); ?></span>
                        </a>
                    </li>

                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'eventmie.ticket_scan' ? 'active' : ''); ?>"
                            href="<?php echo e(route('eventmie.ticket_scan')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.scan'); ?> <?php echo app('translator')->get('eventmie-pro::em.ticket'); ?>">
                            <span class="nav-icon"><i class="fas fa-qrcode"></i></span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.scan'); ?> <?php echo app('translator')->get('eventmie-pro::em.ticket'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item tooltip-custom">
                        <a class="nav-link <?php echo e(Route::currentRouteName() == 'scanner.index' ? 'active' : ''); ?>"
                            href="<?php echo e(route('scanner.index')); ?>" title="<?php echo app('translator')->get('eventmie-pro::em.scanner'); ?> <?php echo app('translator')->get('eventmie-pro::em.bookings'); ?>">
                            <span class="nav-icon"><i class="fas fa-money-check-alt"></i> </span>
                            <span class="tooltiptext"><?php echo app('translator')->get('eventmie-pro::em.scanner'); ?> <?php echo app('translator')->get('eventmie-pro::em.bookings'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </nav>
</div>
<?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/o_dashboard/sidebar.blade.php ENDPATH**/ ?>
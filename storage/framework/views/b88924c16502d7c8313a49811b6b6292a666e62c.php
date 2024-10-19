<div id="navbar_vue"
    class="nav-header nav-header-classic <?php echo e(\Str::contains(url()->current(), 'dashboard') ? 'shadow menu-fixed nav-dashboard' : 'menu-space header-position header-white'); ?>">
    <div class="<?php echo e(\Str::contains(url()->current(), 'dashboard') ? 'dashboard-container' : 'container'); ?>">
        <div class="row">
            <div class="col-md-12">
                <!-- GDPR -->
                <cookie-law theme="gdpr" button-text="<?php echo app('translator')->get('eventmie-pro::em.accept'); ?>">
                    <div slot="message">
                        <gdpr-message></gdpr-message>
                    </div>
                </cookie-law>
                <!-- GDPR -->

                <!-- Vue Alert message -->
                <?php if($errors->any()): ?>
                    <alert-message :errors="<?php echo e(json_encode($errors->all(), JSON_HEX_APOS)); ?>"></alert-message>
                <?php endif; ?>

                <?php if(session('status')): ?>
                    <alert-message :message="'<?php echo e(session('status')); ?>'"></alert-message>
                <?php endif; ?>
                <!-- Vue Alert message -->

                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand pr-5" href="<?php echo e(url('')); ?>">
                        <img src="/storage/<?php echo e(setting('site.logo')); ?>"
                            class="mx-auto d-blocks <?php echo e(App::isLocale('ar') ? 'float-end' : 'float-start'); ?>"
                            alt="<?php echo e(setting('site.site_name')); ?>" style="height:50px;" />
                        <div class="my-2">
                            <p class="py-0 my-0 l-height site-name">
                                &nbsp;&nbsp;<?php echo e(setting('site.site_name')); ?>

                            </p>
                            <p class="py-0 my-0 site-slogan">
                                &nbsp;&nbsp;<?php echo e(setting('site.site_slogan')); ?>

                            </p>
                        </div>
                    </a>
                    <button class="navbar-toggler collapsed " type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" id='navbartoggler'>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>


                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-lg-3">
                            <!-- Authentication Links -->
                            <?php if(auth()->guard()->guest()): ?>
                                <?php echo $__env->make('eventmie::layouts.guest_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('eventmie::layouts.member_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('eventmie.venues.index')); ?>"><i
                                        class="fas fa-map-location"></i> <?php echo app('translator')->get('eventmie-pro::em.venues'); ?></a>
                            </li>

                            
                            
                            <?php $categoriesMenu = categoriesMenu() ?>
                            <?php if(!empty($categoriesMenu)): ?>

                                <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle" href="#" id="homeDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="fas fa-bars-staggered"></i>
                                        <?php echo app('translator')->get('eventmie-pro::em.categories'); ?>&nbsp;<i class="fas fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php $__currentLoopData = $categoriesMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('eventmie.events_index', ['category' => urlencode($val->name)])); ?>">
                                                    <?php echo e($val->name); ?>

                                                </a>

                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>

                            <?php endif; ?>

                            
                            <?php $headerMenuItems = headerMenu() ?>
                            <?php if(!empty($headerMenuItems)): ?>
                                <li class="nav-item dropdown ">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle nav-item dropdown"
                                        href="#" data-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false" v-pre><i class="fas fa-grip-vertical"></i>
                                        <?php echo app('translator')->get('eventmie-pro::em.more'); ?> &nbsp;<i class="fas fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu  nav-item dropdown">
                                        <?php $__currentLoopData = $headerMenuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($parentItem->submenu)): ?>
                                                <li class="nav-item dropdown">
                                                    <a disabled class="dropdown-item disabled" data-toggle="dropdown"
                                                        role="button" aria-haspopup="true" aria-expanded="false"><i
                                                            class="<?php echo e($parentItem->icon_class); ?>"></i>
                                                        <?php echo e($parentItem->title); ?> &nbsp;&nbsp;<i
                                                            class="fas fa-angle-right"></i></a>
                                                    <ul class="dropdown-menu">
                                                        <?php $__currentLoopData = $parentItem->submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    target="<?php echo e($childItem->target); ?>"
                                                                    href="<?php echo e($childItem->url); ?>">
                                                                    <i class="<?php echo e($childItem->icon_class); ?>"></i>
                                                                    <?php echo e($childItem->title); ?>

                                                                </a>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a class="dropdown-item" target="<?php echo e($parentItem->target); ?>"
                                                        href="<?php echo e($parentItem->url); ?>">
                                                        <i class="<?php echo e($parentItem->icon_class); ?>"></i>
                                                        <?php echo e($parentItem->title); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php endif; ?>

                        </ul>

                        <a href="<?php echo e(route('eventmie.events_index')); ?>"
                            class="btn btn-primary d-none d-lg-block bg-gradient">
                            <i class="fas fa-calendar-day"></i> <?php echo app('translator')->get('eventmie-pro::em.browse_events'); ?>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/layouts/header.blade.php ENDPATH**/ ?>
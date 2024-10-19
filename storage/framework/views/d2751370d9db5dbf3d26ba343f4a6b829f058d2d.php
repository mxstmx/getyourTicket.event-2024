<div class="footer pt-10 bg-secondary">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-3">
                <h5 class="mb-3 text-white"><?php echo app('translator')->get('eventmie-pro::em.useful_links'); ?></h5>
                <div>
                    <ul class="list-unstyled">
                        <li><a class="text-white lh-lg"
                                href="<?php echo e(route('eventmie.page', ['page' => 'about'])); ?>"><?php echo app('translator')->get('eventmie-pro::em.about'); ?></a>
                        </li>
                        <li><a class="text-white lh-lg" href="<?php echo e(route('eventmie.events_index')); ?>"><?php echo app('translator')->get('eventmie-pro::em.events'); ?></a>
                        </li>
                        <li><a class="text-white lh-lg" href="<?php echo e(route('eventmie.get_posts')); ?>"><?php echo app('translator')->get('eventmie-pro::em.blogs'); ?></a>
                        </li>
                        <li><a class="text-white lh-lg"
                                href="<?php echo e(route('eventmie.page', ['page' => 'terms'])); ?>"><?php echo app('translator')->get('eventmie-pro::em.terms'); ?></a>
                        </li>
                        <li><a class="text-white lh-lg"
                                href="<?php echo e(route('eventmie.page', ['page' => 'privacy'])); ?>"><?php echo app('translator')->get('eventmie-pro::em.privacy'); ?></a>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <h5 class="mb-3 text-white"><?php echo app('translator')->get('eventmie-pro::em.social'); ?></h5>
                <div>
                    <ul class="list-unstyled">
                        <?php if(setting('social.facebook')): ?>
                            <li><a href="<?php echo e('https://www.facebook.com/' . setting('social.facebook')); ?>" target="_blank"
                                    class="text-white lh-lg"><?php echo app('translator')->get('eventmie-pro::em.facebook'); ?></a>
                        <?php endif; ?>
                        <?php if(setting('social.twitter')): ?>
                            <li><a href="<?php echo e('https://twitter.com/' . setting('social.twitter')); ?>" target="_blank"
                                    class="text-white lh-lg"><?php echo app('translator')->get('eventmie-pro::em.twitter'); ?></a>
                        <?php endif; ?>
                        <?php if(setting('social.instagram')): ?>
                            <li><a href="<?php echo e(setting('social.instagram')); ?>" target="_blank"
                                    class="text-white lh-lg"><?php echo app('translator')->get('eventmie-pro::em.instagram'); ?></a>
                        <?php endif; ?>
                        <?php if(setting('social.linkedin')): ?>
                            <li><a href="<?php echo e(setting('social.linkedin')); ?>" target="_blank"
                                    class="text-white lh-lg"><?php echo app('translator')->get('eventmie-pro::em.linkedin'); ?></a>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <h5 class="mb-3 text-white"><?php echo app('translator')->get('eventmie-pro::em.contact'); ?></h5>
                <div>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(route('eventmie.contact')); ?>" class="text-white lh-lg"><?php echo app('translator')->get('eventmie-pro::em.contact_send_message'); ?></a>
                        </li>
                        <li><a href="<?php echo e(route('eventmie.contact')); ?>" class="text-white lh-lg"><?php echo app('translator')->get('eventmie-pro::em.contact_find_us'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <img class="w-50 mx-auto" src="/storage/<?php echo e(setting('site.logo')); ?>"
                    alt="<?php echo e(setting('site.site_name')); ?>" />
            </div>
        </div>

        <?php $footerMenuItems = footerMenu() ?>
        <?php if(!empty($footerMenuItems)): ?>
            <div class="row mb-3">
                <?php $key = 1; ?>
                <?php $__currentLoopData = $footerMenuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                        <h5 class=" mb-3 text-white"><i class="<?php echo e($parentItem->icon_class); ?>"></i>
                            <?php echo e($parentItem->title); ?></h5>
                        <ul class="list-unstyled">
                            <?php $__currentLoopData = $parentItem->submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="text-white lh-lg" target="<?php echo e($childItem->target); ?>"
                                        href="<?php echo e($childItem->url); ?>">
                                        <i class="<?php echo e($childItem->icon_class); ?>"></i> <?php echo e($childItem->title); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <?php if(!($key % 4)): ?>
            </div>
        <?php endif; ?>

        <?php $key++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <div class="container">
        <div class="row mb-3">
            <div class="col-12 h-scroll">

                <ul
                    class="list-group list-group-horizontal list-group-flush justify-content-lg-center justify-content-md-between m-auto">
                    <?php $__currentLoopData = lang_selector(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item bg-secondary border-0 p-1">
                            <a class="text-center col-grey px-2 text-white <?php echo e($val == config('app.locale') ? 'active' : ''); ?>"
                                href="<?php echo e(route('eventmie.change_lang', ['lang' => $val])); ?>">
                                <?php echo app('translator')->get('eventmie-pro::em.lang_' . $val); ?>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-12 text-center">
                <p class="fs-6 text-gray-500 pb-3">
                    <span>©</span> <?php echo e(date('Y')); ?>

                    <a
                        href="<?php echo e(eventmie_url()); ?>"><?php echo e(setting('site.site_name') ? setting('site.site_name') : config('app.name')); ?></a><br>

                    <?php if(!empty(setting('site.site_footer'))): ?>
                        <?php echo setting('site.site_footer'); ?>

                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
    <!-- tiny footer  -->
    <!-- footer section -->
</div>
<!-- footer section -->
</div>
<?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/eventmie-pro/src/../resources/views/layouts/footer.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('eventmie-pro::em.events'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main>
        <div class="lgx-page-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php $__env->startComponent('eventmie::skeleton.event'); ?> <?php echo $__env->renderComponent(); ?>
                    </div>
                </div>
            </div>
            <router-view
                :date_format="<?php echo e(json_encode(
                    [
                        'vue_date_format' => format_js_date(),
                        'vue_time_format' => format_js_time(),
                    ],
                    JSON_HEX_APOS,
                )); ?>">
            </router-view>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <script>
        var path = <?php echo json_encode($path, JSON_HEX_TAG); ?>;
        var events_slider = false;
    </script>
    <script type="text/javascript" src="<?php echo e(mix('js/events_listing.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie-pro/events/index.blade.php ENDPATH**/ ?>
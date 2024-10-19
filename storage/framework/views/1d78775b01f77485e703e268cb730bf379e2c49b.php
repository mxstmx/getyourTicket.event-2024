<?php $__env->startSection('title'); ?>
    <?php if(empty($event)): ?>
        <?php echo app('translator')->get('eventmie-pro::em.create_event'); ?>
    <?php else: ?>
        <?php echo app('translator')->get('eventmie-pro::em.update_event'); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('o_dashboard'); ?>
    <div class="container-fluid my-2">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between flex-wrap p-4 bg-white border-bottom-0">
                        <div>
                            <h1 class="mb-0 fw-bold h2">
                                <?php if(empty($event)): ?>
                                    <?php echo app('translator')->get('eventmie-pro::em.create_event'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('eventmie-pro::em.update_event'); ?> - <?php echo e($event->title); ?>

                                <?php endif; ?>
                            </h1>
                        </div>
                        <div>
                            <a class="btn btn-secondary btn-block" href="<?php echo e(route('eventmie.myevents_index')); ?>"><span><i
                                        class="fas fa-xmark"></i> <?php echo app('translator')->get('eventmie-pro::em.cancel'); ?></span></a>
                        </div>
                    </div>

                    <div class="bg-light">
                        <tabs-component
                            :is_publishable="<?php echo e(!empty($event->is_publishable) ? $event->is_publishable : '{}'); ?>"
                            :event_id="<?php echo e(!empty($event) ? $event->id : 0); ?>" :organiser_id="<?php echo e($organiser_id); ?>"
                            :event_ck="<?php echo e(json_encode($event, JSON_HEX_APOS)); ?>"></tabs-component>
                    </div>

                    <!-- Card body -->
                    <div class="card-body p-4">
                        <router-view :is_admin="<?php echo e(json_encode(Auth::user()->hasRole('admin'))); ?>"
                            :organisers="<?php echo e(json_encode($organisers, JSON_HEX_APOS)); ?>" :organiser_id="<?php echo e($organiser_id); ?>"
                            :event_ck="<?php echo e(json_encode($event, JSON_HEX_APOS)); ?>"
                            :selected_organiser="<?php echo e(json_encode($selected_organiser, JSON_HEX_APOS)); ?>"
                            :server_timezone="<?php echo e(json_encode(setting('regional.timezone_default'), JSON_HEX_APOS)); ?>">

                        </router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        var is_event_id = <?php echo !empty($event) ? $event->id : 0; ?>;
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(setting('apps.google_map_key')); ?>&libraries=places">
    </script>
    <script type="text/javascript" src="<?php echo e(mix('js/events_manage.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::o_dashboard.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie-pro/events/form.blade.php ENDPATH**/ ?>
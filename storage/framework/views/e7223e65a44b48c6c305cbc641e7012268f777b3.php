<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('eventmie::o_dashboard.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="db-wrapper">
        <div class="bg-light mt-12" id="page-content-for-mini">
            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 py-1 mt-2">
                            <button type="button" id="nav-toggle" class="btn btn-sm bg-secondary rounded-circle"
                                onclick="clickToggle()">
                                <i class="fas fa-bars text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php echo $__env->yieldContent('o_dashboard'); ?>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/o_dashboard/index.blade.php ENDPATH**/ ?>
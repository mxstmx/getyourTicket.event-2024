<?php $__env->startSection('content'); ?>
    <!--BANNER-->
    <section>
        <div class="bg-gradient">
            <div class="login-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="min-vh-100 py-md-10 py-lg-0">
                            <div class="container">
                                <div class="row d-flex align-items-center min-vh-100 justify-content-center">
                                    <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 py-10">
                                        <!--lgx-registration-banner-box-->
                                        <?php echo $__env->yieldContent('authcontent'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//.ROW-->
                </div>
                <!-- //.CONTAINER -->
            </div>

        </div>
        <!-- //.INNER -->
    </section>
    <!--BANNER END-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/eventmie-pro/src/../resources/views/auth/authapp.blade.php ENDPATH**/ ?>
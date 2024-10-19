<section>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12 mt-15">
                <!-- content -->
                <h2 class="text-dark fw-bold mb-2"><?php echo $__env->yieldContent('title'); ?></h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item ">
                            <a href="<?php echo e(route('eventmie.welcome')); ?>"><i class="fas fa-home text-primary"></i></a>
                        </li>
                        <?php
                            $i_count = 1;
                            if (config('eventmie.route.prefix')) {
                                $i_count = 2;
                                $prefix_count = count(explode('/', config('eventmie.route.prefix')));
                                if ($prefix_count > 1) {
                                    $i_count = $prefix_count + 1;
                                }
                            }
                        ?>

                        <?php for($i = $i_count; $i <= count(Request::segments()); $i++): ?>
                            <?php if($i != count(Request::segments())): ?>
                                <li class="breadcrumb-item">
                                    <a class="text-primary"
                                        href="<?php echo e(URL::to(implode('/', array_slice(Request::segments(), 0, $i, true)))); ?>">
                                        
                                        <?php if(\Lang::has('eventmie-pro::em.' . strtolower(Request::segment($i)))): ?>
                                            <?php echo app('translator')->get('eventmie-pro::em.' . strtolower(Request::segment($i))); ?>
                                        <?php else: ?>
                                            <?php echo e(strtoupper(Request::segment($i))); ?>

                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="breadcrumb-item active">
                                    
                                    <?php if(\Lang::has('eventmie-pro::em.' . strtolower(Request::segment($i)))): ?>
                                        <?php echo app('translator')->get('eventmie-pro::em.' . strtolower(Request::segment($i))); ?>
                                    <?php else: ?>
                                        <?php echo e(strtoupper(Request::segment($i))); ?>

                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ol>
                </nav>
            </div>
        </div>
        <!--//.ROW-->
    </div><!-- //.CONTAINER -->
</section>
<?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/layouts/breadcrumb.blade.php ENDPATH**/ ?>
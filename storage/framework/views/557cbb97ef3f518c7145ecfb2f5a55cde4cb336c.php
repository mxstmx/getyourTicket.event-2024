<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('eventmie-pro::em.blogs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main>

        <!--Blogs-->
        <section>
            <!-- section blog -->
            <div class="blog pb-5 px-2">
                <div class="container">
                    <div class="row gap-lg-0 gap-3">
                        <?php if(!empty($posts)): ?>
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="blog-card">
                                        <div class="position-relative">
                                            <a href="<?php echo e(route('eventmie.post_view', $item['slug'])); ?>">
                                                <div class="back-image rounded"
                                                    style="background-image:url('/storage/<?php echo e($item['image']); ?>')"></div>
                                            </a>
                                        </div>

                                        <div class="blog-date mt-2">
                                            <?php echo e(\Carbon\Carbon::parse($item['updated_at'])->translatedFormat(format_carbon_date())); ?>

                                        </div>
                                        <div class="blog-title mt-2 lh-sm">
                                            <a href="<?php echo e(route('eventmie.post_view', $item['slug'])); ?>" class="text-inherit">
                                                <?php echo e($item['title']); ?>

                                            </a>
                                        </div>
                                        <div class="blog-des mt-2">
                                            <p><?php echo e($item['excerpt']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="col-md-12 col-12">
                                <h4 class="text-center"><?php echo app('translator')->get('eventmie-pro::em.nothing'); ?></h4>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- .row end -->
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <?php echo e($posts->links()); ?>

                        </div>
                    </div>
                </div>
            </div>





        </section>
        <!--Blogs END-->

    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/blogs/index.blade.php ENDPATH**/ ?>
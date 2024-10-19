<?php $__env->startSection('meta_title', $page->title); ?>
<?php $__env->startSection('meta_description', setting('site.site_name') ? setting('site.site_name') : config('app.name')); ?>
<?php $__env->startSection('meta_url', url()->current()); ?>

<?php if(!empty($page)): ?>
    
    <?php $__env->startSection('title', $page->title); ?>

    
    <?php $__env->startSection('heading', $page->title); ?>

    <?php $__env->startSection('content'); ?>
        <main>
            <!--ABOUT-->
            <section>
                <div class="py-6 py-lg-8 ">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12  col-12">
                                <p>
                                    <?php echo $page->body; ?>

                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--ABOUT END-->
        </main>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('eventmie::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/eventmie-pro/src/../resources/views/pages.blade.php ENDPATH**/ ?>
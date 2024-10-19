<?php $__env->startSection('title', $post['title']); ?>
<?php $__env->startSection('meta_title', $post['seo_title']); ?>
<?php $__env->startSection('meta_keywords', $post['meta_keywords']); ?>
<?php $__env->startSection('meta_description', $post['meta_description']); ?>
<?php $__env->startSection('meta_image', '/storage/' . $post['image']); ?>
<?php $__env->startSection('meta_url', url()->current()); ?>

<?php $__env->startSection('content'); ?>
    <main>

        <!--News-->
        <section>
            <div class="position-relative blog-details mt-lg-12 my-10">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 p-2 mx-auto">
                            <div class="blog-main-img">
                                <img src="/storage/<?php echo e($post['image']); ?>" alt="<?php echo e($post['title']); ?>"
                                    class="img-fluid rounded-6 blog-detail-img w-100" />
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-12 mx-auto">
                            <div class="d-flex align-items-center justify-content-center mt-lg-4 mt-2">
                                <?php echo e(\Carbon\Carbon::parse($post['updated_at'])->translatedFormat(format_carbon_date())); ?>

                            </div>
                            <h1 class="text-center p-0 my-2">
                                <?php echo e($post['title']); ?>

                            </h1>
                            

                        </div>
                        <div class="col-lg-12 col-md-12 col-12 blog-img mt-5">
                            <?php echo $post['body']; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--News END-->

    </main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/blogs/show.blade.php ENDPATH**/ ?>
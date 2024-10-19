<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('eventmie-pro::em.contact'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_title'); ?> <?php echo app('translator')->get('eventmie-pro::em.contact'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_description', setting('site.site_name') ? setting('site.site_name') : config('app.name')); ?>
<?php $__env->startSection('meta_url', url()->current()); ?>

<?php $__env->startSection('content'); ?>

    <main>
        <!--News-->
        <section>
            <!-- section contact info -->
            <div class="pb-lg-6 pb-6">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <!-- card -->
                            <div class="card-base mb-4">
                                <div class="card-body p-4">
                                    <h4 class="mb-3"><?php echo app('translator')->get('eventmie-pro::em.address'); ?></h4>
                                    <p class="mb-3 pe-4"><?php echo e(setting('contact.address')); ?></p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <!-- card -->
                            <div class="card-base mb-4">
                                <div class="card-body p-4">
                                    <h4 class="mb-3"><?php echo app('translator')->get('eventmie-pro::em.phone'); ?></h4>
                                    <p class="mb-3 pe-4"><?php echo e(setting('contact.phone')); ?></p>
                                    <a href="#" class="btn-link"><?php echo e(setting('contact.email')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-8">
                        <div class="section">
                            <div class="container">
                                <h1 class="text-center p-0 mb-4">✺ Get in Touch With Us</h1>
                                <div class="py-lg-4 px-lg-5 p-3 custom-form bg-white">
                                    <div>
                                        <?php if(\Session::has('msg')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(\Session::get('msg')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <!-- form -->
                                        <form class="row needs-validation" novalidate="" method="POST"
                                            action="<?php echo e(route('eventmie.store_contact')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo view('honeypot::honeypotFormFields'); ?>
                                            <!-- first name -->
                                            <div class="mb-3 col-md-6">
                                                <label for="fname" class="form-label"><?php echo app('translator')->get('eventmie-pro::em.name'); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="<?php echo app('translator')->get('eventmie-pro::em.name'); ?>" required="">
                                                <div class="invalid-feedback">
                                                    <?php if($errors->has('name')): ?>
                                                        <div class="alert alert-danger"><?php echo e($errors->first('name')); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <!-- email -->
                                            <div class="mb-3 col-md-6">
                                                <label for="lname" class="form-label"><?php echo app('translator')->get('eventmie-pro::em.email'); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control" id="lname"
                                                    placeholder="<?php echo app('translator')->get('eventmie-pro::em.email'); ?>" required="">
                                                <div class="invalid-feedback">
                                                    <?php if($errors->has('email')): ?>
                                                        <div class="alert alert-danger"><?php echo e($errors->first('email')); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <!-- title -->
                                            <div class="mb-3 col-md-12">
                                                <label for="title" class="form-label"><?php echo app('translator')->get('eventmie-pro::em.title'); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="title" class="form-control"
                                                    placeholder="<?php echo app('translator')->get('eventmie-pro::em.title'); ?>" required="">
                                                <div class="invalid-feedback">
                                                    <?php if($errors->has('title')): ?>
                                                        <div class="alert alert-danger"><?php echo e($errors->first('title')); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- message -->
                                            <div class="mb-3 col-md-12">
                                                <label for="message" class="form-label">Message</label>
                                                <textarea class="form-control " rows="3" name="message" placeholder="<?php echo app('translator')->get('eventmie-pro::em.message'); ?>" id="message"
                                                    required=""></textarea>
                                                <?php if($errors->has('message')): ?>
                                                    <div class="alert alert-danger mt-1"><?php echo e($errors->first('message')); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <!-- button -->
                                            <div class="col-md-12">
                                                <button class="btn btn-primary" type="submit" value="contact-form">
                                                    <span><i class="fas fa-paper-plane"></i></span>
                                                    <?php echo app('translator')->get('eventmie-pro::em.send_message'); ?></button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="innerpage-section g-map-wrapper">
                    <div class="lgxmapcanvas map-canvas-default">
                        <div id="contact_map" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </section>

    </main>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(setting('apps.google_map_key')); ?>&callback=initMap&v=weekly"
        defer></script>
    <script>
        function initMap() {
            const myLatLng = {
                lat: <?php echo e(setting('contact.google_map_lat')); ?>,
                lng: <?php echo e(setting('contact.google_map_long')); ?>

            };
            const map = new google.maps.Map(document.getElementById("contact_map"), {
                zoom: 15,
                center: myLatLng,
            });

            new google.maps.Marker({
                position: myLatLng,
                map,
                title: <?php echo setting('site.site_name') ? json_encode(setting('site.site_name')) : json_encode(config('app.name')); ?>,
            });
        }
        window.initMap = initMap;
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/contact.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('eventmie-pro::em.register'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('authcontent'); ?>

    <div class="card border-0 shadow">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <span class="" role="alert">
                                <strong><?php echo e($error); ?></strong>
                            </span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="card-body p-5">


            <h3 class="mb-4"><?php echo app('translator')->get('eventmie-pro::em.register'); ?></h3>
            <!-- form -->
            <form method="POST" action="<?php echo e(route('eventmie.register')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo view('honeypot::honeypotFormFields'); ?>
                <div class="mb-3">
                    <label for="email" class="form-label"><?php echo app('translator')->get('eventmie-pro::em.name'); ?></label>
                    <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                        name="name" value="<?php echo e(old('name')); ?>" required autofocus placeholder="<?php echo app('translator')->get('eventmie-pro::em.name'); ?>">
                </div>

                <!-- email -->
                <div class="mb-3">
                    <label for="email" class="form-label"><?php echo app('translator')->get('eventmie-pro::em.email_address'); ?></label>
                    <input id="email" type="email"
                        class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email"
                        value="<?php echo e(old('email')); ?>" required placeholder="<?php echo app('translator')->get('eventmie-pro::em.email'); ?>">

                </div>
                <!-- password -->
                <div class="mb-3">
                    <label for="password" class="form-label"><?php echo app('translator')->get('eventmie-pro::em.password'); ?></label>
                    <input id="password" type="password"
                        class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required
                        placeholder="<?php echo app('translator')->get('eventmie-pro::em.password'); ?>">

                </div>


                <div class="mb-2">
                    <input class="form-check-input" type="checkbox" name="accept" id="accept" checked value="1"
                        hidden>
                    <p class="text-sm">
                        <?php echo app('translator')->get('eventmie-pro::em.accept_terms'); ?>
                    </p>
                </div>
                <!-- button -->

                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-door-open"></i>
                    <?php echo app('translator')->get('eventmie-pro::em.register'); ?></button>

                <div class="d-flex justify-content-between mb-2 pb-2 mt-3 text-sm ">
                    <!-- form check -->
                    <div class="fw-bold">
                        <a href="<?php echo e(route('eventmie.password.request')); ?>" class="text-inherit"><?php echo app('translator')->get('eventmie-pro::em.forgot_password'); ?></a>
                    </div>
                    <!-- forgot password -->
                    <div class="fw-bold">
                        <a href="<?php echo e(route('eventmie.login')); ?>" class="text-inherit"> <?php echo app('translator')->get('eventmie-pro::em.login'); ?></a>
                    </div>
                </div>
                <div class="mt-3">
                    <hr style="border-top: 2px solid #eee;">
                    <?php if(!empty(config('services')['facebook']['client_id']) || !empty(config('services')['google']['client_id'])): ?>
                        <div class="d-flex justify-content-between mb-2 pb-2 mt-3 text-sm">
                            <div class="text-left">
                                <span><?php echo app('translator')->get('eventmie-pro::em.continue_with'); ?></span>
                            </div>
                            <div class="text-right">
                                <?php if(!empty(config('services')['facebook']['client_id'])): ?>
                                    <a href="<?php echo e(route('eventmie.oauth_login', ['social' => 'facebook'])); ?>"
                                        class="btn btn-sm btn-primary btn-block"><i class="fab fa-facebook-f"></i>
                                        <?php echo app('translator')->get('eventmie-pro::em.facebook'); ?></a>
                                <?php endif; ?>

                                <?php if(!empty(config('services')['google']['client_id'])): ?>
                                    <a href="<?php echo e(route('eventmie.oauth_login', ['social' => 'google'])); ?>"
                                        class="btn btn-sm btn-primary btn-block"><i class="fab fa-google"></i>
                                        <?php echo app('translator')->get('eventmie-pro::em.google'); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </form>



        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::auth.authapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/eventmie-pro/src/../resources/views/auth/register.blade.php ENDPATH**/ ?>
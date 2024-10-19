<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('eventmie-pro::em.login'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('authcontent'); ?>
    <!-- card -->
    <div class="card shadow border-0">
        <!-- card body -->
        <?php if(config('voyager.demo_mode')): ?>
            <div class="alert alert-info">
                <a href="https://eventmie-pro-docs.classiebit.com/docs/2.0/demo-accounts" target="_blank">
                    <?php echo app('translator')->get('eventmie-pro::em.visit_accounts'); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="card-body p-5">

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <span role="alert">
                                    <strong><?php echo e($error); ?></strong>
                                </span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <h3 class="mb-4"><?php echo app('translator')->get('eventmie-pro::em.login'); ?></h3>
            <!-- form -->
            <form method="POST" action="<?php echo e(route('eventmie.login_post')); ?>">
                <!-- email -->
                <div class="mb-3">
                    <label for="email" class="form-label"><?php echo app('translator')->get('eventmie-pro::em.email_address'); ?></label>
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input id="email" type="email"
                        class="wpcf7-form-control form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                        name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="<?php echo app('translator')->get('eventmie-pro::em.email'); ?>">
                    <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>

                </div>
                <!-- password -->
                <div class="mb-3">
                    <label for="password" class="form-label"><?php echo app('translator')->get('eventmie-pro::em.password'); ?></label>
                    <input id="password" type="password"
                        class="wpcf7-form-control form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                        name="password" required placeholder="<?php echo app('translator')->get('eventmie-pro::em.password'); ?>">
                    <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-between mb-2 pb-2 mt-3 text-sm ">
                    <!-- form check -->
                    <div class="form-check ">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked
                            value="1">
                        <label class="form-check-label" for="remember"><?php echo app('translator')->get('eventmie-pro::em.remember'); ?></label>
                    </div>
                    <!-- forgot password -->
                    <div class="fw-bold">
                        <a href="<?php echo e(route('eventmie.password.request')); ?>" class="text-inherit"> <?php echo app('translator')->get('eventmie-pro::em.forgot_password'); ?></a>
                    </div>

                </div>
                <!-- button -->
                <button type="submit" class="btn btn-primary btn-block"><?php echo app('translator')->get('eventmie-pro::em.login'); ?> <i
                        class="fas fa-sign-in-alt"></i></button>
            </form>
            <div class="mt-4">
                <p class="mb-0"><?php echo app('translator')->get('eventmie-pro::em.donot_account'); ?><a href="<?php echo e(route('eventmie.register_show')); ?>">
                        <?php echo app('translator')->get('eventmie-pro::em.register'); ?></a></p>
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

        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::auth.authapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/eventmie-pro/src/../resources/views/auth/login.blade.php ENDPATH**/ ?>
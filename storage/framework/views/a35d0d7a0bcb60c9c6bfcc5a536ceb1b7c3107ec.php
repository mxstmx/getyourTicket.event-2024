<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('eventmie-pro::em.forgot_password'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('authcontent'); ?>
    <div class="card border-0 shadow">
        <div class="card-body p-8">
            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <h3 class="my-4"><?php echo app('translator')->get('eventmie-pro::em.forgot_password'); ?></h3>
            <!-- form -->
            <form method="POST" action="<?php echo e(route('eventmie.password.email')); ?>">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                <!-- email -->
                <div class="mb-3">
                    <label for="email" class="form-label"><?php echo app('translator')->get('eventmie-pro::em.email_address'); ?></label>
                    <input id="email" type="email"
                        class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email"
                        value="<?php echo e(old('email')); ?>" required autofocus placeholder="<?php echo app('translator')->get('eventmie-pro::em.email'); ?>">
                    <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary btn-block text-center">
                    <i class="fas fa-paper-plane"></i><?php echo app('translator')->get('eventmie-pro::em.send_password_reset_link'); ?>
                </button>
            </form>
            <div class="mt-3">
                <p class="mb-0">
                    <span class="ml-3">
                        <a class="btn btn-link text-center" href="<?php echo e(route('eventmie.login')); ?>"><?php echo app('translator')->get('eventmie-pro::em.cancel'); ?></a>
                    </span>
                </p>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::auth.authapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/eventmie-pro/src/../resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>
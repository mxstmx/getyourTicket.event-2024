<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('eventmie-pro::em.reset_password'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('authcontent'); ?>
    <div class="card border-0 shadow">
        <div class="card-body p-8">
            <h3 class="mb-4"><?php echo app('translator')->get('eventmie-pro::em.reset_password'); ?></h3>

            <form method="POST" action="<?php echo e(route('eventmie.password.reset_post')); ?>">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                <input type="hidden" name="token" value="<?php echo e($token); ?>">
                <?php if(!empty(request()->api)): ?>
                    <input type="hidden" name="api" value="1">
                <?php endif; ?>

                <div class="mb-3">
                    <input id="email" type="email"
                        class="wpcf7-form-control form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                        name="email" value="<?php echo e($email ?? old('email')); ?>" required autofocus
                        placeholder="<?php echo app('translator')->get('eventmie-pro::em.email'); ?>">
                    <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <input id="password" type="password"
                        class="wpcf7-form-control form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                        name="password" required placeholder="<?php echo app('translator')->get('eventmie-pro::em.new'); ?> <?php echo app('translator')->get('eventmie-pro::em.password'); ?>">
                    <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <input id="password-confirm" type="password" class="wpcf7-form-control form-control"
                        name="password_confirmation" required placeholder="<?php echo app('translator')->get('eventmie-pro::em.confirm_password'); ?>">
                </div>

                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('eventmie-pro::em.reset_password'); ?></button>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::auth.authapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/auth/passwords/reset.blade.php ENDPATH**/ ?>
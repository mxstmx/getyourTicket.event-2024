<?php $__env->startSection('content'); ?>      
<div class="row d-flex align-items-center justify-content-center">
	<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 py-10">
		<!--lgx-registration-banner-box-->
		<?php echo $__env->yieldContent('authcontent'); ?>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('eventmie::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/auth/authapp.blade.php ENDPATH**/ ?>
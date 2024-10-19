

<!-- Footer -->
<footer class="position-relative py-10 py-lg-12 bg-dark text-gray-500">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-12 col-xxl-10 mx-auto text-center">
        <ul class="list-inline mb-5">
          <li class="list-inline-item mx-0"> <a class="btn btn-icon btn-text-secondary text-gray-400" href="<?php echo e(setting('social.facebook')); ?>" tabindex="0"> <i class="fab fa-facebook-f btn-icon-inner"></i> </a> </li>
          <li class="list-inline-item mx-0"> <a class="btn btn-icon btn-text-secondary text-gray-400" href="<?php echo e(setting('social.instagram')); ?>" tabindex="0"> <i class="fab fa-instagram btn-icon-inner"></i> </a> </li>
        </ul>
	  
		    <p class="mb-0">
		<a href="<?php echo e(eventmie_url()); ?>"><?php echo e(setting('site.site_name') ? setting('site.site_name') : config('app.name')); ?></a>
		<span>©</span> <?php echo e(date('Y')); ?>- All Rights Reserved - <a href="<?php echo e(route('eventmie.page', ['page' => 'impressum'])); ?>">Impressum</a>
	</p>
      </div>
    </div>
  </div>
</footer>
<!-- footer end --> 


<!-- Fullpage - Social icons -->
<nav class="ln-social-icons">
  <ul class="mx-auto">
    <li><a href="<?php echo e(setting('social.facebook')); ?>"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="<?php echo e(setting('social.instagram')); ?>"><i class="fab fa-instagram"></i></a></li>
  </ul>
</nav>

<!-- Fullpage - Copyright -->
<div class="ln-copyright text-right">
  <p>
		<a href="<?php echo e(eventmie_url()); ?>"><?php echo e(setting('site.site_name') ? setting('site.site_name') : config('app.name')); ?></a>
		<span>©</span> <?php echo e(date('Y')); ?>- All Rights Reserved - <a href="<?php echo e(route('eventmie.page', ['page' => 'impressum'])); ?>">Impressum</a>
	</p>
</div>
<?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/layouts/footer_new_integration.blade.php ENDPATH**/ ?>
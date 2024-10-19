<!doctype html>
<html class="no-js" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>

    <?php echo $__env->make('eventmie::layouts.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('eventmie::layouts.favicon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->make('eventmie::layouts.include_new_integration_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <?php echo $__env->yieldContent('stylesheet'); ?>
</head>

<body class="layout-boxed">

<!-- Loader -->
<div class="loader bg-dark">
  <div class="spinner-grow text-primary" role="status"> <span class="sr-only">Loading...</span> </div>
</div>
	
<div class="overlay overlay-global">
  <div class="overlay-inner bg-image-holder bg-cover"> <img src="assets/video/etyourticket.events.png" alt="background"> </div>
  <div class="overlay-inner overlay-video">
    <video autoplay muted loop>
      <source src="assets/video/getyourticket.events.webm" type="video/webm">
    </video>
  </div>
  <div class="overlay-inner bg-dark opacity-70"></div>
</div>

	
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
        your browser</a> to improve your experience.</p>
    <![endif]-->

    
    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>



        
        <?php echo $__env->make('eventmie::layouts.header_new_integration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	
	    
    <!-- Fullpage content -->
<div class="ln-fullpage" data-navigation="true"> 
	
        <?php
            $no_breadcrumb = [
                'eventmie.welcome',
                'eventmie.events_show',
                'eventmie.login',
                'eventmie.register',
                'eventmie.register_show',
                'eventmie.password.request',
                'eventmie.password.reset',
                'eventmie.o_dashboard',
                'eventmie.myevents_index',
                'eventmie.myevents_index',
                'eventmie.myevents_form',
                'eventmie.obookings_index',
                'eventmie.event_earning_index',
                'eventmie.tags_form',
                'eventmie.myvenues.index',
                'eventmie.venues.show',
                'eventmie.ticket_scan',
                'myglists_index',
                'sub_organizer.index',
                'myglists_index',
                'manage_reviews.index',
                'pos.index',
                'eventmie.ticket_scan',
                'scanner.index',
                'pos.o_dashboard',
                'scanner.o_dashboard',
                'organiser_show',
            ];
        ?>
        <?php if(!in_array(Route::currentRouteName(), $no_breadcrumb)): ?>
            <?php echo $__env->make('eventmie::layouts.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <section class="db-wrapper">

            
            <?php echo $__env->yieldContent('content'); ?>

            
            <vue-progress-bar></vue-progress-bar>
        </section>
    </div>
        
        <?php echo $__env->make('eventmie::layouts.footer_new_integration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!--Main wrapper end-->

    <?php echo $__env->make('eventmie::layouts.include_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->yieldContent('javascript'); ?>

</body>

</html>
<?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/layouts/app.blade.php ENDPATH**/ ?>
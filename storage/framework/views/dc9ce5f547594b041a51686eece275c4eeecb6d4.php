<?php $__env->startSection('page_title', __('voyager::generic.viewing').' '.$dataType->display_name_plural); ?>

<?php $__env->startSection('page_header'); ?>
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="<?php echo e($dataType->icon); ?>"></i> <?php echo e($dataType->display_name_plural); ?>

        </h1>
        <?php echo $__env->make('voyager::multilingual.language-selector', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content browse container-fluid">
        <?php echo $__env->make('voyager::alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                       
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('voyager::generic.Organiser')); ?></th>
                                        <th><?php echo e(__('voyager::generic.total')); ?> <?php echo e(__('voyager::generic.Bookings')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Admin Commission')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Admin Tax')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Organiser Earning')); ?></th>
                                        <th class="actions text-right"><?php echo e(__('voyager::generic.actions')); ?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($commissions)): ?>
                                        <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->organiser_name); ?></td>
                                            <td><?php echo e($data->customer_paid_total); ?> <?php echo e($data->currency); ?></td>
                                            <td><?php echo e($data->admin_commission_total); ?> <?php echo e($data->currency); ?></td>
                                            <td><?php echo e($data->admin_tax_total); ?> <?php echo e($data->currency); ?></td>
                                            <td><?php echo e($data->organiser_earning_total); ?> <?php echo e($data->currency); ?></td>
                                            
                                            <td class="no-sort no-click" id="bread-actions">
                                                
                                                <a href="<?php echo e(route('voyager.'.$dataType->slug.'.show', [$data->org_id])); ?>" class="btn btn-sm btn-warning pull-right view">
                                                    <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm"><?php echo e(__('voyager::generic.view')); ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>    
                                </tbody>
                            </table>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php if(config('dashboard.data_tables.responsive')): ?>
    <link rel="stylesheet" href="<?php echo e(voyager_asset('lib/css/responsive.dataTables.min.css')); ?>">
<?php endif; ?>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/vendor/voyager/commissions/browse.blade.php ENDPATH**/ ?>
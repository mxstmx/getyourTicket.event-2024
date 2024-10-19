<?php $__env->startSection('page_title', __('voyager::generic.viewing').' '.$dataType->display_name_plural); ?>

<?php $__env->startSection('page_header'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mb-0">
                <h1 class="page-title">
                    <i class="<?php echo e($dataType->icon); ?>"></i> <?php echo e($dataType->display_name_plural); ?>

                </h1>
            </div>
            <div class="col-md-6 mb-0">
                <a href="javascript:;" onclick='openBankModal()' title="<?php echo e(__('voyager::generic.organizer_bank')); ?>" class="btn btn-primary pull-right mt-2" data-id="bank-modal" id="bank-modal">
                    <i class="voyager-lighthouse"></i> <span class="hidden-xs hidden-sm"><?php echo e(__('voyager::generic.organizer_bank')); ?></span>
                </a>
                
                <div class="modal modal-primary fade" tabindex="-1" id="bank_modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo e(__('voyager::generic.close')); ?>"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><i class="voyager-lighthouse"></i> <?php echo e(__('voyager::generic.organizer_bank')); ?></h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td><?php echo e(__('voyager::generic.Organiser')); ?></td>
                                            <th><?php echo e($organiser->name); ?> (<?php echo e($organiser->email); ?>)</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('voyager::generic.Organisation')); ?></td>
                                            <th><?php echo e($organiser->organisation); ?></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('voyager::generic.Bank Name')); ?></td>
                                            <th><?php echo e($organiser->bank_name); ?></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('voyager::generic.Bank Code')); ?></td>
                                            <th><?php echo e($organiser->bank_code); ?></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('voyager::generic.Bank Branch Name')); ?></td>
                                            <th><?php echo e($organiser->bank_branch_name); ?></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('voyager::generic.Bank Branch Code')); ?></td>
                                            <th><?php echo e($organiser->bank_branch_code); ?></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('voyager::generic.Bank Account Number')); ?></td>
                                            <th><?php echo e($organiser->bank_account_number); ?></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('voyager::generic.Bank Account Name')); ?></td>
                                            <th><?php echo e($organiser->bank_account_name); ?></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('voyager::generic.Bank Account Phone')); ?></td>
                                            <th><?php echo e($organiser->bank_account_phone); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><?php echo e(__('voyager::generic.close')); ?></button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
        </div>
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
                        <h3><?php echo e(__('voyager::generic.payouts')); ?></h3>
                        <h5><?php echo e(__('voyager::generic.payouts_info')); ?></h5>
                        <br>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('voyager::generic.Event')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Organiser')); ?></th>
                                        <th><?php echo e(__('voyager::generic.total')); ?> <?php echo e(__('voyager::generic.Bookings')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Admin Commission')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Admin Tax')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Organiser Earning')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Month Year')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Transferred')); ?></th>
                                        <th class="actions text-right"><?php echo e(__('voyager::generic.actions')); ?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($commissions)): ?>
                                        <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <form method="POST"  action="<?php echo e(route('eventmie.commission_update')); ?>" class="form-search">
                                                <?php echo e(csrf_field()); ?>

                                                <tr>
                                                <input type="hidden" class="form-control" name="month_year"  value="<?php echo e($data->month_year); ?>">
                                                <input type="hidden" class="form-control" name="organiser_id" value="<?php echo e($data->org_id); ?>">
                                                <input type="hidden" class="form-control" name="event_id" value="<?php echo e($data->event_id); ?>">
                                                <input type="hidden" class="form-control" name="currency" value="<?php echo e($data->currency); ?>">
                                                        
                                                    <td><?php echo e($data->event_name); ?></td>
                                                    <td><?php echo e($data->organiser_name); ?></td>
                                                    <td><?php echo e($data->customer_paid_total); ?> <?php echo e($data->currency); ?></td>
                                                    <td><?php echo e($data->admin_commission_total); ?> <?php echo e($data->currency); ?></td>
                                                    <td><?php echo e($data->admin_tax_total); ?> <?php echo e($data->currency); ?></td>
                                                    <td><?php echo e($data->organiser_earning_total); ?> <?php echo e($data->currency); ?></td>
                                                    <td><?php echo e($data->month_year); ?></td>
                                                    <td>  
                                                        <div class="form-check">
                                                            <input type="checkbox" name="transferred"  class="form-check-input"  
                                                            <?php echo e($data->transferred > 0 ? 'checked' : ''); ?>>
                                                        </div>
                                                    </td>
                                                    <td class="no-sort no-click" id="bread-actions">

                                                        <button type="submit" class="btn btn-sm btn-primary     pull-right view">
                                                            <i class="voyager-edit"></i>
                                                             <span class="hidden-xs hidden-sm">
                                                                <?php echo e(__('voyager::generic.update')); ?>

                                                            </span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </form>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>    
                                </tbody>
                            </table>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <h3><?php echo e(__('voyager::generic.refunds')); ?></h3>
                        <h5><?php echo e(__('voyager::generic.refunds_info')); ?></h5>
                        <br>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('voyager::generic.Event')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Organiser')); ?></th>
                                        <th><?php echo e(__('voyager::generic.total')); ?> <?php echo e(__('voyager::generic.Bookings')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Admin Commission')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Admin Tax')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Organiser Earning')); ?></th>
                                        <th><?php echo e(__('voyager::generic.Month Year')); ?></th>
                                        <th><?php echo e(__('voyager::generic.settlement')); ?></th>
                                        <th class="actions text-right"><?php echo e(__('voyager::generic.actions')); ?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($refunds)): ?>
                                        <?php $__currentLoopData = $refunds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <form method="POST"  action="<?php echo e(route('eventmie.settlement_update')); ?>" class="form-search">
                                                <?php echo e(csrf_field()); ?>

                                                <tr>
                                                <input type="hidden" class="form-control" name="month_year"  value="<?php echo e($data->month_year); ?>">
                                                <input type="hidden" class="form-control" name="organiser_id" value="<?php echo e($data->org_id); ?>">
                                                <input type="hidden" class="form-control" name="event_id" value="<?php echo e($data->event_id); ?>">
                                                <input type="hidden" class="form-control" name="currency" value="<?php echo e($data->currency); ?>">
                                                        
                                                    <td><?php echo e($data->event_name); ?></td>
                                                    <td><?php echo e($data->organiser_name); ?></td>
                                                    <td><?php echo e($data->customer_paid_total); ?> <?php echo e($data->currency); ?></td>
                                                    <td><?php echo e($data->admin_commission_total); ?> <?php echo e($data->currency); ?></td>
                                                    <td><?php echo e($data->admin_tax_total); ?> <?php echo e($data->currency); ?></td>
                                                    <td>-<?php echo e($data->organiser_earning_total); ?> <?php echo e($data->currency); ?></td>
                                                    <td><?php echo e($data->month_year); ?></td>
                                                    <td>  
                                                        <div class="form-check">
                                                            <input type="checkbox" name="settled"  class="form-check-input"  
                                                            <?php echo e($data->settled > 0 ? 'checked' : ''); ?>>
                                                        </div>
                                                    </td>
                                                    <td class="no-sort no-click" id="bread-actions">

                                                        <button type="submit" class="btn btn-sm btn-primary     pull-right view">
                                                            <i class="voyager-edit"></i>
                                                             <span class="hidden-xs hidden-sm">
                                                                <?php echo e(__('voyager::generic.update')); ?>

                                                            </span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </form>
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

<?php $__env->startSection('javascript'); ?>
<script>
function openBankModal() {
    $('#bank_modal').modal('show');
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/vendor/voyager/commissions/update_commissions.blade.php ENDPATH**/ ?>
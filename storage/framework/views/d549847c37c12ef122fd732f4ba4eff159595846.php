<?php $__env->startSection('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural')); ?>

<?php $__env->startSection('page_header'); ?>
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="<?php echo e($dataType->icon); ?>"></i> <?php echo e($dataType->getTranslatedAttribute('display_name_plural')); ?>

        </h1>
        <a href="<?php echo e(route('eventmie.myevents_form')); ?>" class="btn btn-success btn-add-new">
            <i class="voyager-plus"></i> <span><?php echo e(__('voyager::generic.add_new')); ?></span>
        </a>
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
                        <?php if($isServerSide): ?>
                            <form method="get" class="form-search">
                                <div id="search-input">
                                    <div class="col-2">
                                        <select id="search_key" name="key">
                                            <?php $__currentLoopData = $searchNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php if($search->key == $key || (empty($search->key) && $key == $defaultSearchKey)): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select id="filter" name="filter">
                                            <option value="contains" <?php if($search->filter == "contains"): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(__('voyager::generic.contains')); ?></option>
                                            <option value="equals" <?php if($search->filter == "equals"): ?><?php echo e('selected'); ?><?php endif; ?>>=</option>
                                        </select>
                                    </div>
                                    <div class="input-group col-md-12">
                                        <input type="text" class="form-control" placeholder="<?php echo e(__('voyager::generic.search')); ?>" name="s" value="<?php echo e($search->value); ?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-lg" type="submit">
                                                <i class="voyager-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <?php if(Request::has('sort_order') && Request::has('order_by')): ?>
                                    <input type="hidden" name="sort_order" value="<?php echo e(Request::get('sort_order')); ?>">
                                    <input type="hidden" name="order_by" value="<?php echo e(Request::get('order_by')); ?>">
                                <?php endif; ?>
                            </form>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <?php if($showCheckboxColumn): ?>
                                            <th>
                                                <input type="checkbox" class="select_all">
                                            </th>
                                        <?php endif; ?>
                                        <?php $__currentLoopData = $dataType->browseRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th>
                                            <?php if($isServerSide): ?>
                                                <a href="<?php echo e($row->sortByUrl($orderBy, $sortOrder)); ?>">
                                            <?php endif; ?>
                                            <?php echo e($row->getTranslatedAttribute('display_name')); ?>

                                            <?php if($isServerSide): ?>
                                                <?php if($row->isCurrentSortField($orderBy)): ?>
                                                    <?php if($sortOrder == 'asc'): ?>
                                                        <i class="voyager-angle-up pull-right"></i>
                                                    <?php else: ?>
                                                        <i class="voyager-angle-down pull-right"></i>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                </a>
                                            <?php endif; ?>
                                        </th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <th class="actions text-right"><?php echo e(__('voyager::generic.actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $dataTypeContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if($showCheckboxColumn): ?>
                                            <td>
                                                <input type="checkbox" name="row_id" id="checkbox_<?php echo e($data->getKey()); ?>" value="<?php echo e($data->getKey()); ?>">
                                            </td>
                                        <?php endif; ?>
                                        <?php $__currentLoopData = $dataType->browseRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            if ($data->{$row->field.'_browse'}) {
                                                $data->{$row->field} = $data->{$row->field.'_browse'};
                                            }
                                            ?>
                                            <td>
                                                <?php if(isset($row->details->view)): ?>
                                                    <?php echo $__env->make($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $data->{$row->field}, 'action' => 'browse'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php elseif($row->type == 'image'): ?>
                                                    <img src="<?php if( !filter_var($data->{$row->field}, FILTER_VALIDATE_URL)): ?><?php echo e(Voyager::image( $data->{$row->field} )); ?><?php else: ?><?php echo e($data->{$row->field}); ?><?php endif; ?>" style="width:100px">
                                                <?php elseif($row->type == 'relationship'): ?>
                                                    <?php echo $__env->make('voyager::formfields.relationship', ['view' => 'browse','options' => $row->details], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php elseif($row->type == 'select_multiple'): ?>
                                                    <?php if(property_exists($row->details, 'relationship')): ?>

                                                        <?php $__currentLoopData = $data->{$row->field}; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($item->{$row->field}); ?>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php elseif(property_exists($row->details, 'options')): ?>
                                                        <?php if(!empty(json_decode($data->{$row->field}))): ?>
                                                            <?php $__currentLoopData = json_decode($data->{$row->field}); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(@$row->details->options->{$item}): ?>
                                                                    <?php echo e($row->details->options->{$item} . (!$loop->last ? ', ' : '')); ?>

                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <?php echo e(__('voyager::generic.none')); ?>

                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php elseif($row->type == 'multiple_checkbox' && property_exists($row->details, 'options')): ?>
                                                        <?php if(@count(json_decode($data->{$row->field})) > 0): ?>
                                                            <?php $__currentLoopData = json_decode($data->{$row->field}); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(@$row->details->options->{$item}): ?>
                                                                    <?php echo e($row->details->options->{$item} . (!$loop->last ? ', ' : '')); ?>

                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <?php echo e(__('voyager::generic.none')); ?>

                                                        <?php endif; ?>

                                                <?php elseif(($row->type == 'select_dropdown' || $row->type == 'radio_btn') && property_exists($row->details, 'options')): ?>

                                                    <?php echo $row->details->options->{$data->{$row->field}} ?? ''; ?>


                                                <?php elseif($row->type == 'date' || $row->type == 'timestamp'): ?>
                                                    <?php if( property_exists($row->details, 'format') && !is_null($data->{$row->field}) ): ?>
                                                        <?php echo e(\Carbon\Carbon::parse($data->{$row->field})->formatLocalized($row->details->format)); ?>

                                                    <?php else: ?>
                                                        <?php echo e($data->{$row->field}); ?>

                                                    <?php endif; ?>
                                                <?php elseif($row->type == 'checkbox'): ?>
                                                    <?php if(property_exists($row->details, 'on') && property_exists($row->details, 'off')): ?>
                                                        <?php if($data->{$row->field}): ?>
                                                            <span class="label label-info"><?php echo e($row->details->on); ?></span>
                                                        <?php else: ?>
                                                            <span class="label label-primary"><?php echo e($row->details->off); ?></span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                    <?php echo e($data->{$row->field}); ?>

                                                    <?php endif; ?>
                                                <?php elseif($row->type == 'color'): ?>
                                                    <span class="badge badge-lg" style="background-color: <?php echo e($data->{$row->field}); ?>"><?php echo e($data->{$row->field}); ?></span>
                                                <?php elseif($row->type == 'text'): ?>

                                                    <?php if($row->getTranslatedAttribute('display_name') == 'Online Location'): ?>
                                                        <?php if($data->{$row->field}): ?>
                                                        <?php echo e(__('voyager::generic.yes')); ?>

                                                        <?php else: ?>
                                                        <?php echo e(__('voyager::generic.no')); ?>

                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php echo $__env->make('voyager::multilingual.input-hidden-bread-browse', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <div><?php echo e(mb_strlen( $data->{$row->field} ) > 200 ? mb_substr($data->{$row->field}, 0, 200) . ' ...' : $data->{$row->field}); ?></div>
                                                    <?php endif; ?>

                                                <?php elseif($row->type == 'text_area'): ?>
                                                    <?php echo $__env->make('voyager::multilingual.input-hidden-bread-browse', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <div><?php echo e(mb_strlen( $data->{$row->field} ) > 200 ? mb_substr($data->{$row->field}, 0, 200) . ' ...' : $data->{$row->field}); ?></div>
                                                <?php elseif($row->type == 'file' && !empty($data->{$row->field}) ): ?>
                                                    <?php echo $__env->make('voyager::multilingual.input-hidden-bread-browse', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php if(json_decode($data->{$row->field}) !== null): ?>
                                                        <?php $__currentLoopData = json_decode($data->{$row->field}); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <a href="<?php echo e(Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: ''); ?>" target="_blank">
                                                                <?php echo e($file->original_name ?: ''); ?>

                                                            </a>
                                                            <br/>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(Storage::disk(config('voyager.storage.disk'))->url($data->{$row->field})); ?>" target="_blank">
                                                            <?php echo e(__('voyager::generic.download')); ?>

                                                        </a>
                                                    <?php endif; ?>
                                                <?php elseif($row->type == 'rich_text_box'): ?>
                                                    <?php echo $__env->make('voyager::multilingual.input-hidden-bread-browse', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <div><?php echo e(mb_strlen( strip_tags($data->{$row->field}, '<b><i><u>') ) > 200 ? mb_substr(strip_tags($data->{$row->field}, '<b><i><u>'), 0, 200) . ' ...' : strip_tags($data->{$row->field}, '<b><i><u>')); ?></div>
                                                <?php elseif($row->type == 'coordinates'): ?>
                                                    <?php echo $__env->make('voyager::partials.coordinates-static-image', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php elseif($row->type == 'multiple_images'): ?>
                                                    <?php $images = json_decode($data->{$row->field}); ?>
                                                    <?php if($images): ?>
                                                        <?php $images = array_slice($images, 0, 3); ?>
                                                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <img src="<?php if( !filter_var($image, FILTER_VALIDATE_URL)): ?><?php echo e(Voyager::image( $image )); ?><?php else: ?><?php echo e($image); ?><?php endif; ?>" style="width:50px">
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php elseif($row->type == 'media_picker'): ?>
                                                    <?php
                                                        if (is_array($data->{$row->field})) {
                                                            $files = $data->{$row->field};
                                                        } else {
                                                            $files = json_decode($data->{$row->field});
                                                        }
                                                    ?>
                                                    <?php if($files): ?>
                                                        <?php if(property_exists($row->details, 'show_as_images') && $row->details->show_as_images): ?>
                                                            <?php $__currentLoopData = array_slice($files, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <img src="<?php if( !filter_var($file, FILTER_VALIDATE_URL)): ?><?php echo e(Voyager::image( $file )); ?><?php else: ?><?php echo e($file); ?><?php endif; ?>" style="width:50px">
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <ul>
                                                            <?php $__currentLoopData = array_slice($files, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><?php echo e($file); ?></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                        <?php if(count($files) > 3): ?>
                                                            <?php echo e(__('voyager::media.files_more', ['count' => (count($files) - 3)])); ?>

                                                        <?php endif; ?>
                                                    <?php elseif(is_array($files) && count($files) == 0): ?>
                                                        <?php echo e(trans_choice('voyager::media.files', 0)); ?>

                                                    <?php elseif($data->{$row->field} != ''): ?>
                                                        <?php if(property_exists($row->details, 'show_as_images') && $row->details->show_as_images): ?>
                                                            <img src="<?php if( !filter_var($data->{$row->field}, FILTER_VALIDATE_URL)): ?><?php echo e(Voyager::image( $data->{$row->field} )); ?><?php else: ?><?php echo e($data->{$row->field}); ?><?php endif; ?>" style="width:50px">
                                                        <?php else: ?>
                                                            <?php echo e($data->{$row->field}); ?>

                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php echo e(trans_choice('voyager::media.files', 0)); ?>

                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php echo $__env->make('voyager::multilingual.input-hidden-bread-browse', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <span><?php echo e($data->{$row->field}); ?></span>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <td class="no-sort no-click" id="bread-actions">
                                            
                                            <a href="javascript:;" title="Delete" class="btn btn-sm btn-danger delete pull-right" onclick='openDeleteModal("<?php echo e($data->id); ?>")'>
                                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm"><?php echo e(__('voyager::generic.delete')); ?></span>
                                            </a>
                                            

                                            <a href="<?php echo e(route('eventmie.myevents_form',[$data->slug])); ?>" class="btn btn-sm btn-primary edit pull-right">
                                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm"><?php echo e(__('voyager::generic.edit')); ?></span>
                                            </a>

                                            <?php if($data->publish > 0): ?>
                                            <a href="<?php echo e(route('eventmie.events_show', [$data->slug])); ?>" class="btn btn-sm btn-warning pull-right">
                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm"><?php echo e(__('voyager::generic.view')); ?></span>
                                            </a>
                                            <?php endif; ?> 
                                            <?php
                                               $count_bookings = \Classiebit\Eventmie\Models\Booking::where(['event_id' => $data->id])->count()    
                                            ?>

                                            

                                            
                                            <a class="btn btn-sm btn-success pull-right " href="<?php echo e(route('eventmie.myevents_index')); ?>"><i class="voyager-dot-3"></i> <?php echo app('translator')->get('eventmie-pro::em.more'); ?></a>
                                            
                                            
                                            
                                            <div class="modal modal-danger fade" tabindex="-1" id="delete_modal<?php echo e($data->id); ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo e(__('voyager::generic.close')); ?>"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title"><i class="voyager-trash"></i> <?php echo e(__('voyager::generic.delete_question')); ?> <?php echo e(strtolower($dataType->display_name_singular)); ?>?</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="<?php echo e(route('eventmie.delete_event',[$data->slug])); ?>" id="delete_form" method="GET">
                                                                <?php echo e(csrf_field()); ?>

                                                                <input type="submit" class="btn btn-danger pull-right delete-confirm" value="<?php echo e(__('voyager::generic.delete_confirm')); ?>">
                                                            </form>
                                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><?php echo e(__('voyager::generic.cancel')); ?></button>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($isServerSide): ?>
                            <div class="pull-left">
                                <div role="status" class="show-res" aria-live="polite"><?php echo e(trans_choice(
                                    'voyager::generic.showing_entries', $dataTypeContent->total(), [
                                        'from' => $dataTypeContent->firstItem(),
                                        'to' => $dataTypeContent->lastItem(),
                                        'all' => $dataTypeContent->total()
                                    ])); ?></div>
                            </div>
                            <div class="pull-right">
                                <?php echo e($dataTypeContent->appends([
                                    's' => $search->value,
                                    'filter' => $search->filter,
                                    'key' => $search->key,
                                    'order_by' => $orderBy,
                                    'sort_order' => $sortOrder,
                                    'showSoftDeleted' => $showSoftDeleted,
                                ])->links()); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php if(!$dataType->server_side && config('dashboard.data_tables.responsive')): ?>
    <link rel="stylesheet" href="<?php echo e(voyager_asset('lib/css/responsive.dataTables.min.css')); ?>">
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <!-- DataTables -->
    <?php if(!$dataType->server_side && config('dashboard.data_tables.responsive')): ?>
        <script src="<?php echo e(voyager_asset('lib/js/dataTables.responsive.min.js')); ?>"></script>
    <?php endif; ?>
    <script>
        $(document).ready(function () {
            <?php if(!$dataType->server_side): ?>
                var table = $('#dataTable').DataTable(<?php echo json_encode(
                    array_merge([
                        "order" => $orderColumn,
                        "language" => __('voyager::datatable'),
                        "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                    ],
                    config('voyager.dashboard.data_tables', []))
                , true); ?>);
            <?php else: ?>
                $('#search-input select').select2({
                    minimumResultsForSearch: Infinity
                });
            <?php endif; ?>

            <?php if($isModelTranslatable): ?>
                $('.side-body').multilingual();
                //Reinitialise the multilingual features when they change tab
                $('#dataTable').on('draw.dt', function(){
                    $('.side-body').data('multilingual').init();
                })
            <?php endif; ?>
            $('.select_all').on('click', function(e) {
                $('input[name="row_id"]').prop('checked', $(this).prop('checked')).trigger('change');
            });
        });


        var deleteFormAction;
        function openDeleteModal(id) {
            $('#delete_modal'+id).modal('show');
        }

        <?php if($usesSoftDeletes): ?>
            <?php
                $params = [
                    's' => $search->value,
                    'filter' => $search->filter,
                    'key' => $search->key,
                    'order_by' => $orderBy,
                    'sort_order' => $sortOrder,
                ];
            ?>
            $(function() {
                $('#show_soft_deletes').change(function() {
                    if ($(this).prop('checked')) {
                        $('#dataTable').before('<a id="redir" href="<?php echo e((route('voyager.'.$dataType->slug.'.index', array_merge($params, ['showSoftDeleted' => 1]), true))); ?>"></a>');
                    }else{
                        $('#dataTable').before('<a id="redir" href="<?php echo e((route('voyager.'.$dataType->slug.'.index', array_merge($params, ['showSoftDeleted' => 0]), true))); ?>"></a>');
                    }

                    $('#redir')[0].click();
                })
            })
        <?php endif; ?>
        $('input[name="row_id"]').on('change', function () {
            var ids = [];
            $('input[name="row_id"]').each(function() {
                if ($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            });
            $('.selected_ids').val(ids);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie-pro/vendor/voyager/events/browse.blade.php ENDPATH**/ ?>
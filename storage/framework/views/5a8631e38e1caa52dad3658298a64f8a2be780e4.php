<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title ">
                        <a href="<?php echo e(route("admin.quotation.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                        <a href="<?php echo e(route("admin.quotation.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.title_singular')); ?> </a>
                        <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.fields.create')); ?></a>
                    </h6>
                </div>
                <hr>

                <div class="card-body">
                    <form action="<?php echo e(route('admin.quotation.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-25">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.quotation.fields.number')); ?></label>
                                    <input type="text" id="segment1" name="segment1" class="form-control" value="<?php echo e(old('segment1', isset($quotation) ? $quotation->segment1 :  date('ymdHs'))); ?>" required>
                                </div>
                                <?php if($errors->any()): ?>
                                <div class="badge bg-danger">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($error); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-25">
                                    <label class="form-label" for="status"><?php echo e(trans('cruds.quotation.fields.status')); ?></label>
                                    <select type="text" id="status" name="status" class="form-control select2" value="<?php echo e(old('status', isset($quotation) ? $quotation->status : '')); ?>" required>
                                        <option value="12">In Active</option>
                                        <option value="14">Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-1 col-md-2">
                                <label class="form-check-label mb-25" for="customSwitch10">Master</label>
                                <div class="form-check form-switch form-check-primary">
                                    <input type="checkbox" class="form-check-input" name="organization_id" id="customSwitch10" value="222" checked="">
                                    <label class="form-check-label" for="customSwitch10">
                                        <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg></span>
                                        <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-25">
                                    <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>">
                                    <input type="hidden" id="type_lookup_code" value='2' name="type_lookup_code">
                                    <label class="form-label" for="vendor_id"><?php echo e(trans('cruds.quotation.fields.supplier')); ?></label>
                                    <select name="vendor_id" id="vendor_id" class="form-control select2" required>
                                        <option hidden disabled selected></option>
                                        <?php $__currentLoopData = $vendor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($row->vendor_id); ?>" <?php echo e((in_array($id, old('vendor', [])) || isset($role) && $row->contains($id)) ? 'selected' : ''); ?>><?php echo e($row->vendor_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-25">
                                    <label class="form-label" for="vendor_site_id"><?php echo e(trans('cruds.quotation.fields.site')); ?></label>
                                    <input type="text" id="vendor_site_id" name="supplier_site_id" class="form-control supplier_site_id" value="<?php echo e(old('vendor_site_id', isset($quotation) ? $quotation->vendor_site_id : '')); ?>" autocomplete="off" required>
                                    <input type="hidden" class="search_vendor_site_id" name="vendor_site_id" value='<?php echo e($purchaseorder->supplierSite->site_code ??''); ?>' required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-25">
                                    <label class="form-label" for="company-column"><?php echo e(trans('cruds.quotation.fields.effective_date')); ?></label>
                                    <input type="text" id="fp-default" name="effective_date" class="form-control flatpickr-basic flatpickr-input" value="<?php echo e(old('effective_date', isset($quotation) ? $quotation->effective_date : '')); ?>" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-25">
                                    <label class="form-label" for="email-id-column"><?php echo e(trans('cruds.quotation.fields.currency')); ?></label>
                                    <select name="currency_code" id="currency_code" class="form-control select2" value="<?php echo e(old('currency_code', isset($currency_code) ? $quotation->currency_code : '')); ?>" required>
                                        <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($row->currency_code); ?>"><?php echo e($row->currency_code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="box box-default">
                                <div class="box-body scrollx" style="height: 450px;overflow: scroll;">
                                    <table class="table table-striped tableFixHead">
                                        <thead>
                                            <th scope="col">Line</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">UOM</th>
                                            <th scope="col" class="text-center">Price</th>
                                            <th scope="col" class="text-end">From</th>
                                            <th scope="col" class="text-end">To</th>
                                            <th scope="col" class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="quotation_container">
                                            <tr class="tr_input">
                                                
                                                <td class="rownumber">1</td>
                                                <td width="30%">
                                                    <input type="text" class="form-control search_item_code " placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off" required>
                                                    <span class="help-block search_item_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                    <input type="hidden" class="search_inventory_item_id" id="id_1" name="inventory_item_id[]">
                                                    <input type="hidden" class="form-control" value="" id="description_1" name="description_item[]" autocomplete="off">

                                                </td>
                                                <td width="15%">
                                                    <input type="text" class="form-control search_uom_conversion" name="po_uom_code[]" id="uom_1" autocomplete="off">
                                                    <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                </td>
                                                <td width="15%">
                                                    <input type="text" class="form-control  text-end" name="unit_price[]" id="price_1" autocomplete="off" required>
                                                </td>
                                                <td width="20%">
                                                    <input type="date" name="start_date[]" class="form-control datepicker text-end" id="start_date_1" autocomplete="off" required>
                                                </td>
                                                <td width="20%">
                                                    <input type="date" name="end_date[]" class="form-control datepicker text-end" id="end_date_1" autocomplete="off">
                                                </td>
                                                <td width="10%">
                                                    <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="button" class="btn btn-light btn-sm add_quotation btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="d-flex justify-content-between mb-1">
                            <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i> Reset</button>
                            <button class="btn btn-success btn-submit"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
<script>
    $(function() {
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_delete')): ?>
        let deleteButtonTrans = '<?php echo e(trans('
        global.datatables.delete ')); ?>'
        let deleteButton = {
            text: deleteButtonTrans
            , url: "<?php echo e(route('admin.purchase-requisition.massDestroy')); ?>"
            , className: 'btn-danger'
            , action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('<?php echo e(trans('
                        global.datatables.zero_selected ')); ?>')

                    return
                }

                if (confirm('<?php echo e(trans('
                        global.areYouSure ')); ?>')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            }
                            , method: 'POST'
                            , url: config.url
                            , data: {
                                ids: ids
                                , _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        <?php endif; ?>
    })

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/quotation/createQuotation.blade.php ENDPATH**/ ?>
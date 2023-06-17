<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e($error); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">
                    <a href="<?php echo e(route("admin.rcv.index")); ?>" class="breadcrumbs__item">Purchase Order </a>
                    <a href="<?php echo e(route("admin.rcv.index")); ?>" class="breadcrumbs__item">Receive </a>
                    <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.fields.create')); ?></a>
                </h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="<?php echo e(route("admin.rcv.store")); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal create_purchase">
                    <?php echo e(csrf_field()); ?>

                    <div class="row mb-25">
                        <div class="col-md-4">
                            <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.supplier')); ?></label>
                            <select id="supplier" name="vendor_id" class="form-control select2 filter">
                                <option selected></option>
                                <?php $__currentLoopData = $vendor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->vendor_id); ?>"><?php echo e($row->vendor_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.rcv.fields.orderno')); ?></label>
                            <select id="orderno" name="segment1" class="form-control select2 filter">
                                <option selected></option>
                                <?php $__currentLoopData = $order_head; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->segment1); ?>"><?php echo e($row->segment1); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.rcv.fields.item')); ?></label>
                            
                            <select id="item" name="item" class="form-control select2 filter">
                                <option selected></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="box-body table-responsive scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                            <table id="table-rcv" class="table mt-1" data-toggle="table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb"></th>
                                        <th class="text-end">Quantity</th>
                                        <th>UOM</th>
                                        <th class="text-start">Purchase Item</th>
                                        <th class="text-center">Subinventory</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-1">
                        <button type="button" class="btn btn-primary pull-left" id="allselect" data-bs-toggle="modal" data-bs-target="#demoModal"> Template</button>
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <?php echo e(trans('global.save')); ?></button>
                    </div>

                    <!-- Modal Example Start-->
                    <div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-primary">
                                    <h4 class="modal-title text-white" id="exampleModalLongTitle"><?php echo e(trans('cruds.rcv.title')); ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-1">
                                                    <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.grn')); ?></label>
                                                    <input type="text" class="form-control" value="<?php echo e($grn->id??''); ?>" readonly value="" name="receipt_num" autocomplete="off" maxlength="10" required>
                                                    <input type="hidden" id="agent_id" name="agent_id" value="<?php echo e(auth()->user()->id?? ''); ?>">
                                                    <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id?? ''); ?>">
                                                    <input type="hidden" id="updated_by" name="updated_by" value="<?php echo e(auth()->user()->id?? ''); ?>">
                                                    <input type="hidden" id="organization_id" value='222' name="organization_id">
                                                    <input type="hidden" id="ship_to_location" value='SH-982221229' name="ship_to_location">
                                                    <input type="hidden" id="bill_to_location" value='BL-982221229' name="bill_to_location">
                                                    <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code">
                                                    <input type="hidden" id="source" value='1' name="source">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.packingslip')); ?></label>
                                                    <input type="text" class="form-control" name="packing_slip" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.rcv.fields.transactiondate')); ?></label>
                                                    <input type="date" id="datePicker" name="gl_date" class="form-control datepicker" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="col-sm-0 control-label" for="rate"><?php echo e(trans('cruds.rcv.fields.aju')); ?></label>
                                                    <input type="text" class="form-control" name="attribute1" autocomplete="off" required>
                                                    
                                                    <input type="hidden" class="form-control search_supplier_name" name="waybill_airbill_num" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="col-sm-0 control-label" for="rate"><?php echo e(trans('cruds.rcv.fields.received')); ?></label>
                                                    <select class="form-control" name="user_receipt">

                                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($usr->id); ?>"><?php echo e($usr->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <input type="hidden" value="0" class="form-control search_supplier_name" name="freight_terms" autocomplete="off">
                                                    <label class="col-sm-0 control-label" for="rate"><?php echo e(trans('cruds.rcv.fields.comments')); ?></label>
                                                    <input type="text" class="form-control " name="comments" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Modal Example Start-->
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <!-- /.content -->
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/rcv/create.blade.php ENDPATH**/ ?>
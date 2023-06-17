<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>

      <a href="" class="breadcrumbs__item">Purchase Order</a>
      <a href="" class="breadcrumbs__item">Miscellaneous Expense</a>
      <a href="" class="breadcrumbs__item">Create</a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<br>
<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route("admin.missExpense.store")); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal create_purchase" >
                        <?php echo e(csrf_field()); ?>

                        <div class="row mt-2 mb-1">
                            <div class="col-md-4">
                                <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.missExpense.head.date')); ?></label>
                                <input type="date" id="datePicker" name="gl_date" class="form-control datepicker" value="" required >
                                <input type="hidden" hidden id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.aju')); ?> </label>
                                <select id="aju" name="attributenumber" class="form-control select2">
                                    <option value="<?php echo e($aju); ?>"><?php echo e($aju); ?></option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.missExpense.head.rate')); ?></label>
                                <input type="text" id="rate" name="intattribute1" class="form-control  text-end" value="<?php echo e((float)$rate); ?>" required >
                            </div>
                        </div>
                        <div class="row mt-2 mb-1">
                            <div class="col-md-3">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.trucking')); ?></label>
                                
                              
                                <input type="number" id="trucking" class="form-control text-end" value="<?php echo e((float)$miss->intattribute10 ?? '0'); ?>" name="intattribute10"  >
                            </div>

                            <div class="col-md-3">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.doc')); ?></label>
                                
                                <input type="number" id="doc_fee" class="form-control text-end" value="<?php echo e((float)$miss->intattribute11 ?? '0'); ?>" value="0" name="intattribute11"  >
                            </div>

                            <div class="col-md-3">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.adm')); ?></label>
                                
                                <input type="number" id="admin" class="form-control text-end" value="<?php echo e((float)$miss->intattribute12 ?? '0'); ?>" name="intattribute12"  >
                            </div>

                            <div class="col-md-3">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.service')); ?></label>
                                
                                <input type="number" id="service" class="form-control text-end" value="<?php echo e((float)$miss->intattribute13 ?? 0); ?>" name="intattribute13"  >
                            </div>
                        </div>
                        <div class="row mt-2 mb-1">
                            <div class="col-md-3">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.cleaning')); ?></label>
                                
                                <input type="number" id="cleaning" class="form-control text-end" value="<?php echo e((float)$miss->intattribute14 ?? 0); ?>" name="intattribute14"  >
                            </div>
                            <div class="col-md-3">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.chanel')); ?></label>
                                
                                <input type="number" id="chanel" class="form-control text-end" value="<?php echo e((float)$miss->intattribute15 ?? 0); ?>" name="intattribute15"  >
                            </div>

                            <div class="col-md-3">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.emkl1')); ?></label>
                                
                                <input type="number" id="emkl" class="form-control text-end" value="<?php echo e((float)$miss->intattribute16 ?? 0); ?>" name="intattribute16"  >
                            </div>

                            <div class="col-md-3">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.lift')); ?></label>
                                
                                <input type="number" id="lift" class="form-control text-end" value="<?php echo e((float)$miss->intattribute17 ?? 0); ?>" name="intattribute17"  >
                            </div>
                        </div>
                        <div class="row mt-2 mb-1">

                            <div class="col-md-3">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.PIB')); ?></label>
                                
                                <input type="number" id="pib" class="form-control text-end" value="<?php echo e((float)$miss->intattribute18 ?? 0); ?>" name="intattribute18"  >
                            </div>
                            <div class="col-md-3">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.miss')); ?></label>
                                <input type="text" id="miscellaneous" class="form-control text-end" value="0" name="intattribute19"  >
                            </div>
                            <div class="col-md-1">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.cont')); ?></label>
                                <input type="number" id="cont" class="form-control text-end" value="1" name="container"  >
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.missExpense.head.total')); ?></label>
                                <label class="form-control text-end head_total" id="head_total">0</label>
                                <input type="hidden" id="" class="form-control text-end" value="0" name="item_code"  >
                            </div>
                            <div class="col-md-1 mt-1">
                                <button type="button" id="button_1" class="btn btn-ligth btn-sm head_expense" style="position: inherit;"><i class="" data-feather="plus"></i></button>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row mt-2">
                        <div class="box box-default">
                                <div class="card-header">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-component-tab" data-bs-toggle="tab" data-bs-target="#nav-component" type="button" role="tab" aria-controls="nav-component" aria-selected="true">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="briefcase" class="font-medium-3"></i>
                                                </span>
                                                Component
                                            </button>
                                            <button class="nav-link expenseCalculate" id="nav-micellaneous-tab" data-bs-toggle="tab" data-bs-target="#nav-micellaneous" type="button" role="tab" aria-controls="nav-micellaneous" aria-selected="false">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="dollar-sign" class="font-medium-3"></i>
                                                </span>
                                                Micellaneous
                                            </button>
                                        </div>
                                    </nav>
                                </div>
                                <hr>
                                <div class="tab-content" id="nav-tabContent" >
                                    
                                    <div class="tab-pane fade show active" id="nav-component" role="tabpanel" aria-labelledby="nav-component-tab">
                                        <div class="box-body table-responsive scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                            <table id="" class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Order Number</th>
                                                        <th class="text-center">Item Code</th>
                                                        <th class="text-center">Description</th>
                                                        <th class="text-center">UOM</th>
                                                        <th class="text-center">Received QTY</th>
                                                        <th class="text-center">Price</th>
                                                        <th class="text-center">Total</th>
                                                        <th class="text-center">Conversion (IDR)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; $total = 0; $asuransi=0;$qty_rcv=0;?>
                                                    <?php $__currentLoopData = $rcv_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $qty_rcv+=$value->secondary_quantity_received;
                                                    ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php foreach ($rcv_detail as $key =>$row) ?>
                                                        <tr class="tr_input">
                                                            <td>
                                                                <label class="form-control text-start" id="tax_main"><?php echo e($row->segment1); ?> </label>
                                                                <input type="hidden" name="order_number[]" class="form-control" value="<?php echo e($row->segment1); ?>"  required>
                                                            </td>
                                                            <td>
                                                                <label class="form-control text-start" id="tax_main"><?php echo e($row->itemmaster->item_code); ?></label>
                                                                <input type="hidden" name="inventory_item_id[]" class="form-control" value="<?php echo e($row->item_id); ?>" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-control text-start" id="tax_main"><?php echo e($row->item_description); ?></label>
                                                                <input type="hidden" name="item_description[]" class="form-control" value="<?php echo e($row->item_description); ?>" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-control text-center" id="tax_main"><?php echo e($row->secondary_uom_code); ?></label>
                                                                <input type="hidden" name="item_id[]" id="uom_ 1" class="form-control" value="<?php echo e($row->secondary_uom_code); ?>" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-control text-end" id="tax_main"><?php echo e(number_format( $qty_rcv,2,",",".")); ?></label>
                                                                <input type="hidden" name="intattribute2[]" id="rcvQty_1" class="form-control" value="<?php echo e($qty_rcv); ?>" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-control text-end" id="tax_main"><?php echo e(number_format($row->transfer_cost,3,",",".")); ?></label>
                                                                <input type="hidden" name="shipment_unit_price[]" id="price_1" class="form-control price" value="<?php echo e(number_format($row->transfer_cost,2)); ?>" required>
                                                            </td>
                                                            <?php
                                                                $total = $row->transfer_cost  *  $qty_rcv
                                                            ?>
                                                            <td>
                                                                <label class="form-control text-end" id="tax_main"><?php echo e(number_format($total,3,",",".")); ?></label>
                                                                <input type="hidden" name="item_id[]" id="total_1" class="form-control"  value="<?php echo e($total); ?>" required>
                                                            <td>
                                                                <label class="form-control text-end conversionRate" id="tax_main"><?php echo e(number_format($row->transfer_cost *  $qty_rcv * $rate,3,",",".")); ?></label>
                                                                <input type="hidden" name="item_id[]" id="conversion_1" class="form-control " value="<?php echo e($row->transfer_cost *  $qty_rcv * $rate); ?>" required>
                                                            </td>
                                                        </tr>

                                                </tbody>
                                            </table></br>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="nav-micellaneous" role="tabpanel" aria-labelledby="nav-micellaneous-tab">
                                        <div class="box-body table-responsive" style="height: 380px;overflow: scroll;">
                                            <table  class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Logistic Cost</th>
                                                        <th class="text-center">KSO</th>
                                                        <th class="text-center">Insurance</th>
                                                        <th class="text-center">Letter of Credit</th>
                                                        <th class="text-center">Cost Total</th>
                                                        <th class="text-center">Cost each Item</th>
                                                        <th class="text-center">Price each Item</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; $total = 0; $asuransi=0;?>
                                                    <?php foreach ($rcv_detail as $key =>$row) ?>
                                                        <tr class="tr_input">
                                                            <td>
                                                                <label class="form-control text-end head_total" id="tax_main">0</label>
                                                                <input type="hidden"  name="intattribute3[]" id="logistic_1" class="form-control text-end  logistic" value="0" required>
                                                                <input type="hidden"  name="item_id[]" id="lineId_1" class="form-control text-end  " value="<?php echo e($row->shipment_header_id); ?>" required>
                                                                <input type="hidden"  name="item_id[]" id="aju_1" class="form-control text-end" value="<?php echo e($aju); ?>" required>
                                                                <input type="hidden"  name="rcv_id[]" class="form-control text-end" value="<?php echo e($row->id); ?>" required>
                                                                <input type="hidden"  name="po_line_id[]" class="form-control text-end" value="<?php echo e($row->po_line_id); ?>" required>
                                                                <input type="hidden"  name="po_line_location_id[]" class="form-control text-end" value="<?php echo e($row->po_line_location_id); ?>" required>
                                                                <input type="hidden"  name="item_id[]" id="rate_1" class="form-control text-end  " value="<?php echo e($rate); ?>" required>
                                                                <input type="hidden"  name="item_id[]" id="price_1" class="form-control text-end sum1 " value="<?php echo e($row->purchaseorderdet->base_model_price ?? $row->transfer_cost); ?>" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-control text-end kso" id="kso2_1">0</label>
                                                                <input type="hidden" name="intattribute4[]" id="kso_1" class="form-control text-end kso" value="0" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-control text-end" id="asuransi2_1">0</label>
                                                                <input type="hidden" name="intattribute5[]" id="asuransi_1" class="form-control text-end sum3" value="0" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-control text-end" id="lc2_1">0</label>
                                                                <input type="hidden" name="intattribute6[]" id="lc_1" class="form-control text-end sum4" value="0" required>
                                                            </td>
                                                            <td >
                                                                <label class="form-control text-end" id="totalCost2_1">0</label>
                                                                <input  type="hidden" name="intattribute7[]" id="totalCost_1" class="form-control text-end"  value="0" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-control text-end" id="costItem2_1">0</label>
                                                                <input type="hidden" name="intattribute8[]" id="costItem_1" class="form-control text-end " value="0" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-control text-end" id="priceItem2_1">0</label>
                                                                <input type="hidden" name="rcv_price[]" id="priceItem_1" class="form-control text-end" value="0" required>
                                                            </td>
                                                        </tr>

                                                </tbody>
                                            </table></br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <hr>
                        <div class="d-flex justify-content-between mb-50">
                            <input class="btn float-left" type="hidden">
                            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> <?php echo e(trans('global.save')); ?></button>
                        </div>
                    </form>
                </div>
          <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/missExpense/create.blade.php ENDPATH**/ ?>
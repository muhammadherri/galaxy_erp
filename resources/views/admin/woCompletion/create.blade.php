@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('breadcrumbs')
    <a href="./" class="breadcrumbs__item">Manufacturing</a>
    <a href="#" class="breadcrumbs__item active">Completion</a>
@endsection
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>
@endif

<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <form action="{{ route("admin.completion.store") }}" method="POST" enctype="multipart/form-data" class="form-horizontal create_purchase">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header">
                        Create Completion
                    </div>
                    <hr>
                    <div class="card-body mt-1">
                        <div class="row mb-2">
                            <div class="col-md-1">
                                <b><p class="text-end">Roll Type :<p></b>
                            </div>
                            <div class="col-md-5">
                                <div class="row mt-1 p-0">
                                    <div class="col-md-4">
                                        <input type="text" id="item_code" class="form-control filter_WorkOrder" value="{{$bigRoll->item->item_code}}" autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" id="gsm" name="jumbo" class="form-control text-center" value="{{$roll->attribute_number_gsm ?? $bigRoll->attribute_float1}}" placeholder="GSM" required>
                                    </div>/
                                    <div class="col-sm-2">
                                        <input type="text" id="l" name="attribute_float10" class="form-control text-center" value="{{$roll->attribute_number_l ?? $bigRoll->attribute_float10}}" placeholder="L" required>
                                    </div>/
                                    <div class="col-sm-2">
                                        <input type="text" id="w" name="width" class="form-control text-center" value="{{$roll->attribute_number_w ?? $bigRoll->attribute_float2}}" placeholder="W" required>
                                    </div>
                                    <input type="hidden" id="" name="inventory_item_id" class="form-control" value="{{$bigRoll->inventory_item_id}}" autocomplete="off" required>
                                    <input type="hidden" id="" name="idRoll" class="form-control" value="{{$bigRoll->work_order_id ?? $bigRoll->id}}" autocomplete="off" required>
                                    <input type="hidden" id="" name="subinventory" class="form-control" value="{{$bigRoll->compl_subinventory_code ?? $bigRoll->jumbo->wo->compl_subinventory_code}}" autocomplete="off" required>
                                    <input type="hidden" id="" name="type" class="form-control" value="{{$type}}" autocomplete="off" required>
                                    <input type="hidden" id="" name="roll" class="form-control" value="{{$bigRoll->planning->revise}}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <b><p class="text-end">Trans Date :</p></b>
                            </div>
                            <div class="col-md-5">
                                <input type="text" id="datepicker-1" name="completion_date" value="{{date('d-M-Y')}}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-1">
                                <b><p class="text-end">Big Roll Code :<p></b>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="attribute_roll" id="" class="form-control" value="{{ $roll->uniq_attribute_roll ?? $jumb_code}}" required>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-1">
                                <b><p class="text-end">Quantity :</p></b>
                            </div>
                            <div class="col-md-5">
                                <input type="text" value="{{$roll->primary_quantity ?? $qty}}"  class="form-control datepicker" id="roll_qty" name="roll_qty" autocomplete="off" required>
                                <input type="hidden" value="{{$roll->primary_quantity ?? NULL}}"  class="form-control datepicker" id="roll_qty" name="jmb_qty" autocomplete="off" required>
                                <input type="number" hidden id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                                <b><p class="text-end">Work Order :<p></b>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="" name="wo_number" autocomplete="off" value="{{$bigRoll->work_order_number}}" readonly required>
                                <input type="hidden" class="form-control" value="" id="comp_subinventory" name="compl_subinventory_code" autocomplete="off" readonly required>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-1">
                                <b><p class="text-end">Reference :</p></b>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="reference" class="form-control" id="source" value="{{$bigRoll->source_line_ref}}" autocomplete="off" required>
                            </div>
                            <div class="col-md-1">
                                <button type="button" id="btn-sales" class="btn btn-sm btn-secondary " data-bs-toggle="modal" data-bs-target="#salesModal"> <span class="bs-stepper-box">
                                    <i data-feather="archive" class="font-medium-3"></i>
                                </span></button>
                            </div>
                        </div>
                    <!-- /.box-body -->
                    </div>
                {{-- </div>

                <div class="card"> --}}
                    <div class="card-header">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-component-tab" data-bs-toggle="tab" data-bs-target="#nav-component" type="button" role="tab" aria-controls="nav-component" aria-selected="true">
                                    <span class="bs-stepper-box">
                                        <i data-feather="tool" class="font-medium-3"></i>
                                    </span>
                                    Component
                                </button>
                                <button class="nav-link" id="nav-micellaneous-tab" data-bs-toggle="tab" data-bs-target="#nav-micellaneous" type="button" role="tab" aria-controls="nav-micellaneous" aria-selected="false">
                                    <span class="bs-stepper-box">
                                        <i data-feather="shuffle" class="font-medium-3"></i>
                                    </span>
                                    Micellaneous
                                </button>
                            </div>
                        </nav>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div >
                            <div class="tab-content" id="nav-tabContent" >
                                {{-- Tab Component --}}
                                <div class="tab-pane fade show active" id="nav-component" role="tabpanel" aria-labelledby="nav-component-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-striped tableFixHead" id="tab_logic">
                                            <thead>
                                                <th width="auto" class="text-center">
                                                </th>
                                                <th scope="col" class="text-center">Roll Number</th>
                                                <th scope="col" class="text-center">UOM</th>
                                                <th scope="col" class="text-center">Qty (kg)</th>
                                                <th scope="col" class="text-center" >Product Detail (GSM L x  W)</th>
                                                <th scope="col" class="text-center">Type</th>
                                                <th scope="col" class="text-center">Action</th>
                                                <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            @php
                                                $date = date("y m d");
                                            @endphp
                                            <tbody class="roll_container">
                                                @foreach ($data as $key =>$row)
                                                <tr class="tr_input">
                                                    <td width="auto" class="text-center">
                                                    </td>
                                                    <td width="30%">
                                                        <input type="hidden" class="line_id" id="line_id_{{$key+1}}" name="line_id[]" value="">
                                                         <input type="text" class="form-control search_sales" id="item_sales_{{$key+1}}"  name="uniq_attribute_roll[]" value="V{{$bigRoll->job_definition_name}} {{$date}} {{$count_date + $key+1}}" autocomplete="off" required>
                                                         <input type="hidden" class="form-control search_sales" id="pm"  name="pm" value="{{$bigRoll->job_definition_name }}" autocomplete="off" required>
                                                         <input type="hidden" class="form-control search_sales" id="count_{{$key+1}}"  name="count[]" value="{{$count_date + $key+1}}" autocomplete="off" required>
                                                    </td>
                                                    <td width="auto">
                                                        <input type="text" class="form-control recount text-end" id="uom_{{$key+1}}" value="KG" name="primary_uom[]" required>
                                                    </td>
                                                    <td width="auto">
                                                        <input type="number" class="form-control check_qty text-end" id="checkQty_{{$key+1}}" value="{{$row->qty_estimation}}" name="primary_quantity[]" required>
                                                    </td>
                                                    <td width="25%">
                                                        <div class="col-xs-2">
                                                            <input class="form-control text-center" id="gsm_{{$key+1}}" name='attribute_number_gsm[]' type="text" value="{{$row->attribute_gsm_line}}"  style="width: 30%;">/
                                                            <input class="form-control text-center" id="l_{{$key+1}}" name='attribute_number_l[]' type="text" placeholder="L" value="0"  style="width: 30%;">/
                                                            <input class="form-control text-center" id="w_{{$key+1}}" name='attribute_number_w[]' type="text" placeholder="W" value="{{$row->attribute_w_line}}" style="width: 30%;">
                                                        </div>
                                                    </td>
                                                    <td width="auto">
                                                        <input type="number" id="harga_{{$key+1}}" class="form-control harga text-center" placeholder="Q1 / Q2 / Q3" name="attribute_num_quality[]"  required>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch form-check-primary text-end">
                                                            <input type="checkbox" class="form-check-input switchButton" id="customSwitch10_{{$key+1}}" checked="">
                                                            <input type="hidden" value="" name="action_status[]" id="action_{{$key+1}}">
                                                            <label class="form-check-label" for="customSwitch10_{{$key+1}}">
                                                                <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                                    </svg></span>
                                                                <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                        <line x1="20" y1="6" x2="6" y2="18"></line>
                                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                    </svg></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><button type="button" class="btn btn-ligth btn-sm remove_tr_sales" disabled>X</button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="9">
                                                        <button type="button" class="btn btn-outline-danger add_roll btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        </div>

                                </div>

                                {{-- Tab Misscellaneous --}}
                                <div class="tab-pane fade" id="nav-micellaneous" role="tabpanel" aria-labelledby="nav-micellaneous-tab">
                                    <table class="table table-striped tableFixHead">
                                        <thead>
                                            <th scope="col">Micellaneous</th>
                                            <th scope="col">Work Center</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">Schedule Started Date</th>
                                            <th scope="col">Expected Duration</th>
                                            <th scope="col">Real Durtion</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bomMicellaneous_container">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-outline-success add_workOrder btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                            </td>
                                            <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between  mt-2">
                            <button type="reset" class="btn btn-danger pull-left">Reset</button>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                    <!-- /.box-body -->

                </div>

                @include('admin.workOrder.sales-src')

            </form>
        </div>

</section>
<!-- /.content -->
@endsection

@push('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        , }
    });
    $(document).on('change', '.switchButton', function() {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];

        if ($('#customSwitch10_'+index).prop('checked')) {
            var value = 1;
        } else {
            var value = 0;
        }
        console.log(value);

        $('#action_' + index).val(value);
    });
</script>
@endpush

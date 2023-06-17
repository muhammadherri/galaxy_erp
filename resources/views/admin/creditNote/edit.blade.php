@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush

@section('content')
@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
<br>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("admin.ar.update",[$cust->id]) }}" method="POST" enctype="multipart/form-data" class="form-horizontal" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header  mt-1 mb-25">
                                    <h6 class="card-title">
                                        <a href="{{ route("admin.ar.index") }}" class="breadcrumbs__item">{{ trans('cruds.aReceivable.title') }} </a>
                                        <a href="{{ route("admin.credit-note.index") }}" class="breadcrumbs__item"> Credit Note </a>
                                        <a href="{{ route("admin.ar.create") }}" class="breadcrumbs__item">Create </a>
                                    </h6>
                                </div>
                                <hr>
                                <div class="box-body">
                                    <div class="card-body mt-1 centered">
                                        <div class="row mb-50">
                                            <div class="col-md-1">
                                                <b>
                                                    <p class="text-start text-nowrap">{{ trans('cruds.aReceivable.ar.trx_number')}}
                                                        <p>
                                                </b>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="invoice_num" class="form-control " id="invoice_num" value="{{$cust->trx_number}}" autocomplete="off">
                                                @if ($errors->any())
                                                <div class="badge bg-danger">
                                                    @foreach ($errors->all() as $error)
                                                    {{ $error }}
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>

                                            <div class="col-md-1">
                                                <b>
                                                    <p class="text-start">{{ trans('cruds.aReceivable.ar.trx_date')}}</p>
                                                </b>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="datepicker-1" name="trx_date" value="{{$cust->trx_date}}" class="form-control datepicker" autocomplete="off" required>
                                            </div>
                                            <div class="col-md-1">
                                                <b>
                                                    <p class="text-start">Delivery</p>
                                                </b>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="attribute1" value="{{$cust->attribute1}}" class="form-control" autocomplete="off" required>

                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-md-1">
                                                <b>
                                                    <p class="text-start">{{ trans('cruds.aReceivable.ar.bill_to')}}
                                                        <p>
                                                </b>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <input type="hidden" name="vendor_id" id="vendor_id" class="form-control" placeholder="Search this blog">
                                                    <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{$cust->customer->party_name}}" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <b>
                                                    <p class="text-start">{{ trans('cruds.aReceivable.ar.terms')}}</p>
                                                </b>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="term_id" id="terms" class="form-control select2" required>
                                                    @foreach($terms as $row)
                                                    @if($row->id == $cust->term_id)
                                                    <option selected value="{{$row->term_code}}" {{old('terms') ? 'selected' : '' }}> {{$row->term_code}} - {{$row->terms_name}} </option>
                                                    @else
                                                    <option value="{{$row->term_code}}" {{old('terms') ? 'selected' : '' }}> {{$row->term_code}} - {{$row->terms_name}} </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @if($errors->has('terms'))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('terms') }}
                                                </em>
                                                @endif
                                            </div>
                                            <div class="col-md-1">
                                                <b>
                                                    <p class="text-start">Note No</p>
                                                </b>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="attribute2" class="form-control" autocomplete="off" value="{{$cust->attribute2}}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-1">
                                                <b>
                                                    <p class="text-start">{{ trans('cruds.aReceivable.ar.ship_to')}}</p>
                                                </b>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" name="address" class="form-control" autocomplete="off" value="{{$cust->party_site->address1 ?? ''}}" required>
                                                <input type="hidden" name="bill_to_customer_id" class="form-control value1" value="{{$cust->bill_to_customer_id}}" id="input" autocomplete="off" required>
                                                <input type="hidden" name="ship_to_party_id" class="form-control value1" value="{{$cust->ship_to_customer_id}}" id="input" autocomplete="off" required>
                                                <input type="hidden" name="exchange_date" class="form-control value1" value="{{$cust->exchange_date}}" id="input" autocomplete="off" required>
                                                <input type="hidden" name="exchange_rate" class="form-control value1" value="{{$cust->exchange_rate}}" id="input" autocomplete="off" required>
                                                <input type="number" hidden id="status " name="je_batch_id" value="{{random_int(0, 999999)}}" class="form-control">
                                                <input type="number" hidden id="status " name="organization_id" value="{{random_int(0, 999999)}}" class="form-control">
                                            </div>
                                            <div class="col-md-1">
                                                <b>
                                                    <p class="text-start">{{ trans('cruds.aReceivable.ar.curr')}}
                                                </b>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="invoice_currency_code" id="customer_currency" class="form-control select2" required>
                                                    @foreach($currency as $row)
                                                    @if($row->currency_code == $cust->invoice_currency_code)
                                                    <option selected value="{{$row->currency_code}}"> {{$row->currency_code}} - {{$row->currency_name}} </option>
                                                    @else
                                                    <option value="{{$row->currency_code}}"> {{$row->currency_code}} - {{$row->currency_name}} </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @if($errors->has('customer_currency'))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('customer_currency') }}
                                                </em>
                                                @endif
                                            </div>
                                            <div class="col-md-1">
                                                <b>
                                                    <p class="text-start">GL Date</p>
                                                </b>
                                            </div>
                                            <div class="col-md-3">

                                                <input type="text" id="datepicker-2" name="gl_date" value="{{$ar->gl_date}}" class="form-control datepicker" autocomplete="off" required>
                                                <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id?? ''}}">
                                            </div>
                                        </div>

                                    </div>
                                    <hr>

                                    {{-- <div class="card"> --}}
                                    <div class="card-header">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active btn btn-light" id="nav-ap-tab" data-bs-toggle="tab" data-bs-target="#nav-ap" type="button" role="tab" aria-controls="nav-ap" aria-selected="true">
                                                    <span class="bs-stepper-box">
                                                        <i data-feather="file-text" class="font-medium-3"></i>
                                                    </span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Main</span>
                                                    </span>
                                                </button>
                                                <button class="nav-link btn btn-light" id="nav-ap-det-tab" data-bs-toggle="tab" data-bs-target="#nav-ap-det" type="button" role="tab" aria-controls="nav-ap-det" aria-selected="false">
                                                    <span class="bs-stepper-box">
                                                        <i data-feather="dollar-sign" class="font-medium-3"></i>
                                                    </span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Journal Items</span>
                                                    </span>

                                                </button>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card-body ">
                                        <div class="tab-content" id="nav-tabContent">
                                            {{-- Tab sales --}}
                                            <div class="tab-pane fade show active" id="nav-ap" role="tabpanel" aria-labelledby="nav-ap-tab">
                                                <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                                    <table class="table table-fixed table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Product</th>
                                                                <th class="text-center">Desc</th>
                                                                <th class="text-center">Account Code</th>
                                                                <th class="text-center">Quantity</th>
                                                                <th class="text-center">Price</th>
                                                                <th class="text-center">Total Amount</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="receivable_container">
                                                            @php $subtotal =0;$ar_account = 'XXXX'; @endphp
                                                            @foreach ($line as $key => $row )
                                                            @if ($row->line_type == 0 ||$row->line_type == 3)
                                                            <tr class="">
                                                                <td width="15%">
                                                                    <input type="text" readonly class="form-control" value="{{$row->ItemMaster->item_code ?? $row->description}}" name="item_code[]" id="searchitem_{{$key+1}}" autocomplete="off" required>
                                                                    <input type="hidden" readonly class="form-control" value="{{$row->inventory_item_id ?? ''}}" name="inventory_item_id[]" autocomplete="off" required>
                                                                </td>
                                                                <td width="20%">
                                                                    <input type="text" readonly class="form-control" value="{{$row->description}}" name="description[]" id="searchitem_{{$key+1}}" autocomplete="off" required>
                                                                    <input type="hidden" readonly class="form-control" value="{{$row->sales_order ?? ''}}" name="sales_order[]" id="sales_order_{{$key+1}}" autocomplete="off" required>
                                                                </td>
                                                                <td width="20%">
                                                                    <input type="text" class="form-control search_acc" value="{{$row->code_combinations ?? $row->ItemMaster->category->inventory_account_code}}  {{$row->acc->description ?? ''}}" name="account_dess[]" id="accDes_{{$key+1}}" autocomplete="off" required>
                                                                    <input type="hidden" name="" value="{{$row->code_combinations ?? $row->ItemMaster->category->attribute1}}" class="form-control datepicker" id="acc_{{$key+1}}" autocomplete="off">
                                                                </td>
                                                                <input type="hidden" name="accts_pay_code_combination_id" class="form-control datepicker" id="acc_{{$key+1}}" value="{{$row->ItemMaster->category->attribute1 ?? ''}}" autocomplete="off">
                                                                @php $ar_account = $row->ItemMaster->category->receivable_account_code ?? ''; @endphp
                                                                </td>
                                                                <td width="10%">
                                                                    <input type="text" class="form-control ar_recount float-end text-end" readonly value="{{$row->quantity_invoiced}}" name="quantity_invoiced[]" id="qty_{{$key+1}}" autocomplete="off" required>
                                                                    <input type="hidden" class="form-control ar_recount float-end text-end" readonly value="{{$row->quantity_ordered}}" name="quantity_ordered[]" id="qty2_{{$key+1}}" autocomplete="off" required>
                                                                </td>
                                                                <td width="20%">
                                                                    <input type="text" name="unit_selling_price[]" readonly class="form-control datepicker float-end text-end" value="{{$row->unit_selling_price}}" id="price_{{$key+1}}" autocomplete="off">
                                                                </td>
                                                                <td width="20%">
                                                                    <input type="text" name="amount_due_original[]" readonly class="form-control subtotal float-center text-end grandSub" id="subtotalAdd_{{$key+1}}" value="{{$row->amount_due_original}}" autocomplete="off">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn  btn-ligth btn-sm" style="position: inherit;">X</button>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @php $subtotal += $row->unit_selling_price * $row->quantity_invoiced; @endphp
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                @if ($cust->status_trx != 2)
                                                                <td colspan="2">
                                                                    <button type="button" class="btn btn-light btn-sm add_receivable " style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                                                </td>
                                                                @endif
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <div class="row mt-2 mb-2">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label> Status</label>
                                                            @if ($cust->status_trx == 1)
                                                            <input type="text" class="form-control grand_total " value="Validate" name="status_name" readonly="">
                                                            @elseif($cust->status_trx == 2)
                                                            <input type="text" class="form-control grand_total " value="Posted" name="status_name" readonly="">
                                                            @elseif($cust->status_trx == 3)
                                                            <input type="text" class="form-control grand_total " value="Canceled" name="status_name" readonly="">
                                                            @elseif($cust->status_trx == 4)
                                                            <input type="text" class="form-control grand_total " value="{{$cust->payment_attributes}}" name="status_name" readonly="">
                                                            @else
                                                            <input type="text" class="form-control grand_total " value="Draft" name="status_name" readonly="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tax ( Amount )</label><br>
                                                            <input type="hidden" class="form-control tax" id="tax_main" value="{{ $ar->tax_applied  }}" name="tax_amount">
                                                            <input type="hidden" class="form-control" id="pajak" value="{{$data->tax_rate}}" name="pajak">
                                                            <label class="form-control text-end tax" id="tax_main2">{{number_format( $ar->tax_applied )}}</label>
                                                        </div>
                                                    </div>
                                                    <div class=" col-md-5">
                                                        <div class="form-group">
                                                            <label>Total</label>
                                                            <input type="hidden" class="form-control calculate" value="{{ $ar->amount_applied }}" id="amount" readonly="" name="ar_amount">
                                                            <label class="form-control text-end calculate" id="total"> {{number_format($ar->amount_applied)}}</label>

                                                        </div>
                                                    </div>
                                                    @if ($cust->payment_attributes == 'Partial')
                                                    <div class="row mt-2 mb-2">
                                                        <div class="col-md-10">
                                                        </div>
                                                        <div class=" col-md-2">
                                                            <div class="form-group">
                                                                <label class="text-end"> &nbsp; Amount Due : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                    <b>{{number_format($ar->amount_applied - $ar->amount_applied_from)}}</b></label>
                                                                <b>
                                                                    <hr></b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show " id="nav-ap-det" role="tabpanel" aria-labelledby="nav-ap-det-tab">
                                                <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                                    <table class="table table-fixed table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th>Account</th>
                                                                <th class="text-center">Label</th>
                                                                <th class="text-center">Debit</th>
                                                                <th class="text-center">Credit</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="journal_container">
                                                            @php $total =0;$inv_total =0; @endphp
                                                            @foreach ($line as $key => $row )
                                                            @if ($row->line_type == 0)
                                                            <tr class="tr_input">
                                                                <td width="20%">
                                                                    <input type="text" class="form-control search_acc" value="{{$row->code_combinations }}  {{$row->acc->description ?? ''}}" name="quantity1[]" id="accDes2_{{$key+1}}" autocomplete="off" required>
                                                                    <input type="hidden" name="code_combinations[]" class="form-control datepicker" id="acc2_{{$key+1}}" value="{{$row->code_combinations}}" autocomplete="off">
                                                                    <input type="hidden" readonly class="form-control" value="{{$row->id}}" name="lineId[]" id="lineId_{{$key+1}}" autocomplete="off" required>
                                                                </td>
                                                                <td width="32%">
                                                                    <input type="text" readonly class="form-control" value="{{$row->description}}" name="label[]" id="searchitem_{{$key+1}}" autocomplete="off" required>
                                                                </td>
                                                                <td width="20%">
                                                                    <label class="form-control  text-end">{{number_format($row->frt_ed_amount )}}</label>
                                                                    <input type="hidden" name="" readonly class="form-control datepicker float-center text-end" id="price_{{$key+1}}" autocomplete="off">
                                                                    <input type="hidden" name="entered_dr[]" readonly class="form-control datepicker float-center text-end" id="" value="{{$row->frt_ed_amount}}" autocomplete="off">
                                                                </td>
                                                                <td width="25%">
                                                                    <label class="form-control text-end">{{number_format($row->frt_uned_amount )}}</label>
                                                                    <input type="hidden" name="entered_cr[]" readonly class="form-control datepicker float-center text-end" id="subtotal_{{$key+1}}" value="{{$row->frt_uned_amount  }}" autocomplete="off">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-ligth btn-sm" disabled style="position: inherit;">X</button>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            @foreach ($line as $key => $row )
                                                            @if ($row->line_type == 1 || $row->line_type == 3)
                                                            <tr class="tr_input_journal">
                                                                <td width="20%">
                                                                    <input type="text" class="form-control search_coa" value="{{$row->code_combinations }}  {{$row->acc->description}}" name="quantity1[]" id="coa_{{$key+1}}" autocomplete="off" required>
                                                                    <input type="hidden" name="code_combinations[]" class="form-control datepicker" id="search_coa_{{$key+1}}" value="{{$row->code_combinations}}" autocomplete="off">
                                                                    <input type="hidden" readonly class="form-control" value="{{$row->id}}" name="lineId[]" id="lineId_{{$key+1}}" autocomplete="off" required>
                                                                </td>
                                                                <td width="32%">
                                                                    <input type="text" readonly class="form-control" value="{{$row->description}}" name="label[]" id="searchitem_{{$key+1}}" autocomplete="off" required>
                                                                </td>
                                                                <td width="20%">
                                                                    @if ($row->code_combinations == $ar_account)
                                                                    <label id="calculate" class="form-control calculate text-end">{{ number_format($row->frt_ed_amount  ) }}</label>
                                                                    <input type="hidden" name="entered_dr[]" id="calculate" readonly class="form-control calculate float-center text-end" value="{{ $row->frt_ed_amount }}" autocomplete="off">
                                                                    <input type="hidden" name="" id="tax" readonly class="form-control tax float-center text-end" value="{{$ar->tax_applied }}" autocomplete="off">
                                                                    <input type="hidden" name="" id="sales" readonly class="form-control datepicker float-center text-end" value="{{ $row->frt_ed_amount }}" autocomplete="off">
                                                                    @else
                                                                    <label class="form-control  text-end">{{number_format($row->frt_ed_amount )}}</label>
                                                                    <input type="hidden" name="" readonly class="form-control datepicker float-center text-end" id="price_{{$key+1}}" autocomplete="off">
                                                                    <input type="hidden" name="entered_dr[]" readonly class="form-control datepicker float-center text-end" id="" value="{{$row->frt_ed_amount}}" autocomplete="off">
                                                                    @endif
                                                                </td>
                                                                <td width="25%">
                                                                    @if ($row->code_combinations == $data->tax_code->tax_account)
                                                                    <label class="form-control text-end tax">{{ number_format($row->frt_uned_amount) }}</label>
                                                                    <input type="hidden" name="entered_cr[]" readonly class="form-control datepicker tax float-center text-end" value="{{ $row->frt_uned_amount }}" autocomplete="off">
                                                                    @else
                                                                    <label class="form-control text-end">{{number_format($row->frt_uned_amount )}}</label>
                                                                    <input type="hidden" name="entered_cr[]" readonly class="form-control datepicker float-center text-end" id="subtotal_{{$key+1}}" value="{{$row->frt_uned_amount  }}" autocomplete="off">
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($row->code_combinations == $data->tax_code->tax_account)
                                                                    <button type="button" class="btn btn-ligth btn-sm remove_tax " data-id="{{$row->id}}" data-term="{{$cust->bill_template_name}}" style="position: inherit;">X</button>
                                                                    @else
                                                                    <button type="button" class="btn btn-ligth btn-sm" disabled style="position: inherit;">X</button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @php
                                                            if($row->line_type != 3){
                                                                $total += $row->frt_uned_amount;
                                                            }
                                                            @endphp
                                                            @endforeach
                                                            <tr class="">
                                                                <td colspan="2"></td>
                                                                <td class="text-end" width="20%">
                                                                    <label id="calculate_debit" class="form-control calculate text-end">{{ number_format( $total ) }}</label>
                                                                    <input type="hidden" name="calculate_debit" id="calculate_debit" readonly class="form-control calculate float-center text-end" value="{{ $total}}" autocomplete="off">
                                                                </td>
                                                                <td class="text-end" width="20%">
                                                                    <label id="calculate_debit" class="form-control calculate text-end">{{ number_format( $total) }}</label>
                                                                    <input type="hidden" name="calculate_credit" id="calculate_debit" readonly class="form-control calculate float-center text-end" value="{{ $total }}" autocomplete="off">
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="d-flex justify-content-between mt-2 mb-2">
                                            @if ($cust->status_trx == 2 || $cust->payment_attributes == 'Partial')
                                            <div>
                                                <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#paymentModal"> <span class="bs-stepper-box">
                                                        <i data-feather="settings" class="font-medium-3"></i>
                                                    </span>Actions</button> &nbsp;&nbsp;
                                            </div>
                                            @else
                                            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#actionModal"> <span class="bs-stepper-box">
                                                    <i data-feather="settings" class="font-medium-3"></i>
                                                </span>Actions</button>
                                            @endif
                                            @if ($cust->status_trx != 2)
                                            <button type="submit" name='action' value="save" class="btn btn-sm btn-primary pull-right"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('admin.arReceivable.action')
                    </form>
                    @include('admin.arReceivable.creditNote')

                </div>
            </div>
        </div>
    </div>
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

    $(document).ready(function() {
        $("input:checkbox").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {
                // the name of the box is retrieved using the .attr() method
                // as it is assumed and expected to be immutable
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                // the checked state of the group/box on the other hand will change
                // and the current value is retrieved using .prop() method
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    });

</script>
@endpush

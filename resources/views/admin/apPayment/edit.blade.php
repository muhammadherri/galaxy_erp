@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery-ui.js') }}"></script>
@endpush
    @section('breadcrumbs')
    <a href="{{route("admin.ap-payment.index")}}" class="breadcrumbs__item">Account Payable </a>
    <a href="{{route("admin.ap-payment.index")}}" class="breadcrumbs__item">AP List </a>
    <a href="" class="breadcrumbs__item active">Open</a>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><b>Draft</b></h4>
                    </div>
                    <hr>

                    <br>
                    <div class="card-body">
                        <form action="{{ route("admin.ap-payment.update",$payment->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="mb-2">
                                        <input type="hidden" id="created_by" name="created_by"value="{{ auth()->user()->id }}">
                                        <input type="hidden" id="status" name="status" value="1">
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.payment.fields.internal') }}</label>
                                            <div class="col-sm-3 ">
                                                <input type="checkbox" class="form-check-input" name="status" id="Check4" value="1">
                                            </div>

                                            <div class="col-sm-2"></div>

                                            <label class="col-sm-2 control-label"for="number">{{ trans('cruds.payment.fields.journal') }}</label>
                                            <div class="col-sm-3">
                                                <select disabled name="attribute_category" id="attribute_category" class="form-control select2" required value="{{$payment->attribute_category}}">
                                                    @foreach($journal as $row)
                                                        <option readonly value="{{ $row->category_code }}"{{ $payment->attribute_category == $row->category_code ? 'selected' : '' }}>{{$row->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.payment.fields.type') }}</label>
                                            <div class="col-sm-3">
                                                @if($payment->global_attribute1=='Send')
                                                <div class=" form-check-inline">
                                                    <input class="form-check-input" type="radio" name="logo" id="inlineRadio1" value="Send" checked="">
                                                    <label class="form-check-label" for="inlineRadio1">&nbsp Send</label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="logo" id="inlineRadio2" value="Receive">
                                                    <label class="form-check-label" for="inlineRadio2">&nbsp Receive</label>
                                                </div>
                                                @else
                                                <div class=" form-check-inline">
                                                    <input class="form-check-input" type="radio" name="logo" id="inlineRadio1" value="Send" >
                                                    <label class="form-check-label" for="inlineRadio1">&nbsp Send</label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="logo" id="inlineRadio2" value="Receive"checked="">
                                                    <label class="form-check-label" for="inlineRadio2">&nbsp Receive</label>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="col-sm-2"></div>

                                            <label class="col-sm-2 control-label"for="number">{{ trans('cruds.payment.fields.method') }}</label>
                                            <div class="col-sm-3">
                                                @if($payment->invoice_payment_type=='Auto')
                                                    <select disabled name="invoice_payment_type" id="payment_method" class="form-control select2" required value="{{$payment->invoice_payment_type}}">
                                                        <option value="Auto">Auto</option>
                                                        <option value="Manual">Manual</option>
                                                    </select>
                                                @else
                                                    <select disabled name="invoice_payment_type" id="payment_method" class="form-control select2" required value="{{$payment->invoice_payment_type}}">
                                                        <option value="Manual">Manual</option>
                                                        <option value="Auto">Auto</option>
                                                    </select>

                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.payment.fields.vendor') }}</label>
                                            <div class="col-sm-3 ">
                                                <select disabled name="vendor" id="vendor" class="form-control select2" required value="{{$payment->invoicing_vendor_site_id}}">
                                                    @foreach($vendor as $row)
                                                        <option value="{{ $row->vendor_id }}"{{ $payment->invoicing_vendor_site_id == $row->vendor_id ? 'selected' : '' }}>{{$row->vendor_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-2"></div>

                                            <label class="col-sm-2 control-label"for="number">{{ trans('cruds.payment.fields.bank') }}</label>
                                            <div class="col-sm-3">
                                                <select disabled name="vendor_bank_account" id="vendor_bank_account" class="form-control select2" required value="{{$payment->bank_num}}">
                                                    @foreach($bankaccount as $row)
                                                        <option value="{{ $row->bank_account_id }}"{{ $payment->bank_num == $row->bank_account_id ? 'selected' : '' }}>{{$row->attribute2}}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="text" class="form-control" name="vendor_bank_account" value="{{$payment->bankacc->attribute2}}"> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.payment.fields.amount') }}</label>
                                            <div class="col-sm-2 ">
                                                <input readonly type="text" class="form-control text-end" name="amount" placeholder="0.00" value="{{number_format($payment->amount, 2, ',', '.')}}">
                                            </div>
                                            <div class="col-sm-1 ">
                                                <select disabled name="payment_currency_code" id="currency" class="form-control select2" required value="{{$payment->payment_currency_code}}">
                                                    @foreach($curr as $row)
                                                        <option value="{{$row->currency_code}}"{{ $payment->payment_currency_code == $row->currency_code ? 'selected' : '' }}> {{$row->currency_code}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-2"></div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.payment.fields.date') }}</label>
                                            <div class="col-sm-3 ">
                                                <input disabled required id="accounting_date" name="accounting_date"type="date" value="{{$payment->accounting_date}}" class="form-control flatpickr-basic-custom flatpickr-input active text-end">
                                            </div>

                                            <div class="col-sm-2"></div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.payment.fields.reference') }}</label>
                                            <div class="col-sm-3 ">
                                                <input type="text" class="form-control" name="reference">
                                            </div>

                                            <div class="col-sm-2"></div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.payment.fields.memo') }}</label>
                                            <div class="col-sm-3 ">
                                                <input readonly type="text" class="form-control" name="memo"value="{{$payment->attribute1}}">
                                            </div>

                                            <div class="col-sm-2"></div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    {{-- <div class="d-flex justify-content-between">
                                        <button type="reset" class="btn btn-danger pull-left">Reset</button>
                                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
                                    </div> --}}
                                </div>
                        </form> <!-- /.box-body -->
                    </div>
                </div>
            </div>
    </section>
    <!-- /.content -->
@endsection

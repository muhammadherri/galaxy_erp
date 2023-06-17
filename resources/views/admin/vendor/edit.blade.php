@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/form-wizard.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.min.js')}}"></script>
@endpush
@section('breadcrumbs')
<a href="{{ route("admin.vendor.index") }}" class="breadcrumbs__item">Purchase Order</a>
<a href="{{ route("admin.vendor.index") }}" class="breadcrumbs__item">Supplier </a>
<a href="" class="breadcrumbs__item active">Edit</a>

@endsection
@section('content')
<!-- Modern Horizontal Wizard -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title ">
                    <a href="{{ route("admin.purchase-requisition.index") }}" class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
                    <a href="{{ route("admin.purchase-requisition.index") }}" class="breadcrumbs__item">{{ trans('cruds.requisition.title_singular') }} </a>
                    <a href="#" class="breadcrumbs__item">{{ trans('cruds.requisition.fields.edit') }}</a>
                </h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="{{ route("admin.vendor.update", [$vendor->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id}}">
                        <input type="hidden" id="status" name="status" value="1">
                        <div class="bs-stepper wizard-modern modern-wizard-example">

                        </div>
                        <div class="bs-stepper-content">
                            <div class="content">
                                <div class="content-header">
                                    {{ trans('global.show') }} {{ trans('cruds.vendor.title') }}
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.vendor_code') }}</label>
                                        <input type="text" class="form-control" name="vendor_id" value="{{ $vendor->vendor_id}}" required="required" maxlength="8" minlength="8">
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.vendor_name') }}</label>
                                        <input type="text" class="form-control" name="vendor_name" value="{{ $vendor->vendor_name}}" maxlength="100" required>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="mb-1 col-md-6">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.address1') }}</label>
                                        <input type="text" class="form-control" name="address1" value="{{ $vendor->address1}}" maxlength="75" required>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.address2') }}</label>
                                        <input type="text" class="form-control" name="address2" value="{{ $vendor->address2}}" maxlength="50">
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.city') }}</label>
                                        <input type="text" class="form-control" name="city" value="{{ $vendor->city}}">
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.province') }}</label>
                                        <input type="text" class="form-control" name="province" value="{{ $vendor->province}}">
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.country') }}</label>
                                        <input type="text" class="form-control" name="country" value="{{ $vendor->country}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.tax') }}</label>
                                        <select type="text" id="currency" name="tax_code" class="form-control" value="{{ old('currency', isset($currency) ? $quotation->currency : '') }}" required>
                                            <option value="{{$vendor->tax_code}}">{{$vendor->tax->tax_name}}</option>
                                            @foreach ($tax as $raw)
                                            @if($vendor->tax_code!=$raw->tax_code)
                                            <option value="{{$raw->tax_code}}">{{$raw->tax_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.currency') }}</label>
                                        <select type="text" id="currency" name="currency" class="form-control" required>
                                            @foreach ($curr as $curr )
                                            @if ($curr->currency_code !=$vendor->currency )
                                            <option value="{{$curr->currency_code}}">{{$curr->currency_code}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.terms') }}</label>
                                        <select type="text" id="terms" name="terms" class="form-control" value="{{ old('terms', isset($terms) ? $vendor->terms : '') }}" required>
                                            @if (($vendor->tems) == 1)
                                            <option value="3" selected>30 After Receive Invoice</option>
                                            <option value="2">Every 15 Next Month</option>
                                            <option value="1">Cash</option>
                                            @elseif (($vendor->terms) == 2)
                                            <option value="3">30 After Receive Invoice</option>
                                            <option value="2" selected>Every 15 Next Month</option>
                                            <option value="1">Cash</option>
                                            @else
                                            <option value="3">30 After Receive Invoice</option>
                                            <option value="2">Every 15 Next Month</option>
                                            <option value="1" selected>Cash</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="mb-1 col-md-3">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.phone') }}</label>
                                        <input type="text" name="phone" value="{{ $vendor->phone}}" class='form-control' required="required" maxlength="12" minlength="10" />
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.vendor.fields.email') }}</label>
                                        <input type="text" name="email" value="{{ $vendor->email}}" class='form-control' />
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="col-sm-3 form-label">{{ trans('cruds.vendor.fields.bank_number') }}</label>
                                        <input type="text" name="bank_number" value="{{ $vendor->bank_number}}" class='form-control' maxlength="16" minlength="10" />
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="col-sm-3 form-label">{{ trans('cruds.vendor.fields.tax_number') }}</label>
                                        <input type="text" name="tax_number" value="{{ $vendor->tax_number}}" class='form-control' maxlength="16" minlength="10" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-success"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

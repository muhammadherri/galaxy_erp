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

@section('content')
<!-- Main content -->
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="{{ route("admin.customer.index") }}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }} </a>
                        <a href="{{ route("admin.customer.index") }}" class="breadcrumbs__item">Customer </a>
                        <a href="" class="breadcrumbs__item">Create</a>
                    </h6>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{ route("admin.customer.store") }}" method="POST" enctype="multipart/form-data" id="jquery-val-form">
                        @csrf
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="homeIcon-tab" data-bs-toggle="tab" href="#homeIcon" aria-controls="home" role="tab" aria-selected="true"><i data-feather="user"></i> Customer Detail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profileIcon-tab" data-bs-toggle="tab" href="#profileIcon" aria-controls="profile" role="tab" aria-selected="false"><i data-feather="tool"></i> Site</a>
                            </li>
                        </ul>
                        <div class="tab-content ">
                            <div class="tab-pane active" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="row mt-1">
                                            <div class="col-md-12 form-check-primary">
                                                <div class="mb-2 p-1">
                                                    <div class="form-check">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="customer_type" id="inlineRadio1" value="1" checked="">
                                                            <label class="form-check-label" for="inlineRadio1">Individual</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="customer_type" id="inlineRadio2" value="2">
                                                            <label class="form-check-label" for="inlineRadio2">Company</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row  mt-1">
                                            <div class="col-md-3 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="cust_party_code">{{ trans('cruds.customer.fields.cust_party_code') }}</label>
                                                    <input type="text" id="purpose_date" name="purpose_date" class="form-control" hidden value="{{ now()->format ('Y-m-d') }}" required>
                                                    <input type="number" id="cust_party_code" name="cust_party_code" onKeyPress="if(this.value.length==8) return false;" class="form-control" value="{{ old('cust_party_code', isset($customer) ? $customer->cust_party_code : '') }}" required>
                                                    @if($errors->first('cust_party_code'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('cust_party_code') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="party_name">{{ trans('cruds.customer.fields.party_name') }}</label>
                                                    <input type="text" id="party_name" name="party_name" class="form-control" value="{{ old('party_name', isset($customer) ? $customer->party_name : '') }}" required>
                                                    @if($errors->first('party_name'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('party_name') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="title">{{ trans('cruds.customer.fields.title') }}</label>
                                                    <select name="title" id="title" class="form-control select2" required>
                                                        <option value="1" {{old('title') ? 'selected' : '' }}>Mr.</option>
                                                        <option value="2" {{old('title') ? 'selected' : '' }}>Mrs.</option>
                                                        <option value="3" {{old('title') ? 'selected' : '' }}>Miss</option>
                                                        <option value="4" {{old('title') ? 'selected' : '' }}>Ms.</option>
                                                    </select>
                                                    @if($errors->first('title'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('title') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="pic">{{ trans('cruds.customer.fields.pic') }}</label>
                                                    <input type="text" id="pic" name="pic" class="form-control" value="{{ old('pic', isset($customer) ? $customer->pic : '') }}" required>
                                                    @if($errors->first('pic'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('pic') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row  mt-1">
                                            <div class="col-md-3 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="email">{{ trans('cruds.customer.fields.email') }}</label>
                                                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($customer) ? $customer->email : '') }}" required>
                                                    @if($errors->first('email'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('email') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="status">{{ trans('cruds.customer.fields.type') }}</label>
                                                    <select name="status" id="status" class="form-control select2" required>
                                                        <option value="1" {{old('status') ? 'selected' : '' }}>Bill To</option>
                                                        <option value="2" {{old('status') ? 'selected' : '' }}>Ship To</option>
                                                        <option value="2" {{old('status') ? 'selected' : '' }}>Delivered To</option>
                                                    </select>
                                                    @if($errors->first('status'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('status') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="address1">{{ trans('cruds.customer.fields.address1') }}</label>
                                                    <input type="text" id="address1" name="address1" class="form-control" value="{{ old('address1', isset($customer) ? $customer->address1 : '') }}" required>
                                                    @if($errors->first('address1'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('address1') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-3 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="phone">{{ trans('cruds.customer.fields.phone') }}</label>
                                                    <input type="number" id="phone" name="phone" class="form-control" min="10" onKeyPress="if(this.value.length==12) return false;" value="{{ old('phone', isset($customer) ? $customer->phone : '') }}" required>
                                                    @if($errors->first('phone'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{$errors->first('phone')}}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="mobile">{{ trans('cruds.customer.fields.mobile') }}</label>
                                                    <input type="number" id="mobile" name="mobile" class="form-control" min="10" onKeyPress="if(this.value.length==12) return false;" value="{{ old('mobile', isset($customer) ? $customer->mobile : '') }}" required>
                                                    @if($errors->first('mobile'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('mobile') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="address2">{{ trans('cruds.customer.fields.address2') }}</label>
                                                    <input type="text" id="address2" name="address2" class="form-control" value="{{ old('address2', isset($customer) ? $customer->address2 : '') }}" required>
                                                    @if($errors->first('address2'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('address2') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-3 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" class="form-label" for="district">{{ trans('cruds.customer.fields.district') }}</label>
                                                    <input type="text" id="attribute5" name="attribute5" class="form-control" value="{{ old('attribute5', isset($customer) ? $customer->attribute5 : '') }}" required>
                                                    @if($errors->first('attribute5'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('attribute5') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="neighborhoods">{{ trans('cruds.customer.fields.neighborhoods') }}</label>
                                                    <input type="text" id="attribute6" name="attribute6" class="form-control" value="{{ old('attribute6', isset($customer) ? $customer->attribute6 : '') }}" required>
                                                    @if($errors->first('attribute6'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('attribute6') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="city">{{ trans('cruds.customer.fields.city') }}</label>
                                                    <input type="text" id="city" name="city" class="form-control" value="{{ old('city', isset($customer) ? $customer->city : '') }}" required>
                                                    @if($errors->first('city'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('city') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="province">{{ trans('cruds.customer.fields.province') }}</label>
                                                    <input type="text" id="province" name="province" class="form-control" value="{{ old('province', isset($customer) ? $customer->province : '') }}" required>
                                                    @if($errors->first('province'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('province') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-4 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="postal_code">{{ trans('cruds.customer.fields.postal_code') }}</label>
                                                    <input type="number" id="postal_code" name="postal_code" class="form-control" min="5" onKeyPress="if(this.value.length==5) return false;" value="{{ old('postal_code', isset($customer) ? $customer->postal_code : '') }}" required>
                                                    @if($errors->first('postal_code'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('postal_code') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="country">{{ trans('cruds.customer.fields.country') }}</label>
                                                    <input type="text" id="country" name="country" class="form-control" value="{{ old('country', isset($customer) ? $customer->country : '') }}" required>
                                                    @if($errors->first('country'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('country') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="">
                                                    <label class="col-sm-0 control-label" for="npwp">{{ trans('cruds.customer.fields.npwp') }}</label>
                                                    <input type="number" class="form-control" min="15" onKeyPress="if(this.value.length==15) return false;" value="{{ old('attribute7', isset($customer) ? $customer->attribute7 : '') }}" name="attribute7" aria-describedby="basic-addon2" required>
                                                    @if($errors->first('attribute7'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('attribute7') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-4">
                                                <label class="col-sm-0 control-label" for="currency_code">{{ trans('cruds.customer.fields.currency_code') }}</label>
                                                <select name="currency_code" id="currency_code" class="form-control select2" required>
                                                    @foreach($currency as $row)
                                                    <option value="{{$row->id}}" {{old('currency_code') ? 'selected' : '' }}> {{$row->currency_code}} - {{$row->currency_name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-sm-0 control-label" for="sales_tax_code">{{ trans('cruds.customer.fields.sales_tax_code') }}</label> <span class="col-sm-0 control-label" id="basic-addon2">%</span>

                                                <select type="text" id="type" name="sales_tax_code" class="form-control select2" value="{{ old('sales_tax_code', isset($customer) ? $customer->sales_tax_code : '') }}" required>
                                                    @foreach ($tax as $row)
                                                    <option value="{{$row->tax_code}}">{{$row->tax_code}}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="number" class="form-control" value="{{ old('sales_tax_code', isset($customer) ? $customer->sales_tax_code : '') }}" name="sales_tax_code" aria-describedby="basic-addon2" required> --}}


                                                @if($errors->first('sales_tax_code'))
                                                <div class="danger">
                                                    <span class="badge bg-danger">{{ $errors->first('sales_tax_code') }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-sm-0 control-label" for="address3">Short Name</label>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="" name="address3" aria-describedby="basic-addon2" required>
                                                </div>
                                                @if($errors->first('address3'))
                                                <div class="danger">
                                                    <span class="badge bg-danger">{{ $errors->first('address3') }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <a href="#" data-bs-original-title="" title="">
                                                    <img src="http://localhost/hris/public/assets/images/user/1649132118.jpg" class="img-fluid w-10" alt="user Photo">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-12 align-content-center text-center">
                                            <input type="file" name="image" class="image form-control" data-bs-original-title="" title="">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <button class="btn btn-outline-secondary btn-prev" disabled>
                                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- End Tab 1---}}
                            {{-- Start Tab II---}}
                            <div class="tab-pane" id="profileIcon" aria-labelledby="profileIcon-tab" role="tabpanel">
                                <div class="row mt-1">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label class="col-sm-0 control-label" for="site_code">{{ trans('cruds.customer.fields.site_code') }}</label>
                                            <input type="text" id="site_code_1" name="site_code" class="form-control" value="">
                                            @if($errors->first('site_code'))
                                            <div class="danger">
                                                <span class="badge bg-danger">{{ $errors->first('site_code') }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="col-sm-0 control-label" for="phone_site">{{ trans('cruds.customer.fields.phone_site') }}</label>
                                            <input type="number" id="phone_site_1" name="phone_site" class="form-control" min="10" onKeyPress="if(this.value.length==12) return false;" value="{{ old('phone_site', isset($customer) ? $customer->phone_site : '') }}">
                                            @if($errors->first('phone_site'))
                                            <div class="danger">
                                                <span class="badge bg-danger">{{ $errors->first('phone_site') }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="col-sm-0 control-label" for="email_site">{{ trans('cruds.customer.fields.email_site') }}</label>
                                            <input type="email_site" id="email_site_1" name="email_site" class="form-control" value="{{ old('email_site', isset($customer) ? $customer->email_site : '') }}">
                                            @if($errors->first('email_site'))
                                            <div class="danger">
                                                <span class="badge bg-danger">{{ $errors->first('email_site') }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="col-sm-1 control-label" for="number">{{ trans('cruds.site.fields.type') }}</label>
                                            <select name="site_type" id="type_code" class="form-control select2">
                                                <option value="Billto"> Bill TO</option>
                                                <option value="Shipto">Ship To</option>
                                                <option value="Deliveryto">Delivery TO</option>
                                                <option value="SupplierSite">Supplier Site</option>
                                                <option value="CustomerSite">Customer Site</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-4 col-12">
                                        <div class="">
                                            <label class="col-sm-0 control-label" for="address1_site">{{ trans('cruds.customer.fields.address1_site') }}</label>
                                            <input type="text" id="address1_site" name="address1_site" class="form-control" value="{{ old('address1_site', isset($customer) ? $customer->address1_site : '') }}">
                                            @if($errors->first('address1_site'))
                                            <div class="danger">
                                                <span class="badge bg-danger">{{ $errors->first('address1_site') }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label class="col-sm-0 control-label" for="address2_site">{{ trans('cruds.customer.fields.address2_site') }}</label>
                                            <input type="text" id="address2_site" name="address2_site" class="form-control" value="{{ old('address2_site', isset($customer) ? $customer->address2_site : '') }}">
                                            @if($errors->first('address2_site'))
                                            <div class="danger">
                                                <span class="badge bg-danger">{{ $errors->first('address2_site') }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label class="col-sm-0 control-label" for="district">{{ trans('cruds.customer.fields.district') }}</label>
                                            <input type="text" id="attribute5_site" name="attribute5_site" class="form-control" value="{{ old('attribute5_site', isset($customer) ? $customer->attribute5_site : '') }}">
                                            @if($errors->first('attribute5_site'))
                                            <div class="danger">
                                                <span class="badge bg-danger">{{ $errors->first('attribute5_site') }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="">
                                            <label class="col-sm-0 control-label" for="neighborhoods">{{ trans('cruds.customer.fields.neighborhoods') }}</label>
                                            <input type="text" id="attribute6_site" name="attribute6_site" class="form-control" value="{{ old('attribute6', isset($customer) ? $customer->attribute6_site : '') }}">
                                            @if($errors->first('attribute6_site'))
                                            <div class="danger">
                                                <span class="badge bg-danger">{{ $errors->first('attribute6_site') }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-3">
                                        <label class="col-sm-0 control-label" for="city_site">{{ trans('cruds.customer.fields.city') }}</label>
                                        <input type="text" id="city" name="city_site" class="form-control" value="{{ old('city_site', isset($customer) ? $customer->city_site : '') }}">
                                        @if($errors->first('city_site'))
                                        <div class="danger">
                                            <span class="badge bg-danger">{{ $errors->first('city_site') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-sm-0 control-label" for="province">{{ trans('cruds.customer.fields.province') }}</label>
                                        <input type="text" id="province" name="province_site" class="form-control" value="{{ old('province', isset($customer) ? $customer->province_site : '') }}">
                                        @if($errors->first('province_site'))
                                        <div class="danger">
                                            <span class="badge bg-danger">{{ $errors->first('province_site') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-sm-0 control-label" for="postal_code">{{ trans('cruds.customer.fields.postal_code') }}</label>
                                        <input type="number" id="postal_code" name="postal_code_site" class="form-control" min="5" onKeyPress="if(this.value.length==5) return false;" value="{{ old('postal_code', isset($customer) ? $customer->postal_code_site : '') }}">
                                        @if($errors->first('postal_code_site'))
                                        <div class="danger">
                                            <span class="badge bg-danger">{{ $errors->first('postal_code_site') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-sm-0 control-label" for="country">{{ trans('cruds.customer.fields.country') }}</label>
                                        <input type="text" id="country" name="country_site" class="form-control" value="{{ old('country', isset($customer) ? $customer->country_site : '') }}">
                                        @if($errors->first('country_site'))
                                        <div class="danger">
                                            <span class="badge bg-danger">{{ $errors->first('country_site') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 mb-2">
                                    <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i> Reset</button>
                                    <button type="submit" class="btn btn-primary btn-submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="row site_container">
                </div>
            </div>
        </div>
    </div>
</section>

</form>
</div>
</div>
<!-- /.content -->
@endsection

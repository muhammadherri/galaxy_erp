@extends('layouts.admin')
@section('styles')
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/currency.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endpush

@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="{{ route("admin.pricelist.index") }}" class="breadcrumbs__item">Order Management </a>
                        <a href="{{ route("admin.pricelist.index") }}" class="breadcrumbs__item">{{ trans('cruds.pricelist.title') }} </a>
                        <a href="#" class="breadcrumbs__item ">Create</a></h6>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{ route("admin.pricelist.store") }}" method="POST" enctype="multipart/form-data" id="jquery-val-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="effective_date">{{ trans('cruds.pricelist.fields.effective_date') }}</label>
                                            <input type="text" id="fp-default" name="effective_date" class="form-control flatpickr-basic flatpickr-input" value="{{ old('effective_date', isset($pricelist) ? $pricelist->effective_date : '') }}" required>
                                            <div class="invalid-feedback">{{ trans('cruds.pricelist.fields.effective_date') }} {{ trans('global.required') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="price_list_name">{{ trans('cruds.pricelist.fields.price_list_name') }}</label>
                                            <input type="text" id="purpose_date" name="purpose_date" class="form-control" hidden value="{{ now()->format ('Y-m-d') }}">
                                            <select name="price_list_name" class="form-control select2" required>
                                                @foreach($customers as $row)
                                                <option value="{{$row->cust_party_code}}" {{old('price_list_name') == $row->cust_party_code ? 'selected' : '' }}> {{$row->party_name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">{{ trans('cruds.pricelist.fields.price_list_name') }} {{ trans('global.required') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">

                                            <label class="form-label" for="description">{{ trans('cruds.pricelist.fields.description') }}</label>
                                            <input type="text" id="description" name="description_header" class="form-control" value="{{ old('description', isset($pricelist) ? $pricelist->description : '') }}" required autocomplete="off">
                                            <div class="invalid-feedback">{{ trans('cruds.pricelist.fields.description') }} {{ trans('global.required') }}</div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="currency">{{ trans('cruds.pricelist.fields.currency') }}</label>
                                            <select name="currency" id="currency" class="form-control select2" required>
                                                @foreach($currency as $row)
                                                <option value="{{$row->id}}" {{old('currency') == $row->id ? 'selected' : '' }}> {{$row->currency_code}} - {{$row->currency_name}} </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">

                                            <label class="form-label" for="location_id">{{ trans('cruds.pricelist.fields.location_id') }}</label>
                                            <input type="number" hidden id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control">
                                            <input type="number" hidden id="updated_by" name="updated_by" value="{{ auth()->user()->id }}" class="form-control">
                                            <input type="number" id="location_id" name="location_id" class="form-control" value="{{ old('location_id', isset($pricelist) ? $pricelist->location_id : '') }}" required>
                                            <div class="invalid-feedback">{{ trans('cruds.pricelist.fields.location_id') }} {{ trans('global.required') }}</div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row mb-4">
                            <div class="box box-default overflow-auto">
                                <div class="box-body" style="height: 350px;">
                                    <table class="table table-responsive" id="tab_logic">
                                        <thead>
                                            <th scope="col">Line ID</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Item Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Packing Type</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="pricelist_container">
                                            <tr class="tr_input">
                                                <td class="rownumber" width="3%">1
                                                </td>
                                                <td width="25%">
                                                    <input type="hidden" class="line_id" id="line_id_1" name="line_id[]" value="1">
                                                    <input type="text" class="form-control search_list" placeholder="Type here ..." id="search_item_code_1" name="item_code[]" autocomplete="off" required>
                                                    <span class="help-block search_item_code_empty1 glyphicon" style="display: none;"> No Results Found </span>
                                                    <input type="hidden" class="search_item_code_id" id="id_1" name="inventory_item_id[]" autocomplete="off">
                                                    <input type="hidden" class="form-control" name="description_item_code[]" id="description_item_code_1" value="">
                                                    <input type="hidden" class="form-control" name="uom[]" id="uom_1" value="">
                                                    @if($errors->first('inventory_item_id'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('inventory_item_id') }}</span>
                                                    </div>
                                                    @endif
                                                </td>
                                                <td width="15%">
                                                    <input type="text" class="form-control user_item_description" id="user_item_description_1" name="user_item_description[]" readonly autocomplete="off">
                                                    <span id="user_item_description_empty_1"></span>
                                                </td>
                                                <td width="15%">
                                                    <input type="number" class="form-control text-end" min=1  oninput="validity.valid||(value='');" id="unit_prices_list_1" name="unit_prices[]" autocomplete="off" required>
                                                    <input type="hidden" id="prices_list_1" name="prices_list[]" autocomplete="off">
                                                    <div class="invalid-feedback">{{ trans('cruds.pricelist.fields.unit_price') }} {{ trans('global.required') }}</div>
                                                </td>
                                                <td width="10%">
                                                    <input type="number" class="form-control discount" min=0  oninput="validity.valid||(value='');" id="discount_1" name="discount[]" autocomplete="off" required>
                                                    <div class="invalid-feedback">{{ trans('cruds.pricelist.fields.discount') }} {{ trans('global.required') }}</div>
                                                </td>
                                                <td width="10%">
                                                    <select class="form-control packing_type" id="packing_type_1" name="packing_type[]" required>
                                                        <option value="2">Roll</option>
                                                        <option value="1">Pallet</option>

                                                    </select>
                                                </td>
                                                <td width="10%">
                                                    <input type="date" class="form-control effective_from" id="effective_from_1" name="effective_from[]" required>
                                                    <div class="invalid-feedback">{{ trans('cruds.pricelist.fields.effective_from') }} {{ trans('global.required') }}</div>
                                                    @if($errors->first('effective_from'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('effective_from') }}</span>
                                                    </div>
                                                    @endif
                                                </td>
                                                <td width="10%">
                                                    <input type="date" name="effective_to[]" id="effective_to_1" class="form-control effective_to">
                                                    <div class="invalid-feedback">{{ trans('cruds.pricelist.fields.effective_to') }} {{ trans('global.required') }}</div>
                                                    @if($errors->first('effective_to'))
                                                    <div class="danger">
                                                        <span class="badge bg-danger">{{ $errors->first('effective_to') }}</span>
                                                    </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-ligth btn-sm remove_tr_pricelist disabled">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="9">
                                                    <button type="button" class="btn btn-light add_pricelist btn-sm " id="add_pricelist"><i data-feather='plus'></i> Add Rows</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mt-1 mb-50">
                            <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i> Reset</button>
                            <button class="btn btn-primary btn-submit" type="submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

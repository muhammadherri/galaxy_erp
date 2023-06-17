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
@endpush

@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }} </a>
                        <a href="{{ route("admin.customer.index") }}" class="breadcrumbs__item"> {{ trans('cruds.customer.title') }} </a>
                    </h6>

                    @can('customer_create')
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="{{ route("admin.customer.create") }}">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg></span>
                                {{ trans('global.add') }} {{ trans('cruds.customer.title') }}
                            </a>
                        </div>
                    </div>
                    @endcan

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Transaction">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.cust_party_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.purpose_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.party_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.city') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.province') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.country') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.customer.fields.currency_code') }}
                                    </th>
                                    <th class="text-center" style="width: 15%">
                                        {{ trans('global.action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer as $key => $row)
                                <tr data-entry-id="{{ $row->id }}">
                                    <td>

                                    </td>
                                    <td>
                                        {{ $row->cust_party_code ?? '' }}
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($row->purpose_date)->format('d/M/Y') ?? '' }}
                                    </td>
                                    <td>
                                        {{ $row->party_name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $row->city ?? '' }}
                                    </td>
                                    <td>
                                        {{ $row->province ?? '' }}
                                    </td>
                                    <td>
                                        {{ $row->country ?? '' }}
                                    </td>
                                    <td>
                                        {{ $row->phone ?? '' }}
                                    </td>
                                    <td>
                                        {{ $row->currency->currency_code ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        {{-- @can('customer_show')
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.customer.show', $row->id) }}">
                                        {{ trans('global.view') }}
                                        </a>
                                        @endcan --}}

                                        @can('customer_edit')
                                        <a class=" badge btn btn-sm btn-warning" href="{{ route('admin.customer.edit', $row->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                        @endcan
                                        @can('customer_delete')
                                        <form action="{{ route('admin.customer.destroy', $row->id) }}" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class=" badge btn btn-sm btn-danger hapusdata" value="" style="vertical-align:super;"> {{ trans('global.delete') }}</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

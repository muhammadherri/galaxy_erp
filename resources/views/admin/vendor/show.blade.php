@extends('layouts.admin')
@section('breadcrumbs')

<a href="{{ route("admin.vendor.index") }}" class="breadcrumbs__item">Purchase Order</a>
<a href="{{ route("admin.vendor.index") }}" class="breadcrumbs__item">Supplier</a>
<a href="" class="breadcrumbs__item active">View</a>

@endsection
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="{{ route("admin.vendor.index") }}" class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
                        <a href="{{ route("admin.vendor.index") }}" class="breadcrumbs__item">{{ trans('cruds.vendor.title_singular') }} </a>
                        <a href="{{ route("admin.vendor.index") }}" class="breadcrumbs__item">Show </a>
                    </h6>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.vendor_code') }}
                                    </th>
                                    <td>
                                        {{ $vendor->vendor_id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.vendor_name') }}
                                    </th>
                                    <td>
                                        {{ $vendor->vendor_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.address1') }}
                                    </th>
                                    <td>
                                        {{ $vendor->address1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.address2') }}
                                    </th>
                                    <td>
                                        {{ $vendor->address2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $vendor->city }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.province') }}
                                    </th>
                                    <td>
                                        {{ $vendor->province }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.country') }}
                                    </th>
                                    <td>
                                        {{ $vendor->country }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $vendor->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $vendor->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.tax') }}
                                    </th>
                                    <td>
                                        @if(($vendor->tax_code ) == 1)
                                            Tax 10%
                                        @else
                                            Non Tax
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.bank') }}
                                    </th>
                                    <td>
                                        {{ $vendor->bank }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.bank_number') }}
                                    </th>
                                    <td>
                                        {{ $vendor->bank_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.terms') }}
                                    </th>
                                    <td>
                                        {{ $vendor->terms }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
@endsection

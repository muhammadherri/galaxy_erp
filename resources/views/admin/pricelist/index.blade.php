@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
@endsection
@push('script')
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
                        <a href="{{ route("admin.pricelist.index") }}" class="breadcrumbs__item"> {{ trans('cruds.pricelist.title') }} </a>
                    </h6>
                    @can('price_list_create')
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="{{ route("admin.pricelist.create") }}">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg></span>
                                {{ trans('global.add') }} {{ trans('cruds.pricelist.title') }}
                            </a>
                        </div>
                    </div>
                    @endcan

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pricelisttable" class=" table table-bordered table-striped table-hover datatable-Transaction">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.pricelist.fields.price_list_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pricelist.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pricelist.fields.effective_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pricelist.fields.currency') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pricelist.fields.location_id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pricelist.fields.flag_status') }}
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pricelist as $key => $row)
                                <tr data-entry-id="{{ $row->id }}">
                                    <td width="auto">
                                        <input type="checkbox" name="item_ids[]" id="item_ids" value="{{ $row->id }}" class="form-check-input sub_chk" data-id="{{ $row->id }}">
                                    </td>
                                    <td>
                                        {{ $row->customer->party_name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $row->description ?? '' }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($row->effective_date)->format('d/M/Y') ?? '' }}
                                    </td>
                                    <td>
                                        {{ $row->curr->currency_code ?? '' }}
                                    </td>
                                    <td>
                                        {{ $row->location_id ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        @if ($row->flag_status==1)
                                        <a class="badge bg-primary text-white">Active</a>
                                        @else
                                        <a class="badge bg-warning text-white">Not Active</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('price_list_show')
                                        <a class=" badge btn btn-sm btn-primary" href="{{ route('admin.pricelist.show', $row->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                        @endcan

                                        @can('price_list_edit')
                                        <a class="badge btn btn-sm btn-warning" href="{{ route('admin.pricelist.edit', $row->id ) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                        @endcan

                                        @can('price_list_delete')
                                        <form action="{{ route('admin.pricelist.destroy', $row->id) }}" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="badge btn btn-sm btn-danger hapusdata" style="  vertical-align: super;" value=""> {{ trans('global.delete') }} </button>
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

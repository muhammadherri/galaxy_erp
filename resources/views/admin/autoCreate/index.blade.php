@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
<style>
    table.dataTable.select tbody tr,
    table.dataTable thead th:first-child {
        cursor: pointer;
    }

</style>
@endsection

@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
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
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="{{ route("admin.category.index") }}" class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
                        <a href="{{ route("admin.category.index") }}" class="breadcrumbs__item">{{ trans('cruds.requisition.awto') }}</a>
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{ route("admin.orders.store") }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="table-responsive">
                                <table id="table" class="display select table  table-striped table-hover datatable datatable-Order w-100">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>
                                                <input type="checkbox" style="margin-right: -53%;" class='form-check-input dt-checkboxes text-start ' id="head-cb">
                                            </th>
                                            <th>
                                                {{ trans('cruds.requisition.fields.number') }}
                                            </th>
                                            <th class="text-start">
                                                {{ trans('cruds.requisition.fields.line') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.requisition.fields.item') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.requisition.fields.description') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.requisition.fields.quantity') }}
                                            </th>
                                            <th>
                                                UOM
                                            </th>
                                            <th>
                                                {{ trans('cruds.requisition.fields.price') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.requisition.fields.requested') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.requisition.fields.created_at') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.requisition.fields.status') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($purchaseRequisitionDet as $key => $raw)
                                        <tr data-entry-id="{{ $raw->id }}">
                                        <td>
                                            {{ $raw->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $raw->purchaseRequisition->segment1 ?? ''}}
                                        </td>
                                        <td class="text-first">
                                            {{ (float)$raw->split_line_id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $raw->ItemMaster->item_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $raw->ItemMaster->description ?? '' }}
                                        </td>
                                        <td style="text-align: right;">
                                            {{ $raw->quantity ?? '' }}
                                        </td>
                                        <td style="text-align: right;">
                                            {{ $raw->estimated_cost?? '' }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ $raw->purchaseRequisition->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $raw->purchaseRequisition->created_at->format('d-m-Y')?? '' }}
                                        </td>
                                        <td>
                                            {{ $raw->TrxStatuses->trx_name ?? '' }}
                                        </td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center bd-highlight bg-light inline">
                                <div class="p-1 bd-highlight " style="margin-top: 0.5%;font-weight: bold;">
                                    Action :
                                </div>
                                <div class="p-1 bd-highlight">
                                    <select class="form-control" id="auto" name="mode">
                                        <option value="1">Create</option>
                                        <option value="2">Add To Purchase Order</option>
                                    </select>
                                </div>
                                <div class="p-1 bd-highlight">
                                    <button type='button' class="form-control btn btn-primary arrow-right-circle auto" id="allselect" Value='Automatic' name="description" autocomplete="off" disabled> Automatic</button>
                                </div>
                            </div>

                            <!-- modal commit auto create -->
                            <div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header  bg-primary">
                                            <h4 class="modal-title text-white" id="exampleModalLongTitle">{{ trans('cruds.autocreate.title') }}</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.requisition.fields.number') }}</label>
                                                            <input type="text" class="form-control" name="segment1" value="{{$po_number}}" autocomplete="off" maxlength="10" required>
                                                            <input type="hidden" id="agent_id" name="agent_id" value="{{auth()->user()->id?? ''}}">
                                                            <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id?? ''}}">
                                                            <input type="hidden" id="updated_by" name="updated_by" value="{{auth()->user()->id?? ''}}">
                                                            <input type="hidden" id="ship_to_location" value='SH-982221229' name="ship_to_location">
                                                            <input type="hidden" id="bill_to_location" value='BL-982221229' name="bill_to_location">
                                                            <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code">
                                                            <input type="hidden" id="source" value='1' name="source">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="mb-1">
                                                            <label class="col-sm-0 control-label" for="site">{{ trans('cruds.autocreate.fields.org') }}</label></br>
                                                            <div class="form-check form-switch form-check-primary">
                                                                <input type="checkbox" class="form-check-input" name="organization_id" id="customSwitch10" value="222" checked="true">
                                                                <label class="form-check-label" for="customSwitch10">
                                                                    <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                                        </svg></span>
                                                                    <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                        </svg></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="col-sm-0 control-label" for="site">Unit</label></br>
                                                            <select name="operation_unit" id="operation_unit" class="form-control select2" required>
                                                                <option></option>
                                                                @foreach($op as $raws)
                                                                <option value="{{ $raws->unit_id }}">{{ $raws->short_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.autocreate.fields.vendor') }}</label>
                                                            <select type="text" id="vendor_id" name="vendor_id" class="form-control select2" required>
                                                                <option hidden disabled selected></option>
                                                                @foreach($vendor as $row)
                                                                <option value="{{ $row->vendor_id }}">{{ $row->vendor_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="col-sm-0 control-label" for="site">{{ trans('cruds.autocreate.fields.site') }}</label>
                                                            <select name="vendor_site_id" id="site" class="form-control select2" required>
                                                                <option value='BM-000000000' selected>Default</option>
                                                                @foreach($site as $row)
                                                                @if($row->site_type=="SupplierSite" && $row->site_code!='BM-000000000')
                                                                <option value="{{ $row->site_code }}">{{ $row->address1 }}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.autocreate.fields.currency') }}</label>
                                                            <select name="currency_code" id="currency_id" class="form-control select2" required>
                                                                <option value='' selected> </option>
                                                                @foreach($currency as $id => $row)
                                                                <option value="{{ $row->currency_code }}">{{ $row->currency_code }}</option>
                                                                @endforeach
                                                                {{-- <option value='IDR' selected>IDR</option>
                                                                @foreach($currency as $id => $row)
                                                                @if ($row->currency_code !='IDR')
                                                                <option value="{{ $row->currency_code }}">{{ $row->currency_code }}</option>
                                                                @endif
                                                                @endforeach --}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="col-sm-0 control-label" for="rate">{{ trans('cruds.autocreate.fields.rate_date') }}</label>
                                                            <input type="text" id="datepicker-1" name="rate_date" class="form-control datepicker" autocomplete="off" required>
                                                            <input type="hidden" name="rate" value="1" id="rate" class="form-control datepicker" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="Submit" class="btn btn-primary" name='action' value="new">Create</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal commit auto create -->

                            <!-- Existing end modal commit auto create -->
                            <div class="modal fade" id="demoModal2" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header  bg-primary">
                                            <h4 class="modal-title text-white" id="exampleModalLongTitle">{{ trans('cruds.autocreate.title') }} </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="mt-1">
                                                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.autocreate.fields.ponum') }}</label>
                                                            <select name="segment1" id="segment1" class="form-control select2" required>
                                                                <option hidden disabled selected></option>
                                                                @foreach($po as $row)
                                                                <option value="{{ $row->id }}">{{ $row->segment1 }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="Submit" class="btn btn-primary" name='action' value="existing">Create</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal commit auto create -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    @endsection
    @push('script')
    <script>
        $(document).on('click', '.auto', function() {
            // console.log("click");
            var data = $("#auto").val();
            // console.log(data)
            if (data == 1) {
                $('#demoModal').modal('show');
            } else {
                $('#demoModal2').modal('show');
            }
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            , }
        });
        $("#currency_id").change(function() {
            var curr = $("#currency_id").val();
            $.ajax({
                url: '{{url("search/getRate") }}'
                , type: 'POST'
                , data: {
                    id: curr
                , }
                , success: function(result) {
                    document.getElementById('datepicker-1').value = result['rate_date'];
                    document.getElementById('rate').value = result['rate'];
                }
            })
        })

        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const table = $('#table').DataTable({
                "bServerSide": true
                , ajax: {
                    url: '{{url("search/auto-create") }}'
                    , type: "POST"
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: function(d) {
                        return d
                    }
                }
                , responsive: false
                , scrollX: true
                , searching: true
                , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
                , displayLength: 25
                , "lengthMenu": [
                    [10, 25, 50, -1]
                    , [10, 25, 50, "All"]
                ]
                , buttons: [{
                        extend: 'print'
                        , text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    }
                    , {
                        extend: 'csv'
                        , text: feather.icons['file-text'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Csv'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    }
                    , {
                        extend: 'excel'
                        , text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    }
                    , {
                        extend: 'pdf'
                        , text: feather.icons['clipboard'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Pdf'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    }
                    , {
                        extend: 'colvis'
                        , text: feather.icons['eye'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Colvis'
                        , className: ''
                    }
                ]
                , columnDefs: [{
                        render: function(data, type, row, meta) {
                            return `<input type="checkbox" class="form-check-input cb-child dt-checkboxes" name="lines[]" id="${row.id}" value="${row.id}">`;
                        }
                        , targets: [0]
                    }, {
                        render: function(data, type, row, index) {
                            return type === 'display' && data.length > 50 ?
                                '<span id="outer" title="' + data + '">' + data.substr(0, 50) + '</span><span id="show"> . &nbsp.</span>' :
                                data;
                        }
                        , targets: [4]
                    }

                ]
                , columns: [{
                        data: 'id'
                        , className: "text-center"
                    }
                    , {
                        data: 'ponumber'
                    }, {
                        data: 'line_id'
                    }, {
                        data: 'item_code'
                    }, {
                        data: 'description'
                    }, {
                        data: 'quantity'
                        , className: "text-end"
                    }, {
                        data: 'uom'
                        , className: "text-center"
                    }, {
                        data: 'cost'
                        , className: "text-center"
                    }, {
                        data: 'created_By'
                        , className: "text-end"
                    }, {
                        data: 'date'
                        , className: "text-end"
                    }, {
                        data: 'stts'
                        , className: "text-center"
                    }
                ]
            })
        });

    </script>
    @endpush

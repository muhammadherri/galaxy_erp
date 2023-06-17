@extends('layouts.admin')
@section('content')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
{{-- @section('breadcrumbs')
<a href="" class="breadcrumbs__item">Account Payable</a>
<a href="#" class="breadcrumbs__item active">AP List</a>
@endsection --}}
@can('order_create')
@endcan
<div class="card">
    <div class="card-header   ">
        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">Account Payables </a>
            <a href="{{ route("admin.ap.index") }}" class="breadcrumbs__item"> Account Payables </a>
        </h6>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route("admin.ap.create") }}">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    {{ trans('global.add') }} Payable
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tbl-ap" class=" table table-striped w-100" data-source="data-source">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            {{ trans('cruds.aPayable.fields.No') }}
                        </th>
                        <th>
                            {{ trans('cruds.aPayable.fields.vendor') }}
                        </th>
                        <th class="text-end">
                            {{ trans('cruds.aPayable.fields.invoiceno') }}
                        </th>
                        <th class="text-end">
                            {{ trans('cruds.aPayable.fields.invoicedate') }}
                        </th>
                        <th class="text-end">
                            {{ trans('cruds.aPayable.fields.duedate') }}
                        </th>
                        <th class="text-end">
                            Currency
                        </th>
                        <th class="text-end">
                            {{ trans('cruds.aPayable.fields.tax') }}
                        </th>
                        <th class="text-end">
                            {{ trans('cruds.aPayable.fields.totalamount') }}
                        </th>
                        <th class="text-end">
                            {{ trans('global.status') }}
                        </th>
                        <th class="text-center">
                            {{ trans('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
        //$.fn.dataTable.ext.errMode = 'none';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // vendor = $("#vendor_id").val();
        // min = $("#min").val();
        // max = $("#max").val();
        // rev = $("#rev").val();

        $('#tbl-ap').DataTable({
            "bServerSide": true
            , ajax: {
                url: '{{url("search/ap-report") }}'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    // d.vendor = $('#vendor_id').val();
                    // d.min = $("#min").val();
                    // d.max = $("#max").val();
                    // d.rev = $("#rev").val();
                    return d
                }
            }
            , responsive: true
            , scrollY: true
            , searching: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            , language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;'
                    , next: '&nbsp;'
                }
            }
            , displayLength: 15
            , "lengthMenu": [
                [10, 25, 50, -1]
                , [10, 25, 50, "All"]
            ]
            , columnDefs: [{
                render: function(data, type, row, index) {
                    content = `<form action="ap/destroy/${row.invoiceID}">
                        <a class="badge btn btn-sm btn-info" href="ap/${row.invoiceID}/edit">
                            {{ trans('global.open') }}
                        </a>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class=" badge btn btn-sm btn-danger hapusdata" value="">{{ trans('global.delete') }}</button>
                        </form>`;
                    return content;
                }
                , targets: [10]
            }]
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
                    extend: 'copy'
                    , text: feather.icons['copy'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Copy'
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
                }, {
                    text: feather.icons['filter'].toSvg({
                        class: 'font-small-4 me-50 '
                    }) + 'Filter'
                    , className: 'btn-warning'
                    , action: function(e, node, config) {
                        $('#modalFilter').modal('show')
                    }
                , }
                , {
                    text: feather.icons['edit'].toSvg({
                        class: 'font-small-4 me-50 '
                    }) + 'Set'
                    , className: 'btn-secondary'
                    , action: function(e, node, config) {
                        $('#modalSet').modal('show')
                    }
                , }
            , ]
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                , {
                    data: 'voucher_num'
                }, {
                    data: 'vendorID'
                }, {
                    data: 'invoice'
                }, {
                    data: 'invoice_date'
                    , className: "text-center"
                }, {
                    data: 'invoice_received_date'
                    , className: "text-center"
                }, {
                    data: 'currency'
                    , className: "text-center"
                }, {
                    data: 'tax_amount'
                }, {
                    data: 'invoice_amount'
                    , className: "text-end"
                }, {
                    data: 'status'
                    , className: "text-center"
                }, {
                    data: 'status'
                    , className: "text-center"
                }
            , ]
        })




    });

</script>
@endpush

@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header  mt-1 mb-25">
        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">{{ trans('cruds.aReceivable.title') }} </a>
            <a href="{{ route("admin.credit-note.index") }}" class="breadcrumbs__item"> {{ trans('cruds.aReceivable.title') }} </a>
        </h6>
        @can('role_create')
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route("admin.ar.create") }}">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    {{ trans('cruds.aReceivable.title_singular') }}</a>
            </div>
        </div>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="ar-table" class=" table  w-100">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.aReceivable.ar.trx_number') }}
                        </th>

                        <th>
                            Date
                        </th>
                        <th>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ trans('cruds.aReceivable.ar.bill_to') }}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        </th>
                        <th>
                            Shipto
                        <th>
                            Delivery
                        </th>
                        <th>
                            Notes
                        </th>

                        <th>
                            {{ trans('cruds.aReceivable.ar.term_id') }}
                        </th>
                        <th>
                            Currency
                        </th>
                        <th>
                            Tax
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            GL Date
                        </th>
                        <th>
                            {{ trans('cruds.aReceivable.ar.status') }}
                        </th>
                        <th>#</th>
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

        const table = $('#ar-table').DataTable({
            "bServerSide": true
            , ajax: {
                url: '{{url("search/ar-index") }}'
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
                    <"d-flex justify-content-between mx-0 row"\
                        <"d-flex justify-content-between mx-0 row"\
                        <"col-sm-12 col-md-5"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-4 text-end"><"col-sm-12 col-md-1"p>\
                        >t>'
            , displayLength: 15
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
                }, {
                    text: feather.icons['filter'].toSvg({
                        class: 'font-small-4 me-50 '
                    }) + 'Filter'
                    , className: 'btn-warning'
                    , action: function(e, node, config) {
                        $('#modalFilter').modal('show')
                    }
                , }
            , ]
            , columnDefs: [{
                render: function(data, type, row, index) {
                    content = `<a class="badge btn btn-info btn-sm waves-effect waves-float waves-light" href="ar/${row.id}/edit">
                                        {{ trans('global.open') }}
                                    </a>`;
                    return content;
                }
                , targets: [12]
            }, ]
            , columns: [{
                    data: 'trx_number'
                }, {
                    data: 'trx_date'
                    , className: "text-start"
                }, {
                    data: 'party_name'
                }, {
                    data: 'address'
                }, {
                    data: 'attribute1'
                    , className: "text-center"
                }, {
                    data: 'attribute2'
                    , className: "text-end"
                }, {
                    data: 'term_id'
                    , className: "text-end"
                }, {
                    data: 'curr'
                    , className: "text-center"
                }, {
                    data: 'tax_apl'
                    , className: "text-end"
                }, {
                    data: 'amount_apl'
                    , className: "text-end"
                }, {
                    data: 'gl_date'
                    , className: "text-end"
                }, {
                    data: 'stts'
                    , className: "text-end"
                }, {
                    data: ''
                    , className: "text-center"
                }
            , ]

        })

    });

</script>
@endpush

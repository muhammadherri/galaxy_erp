@extends('layouts.admin')
@section('content')
@push('script')
<script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endpush
@can('order_create')
@endcan
<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.salesorder.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header  mt-1 mb-1">
                    <h6 class="card-title">
                        <a href="#" class="breadcrumbs__item">Purchase Requisition </a>
                        <a href="#" class="breadcrumbs__item">Report </a>
                    </h6>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table id="report-pr"" class=" table table-bordered table-striped w-100">
                            <thead>
                                <tr style="text-align: center;">
                                    <th width="10">
                                        No
                                    </th>

                                    <th>
                                        {{ trans('cruds.requisition.fields.number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.requisition.fields.cost_center') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.requisition.fields.item') }}
                                    </th>
                                    <th class="text-end">
                                        {{ trans('cruds.requisition.fields.quantity') }}
                                    </th>
                                    <th class="text-center">
                                        UOM
                                    </th>
                                    <th>
                                        {{ trans('cruds.requisition.fields.status') }}
                                    </th>
                                    <th class="text-center">
                                        Approved
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                {{-- <tr>
                                    <th colspan="3">Total</th>
                                    <th id="total_order" class="text-end w-20"></th>
                                    <th class="text-end w-20"></th>
                                </tr> --}}
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>
<!-- Modal Example Start-->
<div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-white" id="exampleModalLongTitle">Split Line</h4>
                <div class="modal-header bg-primary">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="number">Line</label>
                                <input class="form-control" name="req_line_id">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="site">Items</label>
                                <input class="form-control" name="item">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="site">Quantity</label>
                                <input class="form-control" name="split_quantity">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" name='action' value="add_lines" data-dismiss="modal"><i data-feather='plus'></i>{{ trans('global.add') }}</button>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- END Modal Example Start-->
@endsection
@push('script')
<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const table = $('#report-pr').DataTable({
            "bServerSide": true
            , ajax: {
                url: '{{url("search/req-report") }}'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            }
            , responsive: true
            , searching: false
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between mx-0 row"\
                        <"d-flex justify-content-between mx-0 mt-2 row"\
                        <"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-3 text-end"><"col-sm-12 col-md-1"p>\
                        >t>'
            , displayLength: 10
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
            , ]
            , columnDefs: [{
                render: function(data, type, row, index) {
                    var info = table.page.info();
                    return index.row + info.start + 1;
                }
                , targets: [0]
            }, {
                className: "text-center"
                , render: function(data, type, row, index) {

                    if ((row.usrmgr === row.login && row.app_lvl === row.userstatus && row.purchase_status === '1') || (row.app_lvl === row.userstatus && row.userstatus >= '2' && row.purchase_status === '1')) {
                        app = ` <form action="app/${row.id}"  method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PUT')
                                    <input type="hidden" name="authorized_status" value="2">
                                    <input type="hidden" name="app_lvl" value="${row.app_lvl}">
                                    <input type="hidden" name="notes" value="Approve Purchasing Manager">
                                    <button type="submit" class="btn btn-sm btn-info pull-left" name='action' value="${row.userstatus}-approve">{{ trans('global.approve') }}</button>
                                </form>
                                <form action="app/${row.id}"  method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PUT')
                                    <input type="hidden" name="authorized_status" value="13">
                                    <input type="hidden" name="app_lvl" value="${row.app_lvl}">
                                    <input type="hidden" name="notes" value="Approve Purchasing Manager">
                                    <button type="submit" class="btn btn-sm btn-danger pull-left" name='action' value="${row.userstatus}-reject">reject</button>
                                </form>`;
                    } else {
                        app = `Approved`;
                    }
                    return app;
                }
                , targets: [7]
            }]
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                , {
                    data: 'pr_number'
                    , className: "text-center"
                }, {
                    data: 'cost_center'
                    , className: "text-center"
                }, {
                    data: 'item'
                    , className: ""
                }, {
                    data: 'qty'
                    , className: "text-end"
                }, {
                    data: 'uom'
                    , className: "text-center"
                }, {
                    data: 'status'
                    , className: "text-center"
                }
            ]
            , "footerCallback": function(tfoot, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // Total over all pages
                total = api
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(4).footer()).html('' + pageTotal.toLocaleString());
                $(api.column(4).footer()).html('' + total.toLocaleString());
            }
            , drawCallback: function(e, response) {
                $(".btn-update").click(function(event) {
                    var id = $(this).data('index');
                    var token = $("meta[name='csrf-token']").attr("content");
                    swal.fire({
                        title: "Submit " + id + " ?"
                        , type: "question"
                        , showCancelButton: true
                        , focusCancel: true
                        , dangerMode: true
                        , closeOnClickOutside: false
                    }).then((confirm) => {
                        if (confirm.value) {
                            $.ajax({
                                    url: '{{ url("admin/app") }}/' + id
                                    , method: "PATCH"
                                    , dataType: "JSON"
                                    , headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                    , data: {
                                        "id": id
                                        , "app_lvl": 3
                                    , }
                                , })
                                .done(function(resp) {
                                    console.log(resp);
                                    if (resp.success) {
                                        swal.fire("Info", resp.message, "success");
                                        table.ajax.reload();
                                    } else {
                                        swal.fire("Warning", resp.message, "warning");
                                    }
                                })
                                .fail(function() {
                                    swal.fire("Warning", 'Unable to process request at this moment', "warning");
                                });
                        } else {
                            event.preventDefault();
                            return false;
                        }
                    });
                })
                $(".btn-delete").click(function(event) {
                    var index = $(this).data('index');
                    var token = $("meta[name='csrf-token']").attr("content");
                    swal.fire({
                            title: "Delete " + index + " ?"
                            , type: "question"
                            , showCancelButton: true
                            , focusCancel: true
                            , dangerMode: true
                            , closeOnClickOutside: false
                        })
                        .then((confirm) => {
                            if (confirm.value) {
                                $.ajax({
                                        url: '{{ url("admin/purchase-requisition") }}/' + index
                                        , method: "DELETE"
                                        , dataType: "JSON"
                                        , headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                        , data: {
                                            "id": index
                                        , }
                                    , })
                                    .done(function(resp) {
                                        console.log(resp);
                                        if (resp.success) {
                                            swal.fire("Info", resp.message, "success");
                                            table.ajax.reload();
                                        } else {
                                            swal.fire("Warning", resp.message, "warning");
                                        }
                                    })
                                    .fail(function() {
                                        swal.fire("Warning", 'Unable to process request at this moment', "warning");
                                    });
                            } else {
                                event.preventDefault();
                                return false;
                            }
                        });
                })

            }
        })
    });

</script>
@endpush

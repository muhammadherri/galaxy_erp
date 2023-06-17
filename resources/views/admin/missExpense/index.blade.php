@extends('layouts.admin')
@section('content')
    @push('script')
        <script src="{{ asset('app-assets/js/scripts/jquery-ui.js') }}"></script>
    @endpush
    {{-- @section('breadcrumbs')
<a href="" class="breadcrumbs__item">Purchase</a>
<a href="" class="breadcrumbs__item active">Index</a>
@endsection --}}
@section('content')
    @can('order_create')
    @endcan
@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">
                            <a href="{{ route('admin.missExpense.index') }}"
                                class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
                            <a href="{{ route('admin.missExpense.index') }}"
                                class="breadcrumbs__item">{{ trans('cruds.missExpense.title') }}</a>
                        </h6>
                        @can('role_create')
                        <div class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaladd"href="">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg></span>
                                        {{ trans('cruds.missExpense.title') }} </a>
                            </div>
                        </div>

                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-striped table-hover datatable" data-source="data-source">
                                <thead>
                                    <tr>
                                        <th style="text-align: left;">

                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.aju') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.orderno') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.rate') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.item') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.qty') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.logisticCost') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.kso') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.asuransi') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.lc') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.costTotal') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.price') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.missExpense.head.cont') }}
                                        </th>
                                        <th>
                                            #
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($missExpenses as $key => $row)
                                        <tr data-entry-id="{{ $row->id }}">
                                            <td></td>
                                            <td class="text-end">
                                                {{ $row->attributenumber ?? '' }}
                                            </td>
                                            <td>
                                                {{ $row->order_number ?? '' }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($row->intattribute1, 2, ',', '.') ?? '' }}
                                            </td>
                                            <td>
                                                {{ $row->itemmaster->item_code ?? '' }} - {{ $row->item_description }}
                                            </td>
                                            <td class="text-end">
                                                {{ $row->intattribute2 ?? '' }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($row->intattribute3, 2, ',', '.') ?? '' }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($row->intattribute4, 2, ',', '.') ?? '' }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($row->intattribute5, 2, ',', '.') ?? '' }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($row->intattribute6, 2, ',', '.') ?? '' }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($row->intattribute7, 2, ',', '.') ?? '' }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($row->rcv_price, 2, ',', '.') ?? '' }}
                                            </td>
                                            <td class="text-end">
                                                {{ $row->intattribute9 ?? '' }}
                                            </td>
                                            <td style="text-align: center;">

                                                @can('order_edit')
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('admin.missExpense.edit', $row->attributenumber) }}">
                                                        {{ trans('global.open') }}
                                                    </a>
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
    <form action="{{ route('admin.missExpense.create') }}" method="GET" enctype="multipart/form-data">
        @csrf
        <!-- Modal Example Start-->
        <div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">

                            {{-- <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="control-label" for="number">Purchase Number</label>
                            </div>
                            <div class="mb-3 col-md-8">
                                <select id="po" name="po" class="form-control select2 filterMissExpense">
                                    <option selected></option>
                                    @foreach ($order_head as $key => $row)
                                        <option value="{{$row->segment1}}">{{$row->segment1}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="control-label" for="number" required>AJU</label>
                                </div>
                                <div class="mb-3 col-md-8">
                                    <select id="aju" name="aju" class="form-control select2 filterMissExpense">
                                        <option selected></option>
                                        @foreach ($return as $key => $row)
                                            @if ($row->transaction_type == 'RECEIVE')
                                                <option value="{{ $row->attribute1 }}">{{ $row->attribute1 }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="control-label" for="number" required>Rate</label>
                                </div>
                                <div class="mb-3 col-md-8">
                                    <input type="text" id="rate" name="rate"
                                        class="form-control  text-end rate_conversion" value="0" required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i data-feather='plus'></i>Transaction
                                Lines</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
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

            var table = $('#table-purchase').DataTable({
                "bServerSide": true,
                ajax: {
                    url: '{{ url('search/po-report') }}',
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        return d
                    }
                },
                responsive: true,
                dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-8"Bl><"col-sm-12 col-md-4"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 10,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [{
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Print',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Csv',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Excel',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Pdf',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Copy',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'colvis',
                    text: feather.icons['eye'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Colvis',
                    className: '',
                }, ],
                columnDefs: [{
                    render: function(data, type, row, index) {
                        var info = table.page.info();
                        return index.row + info.start + 1;
                    },
                    targets: [0]
                }, {
                    render: function(data, type, row, index) {
                        content = ` @can('order_show') <a target="_blank" class="btn btn-sm btn-primary" href="orders/${row.id}">
                            {{ trans('global.view') }}
                        </a> @endcan   @can('order_edit')<a class="btn btn-sm btn-info" href="orders/${row.id}/edit">
                            {{ trans('global.open') }}
                        </a> @endcan
                        @can('order_delete')<button type="button" class="btn btn-delete btn-accent btn-danger m-btn--pill btn-sm m-btn m-btn--custom" data-index="${row.id}">{{ trans('global.delete') }}</button> @endcan
                       `;
                        return content;
                    },
                    targets: [9]
                }],
                drawCallback: function(e, response) {
                    $(".btn-delete").click(function(event) {
                        var index = $(this).data('index');
                        var token = $("meta[name='csrf-token']").attr("content");
                        swal.fire({
                                title: "Delete " + index + " ?",
                                type: "question",
                                showCancelButton: true,
                                focusCancel: true,
                                dangerMode: true,
                                closeOnClickOutside: false
                            })
                            .then((confirm) => {
                                if (confirm.value) {
                                    $.ajax({
                                            url: '{{ url('admin/orders') }}/' + index,
                                            method: "DELETE",
                                            dataType: "JSON",
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]').attr(
                                                    'content')
                                            },
                                            data: {
                                                "id": index,
                                            },
                                        })
                                        .done(function(resp) {
                                            console.log(resp);
                                            if (resp.success) {
                                                swal.fire("Info", resp.message,
                                                    "success");
                                                table.ajax.reload();
                                            } else {
                                                swal.fire("Warning", resp.message,
                                                    "warning");
                                            }
                                        })
                                        .fail(function() {
                                            swal.fire("Warning",
                                                'Unable to process request at this moment',
                                                "warning");
                                        });
                                } else {
                                    event.preventDefault();
                                    return false;
                                }
                            });
                    });
                },
                columns: [{
                    data: 'id',
                    className: "text-center"
                }, {
                    data: 'order_number'
                }, {
                    data: 'vendor_id'
                }, {
                    data: 'vendor_name'
                }, {
                    data: 'currency'
                }, {
                    data: 'rate_date'
                }, {
                    data: 'agent_id',
                    className: "text-end"
                }, {
                    data: 'status',
                    className: "text-end"
                }, {
                    data: 'created_at',
                    className: "text-center"
                }, {
                    data: '',
                    className: "text-center"
                }]
            })
        });
    </script>
@endpush

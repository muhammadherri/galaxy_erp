@extends('layouts.admin')
@section('styles')

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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header mt-50">
                <h6 class="card-title ">
                    <a href="{{ route("admin.physic.index") }}" class="breadcrumbs__item">Inventory </a>
                    <a href="{{ route("admin.physic.index") }}" class="breadcrumbs__item">{{ trans('cruds.physic.title') }} </a>
                    <a href="{{ route("admin.physic.create") }}" class="breadcrumbs__item">Create </a>
                </h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="{{ route('admin.physic.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.physic.fields.date') }}</label>
                            <input type="date" id="datePicker" name="gl_date" class="form-control datepicker" value="" required>
                            <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id?? ''}}">
                            <input type="hidden" id="created_by" name="last_updated_by" value="{{auth()->user()->id}}">
                        </div>
                        <div class="col-md-4">
                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.physic.fields.subinv_from') }}</label>
                            <select id="order" name="segment1" class="form-control select2">
                                <option selected></option>
                                @foreach ($subInventory as $key => $row)
                                <option value="{{$row->id}}">{{$row->sub_inventory_name}} - {{$row->description}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4    ">
                            <label class="col-sm-0 control-label" for="site">{{ trans('cruds.physic.fields.subinv_to') }} </label>
                            <select id="grn" name="receipt_num" class="form-control select2">
                                <option selected></option>
                                @foreach ($subInventory as $key => $row)
                                <option value="{{$row->id}}">{{$row->sub_inventory_name}} - {{$row->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="box box-default">
                            <div class="box-body scrollx" style="height: 450px;overflow: scroll;">
                                <table class="table table-striped tableFixHead">
                                    <thead>
                                        <th scope="col">Item</th>
                                        <th scope="col">UOM</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subinventory</th>
                                        <th scope="col">Locator</th>
                                        <th scope="col">Rev</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="physical_container">
                                        <tr class="tr_input">
                                            {{-- <td class="">1</td> an original code --}}
                                            <td width="30%">
                                                <input type="text" class="form-control search_item_code " placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off" required>
                                                <span class="help-block search_item_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                <input type="hidden" class="search_inventory_item_id" id="id_1" name="inventory_item_id[]"></td>
                                            <input type="hidden" class="form-control" value="" id="description_1" name="description_item[]" autocomplete="off">
                                            <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id?? ''}}">
                                            <td width="10%">
                                                <input type="text" class="form-control" name="tag_uom[]" id="uom_1" autocomplete="off" readonly>
                                            </td>
                                            <td width="10%">
                                                <input type="text" class="form-control" name="tag_quantity[]" id="tag_quantity_1" autocomplete="off">
                                            </td>
                                            <td width="20%">
                                                <input type="text" class="form-control search_subinventory" value="" name="subinventory1[]" id="subinventoryfrom_1" autocomplete="off">
                                                <input type="hidden" class="form-control subinvfrom_1" name="subinventory[]" id="subinvfrom_1" autocomplete="off">
                                            </td>
                                            <td width="20%">
                                                <input type="text" name="locator_id[]" class="form-control" id="locator_1" autocomplete="off" required>
                                            </td>
                                            <td width="20%">
                                                <input type="text" name="revision[]" class="form-control " id="rev_1" autocomplete="off">
                                            </td>
                                            <td width="10px">
                                                <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-light btn-sm add_physicalInventory btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <br>
                        </div>

                        <div class="d-flex justify-content-between mb-1">
                            <button class="btn btn-sm btn-warning" type="reset"><i data-feather='refresh-ccw'></i> Reset</button>
                            <button class="btn btn-sm btn-danger btn-submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function() {
        @can('order_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans
            , url: "{{ route('admin.purchase-requisition.massDestroy') }}"
            , className: 'btn-danger'
            , action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans('
                        global.datatables.zero_selected ') }}')

                    return
                }

                if (confirm('{{ trans('
                        global.areYouSure ') }}')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            }
                            , method: 'POST'
                            , url: config.url
                            , data: {
                                ids: ids
                                , _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan
    })

</script>
@endsection

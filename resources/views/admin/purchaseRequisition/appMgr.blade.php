@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endpush
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header mt-1 mb-25">
                    <h6 class="card-title ">
                        <a href="{{ route("admin.purchase-requisition.index") }}" class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
                        <a href="{{ route("admin.purchase-requisition.index") }}" class="breadcrumbs__item">{{ trans('cruds.requisition.title_singular') }}</a>
                        <a href="" class="breadcrumbs__item">Approve</a>
                    </h6>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{ route("admin.app.update", [$purchaseRequisition->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <div class="mb-50">
                                    <label class="col-sm-0 control-label" for="number">{{ trans('cruds.requisition.fields.number') }}</label>
                                    <input type="text" class="form-control" value="{{$purchaseRequisition->segment1}}" name="segment1" autocomplete="off" maxlength="10" readonly>
                                    <input type="hidden" id="id" name="app_lvl" value="{{auth()->user()->user_status}}">
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="mb-50">
                                    <label class="col-sm-0 control-label" for="site">{{ trans('cruds.requisition.fields.cost_center') }}</label>
                                    <input readonly type="text" class="form-control search_cost_center " value="{{$purchaseRequisition->CcBook->cc_name ?? ''}}" placeholder="Type here ..." name="search_cost_center" autocomplete="off" required>
                                    <input type="hidden" class="form-control search_cc_id" value="{{$purchaseRequisition->attribute1 ?? ''}}" name="attribute1" autocomplete="off">

                                </div>
                            </div>

                            <div class="col-md-2 col-12">
                                <div class="mb-50">
                                    <label class="col-sm-0 control-label" for="number"> {{ trans('cruds.requisition.fields.requested') }}</label>
                                    <select name="requested_by" id="agent_id" class="form-control select2">
                                        <option value="{{$purchaseRequisition->requested_by}}">{{$purchaseRequisition->user->name}} </option>
                                        {{-- @foreach($users as $id => $users)
                                        <?php if($purchaseRequisition->requested_by!=$users->id) {?>
                                        <option value="{{ $users->id }}" {{ (in_array($id, old('users', [])) || isset($role) && $users->contains($id)) ? 'selected' : '' }}>{{ $users->name }}</option>
                                        <?php }?>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-50">
                                    <label class="col-sm-0 control-label" for="site">Creation Date</label>
                                    <input type="text" id="transaction_date" name="transaction_date" class="form-control" value="{{$purchaseRequisition->transaction_date ?? ''}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="mb-50">
                                    <label class="col-sm-0 control-label" for="site">Action</label>
                                    <select name="authorized_status" id="agent_id" class="form-control">
                                        @foreach($status as $id => $status)
                                        <?php if(($purchaseRequisition->authorized_status != $status->trx_code) & ( $status->trx_code != 1)) { ?>
                                        <option value="{{ $status->trx_code }}">{{ $status->trx_name }}</option>
                                        <?php } ?>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            </hr>
                            <div class="box box-default">
                                <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                    <table class="table table-fixed table-borderless">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th style="display:none;"></th>
                                                <th>Product</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>UOM</th>
                                                <th>Quantity</th>
                                                <th>Cost</th>
                                                <th>Need By Date</th>
                                                <th>Total</th>
                                                <th>Img</th>
                                                <th>#</th>

                                            </tr>
                                        </thead>
                                        <tbody class="requisition_container">
                                            @foreach($requisitionDetail as $key => $raw)
                                            <tr class="tr_input" data-entry-id="{{ $raw->id }}">
                                                <td style="display:none;">
                                                </td>
                                                <td width="15%">
                                                    <input readonly type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off" value="{{$raw->itemMaster->item_code ?? ''}} - {{$raw->itemMaster->description ?? ''}}"><span class="help-block search_item_code_empty" style="display: none;">No Results Found ...</span>
                                                    <input type="hidden" class="search_inventory_item_id" id="id_1'" value='{{$raw->inventory_item_id}}' name="inventory_item_id[]" autocomplete="off">
                                                    <input type="hidden" class="search_inventory_item_id" id="id_1" value='{{$raw->id}}' name="lineId[]" autocomplete="off">
                                                    {{-- <input type="hidden" class="form-control" value="{{$raw->itemMaster->description ?? ''}}" id="description_1" name="description_item[]" autocomplete="off"> --}}
                                                </td>
                                                <td width="35%">
                                                    <input type="text" class="form-control" id="description_{{$key+1}}" value="{{$raw->attribute1}}" name="description_item[]" autocomplete="off">
                                                </td>
                                                <td width="10%">
                                                    <input readonly type="text" class="form-control search_subcategory_code" name="sub_category[]" id="subcategory_1" value="{{$raw->attribute2}}" autocomplete="off">
                                                    <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                </td>
                                                <td width="5%">
                                                    <input type="text" class="form-control float-center text-center" value="{{$raw->pr_uom_code}}" name="pr_uom_code[]" id="uom_1" autocomplete="off" readonly>
                                                </td>
                                                <td width="5%">
                                                    <input readonly type="text" class="form-control purchase_quantity  float-end text-end" name="quantity[]" id="qty_1" autocomplete="off" value="{{number_format($raw->quantity,2)}}" required>
                                                </td>
                                                <td width="10%">
                                                    <input type="text" class="form-control purchase_cost  float-end text-end" name="estimated_cost[]" id="price_1" onblur="cal()" autocomplete="off" value="{{number_format($raw->estimated_cost,2)}}" readonly>
                                                </td>
                                                <td width="5%">
                                                    <input readonly type="date" name="requested_date[]" class="form-control datepicker float-center text-center" id="requested_date_1" value="{{$raw->requested_date}}" autocomplete="off">
                                                </td>
                                                <td width="5%">
                                                    <input type="text" class="form-control stock_total  float-end text-end" name="toal[]" value="{{number_format($raw->estimated_cost * $raw->quantity,2)}}" readonly="1">
                                                </td>
                                                <td>
                                                    <a class="btn btn-ligth" data-bs-toggle="modal" data-bs-target="#modaladd_{{ $raw->id}}">
                                                        <i data-feather='camera'> </i>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($loop->first) <form></form> @endif
                                                    <form type="hidden" action="{{ route('admin.requisition-detail.destroy',$raw->id) }}" enctype="multipart/form-data" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-ligth  btn-sm" --disabled- style="position: inherit;" readonly>X</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="form-label textarea-counter ">Description</label>
                                    <textarea data-length="240" class="form-control char-textarea" id="textarea-counter" name="description" rows="1" required>{{$purchaseRequisition->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>App Notes</label>
                                    <textarea data-length="240" class="form-control char-textarea" id="textarea-counter" name="notes" rows="1" required></textarea>
                                </div>
                            </div>
                            {{-- <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="form-label textarea-counter ">Attachment   :</label><br>
                                    <a class="btn btn-ligth"  data-bs-toggle="modal" data-bs-target="#modaladd">
                                        <i data-feather='camera'> </i>  Attachment
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                        <!-- /.box-body -->
                        <div class="d-flex justify-content-between mb-50 mt-1">
                            <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i> Reset</button>
                            <button type="submit" class="btn btn-success pull-left btn-submit" name='action' value="{{auth()->user()->user_status}}"><i data-feather='save'></i> {{ trans('global.submit') }}</button>
                        </div>
                </div>

                </br>
                </br>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Add Attachment</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div id="dropBox">

                            <div class="container">
                                <div><img src="{{ asset($purchaseRequisition->img_path) }}" width="100%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach($requisitionDetail as $key => $raw)
    <div class="modal fade" id="modaladd_{{ $raw->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Attachment</h4>
                    <div class="modal-header bg-primary">
                        <button type="button" class="btn-close-img" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div id="dropBox">

                            <div class="container">
                                <div><img src="{{ asset($raw->img_path) }}" width="100%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
<!-- /.content -->
@endsection
@section('scripts')
@parent
<script>
    <script>
  $( function() {
    $( "#dialog" ).dialog();
  } );

</script>
$(function () {
let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('project_delete')
let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
let deleteButton = {
text: deleteButtonTrans,
url: "{{ route('admin.projects.massDestroy') }}",
className: 'btn-danger',
action: function (e, dt, node, config) {
var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
return $(entry).data('entry-id')
});

if (ids.length === 0) {
alert('{{ trans('global.datatables.zero_selected') }}')

return
}

if (confirm('{{ trans('global.areYouSure') }}')) {
$.ajax({
headers: {'x-csrf-token': _token},
method: 'POST',
url: config.url,
data: { ids: ids, _method: 'DELETE' }})
.done(function () { location.reload() })
}
}
}
dtButtons.push(deleteButton)
@endcan

$.extend(true, $.fn.dataTable.defaults, {
order: [[ 1, 'desc' ]],
pageLength: 100,
});
$('.datatable-Project:not(.ajaxTable)').DataTable({ buttons: dtButtons })
$('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
$($.fn.dataTable.tables(true)).DataTable()
.columns.adjust();
});
})
</script>
@endsection

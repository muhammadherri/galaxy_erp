@extends('layouts.admin')
@section('content')


@section('content')
<div class="card" >
        <div class="card-header  mt-1 mb-1">
            <h6 class="card-title">
                <a href="{{route('admin.shipment.index')}}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }} </a>
                <a href="{{route('admin.shipment.index')}}" class="breadcrumbs__item">{{ trans('cruds.shiping.title_singular') }} </a>
                <a href="{{route('admin.shipment.create')}}" class="breadcrumbs__item">Create</a></h6>
        </div>
    <hr>
    <br>
    <div class="card-body">
        <form id = "formship" action="{{ route("admin.shipment.update",$DeliveryHeader->delivery_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.customer_name') }}</label>
                            <select type="text" id="customer" name="customer" class="form-control select2" value="{{$DeliveryHeader->sold_to_party_id}}" required>
                                <option value="{{$DeliveryHeader->cust_party_code}}" >{{$DeliveryHeader->cust_party_code}} -{{$DeliveryHeader->party_name}} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.customer_shipto') }}</label>
                            <select type="text" id="customer_shipto" name="customer_shipto" class="form-control select2" value=""  >
                                <option selected value="{{$DeliveryHeader->ship_to_party_id}}">{{$DeliveryHeader->party_site->site_code}}/ {{$DeliveryHeader->party_site->address1}}</option>
                                @foreach($customershiipto as $row)
                                @if($DeliveryHeader->ship_to_party_id != $row->site_code)
                                <option value="{{$row->site_code}}" {{old('customer_shipto') == $row->site_code ? 'selected' : '' }}>{{$row->site_code}} / {{$row->address1}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label"
                                for="segment1">Attribute</label>
                            <input type="text" class="form-control" name="text" value="{{$DeliveryHeader->attribute1}}" disabled>
                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.surat_jalan') }}</label>
                            <input autocomplete="off" required id="invoice_no" name="invoice_no" class="form-control" value="{{$DeliveryHeader->delivery_name }}">
                        </div>
                    </div>
                    {{-- <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.order_letter_no') }}</label> --}}
                            <input type="hidden" readonly="readonly" id="delivery_name" name="delivery_name" class="form-control" value="{{$DeliveryHeader->delivery_name}}">
                            <input type="hidden" id="id" name="id" value="{{$DeliveryHeader->id}}">
                            <input type="hidden" id="delivery_id" name="delivery_id" value="{{$DeliveryHeader->delivery_id}}">
                        {{-- </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.note') }}</label>
                            <input autocomplete="off" required type="text" id="note" name="note" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label " for="segment1">{{ trans('cruds.shiping.fields.invoice_date') }}</label>
                            <input required autocomplete="off" type="text" id="fp-default" name="invoice_date" class="form-control flatpickr-basic flatpickr-input text-end">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label"for="segment1">
                               Attribute
                            </label>
                            <input type="text" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.status') }}</label>
                            <select type="text" id="status" name="status" class="form-control select2" value="{{$DeliveryHeader->status_code}}">
                                <option value="{{$DeliveryHeader->status_code}}}">{{$DeliveryHeader->trx_name}}</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.freight_term') }}</label>
                            <select type="text" id="freight_term" name="freight_term" class="form-control select2" value=""  >
                                @foreach($freight_terms as $row)
                                    <option value="{{$row->id}}">{{$row->term_code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.gross_weight') }}</label>
                            <input autocomplete="off" required type="number" id="gross_weight" name="gross_weight" class="form-control" value="{{ $DeliveryHeader->gross_weight }}">
                        </div>
                    </div> --}}
                </div>
            </div>
            <br>
            <div class="row mb-4">
                <div class="box box-default overflow-auto">
                    <div class="box-body" style="height: 350px;">
                        <table class="table table-bordered table-striped table-hover datatable">
                            <thead >
                                <tr>
                                    <th>
                                    </th>
                                    <th style="width: 0%">NO</th>
                                    <th class="text-center" style="width: 10%">{{ trans('cruds.shiping.table.sn') }}</th>
                                    <th style="width: 0%">{{ trans('cruds.shiping.modaltable.line') }}</th>
                                    <th>{{ trans('cruds.shiping.table.custpo') }}</th>
                                    <th style="width: 10%">
                                        {{ trans('cruds.shiping.table.item_no') }}
                                        <input type="hidden"name="dvdtckcbx"id="dvdtckcbx"class="detilchbx">
                                    </th>

                                    <th>{{ trans('cruds.shiping.table.item_desc') }}</th>
                                    <th class="text-end" style="width: 0%">{{ trans('cruds.shiping.modaltable.qty') }}</th>
                                    <th class="text-center" style="width: 0%">{{ trans('cruds.shiping.table.uom') }}</th>
                                    <th style="width: 0%">{{ trans('cruds.shiping.table.subinventory') }}</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($DeliveryDetail as $deliveryDetail)
                                    @if(($deliveryDetail->delivery_detail_id)==($DeliveryHeader->delivery_id))
                                        <tr>
                                            <td style="width: 0%"></td>
                                            <td class="text-center" style="font-size:11px" >
                                                {{$no++}}
                                            </td>
                                            <td class="text-center" style='font-size:11px'>
                                                {{ $deliveryDetail->source_header_number ?? '' }}
                                            </td>
                                            <td class="text-end" style='font-size:11px'>
                                                {{ (float)$deliveryDetail->source_line_id ?? '' }}
                                            </td>
                                            <td style='font-size:11px'>
                                                {{ $deliveryDetail->cust_po_number ?? '' }}
                                            </td>
                                            <td style='font-size:11px'>
                                                {{ $deliveryDetail->item_code}}
                                                <input type="hidden" value="{{$deliveryDetail->id}}" name="id[]" class="detilchbx" data-id="{{$deliveryDetail->header_id}}">
                                                <input type="hidden" value="{{$deliveryDetail->delivery_detail_id}}" name="delivery_detail_id[]" class="detilchbx" data-id="{{$deliveryDetail->delivery_detail_id}}">
                                                <input type="hidden" value="{{$deliveryDetail->source_header_id}}" name="source_header_id[]" class="detilchbx" data-id="{{$deliveryDetail->source_header_id}}">
                                                <input type="hidden" value="{{$deliveryDetail->source_line_id}}" name="source_line_id[]" class="detilchbx" data-id="{{$deliveryDetail->source_line_id}}">
                                                <input type="hidden" value="{{$deliveryDetail->sold_to_contact_id}}" name="sold_to_contact_id[]" class="detilchbx" data-id="{{$deliveryDetail->sold_to_contact_id}}">
                                                <input type="hidden" value="{{$deliveryDetail->delivery_name}}" name="delivery_name[]" class="detilchbx" data-id="{{$deliveryDetail->delivery_name}}">
                                            </td>

                                            <td style='font-size:11px'>
                                                {{ $deliveryDetail->item_description ?? '' }}
                                            </td>
                                            <td class="text-end" style='font-size:11px'>
                                                {{ $deliveryDetail->requested_quantity ?? '' }}
                                            </td>
                                            <td class="text-center" style='font-size:11px'>
                                                {{ $deliveryDetail->requested_quantity_uom ?? '' }}
                                            </td>
                                            <td class="text-center" style='font-size:11px'>
                                                {{$deliveryDetail->subinventory?? ''}}
                                            </td>
                                            <td class="text-center" style="width: 0%">
                                                <a class="btn btn-sm btn-delete btn-danger" data-bs-toggle="modal" data-bs-target="#modaldelete"
                                                    value="{{$deliveryDetail->id}}" data-id="{{$deliveryDetail->id}}"data-header_id="{{$deliveryDetail->source_header_id}}"data-line_id="{{$deliveryDetail->source_line_id}}">
                                                    x
                                                </a>
                                                {{-- @if ($DeliveryHeader->lvl==6)
                                                    <button type="button" class="btn btn-sm btn-danger " onclick="deleteItem({{ $deliveryDetail->id }})" id="hapus" >
                                                        X
                                                    </button>
                                                @endif --}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <br>
                <div class="d-flex justify-content-between">
                    @if ($DeliveryHeader->lvl==6)
                        <button class="btn btn-warning resetbtn" type="button"><i data-feather='refresh-ccw'></i> Reset</button>
                        <button class="btn btn-primary btn-submit"name='action' value="create" id="add_all" type="submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                    @endif
                </div>
            </div>
        </form>
        <div class="modal fade" id="modaldelete" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        {{-- <h4 class="modal-title">{{ trans('cruds.shiping.modaltable.deleteitem') }}</h4> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id = "formship" action="{{ route("admin.shipment.update",$DeliveryHeader->delivery_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="container">
                                <p class="text-center">{{ trans('cruds.shiping.modaltable.areyousure') }}</p>
                                <hr>
                                <div class="col text-center">
                                    <button type="submit" name="action" value="delete" class="btn btn-primary pull-center"><i class="fa fa-plus"></i> {{ trans('cruds.shiping.modaltable.yes') }} </button>
                                    <input type="hidden" id="id" name="id" class="form-control">
                                    <input type="hidden" id="header_id" name="header_id" class="form-control">
                                    <input type="hidden" id="line_id" name="line_id" class="form-control">

                                    <button type="button"class="btn btn-danger pull-center" data-bs-dismiss="modal"><i class="fa fa-plus"></i> {{ trans('cruds.shiping.modaltable.no') }} </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
        ///////////// DELETE BUTTON//////////////
    function deleteItem(id) {
        console.log(id);
        var check = confirm("Are you sure you want to Delete this row?");
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        if(check == true){
            console.log(check);
            $.ajax({
                url:"./../shipment/destroy"+id,
                type:"DELETE",
                data:{id:id,},
                success: function(result) {
                    location.reload();
                    alert('Success');
                },
                error:function(result){
                    alert('Success');
                    location.reload();

                }
            });
        }
	}
        ///////////// DELETE BUTTON//////////////

    $(document).ready( function () {
        var xid = $('#masterckcbx').val();
        var xhead = $('#inputhead').val();
        var xlineid = $('#lineid').val();
        var xorderfrom = $('#orderfrom').val();
        var xorderto = $('#orderto').val();
        var xitemfrom = $('#itemfrom').val();
        var xitemto = $('#itemto').val();
        // checked//
            // // checked//
            // // submit//
        $('.add_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            console.log(allVals);
            if(allVals.length <=0)
            {
                alert("Please select row.");

            }  else {
                var check = alert("Add Row Success");
                if(check == true){
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            // alert(data['success']);
                        },
                        error: function (data) {
                            // alert(data.responseText);
                        }
                    });
                }
            }
        });

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();
            $.ajax({
                url: ele.href,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
            return false;
        });
            // // submit//

        ///////////// RESET BUTTON//////////////
        $(".resetbtn").click(function(){
            $("#formship").trigger("reset");
        });
        ///////////// RESET BUTTON//////////////
    });
</script>
@endpush

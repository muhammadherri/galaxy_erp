@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title ">
                    <a href="{{ route("admin.purchase-requisition.index") }}" class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
                    <a href="{{ route("admin.purchase-requisition.index") }}" class="breadcrumbs__item">{{ trans('cruds.requisition.title_singular') }} </a>
                    <a href="#" class="breadcrumbs__item">{{ trans('cruds.requisition.fields.edit') }}</a>
                </h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="{{ route("admin.purchase-requisition.update", [$purchaseRequisition->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="mb-25">
                                <label class="col-sm-0 control-label" for="number">{{ trans('cruds.requisition.fields.number') }}</label>
                                <input type="text" class="form-control" value="{{$purchaseRequisition->segment1}}" name="segment1" autocomplete="off" maxlength="10" readonly>
                                <input type="hidden" id="id" name="id" value="{{$purchaseRequisition->id}}">
                                <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id}}">
                                <input type="hidden" id="created_by" name="updated_by" value="{{auth()->user()->id}}">
                                <input type="hidden" id="organization_id" value='222' name="org_id">
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="mb-25">
                                <label class="col-sm-0 control-label" for="site">{{ trans('cruds.requisition.fields.cost_center') }}</label>
                                <input readonly type="text" class="form-control search_cost_center " value="{{$purchaseRequisition->CcBook->cc_name ?? ''}}" placeholder="Type here ..." name="search_cost_center" autocomplete="off" required>
                                <input type="hidden" class="form-control search_cc_id" value="{{$purchaseRequisition->attribute1 ?? ''}}" name="attribute1" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="mb-25">
                                <label class="col-sm-0 control-label" for="number"> {{ trans('cruds.requisition.fields.requested') }}</label>
                                <select name="requested_by" id="agent_id" class="form-control select2">
                                    <option value="{{ auth()->user()->id}}">{{ auth()->user()->name }}</option>

                                    {{-- @foreach($users as $id => $users)
                                    <option value="{{ $users->id }}" {{ (in_array($id, old('users', [])) || isset($role) && $users->contains($id)) ? 'selected' : '' }}>{{ $users->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="mb-25">
                                <label class="col-sm-0 control-label" for="site">Creation Date</label>
                                <input type="text" id="transaction_date" name="transaction_date" class="form-control" value="{{$purchaseRequisition->transaction_date ?? ''}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="mb-25">
                                <label class="col-sm-0 control-label" for="site">{{ trans('cruds.requisition.fields.ref') }}</label>
                                <select name="ref" id="agent_id" class="form-control select2">
                                    <option value="{{$purchaseRequisition->reference ?? ''}}">
                                        @if ($purchaseRequisition->reference=='0')
                                        Others
                                        @else
                                        Material
                                        @endif
                                    </option>
                                </select>
                                <input type="hidden" class="form-control search_address1 " name="authorized_status" value="{{$purchaseRequisition->authorized_status ?? ''}}" autocomplete="off" readonly>
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
                                            <th>Need By Date</th>
                                            <th colspan="3" class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="requisition_container">
                                        @foreach($requisitionDetail as $key => $raw)
                                        <tr class="tr_input" data-entry-id="{{ $raw->id }}">
                                            <td style="display:none;">
                                            </td>
                                            <td width="15%">
                                                <input type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_{{$key+1}}" autocomplete="off" value="{{$raw->itemMaster->item_code ?? '' }} - {{$raw->itemMaster->description ?? '' }}" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span>
                                                <input type="hidden" class="search_inventory_item_id" id="id_{{$key+1}}" value='{{$raw->inventory_item_id}}' name="inventory_item_id[]" autocomplete="off">
                                                <input type="hidden" class="search_inventory_item_id" id="id_{{$key+1}}" value='{{$raw->id}}' name="lineId[]" autocomplete="off">
                                                {{-- <input type="hidden" class="form-control" value="{{$raw->itemMaster->description ?? ''}}" id="description_{{$key+1}}" name="description_item[]" autocomplete="off"> --}}
                                            </td>
                                            <td width="35%">
                                                <input type="text" class="form-control" id="description_{{$key+1}}" value="{{$raw->attribute1}}" name="description_item[]" autocomplete="off">
                                            </td>
                                            <td width="10%">
                                                <input type="text" class="form-control search_subcategory_code_" name="sub_category[]" id="subcategory_{{$key+1}}" value="{{$raw->attribute2}}" autocomplete="off">
                                                <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                            </td>
                                            <td width="10%">
                                                <input type="text" class="form-control float-center text-center search_uom_conversion" value="{{$raw->pr_uom_code}}" name="pr_uom_code[]" id="pr_uom_{{$key+1}}" autocomplete="off" readonly>
                                            </td>
                                            <td width="10%">
                                                <input type="text" class="form-control purchase_quantity float-end text-end" name="quantity[]" id="qty_{{$key+1}}" autocomplete="off" value="{{$raw->quantity}}" required>
                                            </td>
                                            <input type="hidden" class="form-control purchase_cost float-end text-end" name="estimated_cost[]" id="price_{{$key+1}}" onblur="cal()" autocomplete="off" value="{{$raw->estimated_cost}}" readonly>
                                            <td width="15%">
                                                <input type="text" name="requested_date[]" class="form-control datepicker_date float-center text-center" id="date_{{$key+1}}" value="{{$raw->requested_date}}" autocomplete="off">
                                                {{-- <input type="text" name="requested_date[]" class="form-control datepicker float-center text-center" id="requested_date_{{$key+1}}" value="{{$raw->requested_date}}" autocomplete="off"> --}}
                                            </td>
                                            <td>
                                                <a class="btn btn-ligth" data-bs-toggle="modal" data-bs-target="#modaladd_{{ $raw->id}}">
                                                    <i data-feather='camera'> </i>
                                                </a>
                                            </td>
                                            <td>
                                                @if ($raw->purchase_status ==3)
                                                <button type="button" class="btn btn-edit  btn-secondary btn-sm" disabled> <i class="m-nav__link-icon " value="{{ $raw->id}}" data-feather='edit'></i></button>
                                                @else
                                                <button type="button" class="btn btn-edit  btn-secondary btn-sm " data-index="{{ $raw->id}}" data-qty="{{ $raw->quantity}}" data-item="{{$raw->itemMaster->item_code ??''}} - {{$raw->itemMaster->description ??''}}" style="position: inherit;">
                                                    <i class="m-nav__link-icon " value="{{ $raw->id}}" data-feather='edit'></i></button>
                                                @endif
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
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-light btn-sm add_requisition_product" style="font-size: 12px;">
                                                    <i data-feather='plus'></i> Add Rows</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    </br>
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row ">
                                <div class="col-sm-8">
                                    <div class="form-group"></br>
                                        <label for="form-label textarea-counter ">Description</label>
                                        <textarea data-length="240" class="form-control char-textarea" id="textarea-counter" name="description" rows="2" required>{{$purchaseRequisition->description}}</textarea>
                                    </div>
                                    <small class="textarea-counter-value float-end">This Note Only For Internal Purposes, <b>Char Left : <span class="char-count">0</span> / 240 </b></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="d-flex justify-content-between mb-1">
                        <button type="reset" class="btn btn-warning pull-left btn-next" value="Reset">Reset</button>
                        <button type="submit" class="btn btn-success  btn-next" name='action' value="save"><i data-feather='save'></i> {{ trans('global.save') }}</button>
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
                                                <div class="mb-25">
                                                    <label class="col-sm-0 control-label" for="number">Line</label>
                                                    <input class="form-control" name="req_line_id" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-25">
                                                    <label class="col-sm-0 control-label" for="site">Items</label>
                                                    <input class="form-control" name="item" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-25">
                                                    <label class="col-sm-0 control-label" for="site">Quantity</label>
                                                    <input class="form-control" name="split_quantity">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name='action' value="add_lines" data-dismiss="modal"><i data-feather='plus'></i>{{ trans('global.add') }}</button>

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
                    <!-- END Modal Example Start-->
                </form>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <!-- /.content -->
    @endsection
    @push('script')
    <script>
        $(function() {
            $('.datepicker_date').datepicker({
                minDate: 1
            });
        });

    </script>
    @endpush
    @section('scripts')
    @push('script')
    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

    </script>
    @endpush
    @endsection

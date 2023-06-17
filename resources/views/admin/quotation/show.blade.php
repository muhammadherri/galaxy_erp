@extends('layouts.admin')
@section('content')
@section('breadcrumbs')
<a href="{{ route('admin.quotation.index') }}" class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
<a href="{{ route('admin.quotation.index') }}" class="breadcrumbs__item">{{ trans('cruds.quotation.title_singular') }}</a>
<a href="" class="breadcrumbs__item active">{{ trans('cruds.quotation.fields.view') }}</a>
@endsection
<section id="multiple-column-form">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">{{$quotation->segment1}}</h4>
                </div>
                <hr>
                <div class="card-body">
<div class="container-fluid mt-100 mb-100">
    <div id="ui-view">
        <div>
            <div class="card">
                <div class="card-header"> Quotation<strong>Detail</strong>

                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-2">
                            <h6 class="mb-1 mt-3">Number:</h6>
                            <div><strong>{{ $quotation->segment1 }}</strong></div>
                        </div>
                        <div class="col-sm-2">
                            <h6 class="mb-1 mt-3">Supplier:</h6>
                            @foreach ($vendor as $vendor)
                                @if(($quotation->vendor_id)== ($vendor->vendor_id))
                                    <div><strong>{{ $vendor->vendor_name}}</strong></div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-sm-2">
                            <h6 class="mb-1 mt-3">Effective Date</h6>
                            <div><strong>{{ $quotation->effective_date}} </strong></div>
                        </div>
                        <div class="col-sm-2">
                            <h6 class="mb-1 mt-3">Status</h6>
                            <div><strong>
                                @if ( ($quotation->status) == 1)
                                    Activ
                                @else
                                    Inactive
                                @endif
                            </strong></div>
                        </div>

                        <div class="col-sm-2">
                            <h6 class="mb-1 mt-3">Currency</h6>
                            <div><strong>{{ $quotation->currency_code}}</strong></div>
                        </div>

                        <div class="col-sm-2">
                            <h6 class="mb-1 mt-3">Site</h6>
                            <div><strong> {{ $quotation->vendor_site_id}}</strong></div>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                            <div class="box box-default">
                                <div class="box-body scrollx" style="height: 450px;overflow: scroll;">
                                    <table class="table table-striped" id="tab_logic">
                                        <thead>
                                            <th scope="col">Line</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">UOM</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quotationDetail as $detail)
                                                @foreach ($ItemMaster as $product)
                                                    @if ((($detail->po_header_id)==($quotation->id)) && (($detail->inventory_item_id)==($product->inventory_item_id)))
                                                        <tr>
                                                            <td>{{ $detail->line_id}}</td>
                                                            <td>{{ $product->item_code}}</td>
                                                            <td>{{ $detail->po_uom_code}}</td>
                                                            <td>{{ $detail->unit_price}}</td>
                                                            <td>{{ $detail->start_date}}</td>
                                                            <td>{{ $detail->end_date}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
          <!-- /.box-body -->
          </div>
        </div>
      </div>
      </div>
    </section>
    <!-- /.content -->
@endsection

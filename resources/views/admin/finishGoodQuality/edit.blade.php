@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/drop-image.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('breadcrumbs')

<a href="" class="breadcrumbs__item">Quality Management</a>
<a href="" class="breadcrumbs__item">{{ trans('cruds.quality_management.material') }}</a>

@endsection
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.qm-finsihGood.update',[$head->uniq_attribute_roll]) }}" class="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header mb-1">
                        <h4 class="card-title">Add Finish Good Quality</h4>
                    </div>

                    <hr>
                    <div class="card-body mt-2">
                        <div class="row mb-2">
                            <div class="col-md-1">
                                <b><p class="text-end">Roll Code : <p></b>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="uniq_attribute_roll" class="form-control" readonly value="{{$head->uniq_attribute_roll}}" autocomplete="off" required>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <b><p class="text-end">Date :</p></b>
                            </div>
                            <div class="col-md-5">
                                <input type="text" id="datepicker-1" name="transaction_date" value="{{$head->transaction_date}}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-1">
                                <b><p class="text-end">Item Code :<p></b>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="planned_start_quantity" class="form-control" value="{{$head->itemmaster->item_code}} - {{$head->itemmaster->description}}" required>
                                <input type="hidden" name="inventory_item_id" class="form-control" value="{{$head->inventory_item_id}}" required>
                                <input type="hidden" name="reference" class="form-control" value="{{$head->reference}}" required>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-1">
                                <b><p class="text-end">PM :</p></b>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="attribute_char" class="form-control datepicker" id="" value="{{$head->attribute_char}}" autocomplete="off" required>
                                <input type="hidden"  id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control">
                            </div>
                        </div>


                    {{-- </div> --}}

                    {{-- Body --}}
                    {{-- <div class="card"> --}}
                    <div class="card-header">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-priceList-tab" data-bs-toggle="tab" data-bs-target="#nav-priceList" type="button" role="tab" aria-controls="nav-priceList" aria-selected="false">
                                    <span class="bs-stepper-box">
                                        <i data-feather="droplet" class="font-medium-3"></i>
                                    </span>
                                    Lab - Quality
                                </button>
                            </div>
                        </nav>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="tab-content" id="nav-tabContent">

                            {{-- Tab priceList --}}
                            <div class="tab-pane fade show active" id="nav-priceList" role="tabpanel" aria-labelledby="nav-priceList-tab">
                                <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                    <table class="table table-striped tableFixHead" id="">
                                        <thead>
                                            <tr>
                                                <th scope="col">Result</th>
                                                <th scope="col" class="text-center">GSM <br> (Min - Max)</th>
                                                <th scope="col" class="text-center" >Moizture<br> (Min - Max)</th>
                                                <th scope="col" class="text-center">Thickness<br> (Min - Max)</th>
                                                <th scope="col" class="text-center">Bursting</th>
                                                <th width="auto" class="text-center" scope="col">Ring Crush CD <br> (Min - Max)</th>
                                                <th scope="col" class="text-center">Ply Bonding MD <br> (Min - Max)</th>
                                                <th scope="col" class="text-center">Cobb 120 sec-Top side <br> (Min - Max)</th>
                                                <th scope="col" class="text-center">Cobb 120 sec-Bottom side <br> (Min - Max)</th>
                                                <th scope="col" class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="fg_quality_container">
                                            @foreach ($qm as $key => $row)
                                                <tr class="tr_input">
                                                    <td class="td text-center" style="width:3%">{{$key+1}}</td>
                                                    <td width="">
                                                        <input type="hidden" class="line_id" id="line_id_{{$key+1}}" name="attribute_num_quality[]" value="{{$key+1}}">
                                                        <input type="text" class="form-control td gsm text-center" value="{{$row->attribute_number_1}}" name="attribute_number_1[]" id="gsm_{{$key+1}}" placeholder="g/m2" autocomplete="off" required>
                                                        <input type="hidden" class="form-control text-center" value="{{$row->id}}" name="id[]" id="id_{{$key+1}}" autocomplete="off" required>
                                                    <td width="">
                                                        <input type="number" class="form-control td recount text-center" value="{{$row->attribute_number_2}}" id="moizture_{{$key+1}}" placeholder="%" name="attribute_number_2[]" required>
                                                    </td>
                                                    <td width="auto">
                                                        <input type="number" class="form-control td recount text-center" value="{{$row->attribute_number_3}}" id="thickness_{{$key+1}}" placeholder="mm" name="attribute_number_3[]" required>
                                                    </td>
                                                    <td width="auto">
                                                        <input type="number" id="bursting_{{$key+1}}" class="form-control harga text-center" value="{{$row->attribute_number_4}}" name="attribute_number_4[]" placeholder="Kgf/cm2" required>
                                                    </td>
                                                    <td width="auto" class="text-center"><input type="text" id="ringCrush_{{$key+1}}" value="{{$row->attribute_number_5}}" name="attribute_number_5[]" placeholder="Newton" class="form-control text-center" required></td>
                                                    <td width="auto">
                                                        <input type="text"  id="plyBonding_{{$key+1}}" class="form-control subtotal123 text-center" value="{{$row->attribute_number_6}}" name="attribute_number_6[]" placeholder="J/m2" name="subtotal[]">
                                                    </td>
                                                    <td width="auto" class="text-center"><input type="text" id="cobbTop_{{$key+1}}" name="attribute_number_7[]" value="{{$row->attribute_number_7}}" placeholder="g/m2"class="form-control text-center" required></td>
                                                    <td width="auto">
                                                        <input type="text"  id="cobbBottom_{{$key+1}}" class="form-control subtotal123 text-center" value="{{$row->attribute_number_8}}" name="attribute_number_8[]" placeholder="g/m2" name="subtotal[]">
                                                    </td>
                                                    <td><button type="button" class="btn btn-ligth btn-sm remove_tr_sales" disabled>X</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="mt-5">
                                            <tr>
                                                <td colspan="9">
                                                    <button type="button" class="add_fg_quality btn btn-outline-danger btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Result</button>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>


                        </div>

                        <div class="mt-2">
                            <button type="button" class="add_summary btn btn-outline-info btn-sm" style="font-size: 12px;"><i data-feather='search'></i> Summary</button>
                            <table class="table table-striped tableFixHead mt-1" id="tab_logic">
                                <thead>
                                    <tr>
                                        <th rowspan="2" scope="col" class="text-center" style="vertical-align: middle;">Result</th>
                                        <th  colspan="3"scope="col" class="text-center" style="vertical-align: middle;">GSM </th>
                                        <th  colspan="3"scope="col" class="text-center" style="vertical-align: middle;">Moizture</th>
                                        <th  colspan="3"scope="col" class="text-center" style="vertical-align: middle;">Thickness</th>
                                        <th  colspan="3"scope="col" class="text-center" style="vertical-align: middle;">Bursting</th>
                                        <th  colspan="3"width="auto" class="text-center" scope="col" style="vertical-align: middle;">Ring Crush CD </th>
                                        <th  colspan="3"scope="col" class="text-center" style="vertical-align: middle;">Ply Bonding</th>
                                        <th colspan="3" scope="col" class="text-center" style="vertical-align: middle;">Cobb 120  <br> sec-Top side</th>
                                        <th colspan="3" scope="col" class="text-center" style="vertical-align: middle;">Cobb 120  <br>  sec-Bottom side</th>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="text-center">Min</th>
                                        <th scope="col" class="text-center" >Max</th>
                                        <th scope="col" class="text-center">Avg</th>
                                        <th scope="col" class="text-center">Min</th>
                                        <th scope="col" class="text-center" >Max</th>
                                        <th scope="col" class="text-center">Avg</th>
                                        <th scope="col" class="text-center">Min</th>
                                        <th scope="col" class="text-center" >Max</th>
                                        <th scope="col" class="text-center">Avg</th>
                                        <th scope="col" class="text-center">Min</th>
                                        <th scope="col" class="text-center" >Max</th>
                                        <th scope="col" class="text-center">Avg</th>
                                        <th scope="col" class="text-center">Min</th>
                                        <th scope="col" class="text-center" >Max</th>
                                        <th scope="col" class="text-center">Avg</th>
                                        <th scope="col" class="text-center">Min</th>
                                        <th scope="col" class="text-center" >Max</th>
                                        <th scope="col" class="text-center">Avg</th>
                                        <th scope="col" class="text-center">Min</th>
                                        <th scope="col" class="text-center" >Max</th>
                                        <th scope="col" class="text-center">Avg</th>
                                        <th scope="col" class="text-center">Min</th>
                                        <th scope="col" class="text-center" >Max</th>
                                        <th scope="col" class="text-center">Avg</th>
                                    </tr>
                                <thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle;">=</td>
                                        <td><label class="form-control text-end" id="min_0">0</label></td>
                                        <td><label class="form-control text-end" id="max_0">0</label></td>
                                        <td><label class="form-control text-end" id="avg_0">0</label></td>
                                        <td><label class="form-control text-end" id="min_1">0</label> </td>
                                        <td><label class="form-control text-end" id="max_1">0</label> </td>
                                        <td><label class="form-control text-end" id="avg_1">0</label> </td>
                                        <td><label class="form-control text-end" id="min_2">0</label> </td>
                                        <td><label class="form-control text-end" id="max_2">0</label> </td>
                                        <td><label class="form-control text-end" id="avg_2">0</label> </td>
                                        <td><label class="form-control text-end" id="min_3">0</label> </td>
                                        <td><label class="form-control text-end" id="max_3">0</label> </td>
                                        <td><label class="form-control text-end" id="avg_3">0</label> </td>
                                        <td><label class="form-control text-end" id="min_4">0</label> </td>
                                        <td><label class="form-control text-end" id="max_4">0</label> </td>
                                        <td><label class="form-control text-end" id="avg_4">0</label> </td>
                                        <td><label class="form-control text-end" id="min_5">0</label> </td>
                                        <td><label class="form-control text-end" id="max_5">0</label> </td>
                                        <td><label class="form-control text-end" id="avg_5">0</label> </td>
                                        <td><label class="form-control text-end" id="min_6">0</label> </td>
                                        <td><label class="form-control text-end" id="max_6">0</label> </td>
                                        <td><label class="form-control text-end" id="avg_6">0</label> </td>
                                        <td><label class="form-control text-end" id="min_7">0</label> </td>
                                        <td><label class="form-control text-end" id="max_7">0</label> </td>
                                        <td><label class="form-control text-end" id="avg_7">0</label> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mb-1 mt-1">
                            <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i>
                                Reset</button>
                            <button class="btn btn-primary btn-submit" type="submit"><i data-feather='save'></i>
                                {{ trans('global.save') }}</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>


            </form>
        </div>
    </div>
</section>

<div class="modal fade" id="summary" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped tableFixHead mt-2" id="tab_logic">
                                <thead>
                                    <tr>
                                        <th scope="col">Component</th>
                                        <th scope="col" class="text-center">Min </th>
                                        <th scope="col" class="text-center" >Max</th>
                                        <th scope="col" class="text-center">Avg</th>
                                    </tr>
                                <thead>
                                <tr class="">
                                    <td class="rownumber" width="auto"><b>GSM</b></td>
                                    <td width=""><label class="form-control text-end">0</label></div>
                                    <td width=""><label class="form-control  text-end">0</label></td>
                                    <td width="auto"><label class="form-control  text-end">0</label></td>
                                </tr>
                                <tr class="">
                                    <td class="rownumber" width="auto"><b>Moizture</b></td>
                                    <td width=""><label class="form-control text-end">0</label></div>
                                    <td width=""><label class="form-control  text-end">0</label></td>
                                    <td width="auto"><label class="form-control  text-end">0</label></td>
                                </tr>
                                <tr class="">
                                    <td class="rownumber" width="auto"><b>Thickness</b></td>
                                    <td width=""><label class="form-control text-end">0</label></div>
                                    <td width=""><label class="form-control  text-end">0</label></td>
                                    <td width="auto"><label class="form-control  text-end">0</label></td>
                                </tr>
                                <tr class="">
                                    <td class="rownumber" width="auto"><b>Bursting</b></td>
                                    <td width=""><label class="form-control text-end">0</label></div>
                                    <td width=""><label class="form-control  text-end">0</label></td>
                                    <td width="auto"><label class="form-control  text-end">0</label></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped tableFixHead mt-2" id="tab_logic">
                                <thead>
                                    <tr>
                                        <th scope="col">Component</th>
                                        <th scope="col" class="text-center">Min </th>
                                        <th scope="col" class="text-center" >Max</th>
                                        <th scope="col" class="text-center">Avg</th>
                                    </tr>
                                <thead>
                                <tr class="">
                                    <td class="rownumber" width="auto"><b>Ring Crush CD</b></td>
                                    <td width=""><label class="form-control text-end">0</label></div>
                                    <td width=""><label class="form-control  text-end">0</label></td>
                                    <td width="auto"><label class="form-control  text-end">0</label></td>
                                </tr>
                                <tr class="">
                                    <td class="rownumber" width="auto"><b>Ply Bonding MD</b></td>
                                    <td width=""><label class="form-control text-end">0</label></div>
                                    <td width=""><label class="form-control  text-end">0</label></td>
                                    <td width="auto"><label class="form-control  text-end">0</label></td>
                                </tr>
                                <tr class="">
                                    <td class="rownumber" width="auto"><b>Cobb 120 <br> sec-Top side</b></td>
                                    <td width=""><label class="form-control text-end">0</label></div>
                                    <td width=""><label class="form-control  text-end">0</label></td>
                                    <td width="auto"><label class="form-control  text-end">0</label></td>
                                </tr>
                                <tr class="">
                                    <td class="rownumber" width="auto"><b>Cobb 120 <br> sec-Bottom side</b></td>
                                    <td width=""><label class="form-control text-end">0</label></div>
                                    <td width=""><label class="form-control  text-end">0</label></td>
                                    <td width="auto"><label class="form-control  text-end">0</label></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i data-feather='plus'></i>Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



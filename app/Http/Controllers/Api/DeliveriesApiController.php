<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Helper\responapi\responapi;
use Illuminate\Http\Request;
use App\DeliveryHeader;
use App\User;
use App\DeliveryDetail;
class DeliveriesApiController extends Controller
{
    public function delivery(Request $request){
        try{
            $trx_name = $request->header('trxname');
            if($trx_name==null){
                $delliveryheader = DeliveryHeader::select(\DB::raw('bm_wsh_new_deliveries.lvl,bm_wsh_new_deliveries.ship_to_party_id,
                bm_wsh_new_deliveries.delivery_id,bm_wsh_new_deliveries.sold_to_party_id,bm_wsh_new_deliveries.packing_slip_number,
                bm_wsh_new_deliveries.attribute2,bm_wsh_new_deliveries.currency_code,bm_wsh_new_deliveries.on_or_about_date,
                SUM(bm_wsh_delivery_details.requested_quantity) as req_qty'))
                ->leftJoin('bm_wsh_delivery_details', 'bm_wsh_delivery_details.delivery_detail_id', '=', 'bm_wsh_new_deliveries.delivery_id')
                ->groupBy('bm_wsh_new_deliveries.lvl','bm_wsh_new_deliveries.ship_to_party_id','bm_wsh_new_deliveries.sold_to_party_id','bm_wsh_new_deliveries.delivery_id','bm_wsh_new_deliveries.packing_slip_number','bm_wsh_new_deliveries.attribute2','bm_wsh_new_deliveries.currency_code','bm_wsh_new_deliveries.on_or_about_date')
                ->orderBy('bm_wsh_new_deliveries.delivery_id','DESC')
                ->get();
                $data_arr = array();
                foreach ($delliveryheader as $raw) {
                    $data_arr[] = array(
                        "delivery_id" =>$raw->delivery_id,
                        "lvl" =>$raw->lvl??'',
                        "attribute2" =>$raw->attribute2??'',
                        "gross_weight" =>$raw->gross_weight??'',
                        "on_or_about_date" =>$raw->on_or_about_date??'',
                        "party_name" =>$raw->customer->party_name ?? '',
                        "site_code" =>$raw->site->site_code ?? '',
                        "currency_code" => $raw->currency->currency_code ?? '',
                        "term_code" =>$raw->term_code??'',
                        "trx_name" =>$raw->trxstatus->trx_name??'',
                        "name" =>$raw->name??'',
                        "reqqty"=> $raw->req_qty,
                        "deliverynote" =>$raw->packing_slip_number??'',
                    );
                }
                return responapi::success([
                    'message' => 'Data is Loaded',
                    'deliveryheader' =>$data_arr,
                ],'Success Boss', 200);
            }else{
                // dd('masuk else');
                $delliveryheader = DeliveryHeader::select(\DB::raw('bm_wsh_new_deliveries.lvl,bm_wsh_new_deliveries.ship_to_party_id,bm_wsh_new_deliveries.delivery_id,bm_wsh_new_deliveries.sold_to_party_id,bm_wsh_new_deliveries.packing_slip_number,bm_wsh_new_deliveries.attribute2,bm_wsh_new_deliveries.currency_code,bm_wsh_new_deliveries.on_or_about_date, SUM(bm_wsh_delivery_details.requested_quantity) as req_qty'))
                ->leftJoin('bm_wsh_delivery_details', 'bm_wsh_delivery_details.delivery_detail_id', '=', 'bm_wsh_new_deliveries.delivery_id')
                ->leftJoin('bm_trx_statuses', 'bm_trx_statuses.trx_code', '=', 'bm_wsh_new_deliveries.lvl')
                ->groupBy('bm_wsh_new_deliveries.lvl','bm_wsh_new_deliveries.ship_to_party_id','bm_wsh_new_deliveries.sold_to_party_id','bm_wsh_new_deliveries.delivery_id','bm_wsh_new_deliveries.packing_slip_number','bm_wsh_new_deliveries.attribute2','bm_wsh_new_deliveries.currency_code','bm_wsh_new_deliveries.on_or_about_date')
                ->orderBy('bm_wsh_new_deliveries.delivery_id','DESC')
                ->where('bm_trx_statuses.trx_name','LIKE','%'.$trx_name.'%')
                ->get();
                // dd($trx_name);
                $data_arr = array();
                foreach ($delliveryheader as $raw) {
                    $data_arr[] = array(
                        "delivery_id" =>$raw->delivery_id,
                        "lvl" =>$raw->lvl??'',
                        "attribute2" =>$raw->attribute2??'',
                        "gross_weight" =>$raw->gross_weight??'',
                        "on_or_about_date" =>$raw->on_or_about_date??'',
                        "party_name" =>$raw->customer->party_name ?? '',
                        "site_code" =>$raw->site->site_code ?? '',
                        "currency_code" => $raw->currency->currency_code ?? '',
                        "term_code" =>$raw->term_code??'',
                        "trx_name" =>$raw->trxstatus->trx_name??'',
                        "name" =>$raw->name??'',
                        "reqqty"=> $raw->req_qty,
                        "deliverynote" =>$raw->packing_slip_number??'',
                    );
                }
                // dd($data_arr);
                if($data_arr==[]){
                    return responapi::error([
                        'message' => 'Not Found',
                        'deliveryheader' =>$data_arr,
                    ],'Error', 401);
                }else{
                    return responapi::success([
                        'message' => 'Data is Loaded',
                        'deliveryheader' =>$data_arr,
                    ],'Success Boss', 200);
                }
                return responapi::success([
                    'message' => 'Data is Loaded',
                    'deliveryheader' =>$data_arr,
                ],'Success Boss', 200);
            }

        }catch(Exception $error){
            return responapi::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ],'Authentication Failed', 401);
        }


    }
    public function deliveryDetail(Request $request){
        try{
            $api_token =  User::where('api_token', $request->header('apitoken'))->first();
            if($api_token) {
                $DeliveryDetail=DeliveryDetail::select('bm_wsh_delivery_details.id','bm_wsh_delivery_details.delivery_detail_id',
                'bm_wsh_delivery_details.source_header_number','bm_wsh_delivery_details.source_line_id','bm_wsh_delivery_details.cust_po_number',
                'bm_wsh_delivery_details.requested_quantity','bm_wsh_delivery_details.requested_quantity_uom',
                'bm_wsh_delivery_details.subinventory','bm_wsh_delivery_details.item_description','bm_mtl_system_item.item_code')
                ->leftJoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_wsh_delivery_details.inventory_item_id')
                ->where('delivery_detail_id',$request->detail)
                ->get();
                // return  json_decode($DeliveryDetail);
                // dd($DeliveryDetail);

                $data_arr = array();
                foreach ($DeliveryDetail as $raw) {
                    $data_arr[] = array(
                        "id" =>$raw->id,
                        "delivery_detail_id" =>$raw->delivery_detail_id,
                        "source_header_number" =>$raw->source_header_number,
                        "source_line_id" =>$raw->source_line_id,
                        "cust_po_number" =>$raw->cust_po_number,
                        "requested_quantity" =>$raw->requested_quantity,
                        "requested_quantity_uom" =>$raw->requested_quantity_uom,
                        "subinventory" =>$raw->subinventory,
                        "item_description" =>$raw->item_description,
                        "item_code" =>$raw->item_code,
                    );
                }
                // dd($data_arr);
                return responapi::success([
                    'message' => 'Data is Loaded',
                    'deliveryitem' =>$data_arr,
                ],'Success Boss', 200);
                return $DeliveryDetail;
            }else{
                return responapi::error([
                    'message' => 'Di mana tokennya?',
                ],'Authentication Failed', 401);
            }
        }catch(Exception $error){
            return responapi::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ],'Authentication Failed', 401);
        }
    }
}

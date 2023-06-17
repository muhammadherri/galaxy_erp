<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\RcvHeader;
use App\AccPayHeader;
use App\AccPayTrxLines;
use App\DeliveryDistrib;
use App\User;
use App\Http\Requests\StoreRcvRequest;
use Exception;
use Illuminate\Http\Response;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{
    public function store_ap(Request $request)
    {
       try {
        \DB::beginTransaction();

            $header_id = $request->input('invoice_id');
            if($header_id == 0){
                /* Header */
                $header_id = DB::table('bm_ap_invoices_all')->get()->last();
                $header_id = $header_id->invoice_id + 1;
                $line_number = 1;

                $voucher_num = str_pad($header_id,6,"0",STR_PAD_LEFT);

                $validate_invoice = AccPayHeader::where('invoice_num',$request->input('invoice_num'))->first();
                if($validate_invoice != Null){
                    // return \Response::json();
                    return response()->json->with('error', 'Data Not Found');
                }

                $validate_po = RcvHeader::where('receipt_num',$request->input('idGrn'))->first();
                if($validate_po->vendor_id != $request->input('vendor_id') || $validate_po->currency_code != $request->input('customer_currency')){
                    return response()->json->with('error', 'Data Not Match');

                }


                $invoice_amount = $request->input('invoice_amount');
                $invoice_amount = floatval(preg_replace('/[^\d.]/', '', $invoice_amount));

                $rcv= RcvHeader::where(["receipt_num"=>$request->input('idGrn'),"vendor_id"=>$request->input('vendor_id')])->first();
                // dd($rcv);
                $head =AccPayHeader::findorNew($request->id);
                $head->invoice_id =$header_id;
                $head->voucher_num =$voucher_num;
                $head->invoice_num =$request->input('invoice_num');
                $head->po_header_id =$rcv->rcvDetail->purchaseorder->segment1;
                $head->vendor_id =$request->input('vendor_id');
                $head->remit_to_supplier_id =$request->input('vendor_id'); //
                $head->remit_to_supplier_name =$rcv->vendor->vendor_name; //
                $head->invoice_amount =$invoice_amount;
                $head->payment_amount_total =$invoice_amount;
                $head->invoice_currency_code =$request->input('customer_currency');
                $head->invoice_type_lookup_code =$request->input('invoice_type_lookup_code');
                $head->invoice_date =$request->input('datepicker1');
                $head->gl_date =$request->input('datepicker2');
                $head->invoice_received_date =$request->input('datepicker3');
                $head->terms_id =$request->input('terms_id');
                $head->org_id =$rcv->organization_id;
                $head->exchange_rate_type =$rcv->conversion_rate_type;
                $head->exchange_rate =$rcv->conversion_rate;
                $head->exchange_date =$rcv->conversion_date;
                $head->job_definition_name='Payable';
                $head->created_by =auth()->user()->id;
                $head->approval_status =0;
                $head->posting_status =0;
                $head->last_update_login =date('Y-m-d H:i:s');
                $head->save();
            }else{
                $header_id = $request->input('invoice_id');
                $line_number = AccPayTrxLines::where('invoice_id',$header_id)->count('id')+1;
            }

              $lines = \App\RcvDetail::whereIn('receipt_num',$request->input('idGrn'))
                        ->leftJoin('bm_c_rcv_shipment_header_id','bm_c_rcv_shipment_header_id.shipment_header_id', '=', 'bm_c_rcv_transactions_id.shipment_header_id')
                        ->select('bm_c_rcv_transactions_id.*','bm_c_rcv_shipment_header_id.receipt_num','bm_c_rcv_shipment_header_id.currency_code')
                        ->get();

              RcvHeader::where("receipt_num", $request->input('idGrn'))->update(["invoice_status_code" => 1]);

              $total_tax = 0;
              $total = 0;
              foreach( $lines as $key =>$line){
                    $subtotal = $line->quantity_received*$line->shipment_unit_price;
                    $tax = $subtotal * $line->tax->tax_rate;
                    $amount = $subtotal + $tax;

                    $data = array(
                        'invoice_id'=>$header_id,
                        'line_id'=> $line_number,
                        'inventory_item_id'=>$line->item_id,
                        'po_header_id'=>$line->po_header_id,
                        'po_line_id'=>$line->po_line_id,
                        'item_description'=>$line->item_description,
                        'rcv_transaction_id'=>$line->receipt_num,
                        'receipt_currency_code'=>$line->currency_code,
                        'quantity_invoiced'=>$line->quantity_received,
                        'unit_price'=>$line->shipment_unit_price,
                        'account_segment'=>$line->ItemMaster->category->inventory_account_code,
                        'stat_amount'=>$subtotal,
                        'amount'=>$amount,
                        'original_amount'=>$subtotal,
                        'total_rec_tax_amount'=>$subtotal ?? 0,
                        'total_nrec_tax_amount'=> 0,
                        'unit_meas_lookup_code'=>$line->uom_code,
                        'line_type_lookup_code'=>false,
                        'job_definition_name'=>'Payable',
                        'tax_rate'=>$line->tax->tax_rate,
                        'tax_rate_code'=>$line->tax_name,
                        'tax'=>$tax,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                    );
                    AccPayTrxLines::create($data);
                    $line_number++;

                    $qry[]= array(
                        'invoice_id'=>$header_id,
                        'line_id'=> $line_number,
                        'inventory_item_id'=>$line->item_id,
                        'po_header_id'=>$line->po_header_id,
                        'po_line_id'=>$line->po_line_id,
                        'item_code'=>$line->itemmaster->item_code,
                        'item_description'=>$line->item_description,
                        'rcv_transaction_id'=>$line->receipt_num,
                        'receipt_currency_code'=>$line->currency_code,
                        'quantity_invoiced'=>$line->quantity_received,
                        'unit_price'=>$line->shipment_unit_price,
                        'acc'=>$line->ItemMaster->category->inventory_account_code, //inventory_account
                        'acc_des'=>$line->ItemMaster->category->inventory->description, //inventory_account
                        'payable'=>$line->ItemMaster->category->payable_account_code, //payable_account
                        'payable_des'=>$line->ItemMaster->category->payable->description, //payable_account
                        'tax_acc_code'=> $line->tax->tax_account ?? 0,
                        'tax_acc_des'=>$line->tax->acc->description ?? 0,
                        'tax_rate'=>$line->tax->tax_rate ?? 0,
                        'stat_amount'=>$subtotal,
                        'original_amount'=>$subtotal,
                        'unit_meas_lookup_code'=>$line->uom_code,
                    );

                    $total_tax += $tax;
                    $total += $amount;
                }

                $ap_tax = array(
                    'invoice_id'=>$header_id,
                    'line_id'=> $line_number,
                    'item_description'=>$lines[0]->tax->acc->description,
                    'account_segment'=>$lines[0]->tax->tax_account,
                    'total_rec_tax_amount'=>$tax,
                    'total_nrec_tax_amount'=> 0,
                    'line_type_lookup_code'=>true,
                    'job_definition_name'=>'Payable',
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                );
                AccPayTrxLines::create($ap_tax);

                $ap_inv = array(
                    'invoice_id'=>$header_id,
                    'line_id'=> $line_number+1,
                    'item_description'=>$lines[0]->ItemMaster->category->payable->description,
                    'account_segment'=>$lines[0]->ItemMaster->category->payable_account_code,
                    'total_rec_tax_amount'=> 0,
                    'total_nrec_tax_amount'=>$total,
                    'line_type_lookup_code'=>true,
                    'job_definition_name'=>'Payable',
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                );
                AccPayTrxLines::create($ap_inv);

                \DB::commit();
                return \Response::json($qry);
              //  return redirect()->route('admin.ap.edit',$header_id)->with('success', 'Data Stored');

        }catch (Throwable $e){
            \DB::rollback();
            dd($e);
        }

    }
    public function store_rollID(Request $request)
    {

       $raw = \App\InvOnhandFG::whereIN('uniq_attribute_roll',$request->container_item_id ?? [''])->get();

       try {
        \DB::beginTransaction();
        foreach ( $raw as $key => $row)
        {
                $data = array(
                    'header_id'=>$request->header_id,
                    'line_id'=>$request->line_id,
                    'container_item_id'=>$row->uniq_attribute_roll,
                    'load_item_id'=>$row->inventory_item_id,
                    'attribute_category'=>"",
                    'attribute1'=>(float)$row->attribute_number_gsm,
                    'attribute3'=>(float)$row->attribute_number_w,
                    'attribute_number1'=>$row->primary_quantity,
                );
                if ( ! DeliveryDistrib::where('container_item_id', '=', $row->uniq_attribute_roll)->exists()) {
                    DeliveryDistrib::create($data);
                    $process=\App\InvOnhandFG::where('uniq_attribute_roll','=',$row->uniq_attribute_roll)->update(['shipping_status_flag'=>1]);
                }else{
                    $process="";
                }
        }

        \DB::commit();
    }catch (Throwable $e) {
        \DB::rollback();
    }

    //Delete roll
    $dist = DeliveryDistrib::where('line_id',$request->line_id)
                    ->whereNotIn('container_item_id',$request->container_item_id ?? [''])->get();
    try {
        \DB::beginTransaction();
            foreach ($dist as $key => $row)
            {
                DeliveryDistrib::where('id',$row->id)->delete();
                $process=\App\InvOnhandFG::where('uniq_attribute_roll','=',$row->container_item_id)->update(['shipping_status_flag'=>0]);
            }
        \DB::commit();
    }catch (Throwable $e) {
        \DB::rollback();
    }

    if ($process) {
        $response = ['status' => 'success', 'success' => true, 'message' => 'Save success'];
    } else {
        $response = ['status' => 'error', 'success' => false, 'message' => 'Unable to save data'];
    }
    return $response;
    }


    public function phyupdate(Request $request)
    {
        $process=\App\Onhand::where('id','=',$request->id)->update(['secondary_transaction_quantity'=>$request->value,'task_id'=>1]);
        if ($process) {
            $diff=\App\Onhand::where([['id','=',$request->id],['task_id','=',1]])->select('primary_transaction_quantity','secondary_transaction_quantity')->first();
            $dif=$diff->primary_transaction_quantity-$diff->secondary_transaction_quantity;
            $response = ['status' => 'success', 'success' => true, 'message' => 'Save success','data'=> $dif];
        } else {
            $response = ['status' => 'error', 'success' => false, 'message' => 'Unable to save data'];
        }
        return $response;
    }
    public function updatebyid(Request $request)
    {
        $process=\App\Onhand::where('id','=',$request->id)->update(['primary_transaction_quantity'=>$request->value,'secondary_transaction_quantity'=>NULL,'task_id'=>2]);
        if ($process) {
            $response = ['status' => 'success', 'success' => true, 'message' => 'Save success'];
        } else {
            $response = ['status' => 'error', 'success' => false, 'message' => 'Unable to save data'];
        }
        return $response;

    }

    public function delete_ar_tax(Request $request)
    {
        $process = \App\ArCustomerTrxLines::find($request->input('deleteId'))->delete();

        if ($process) {
            $response = ['status' => 'success', 'success' => true, 'message' => 'Save success'];
        } else {
            $response = ['status' => 'error', 'success' => false, 'message' => 'Unable to save data'];
        }
        return $response;
    }

    public function delete_ap_tax(Request $request)
    {
        $process = \App\AccPayTrxLines::find($request->input('deleteId'))->delete();

        if ($process) {
            $response = ['status' => 'success', 'success' => true, 'message' => 'Save success'];
        } else {
            $response = ['status' => 'error', 'success' => false, 'message' => 'Unable to save data'];
        }
        return $response;
    }

}

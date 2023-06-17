<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\PurchaseOrderDet;
use App\Vendor;
use App\Terms;
use App\ItemMaster;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use DB;
use PDF;

class poController extends Controller
{
    public function index(Request $request){
        $lg = $request->logo;
        $tax =  $request->input('tax');
        $supplierFrom =  $request->input('supplierFrom');
        $poFrom = $request->input('poFrom');
        $poTo = $request->input('poTo');
        $createFrom = $request->input('createFrom');
        $createTo = $request->input('createTo');

        $header = PurchaseOrder::whereBetween('segment1',[$poFrom,$poTo])
                                ->where('type_lookup_code',1)
                                ->where('status',2)
                                ->where('ship_to_location','!=',null)
                                ->get();
        foreach($header as $key => $value)
        {
            $qry[$key] = $value->po_head_id;
            $qry1[$key]= 1;
        }
        if(empty($qry)){
            return back()->with('error', 'Field (From / To) is required | Or Purchase dont Exist');
        }

        $data = PurchaseOrderDet::whereIn('po_header_id',$qry)->where('deleted_at',NULL)->get();
        // dd($data);
        $counter = DB::table('bm_po_lines_all')
                    ->select('po_header_id',DB::raw('count(po_header_id) as pgs' ))
                    ->whereIn('po_header_id',$qry)
                    ->where('deleted_at',NULL)
                    ->groupBy('po_header_id')
                    ->get();
        // dd($counter);
        $pdf = PDF::loadview('admin.stdReports.poReport', compact('data','header','counter','lg'))->setPaper('A4');
        return $pdf->stream('PO Report'.$poFrom.'-'.$poTo.'.pdf');
    }
}

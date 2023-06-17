<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InvOnhandFgOstd;
use App\OperationUnit;

class OutstandingFGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $value = array();
        $result =[];
        $data = InvOnhandFgOstd::where(['status'=>0,'attribute_int1'=>Null])->get(); //will by range date

        foreach ($data as $key => $data){

            $query = $this->getMatch($data->fg_ostd_is);

            for ($i=0; $i < count($query); $i++){
                $width = $query[$i]->attribute_number_w;
                $detail = [$query[$i]->fg_ostd_is];

                $match = $this->getMatch($detail);

                for($j=$i+1; $j < count($match); $j++){
                    if($match[$j]->inventory_item_id == $query[$i]->inventory_item_id && $match[$j]->attribute_number_gsm == $query[$i]->attribute_number_gsm && $match[$j]->attribute_int1 == Null ){  //get same item & gsm
                        $width += $match[$j]->attribute_number_w;
                        $array = array(
                            'gsm_min'=>$query[$i]->attribute_number_gsm,
                            'gsm_max'=>$query[$i]->attribute_number_gsm,
                            'width'=>$width,
                            'id'=>$detail
                        );
                        $data = $this->getOperation($array);

                        if($width >= $data['min'] && $width <= $data['max']){
                            $detail[] = $query[$j]->fg_ostd_is;
                            $result = ['id'=>$detail,'w_total'=>$width,'operation'=>$data['operation']];
                            $trim = $this->getDetail($result);
                            $value[]=$trim;
                            break;
                        }else if($width > $data['max']){
                            $width = $query[$i]->attribute_number_w;
                        }else{
                            $width = $width;
                        }
                    }
                }
            }
        }
        return json_encode($value);
    }

    public function getOperation($array){
        $pm = OperationUnit::where('range_gsm_min','<=',$array['gsm_min'])
                            ->where('range_gsm_max','>=',$array['gsm_max'])
                            ->where('range_capacity_min','<=',$array['width'])
                            ->where('range_capacity_max','>=',$array['width'])
                            ->first();

        $id = InvOnhandFgOstd::where('fg_ostd_is',$array['id'])->where('status',1)->first();
        if (isset($id)){
            $pm = null;
        }
        $data = array(
            'operation' => $pm->short_name ?? '',
            'min' => $pm->range_capacity_min ?? 0,
            'max' => $pm->range_capacity_max ?? 0
        );
        // dd($data);
        return $data;

    }

    public function getDetail($result){
        $queries = InvOnhandFgOstd::whereIn('fg_ostd_is',$result['id'])->get();
        $roll_seq =\DB::table('bm_inv_onhand_fg_ostd')->where('attribute_int1','!=',Null)->get()->last();
        $roll_seq =($roll_seq->attribute_int1 ?? 0) + 1;
        foreach ($queries as $query){

            $query->status = 1;
            $query->attribute_int1 =$roll_seq;
            $query->save();

            $trim[] = array(
                'id'=>$query->fg_ostd_is ?? '',
                'status'=>$query->status ?? '',
                'seq'=>$roll_seq ?? '',
            );
        }
        return $trim;
    }

    public function getMatch($id){
        $match = InvOnhandFgOstd::where(['status'=>0,'attribute_int1'=>Null])
                                // ->where('fg_ostd_is','!=',$id)
                                ->get();
        return $match;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $draw = $request->get('draw');
        $start = $request->get("start");
        $search_arr = $request->get('search');
        $rowperpage = $request->get("length");

        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        $totalRecords = InvOnhandFgOstd::select('count(*) as allcount')->where('status','=',1)->count();
        $totalRecordswithFilter = InvOnhandFgOstd::select('count(*) as allcount')->Where('item_code', 'like', '%' . $searchValue . '%')->Orwhere('item_code','like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = InvOnhandFgOstd::where('status',1)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $records,
        );

        return json_encode($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = InvOnhandFgOstd::where('status',0)->get(); //will by range date

        foreach ($data as $key => $data){
            $query = InvOnhandFgOstd::where('attribute_int1',Null)
                                    ->where('status',0)->get(); // where in range data

            for ($i=0; $i < count($query); $i++){
                $width = $query[$i]->attribute_number_w; 
                dd($width);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

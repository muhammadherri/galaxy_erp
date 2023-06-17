<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGsmRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Gramatur;
use App\ItemMaster;
use Gate;

class GramaturStdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gramatur =Gramatur::All();
        return view('admin.gramaturstd.index',compact('gramatur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gramaturstd.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGsmRequest $request)
    {
        Gramatur::create($request->all());
        return redirect()->route('admin.gsm.index')->with('success', 'Data Stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Gramatur::find($id);
        $op=\App\OperationUnit::all();
        return view('admin.gramaturstd.edit',compact('edit','op'));
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

        Gramatur::where('id', $id)
            ->update(['value' => $request->value,'operation'=>$request->operation]);
        return redirect()->route('admin.gsm.index');
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

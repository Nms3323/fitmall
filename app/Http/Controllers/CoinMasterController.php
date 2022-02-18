<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CoinMaster;
use Str;
use DB;

class CoinMasterController extends Controller
{
    public function __construct(CoinMaster $s)
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Coin Master';
        $data['data'] = CoinMaster::get();
        return view('coinMaster.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Coin Master";
        return view('coinMaster.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->all();
        $create = CoinMaster::create($param);
        if ($create) 
        {
            return redirect()->back();
        } 
        else 
        {
            return redirect()->back();
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
        $data['title'] = "Coin Master";
        $data['coinMaster_data'] = CoinMaster::where('id',$request->get('id'))->first();
        return response()->json($data);
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
        $param['title'] = "Coin Master";
        $update = CoinMaster::where('id',$request->coinMaster_hidden_id)->update($param);
        if($update)
        {
            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CoinMaster::where('id',$request->get('id'))->delete();
        if ($delete)
        {
            return response()->json(['status' => 'success']);
        }
    }
}

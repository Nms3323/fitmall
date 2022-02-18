<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CoinVia;
use Str;
use DB;

class CoinviaController extends Controller
{
    public function __construct(CoinVia $s)
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
        $data['title'] = 'Coin Via';
        $data['data'] = CoinVia::get();
        return view('coinVia.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Coin Via";
        return view('coinVia.create')->with($data);
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
        $create = CoinVia::create($param);
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
        $data['title'] = "Coin Via";
        $data['coinVia_data'] = CoinVia::where('id',$request->get('id'))->first();
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
        $param['title'] = "Coin Via";
        $update = CoinVia::where('id',$request->coinMaster_hidden_id)->update($param);
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
        $delete = CoinVia::where('id',$request->get('id'))->delete();
        if ($delete)
        {
            return response()->json(['status' => 'success']);
        }
    }
}

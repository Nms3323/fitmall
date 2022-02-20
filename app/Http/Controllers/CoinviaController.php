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
		$data['coinVia_data'] = CoinVia::where('id',$id)->first();
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
		$param = $request->all();

		unset($param['_token'],$param['coinVia_hidden_id'],$param['_method']);
		$update = CoinVia::where('id',$request->coinVia_hidden_id)->update($param);
		if($update)
		{
			toastr()->success('Successfully State Updated');
			return redirect()->back();
		}
		else
		{
			toastr()->error('Something Want Wrong..!');
			return redirect()->back();
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
		$delete = CoinVia::where('id',$id)->delete();
		if ($delete)
		{
			toastr()->success('Successfully Coin Via Deleted');
			return response()->json(['status' => 'Success']);
		}else{
			toastr()->error('Something Want Wrong..!');
			return response()->json(['status' => 'Error']);
		}
	}

	public function statusChange(Request $request)
	{
		$coinVia = CoinVia::where('id',$request->get('id'))->value('active');
		if($coinVia == 1)
		{
			$update = CoinVia::where('id',$request->get('id'))->update(['active' => 0]);
		}
		if($coinVia == 0)
		{
			$update = CoinVia::where('id',$request->get('id'))->update(['active' => 1]);
		}
		if($update)
		{
			return response()->json(['status' => 'status_changed']);
		}
	}

	public function withdrawChange(Request $request)
	{
		$coinVia = CoinVia::where('id',$request->get('id'))->value('can_withdraw');
		if($coinVia == 1)
		{
			$update = CoinVia::where('id',$request->get('id'))->update(['can_withdraw' => 0]);
		}
		if($coinVia == 0)
		{
			$update = CoinVia::where('id',$request->get('id'))->update(['can_withdraw' => 1]);
		}
		if($update)
		{
			return response()->json(['status' => 'status_changed']);
		}
	}
}

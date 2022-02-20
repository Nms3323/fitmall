<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CoinMaster;
use App\Currency;
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
		$data['data'] = CoinMaster::join('currency','currency.id','coin_master.currency_id')->select('coin_master.*','currency.currency_name')->get();
		$data['currency'] = Currency::get();
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
		$data['coinMaster_data'] = CoinMaster::where('id',$id)->first();
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

		unset($param['_token'],$param['coinMaster_hidden_id'],$param['_method']);
		$update = CoinMaster::where('id',$request->coinMaster_hidden_id)->update($param);
		
		if($update)
		{
			toastr()->success('Successfully Coin Master Updated');
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
		$delete = CoinMaster::where('id',$id)->delete();
		if ($delete)
		{
			toastr()->success('Successfully Sub Services Deleted');
			return response()->json(['status' => 'Success']);
		}else{
			toastr()->error('Something Want Wrong..!');
			return response()->json(['status' => 'Error']);
		}
	}

	public function checkCoinMaster(Request $request)
	{
		$param = $request->all();
		if($param['currency_id'] != ""){
			if(isset($param['id'])){
				if($param['id'] > 0){
					$check = CoinMaster::where('currency_id',$param['currency_id'])->where('id','!=',$param['id'])->exists();
				}
			}else{
				$check = CoinMaster::where('currency_id',$param['currency_id'])->exists();
			}

			if($check){
				echo json_encode(false);
			}else{
				echo json_encode(true);
			}
		}
	}

	public function statusChange(Request $request)
	{
		$coinMaster = CoinMaster::where('id',$request->get('id'))->value('active');
		if($coinMaster == 1)
		{
			$update = CoinMaster::where('id',$request->get('id'))->update(['active' => 0]);
		}
		if($coinMaster == 0)
		{
			$update = CoinMaster::where('id',$request->get('id'))->update(['active' => 1]);
		}
		if($update)
		{
			return response()->json(['status' => 'status_changed']);
		}
	}
}

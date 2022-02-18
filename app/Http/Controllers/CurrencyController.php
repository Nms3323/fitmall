<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use Str;
use DB;

class CurrencyController extends Controller
{
	public function __construct(Currency $s)
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
		$data['title'] = 'Currency';
		$data['data'] = Currency::get();
		return view('currency.index')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['title'] = "Currency";
		return view('currency.create')->with($data);
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
		$param['slug'] = Str::slug($param['code']);
		$create = Currency::create($param);
		if ($create) 
		{
			toastr()->success('Successfully Currency Created');
			return redirect()->back();
		} 
		else 
		{
			toastr()->error('Something Want Wrong');
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

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$data['title'] = "Currency";
		$data['currency_data'] = Currency::where('id',$id)->first();
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
		unset($param['_token'],$param['currency_hidden_id'],$param['_method']);
		$param['slug'] = Str::slug($param['code']);
		$update = Currency::where('id',$request->currency_hidden_id)->update($param);
		
		if($update)
		{
			toastr()->success('Successfully Services Updated');
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
		$delete = Currency::where('id',$id)->delete();
		if ($delete)
		{
			toastr()->success('Successfully Services Deleted');
			return response()->json(['status' => 'Success']);
		}else{
			toastr()->error('Something Want Wrong..!');
			return response()->json(['status' => 'Error']);
		}
	}
	
	public function checkCurrencyName(Request $request)
	{
		$param = $request->all();
		if($param['code'] != ""){
			$param['slug'] = Str::slug($param['code']);
			if(isset($param['id'])){
				if($param['id'] > 0){
					$check = Currency::where('slug',$param['slug'])->where('id','!=',$param['id'])->exists();
				}
			}else{
				$check = Currency::where('slug',$param['slug'])->exists();
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
		$user = Currency::where('id',$request->get('id'))->value('active');
		if($user == 1)
		{
			$update = Currency::where('id',$request->get('id'))->update(['active' => 0]);
		}
		if($user == 0)
		{
			$update = Currency::where('id',$request->get('id'))->update(['active' => 1]);
		}
		if($update)
		{
			return response()->json(['status' => 'status_changed']);
		}
	}
}

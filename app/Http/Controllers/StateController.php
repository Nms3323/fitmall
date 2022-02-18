<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;
use App\Country;
use Str;
use DB;

class StateController extends Controller
{
	public function __construct(State $s)
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
		$data['title'] = 'State';
		$data['data'] = State::join('country','country.id','state.country_id')->select('state.*','country.country_name')->get();
		$data['country'] = Country::get();
		return view('state.index')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['title'] = "State";
		return view('state.create')->with($data);        
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
		$param['slug'] = Str::slug($param['state_name']);
		$create = State::create($param);
		if ($create) 
		{
			toastr()->success('Successfully State Created');
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
		$data['title'] = "State";
		$data['state_data'] = State::join('country','country.id','state.country_id')->where('state.id',$id)->select('state.*','country.country_name')->first();
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

		unset($param['_token'],$param['state_hidden_id'],$param['_method']);
		$param['slug'] = Str::slug($param['state_name']);
		
		$update = State::where('id',$request->state_hidden_id)->update($param);
		
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
		$delete = State::where('id',$request->get('id'))->delete();
		$delete_city = City::where('state_id',$request->get('id'))->delete();

		if ($delete)
		{
			toastr()->success('Successfully State Deleted');
			return response()->json(['status' => 'Success']);
		}else{
			toastr()->error('Something Want Wrong..!');
			return response()->json(['status' => 'Error']);
		}
	}

	public function checkstateName(Request $request)
	{
		$param = $request->all();
		if($param['state_name'] != ""){
			$param['slug'] = Str::slug($param['state_name']);
			if(isset($param['id'])){
				if($param['id'] > 0){
					$check = State::where('slug',$param['slug'])->where('id','!=',$param['id'])->exists();
				}
			}else{
				$check = State::where('slug',$param['slug'])->exists();
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
		$subServices = State::where('id',$request->get('id'))->value('active');
		if($subServices == 1)
		{
			$update = State::where('id',$request->get('id'))->update(['active' => 0]);
		}
		if($subServices == 0)
		{
			$update = State::where('id',$request->get('id'))->update(['active' => 1]);
		}
		if($update)
		{
			return response()->json(['status' => 'status_changed']);
		}
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use App\SubServices;
use Str;
use DB;
use DataTables;

class ServicesController extends Controller
{
	public function __construct(Services $s)
	{
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$data['title'] = 'Services';
		$data['data'] = Services::get();
		return view('services.index')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['title'] = "Services";
		return view('services.create')->with($data);
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
		
		$param['slug'] = Str::slug($param['services_name']);
		$create = Services::create($param);
		if ($create) 
		{
			toastr()->success('Successfully Services Created');
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
		$data['title'] = "Services";
		$data['services_data'] = Services::where('id',$id)->first();
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
		unset($param['_token'],$param['services_hidden_id']);
		$param['slug'] = Str::slug($param['services_name']);
		$update = Services::where('id',$request->services_hidden_id)->update($param);

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
		$delete = Services::where('id',$id)->delete();
		$delete_subservices = SubServices::where('service_id',$id)->delete();

		if ($delete)
		{
			toastr()->success('Successfully Services Deleted');
			return response()->json(['status' => 'Success']);
		}else{
			toastr()->error('Something Want Wrong..!');
			return response()->json(['status' => 'Error']);
		}
	}

	public function checkSerName(Request $request)
	{
		$param = $request->all();
		if($param['services_name'] != ""){
			$param['slug'] = Str::slug($param['services_name']);
			if(isset($param['id'])){
				if($param['id'] > 0){
					$check = Services::where('slug',$param['slug'])->where('id','!=',$param['id'])->exists();
				}
			}else{
				$check = Services::where('slug',$param['slug'])->exists();
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
		$user = Services::where('id',$request->get('id'))->value('active');
		if($user == 1)
		{
			$update = Services::where('id',$request->get('id'))->update(['active' => 0]);
		}
		if($user == 0)
		{
			$update = Services::where('id',$request->get('id'))->update(['active' => 1]);
		}
		if($update)
		{
			return response()->json(['status' => 'status_changed']);
		}
	}
}

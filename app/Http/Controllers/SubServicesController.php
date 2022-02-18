<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubServices;
use App\Services;
use Str;
use DB;

class SubServicesController extends Controller
{
	protected $services;
	public function __construct(SubServices $s)
	{
		$this->middleware('auth');
		$this->services = new Services();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data['title'] = 'Sub Services';
		$data['data'] = SubServices::join('services','services.id','sub_services.service_id')->select('sub_services.*','services.services_name')->get();
		$data['services'] =  Services::get(); 
		return view('subServices.index')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['title'] = "Sub Services";
		return view('subServices.create')->with($data);
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
		$param['slug'] = Str::slug($param['sub_services_name']);
		$create = SubServices::create($param);
		if ($create) 
		{
			toastr()->success('Successfully Sub Services Created');
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
		$data['title'] = "Sub Services";
		$data['subServices_data'] = SubServices::leftjoin('services','services.id','sub_services.service_id')->where('sub_services.id',$id)->select('sub_services.*')->first();
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

		unset($param['_token'],$param['subservices_hidden_id'],$param['_method']);
		$param['slug'] = Str::slug($param['sub_services_name']);
		
		$update = SubServices::where('id',$request->subservices_hidden_id)->update($param);
		
		if($update)
		{
			toastr()->success('Successfully Sub Services Updated');
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
		$delete = SubServices::where('id',$id)->delete();

		if ($delete)
		{
			toastr()->success('Successfully Sub Services Deleted');
			return response()->json(['status' => 'Success']);
		}else{
			toastr()->error('Something Want Wrong..!');
			return response()->json(['status' => 'Error']);
		}
	}

	public function checkSubSerName(Request $request)
	{
		$param = $request->all();
		if($param['sub_services_name'] != ""){
			$param['slug'] = Str::slug($param['sub_services_name']);
			if(isset($param['id'])){
				if($param['id'] > 0){
					$check = SubServices::where('slug',$param['slug'])->where('id','!=',$param['id'])->exists();
				}
			}else{
				$check = SubServices::where('slug',$param['slug'])->exists();
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
		$subServices = SubServices::where('id',$request->get('id'))->value('active');
		if($subServices == 1)
		{
			$update = SubServices::where('id',$request->get('id'))->update(['active' => 0]);
		}
		if($subServices == 0)
		{
			$update = SubServices::where('id',$request->get('id'))->update(['active' => 1]);
		}
		if($update)
		{
			return response()->json(['status' => 'status_changed']);
		}
	}
}

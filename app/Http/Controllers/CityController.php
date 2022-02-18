<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Country;
use App\State;
use Str;
use DB;

class CityController extends Controller
{
    public function __construct(City $s)
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
        $data['title'] = 'City';
        $data['data'] = City::join('state','state.id','city.state_id')->join('country','country.id','city.country_id')->select('city.*','state.state_name','country.country_name')->get();
        $data['country'] = Country::get();
        return view('city.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "City";
        return view('city.create')->with($data);
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
        $param['slug'] = Str::slug($param['city_name']);
        $create = City::create($param);
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
        $data['city_data'] = City::where('id',$id)->first();
        $state_data = State::where('country_id',$data['city_data']['country_id'])->get();
        $data['html'] = "<option value=''>--Select State--</option>";
        foreach ($state_data as $state_dt) {
            $data['html'] .= "<option value='".$state_dt['id']."'>".$state_dt['state_name']."</option>";
        }
        
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

        unset($param['_token'],$param['city_hidden_id'],$param['_method']);
        $update = City::where('id',$request->city_hidden_id)->update($param);
        
        if($update)
        {
            toastr()->success('Successfully City Updated');
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
        $delete = City::where('id',$id)->delete();
        if ($delete)
        {
            toastr()->success('Successfully City Deleted');
            return response()->json(['status' => 'Success']);
        }else{
            toastr()->error('Something Want Wrong..!');
            return response()->json(['status' => 'Error']);
        }
    }

    public function checkCityName(Request $request)
    {
        $param = $request->all();
        if($param['city_name'] != "" && $param['country_id'] && $param['state_id']){
            $param['slug'] = Str::slug($param['city_name']);
            if(isset($param['id'])){
                if($param['id'] > 0){
                    $check = City::where('slug',$param['slug'])->where('country_id',$param['country_id'])->where('state_id',$param['state_id'])->where('id','!=',$param['id'])->exists();
                }
            }else{
                $check = City::where('slug',$param['slug'])->where('country_id',$param['country_id'])->where('state_id',$param['state_id'])->exists();
            }

            if($check){
                echo json_encode(false);
            }else{
                echo json_encode(true);
            }
        }else{
            echo json_encode(false);
        }
    }

    public function statusChange(Request $request)
    {
        $city = City::where('id',$request->get('id'))->value('active');
        if($city == 1)
        {
            $update = City::where('id',$request->get('id'))->update(['active' => 0]);
        }
        if($city == 0)
        {
            $update = City::where('id',$request->get('id'))->update(['active' => 1]);
        }
        if($update)
        {
            return response()->json(['status' => 'status_changed']);
        }
    }

    public function stateList(Request $request)
    {
        $param = $request->all();

        $html = "<option value=''>--Select State--</option>";
        $state = State::where('country_id',$param['country_id'])->where('active',1)->get();

        if(!empty($state)){
            foreach ($state as $state_data) {
                $html .= "<option value='".$state_data['id']."'>".$state_data['state_name']."</option>";
            }
        }

        echo $html;

    }
}

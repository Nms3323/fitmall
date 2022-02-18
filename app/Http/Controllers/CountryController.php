<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;
use Str;
use DB;

class CountryController extends Controller
{
    public function __construct(Country $s)
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
        $data['title'] = 'Country';
        $data['data'] = Country::get();
        return view('country.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Country";
        return view('country.create')->with($data);
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
        $param['slug'] = Str::slug($param['country_name']);
        $create = Country::create($param);
        if ($create) 
        {
            toastr()->success('Successfully Country Created');
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
        $data['title'] = "Country";
        $data['country_data'] = Country::where('id',$id)->first();
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
        unset($param['_token'],$param['country_hidden_id'],$param['_method']);
        $param['slug'] = Str::slug($param['country_name']);
        $update = Country::where('id',$request->country_hidden_id)->update($param);

        if($update)
        {
            toastr()->success('Successfully Country Updated');
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
        $delete = Country::where('id',$id)->delete();
        $delete_state = State::where('country_id',$id)->delete();
        $delete_city = City::where('country_id',$id)->delete();

        if ($delete)
        {           
            toastr()->success('Successfully Country Deleted');
            return response()->json(['status' => 'success']);
        }
        else{
            toastr()->error('Something Want Wrong..!');
            return response()->json(['status' => 'Error']);
        }
    }

    public function checkcountryName(Request $request)
    {
        $param = $request->all();
        if($param['country_name'] != ""){
            $param['slug'] = Str::slug($param['country_name']);
            if(isset($param['id'])){
                if($param['id'] > 0){
                    $check = Country::where('slug',$param['slug'])->where('id','!=',$param['id'])->exists();
                }
            }else{
                $check = Country::where('slug',$param['slug'])->exists();
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
        $user = Country::where('id',$request->get('id'))->value('active');
        if($user == 1)
        {
            $update = Country::where('id',$request->get('id'))->update(['active' => 0]);
        }
        if($user == 0)
        {
            $update = Country::where('id',$request->get('id'))->update(['active' => 1]);
        }
        if($update)
        {
            return response()->json(['status' => 'status_changed']);
        }
    }
}

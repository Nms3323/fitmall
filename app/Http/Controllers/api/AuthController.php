<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Business;

class AuthController extends Controller
{
	/**
	 * Create user
	 *
	 * @param  [string] name
	 * @param  [string] email
	 * @param  [string] password
	 * @param  [string] password_confirmation
	 * @return [string] message
	 */
	public function signup(Request $request)
	{
		$request->validate([
			'name' => 'required|string',
			'email' => 'required|string|email|unique:users',
			'password' => 'required|string|confirmed'
		]);
		
		$user = new User([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password)
		]);
		
		$user->save();

		return response()->json([
			'message' => 'Successfully created user!'
		], 201);
	}
	
	/**
	 * Login user and create token
	 *
	 * @param  [string] email
	 * @param  [string] password
	 * @param  [boolean] remember_me
	 * @return [string] access_token
	 * @return [string] token_type
	 * @return [string] expires_at
	 */
	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required|string|email',
			'password' => 'required|string',
			'remember_me' => 'boolean'
		]);
		$credentials = request(['email', 'password']);
		if(!Auth::attempt($credentials))
			return response()->json([
				'message' => 'Unauthorized'
			], 401);
		$user = $request->user();
		$tokenResult = $user->createToken('Personal Access Token');
		$token = $tokenResult->token;
		if ($request->remember_me)
			$token->expires_at = Carbon::now()->addWeeks(1);
		$token->save();
		return response()->json([
			'access_token' => $tokenResult->accessToken,
			'token_type' => 'Bearer',
			'expires_at' => Carbon::parse(
				$tokenResult->token->expires_at
			)->toDateTimeString()
		]);
	}
	
	/**
	 * Logout user (Revoke the token)
	 *
	 * @return [string] message
	 */
	public function logout(Request $request)
	{
		$request->user()->token()->revoke();
		return response()->json([
			'message' => 'Successfully logged out'
		]);
	}
	
	/**
	 * Get the authenticated User
	 *
	 * @return [json] user object
	 */
	public function user(Request $request)
	{
		return response()->json($request->user());
	}

	public function UpdateProfile(Request $request)
	{ 
		$validatedData  = $request->validate([
			'name' => 'required|string',
			'date_of_birth' => 'required|date',
			'phone_no' => 'required|string',
			'profile' => 'mimes:jpeg,png,jpg,gif,svg',
			'old_profile' => 'required|string',
		]);
		
		$param = $request->all();

		if($request->old_profile != null){
			if($request->hasFile('profile'))
			{
				$profile_name = time().'-'.$request->profile->getClientOriginalName();
				request()->profile->move(public_path('/profile/'), $profile_name);
				unlink(public_path('/profile/'.$request->old_profile));
				$param['profile'] = $profile_name;
			}else{
				$param['profile'] = $request->old_profile;
			}
		}else{
			if($request->hasFile('profile'))
			{
				$profile_name = time().'-'.$request->profile->getClientOriginalName();
				request()->profile->move(public_path('/profile/'), $profile_name);
				$param['profile'] = $profile_name;
			}
		}

		$param = array(
			'name' => $param['name'],
			'date_of_birth' => $param['date_of_birth'],
			'phone_no' => $param['phone_no'],
			'profile' => $param['profile']
		);
		unset($param['user_id'],$param['old_profile']);
		$update = User::where('id',$request->user_id)->update($param);

		if($update){
			return response()->json([
				'message' => 'Successfully Update Personal Profile'
			], 201);
		}else{
			return response()->json([
				'message' => 'Somthing Want Wrong'
			], 500);
		}
	}
	
	public function businessRegister(Request $request)
	{
		// $validatedData  = $request->validate([
		// 	'brand_name' => 'required|string',
		// 	'legal_name' => 'required|string',
		// 	'brand_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
		// 	'incorporation_dt' => 'required|string',
		// 	'currency_id' => 'required|numeric',
		// 	'user_id' => 'required|numeric'
		// ]);
		// if($validatedData){
		// 	return response()->json([
		// 		'message' => 'Validation Error'
		// 	], 422);
		// }else{

		// }

		$param = $request->all();
		

		if($request->hasFile('brand_logo'))
		{
			$brand_logo_name = time().'-'.$request->brand_logo->getClientOriginalName();
			request()->brand_logo->move(public_path('/brand_logo/'), $brand_logo_name);
			$param['brand_logo'] = $brand_logo_name;
		}

        $create = Business::create($param);

		if($create){
			return response()->json([
				'message' => 'Successfully Registerd Business'
			], 201);
		}else{
			return response()->json([
				'message' => 'Somthing Want Wrong'
			], 500);
		}
	}
}

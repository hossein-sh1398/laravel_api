<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserResource;
use App\User;
use Hash;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function login(Request $request ){

    	 $data= $this->validate($request,[
          'email'=>'required|exists:users',
          'password'=>'required'
    	]);


    	if(auth()->attempt($data))
    	{

           return new UserResource(auth()->user());
    	}

       return response(['data'=>'اطلاعات صحیصح نیست','status'=>'error'],403);

    }

    public function register(Request $request)
    {
    	$data = $this->validate($request,[
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
    	]);

    	$user = User::create([
           'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' =>Str::random(60)
    	]);

    	  return new UserResource($user);

    }
}

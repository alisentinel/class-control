<?php

namespace App\Http\Controllers\sanctum;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SanctumAuthController extends ApiController
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|string',
           // 'username'=>'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse('422',$validate->messages());
        }
        $user = User::query()->create([
            'name' => $request->name,
            'username'=>$request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
     
        $token = $user->createToken('myApp')->plainTextToken;
        return $this->successResponse(201,[
            'user' => $user,
            'token' => $token,
        ],'user created successfully');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(),[
            //'username' => 'required|username|exists:users,username',
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            // 'captcha' => 'required|captcha'
        ]);
        if ($validate->fails()) {
            return $this->errorResponse('422',$validate->messages());
        }


        $user = User::query()->where('email',$request->email)->first();

        if ($user->role === 'blocked') {
            return $this->errorResponse('403','Login is disabled for you, please contact the administrator');
        }
        if (!Hash::check($request->password,$user->password)) {
            return $this->errorResponse('422','password is incorrect');
        }
        $token = $user->createToken('myApp')->plainTextToken;
        return $this->successResponse(200,[
            'user' => $user,
            'token' => $token,
        ],'user login ok');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->successResponse('200','logged out');
    }
}
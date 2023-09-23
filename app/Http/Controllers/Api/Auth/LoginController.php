<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request){

        $credentials = [
            'country_code' => $request->country_code,
            'phone' => $request->phone,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials)) {

            $user = Auth::user();

            $user->tokens()->delete();

            $success['token'] = $user->createToken(request()->userAgent())->plainTextToken;

            $success['success'] = true;

            return response()->json([
                'message' => trans('general.Login Successfully'),
                'user'=> $user,
                'success' => $success,
            ],200);

        } else {

            return response()->json([
                // 'message' => 'Unauthorized',
                'message' => __('auth.Unauthorized'),
            ],401);

        }

    }

}

<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LoginNotification;
use App\Http\Requests\Api\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request){

        $credentials = [
            'phone' => $request->phone,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials)) {

            $user = Auth::user();

            $user->tokens()->delete();

            $success['token'] = $user->createToken(request()->userAgent())->plainTextToken;

            $success['success'] = true;

            // Send Email

            $user->notify(new LoginNotification());

            return response()->json([
                'message' => 'User Login Successfully',
                'user'=> $user,
                'success' => $success,
            ],200);

        } else {

            return response()->json([
                'message' => __('auth.Unauthorized'),
            ],401);

        }

    }
}

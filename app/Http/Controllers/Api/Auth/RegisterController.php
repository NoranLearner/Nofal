<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Auth\RegisterationRequest;
use App\Notifications\PhoneVerificationNotification;

class RegisterController extends Controller
{
    public function register(RegisterationRequest $request){

        $newUser = $request->validated();

        $newUser['password'] = Hash::make($newUser['password']);

        $user = User::create($newUser);

        $success['token'] = $user->createToken('user',['app:all'])->plainTextToken;

        $success['success'] = true;

        $user->notify(new PhoneVerificationNotification());

        return response()->json([
            'message' => 'User Registered Successfully',
            'user'=> $user,
            'success' => $success,
        ],201);

    }
}

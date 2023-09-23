<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Auth\RegistrationRequest;

class RegisterController extends Controller
{
    public function register(RegistrationRequest $request)
    {

        $newUser = $request->validated();

        $newUser['password'] = Hash::make($newUser['password']);

        $user = User::create($newUser);

        $success['token'] = $user->createToken('user', ['app:all'])->plainTextToken;

        $success['success'] = true;

        return response()->json([
            'message' => trans('general.verification process'),
            'user' => $newUser,
            'success' => $success,
        ], 201);

    }
}

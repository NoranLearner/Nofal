<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordPhoneNotification;
use App\Http\Requests\Api\Auth\ForgetPasswordPhoneRequest;

class ForgetPasswordPhoneController extends Controller
{
    public function forgetPassword(ForgetPasswordPhoneRequest $request){

        $input = $request->only('phone');

        $user = User::where('phone', $input)->first();

        $user->notify(new ResetPasswordPhoneNotification());

        $success['success'] = true;

        return response()->json([
            'message' => 'Phone Correct, Go to make a new password',
            'user'=> $user,
            'success' => $success,
        ],200);

    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordEmailNotification;
use App\Http\Requests\Api\Auth\ForgetPasswordEmailRequest;

class ForgetPasswordEmailController extends Controller
{
    public function forgetPassword(ForgetPasswordEmailRequest $request){

        $input = $request->only('email');

        $user = User::where('email', $input)->first();

        $user->notify(new ResetPasswordEmailNotification());

        $success['success'] = true;

        return response()->json([
            'message' => 'Email Correct, Go to make a new password',
            'user'=> $user,
            'success' => $success,
        ],200);

    }
}

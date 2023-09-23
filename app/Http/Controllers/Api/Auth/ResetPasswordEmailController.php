<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Auth\ResetPasswordEmailRequest;

class ResetPasswordEmailController extends Controller
{

    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function resetPassword(ResetPasswordEmailRequest $request){

        $otp2 = $this->otp->validate($request->email, $request->otp);

        if (!$otp2->status) {
            return response()->json([
                'message' => $otp2,
            ],401);
        }

        $user = User::where('email', $request->email)->first();

        $user->update(['password'=>Hash::make($request->password)]);

        $user->tokens()->delete();

        $success['success'] = true;

        return response()->json([
            'message' => 'Reset Password Successfully',
            'user'=> $user,
            'success' => $success,
        ],200);

    }

}

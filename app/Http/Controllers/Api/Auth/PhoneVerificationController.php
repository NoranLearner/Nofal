<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\PhoneVerificationNotification;
use App\Http\Requests\Api\Auth\PhoneVerificationRequest;

class PhoneVerificationController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function send_phone_verification(Request $request){

        $request->user()->notify(new PhoneVerificationNotification());

        $success['success'] = true;

        return response()->json([
            'message' => 'Send Phone Verification Successfully',
            'success' => $success,
        ],200);

    }

    public function phone_verification(PhoneVerificationRequest $request){

        $otp2 = $this->otp->validate($request->phone,$request->otp);

        if (!$otp2->status) {
            return response()->json([
                'message' => $otp2,
            ],401);
        }

        $user = User::where('phone', $request->phone)->first();

        $user->update(['phone_verified_at'=>now()]);

        $success['success'] = true;

        return response()->json([
            'message' => 'Phone Verified Successfully',
            'user'=> $user,
            'success' => $success,
        ],200);

    }
}

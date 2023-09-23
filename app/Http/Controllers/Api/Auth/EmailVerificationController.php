<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\EmailVerificationNotification;
use App\Http\Requests\Api\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{

    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function send_email_verification(Request $request){

        $request->user()->notify(new EmailVerificationNotification());

        $success['success'] = true;

        return response()->json([
            'message' => 'Send Email Verification Successfully',
            'success' => $success,
        ],200);

    }

    public function email_verification(EmailVerificationRequest $request){

        $otp2 = $this->otp->validate($request->email, $request->otp);

        if (!$otp2->status) {
            return response()->json([
                'message' => $otp2,
            ],401);
        }

        $user = User::where('email', $request->email)->first();

        $user->update(['email_verified_at'=>now()]);

        $success['success'] = true;

        return response()->json([
            'message' => 'Email Verified Successfully',
            'user'=> $user,
            'success' => $success,
        ],200);

    }
}

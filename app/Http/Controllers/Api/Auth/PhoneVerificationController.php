<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\PhoneVerificationRequest;

class PhoneVerificationController extends Controller
{

    public function phone_verification(PhoneVerificationRequest $request)
    {

        if ($request->country_code != auth()->user()->country_code) {

            return response()->json(['message' => trans('auth.Country Code Error')]);

        } elseif ($request->phone != auth()->user()->phone) {

            return response()->json(['message' => trans('auth.Phone Error')]);

        }elseif ( $request->phone_verify_code != env('Phone_Verify_Code', '123456') ) {

            return response()->json(['message' => trans('auth.Phone Verify Code Error')]);

        } else {

            $user = User::where(
                ['country_code', $request->country_code],
                ['phone', $request->phone]
                )->first();

            $user->update(['phone_verified_at' => now()]);

            $success['success'] = true;

            return response()->json([
                'message' => trans('general.Verified Successfully'),
                'user' => $user,
                'success' => $success,
            ], 200);

        }

    }

}

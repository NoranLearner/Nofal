<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;

class ResetPasswordController extends Controller
{

    public function resetPassword(ResetPasswordRequest $request)
    {

        $user = User::where([
            ['country_code', $request->country_code],
            ['phone', $request->phone]
        ])->first();

        if ($user) {

            if ($request->reset_code == env('Reset_Code', '654321')) {

                $user->update(['password' => Hash::make($request->password)]);

                $user->tokens()->delete();

                $success['success'] = true;

                return response()->json([
                    'message' => trans('general.Reset Successfully'),
                    'user' => $user,
                    'success' => $success,
                ], 200);

            } else {

                return response()->json([
                    'message' => trans('auth.Reset Code Error'),
                ],401);

            }

        } else {

            return response()->json([
                'message' => trans('general.incorrect data'),
            ], 404);

        }

    }

}

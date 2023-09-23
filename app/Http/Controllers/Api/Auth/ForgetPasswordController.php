<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ForgetPasswordRequest;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(ForgetPasswordRequest $request)
    {

        $user = User::where([
            ['country_code', $request->country_code],
            ['phone', $request->phone]
        ])->first();

        if ($user) {

            $success['success'] = true;

            return response()->json([
                'message' => trans('general.Reset process'),
                'user' => $user,
                'success' => $success,
            ], 200);

        } else {

            return response()->json([
                'message' => trans('general.incorrect data'),
            ], 401);

        }

    }
}

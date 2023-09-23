<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use GeneralTrait;

    public function register(Request $request)
    {

        try {

            // Validation

            $rules = [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|confirmed|min:6',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            // Register

            $user = User::create(
                array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                )
            );

            return $this->returnSuccessMessage('User successfully registered');

        } catch (\Exception $ex) {

            return $this->returnError($ex->getCode(), $ex->getMessage());

        }

    }

    public function login(Request $request)
    {

        try {

            // Validation

            $rules = [
                'email' => 'required|exists:users,email',
                'password' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            // Login

            $credentials = $request->only('email', 'password');

            $token = Auth::guard('user-api')->attempt($credentials);

            if (!$token) {
                return $this->returnError('E001', 'Data Not Valid');
            }

            // return Data & token

            $user = Auth::guard('user-api')->user();

            $user->api_token = $token;

            return $this->returnData('user', $user);

        } catch (\Exception $ex) {

            return $this->returnError($ex->getCode(), $ex->getMessage());

        }

    }

    public function logout(Request $request)
    {

        $token = $request->header('auth-token');

        if ($token) {

            try {

                JWTAuth::setToken($token)->invalidate(); // logout

            } catch (\Exception $e) {

                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {

                    return $this->returnError('', 'Token Is Invalid');

                }

            }

            return $this->returnSuccessMessage('Logout Successfully');

        } else {
            return $this->returnError('', 'Token Not Found');
        }

    }

    public function profile(Request $request)
    {

        return Auth::user();

    }

    public function refresh(Request $request)
    {
        return response()->json([
            'access_token' => auth()->refresh(),
            // 'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}

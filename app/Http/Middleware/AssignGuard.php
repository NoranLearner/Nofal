<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AssignGuard extends BaseMiddleware
{

    use GeneralTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard=null): Response
    {

        if ($guard != null) {

            auth()->shouldUse($guard); //should use guard / table

            $token = $request->header('auth-token');

            $request->headers->set('auth-token', (string) $token, true);

            $request->headers->set('Authorization', 'Bearer ' . $token, true);

            try {

                 // $user = $this->auth->authenticate($request);  //check authenticated user

                $user = JWTAuth::parseToken()->authenticate();

            } catch (TokenExpiredException $e) {

                return $this->returnError('401', 'Unauthenticated user');

            } catch (JWTException $e) {

                return $this->returnError('', 'token_invalid' . $e->getMessage());

            }

        }

        return $next($request);
    }
}

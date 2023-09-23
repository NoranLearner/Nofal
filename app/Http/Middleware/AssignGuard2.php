<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
// use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
// use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
// use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AssignGuard
{

    use GeneralTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = null;

        try {

            $user = JWTAuth::parseToken()->authenticate();

        } catch (\Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                return $this->returnError('E3001', 'INVALID _TOKEN');

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){

                return $this->returnError('E3001', 'EXPIRED_TOKEN');

            } else{

                return $this->returnError('E3001', 'TOKEN_NOTFOUND');

            }

        } catch(\Throwable $e){

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                return $this->returnError('E3001', 'INVALID _TOKEN');

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){

                return $this->returnError('E3001', 'EXPIRED_TOKEN');

            } else{

                return $this->returnError('E3001', 'TOKEN_NOTFOUND');

            }
        }

        if(!$user){

            return $this->returnError('E331','Unauthenticated');

        }

        return $next($request);
    }
}

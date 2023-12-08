<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session; // تغيير الاستيراد هنا

class JwtMiddleware
{
    use ResponseTrait;
    public function handle($request, Closure $next)
    {
        // $token = $request->header("auth-token");
        // $request->headers->set("auth-token", (string) $token, true);
        // $request->headers->set("Authorization", 'Bearer ' . $token, true);
        // return response($request->headers->get('Authorization'));
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {

            return $this->returnError($e->getMessage());
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }

        return $next($request);
    }
}

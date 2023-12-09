<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class GeneralMiddleware extends BaseMiddleware
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        if ($guard != null) {
            auth()->shouldUse($guard);

            $token = $request->header("auth-token");
            // $authenticatedUser = auth()->guard($guard)->setToken($token)->user();
            // return response()->json([]);
                // return response(JWTAuth::decode($token));
            $request->headers->set("auth-token", (string) $token, true);
            $request->headers->set("Authorization", 'Bearer'.$token, true);

            try {
           $user=   JWTAuth::parseToken()->authenticate();

            } catch (TokenExpiredException $e) {
                return response()->json(['message' => 'Token expired: ' . $e->getMessage()]);
            } catch (JWTException $e) {
                return response()->json(['message' => 'JWT exception: ' . $e->getMessage()]);
            } catch (\Exception $e) {
                return response()->json(['message' => 'General exception: ' . $e->getMessage()]);
            }
            // if ($user == null) {
            //     return response()->json([

            //         "status" => false,
            //         "message" => "you are unauthorized",
            //         "errorNumber" => "400"

            //     ]);
            // }

        }

        return $next($request);
    }

}

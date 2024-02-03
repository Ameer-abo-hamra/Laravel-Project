<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard("web")->user()) {

            // if ($request->session()->has('admin_data' . Auth::guard("web")->user()->id)) {

            return $next($request);
            // }
        }
        return redirect()->Route("llogin")->with("unauth", "you have to login before :)");
    }
}

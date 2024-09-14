<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permission = null): Response
    {
        /*$currentName    =   Route::getCurrentRoute()->getPath();
        if (Auth::user()->can($currentName)) {
            return $next($request);
        }else{
            return response()->view('errors.403', ['prevPage'=> URL::previous()]);
        }*/

//        return $next($request);
        if (Auth::check()){
            return $next($request);
        }
        else{
            toastr()->error("unauthorized attempt.");
            return redirect()->back();
        }
    }
}

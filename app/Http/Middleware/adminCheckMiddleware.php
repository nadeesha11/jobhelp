<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $check = $request->session()->get('adminLogin');

        if($check){
            return $next($request);

        }
        else{

            return redirect()->route('admin.index');
        }
      

       
    }
}

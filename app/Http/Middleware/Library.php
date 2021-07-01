<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LibAccess;

class Library
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auth_user_access = LibAccess::where('book_author', '=', $request->route()->id)
            ->where('user', '=', $request->user()->id)->first();
            
        if(($request->route()->id == $request->user()->id) || ($auth_user_access))
        {
            return $next($request);
        }
        
        return redirect()->route('home');
    }
}

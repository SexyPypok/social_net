<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LibAccessNonAuth;

class Book
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
        $access = LibAccessNonAuth::where('book_id', '=', $request->route()->book_id)->first();

        if($access)
        {
            return $next($request);
        }

        return redirect()->route('login');
    }
}

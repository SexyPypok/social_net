<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Book;

class Author
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
        $access = Book::where('book_author_id', '=', $request->user()->id)->where('id', '=', $request->book_id);

        if($access)
        {
            return $next($request);
        }
        
        return redirect()->route('home');
    }
}

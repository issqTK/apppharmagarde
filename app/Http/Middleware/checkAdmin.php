<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkAdmin
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
      if(!session()->has('loggedAdmin') ) {
          return redirect()->route('index')->with('fail', 'You must be logged in');
      } 
      return $next($request);
    }
}

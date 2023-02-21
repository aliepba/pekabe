<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */

    // public function handle($request, Closure $next)
    // {
    //     if ($this->isReading($request) || $this->shouldPassThrough($request)) {
    //         return $next($request);
    //     }

    //     if ($request->session()->has('_token')) {
    //         $token = $request->session()->get('_token');

    //         if ($request->_token !== $token) {
    //             return redirect()->route('login')->with('error', 'CSRF token expired. Please log in again.');
    //         }
    //     }

    //     return parent::handle($request, $next);
    // }


    protected $except = [
        //
    ];
}

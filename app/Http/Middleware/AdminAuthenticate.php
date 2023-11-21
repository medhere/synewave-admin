<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Filament\Facades\Filament;


class AdminAuthenticate
{
    protected function redirectTo($request): ?string
    {
        return Filament::getLoginUrl();
    }

    public function handle(Request $request, Closure $next): Response
    {
        // if(auth()->user()->role !== 'admin'){
        //     return Filament::getLoginUrl();
        // }
        
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user?->role !== 'admin') {
            return redirect('/dashboard'); // normal user → livewire dashboard
        }
        return $next($request);
    }
}

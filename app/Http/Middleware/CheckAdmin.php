<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    
    public function handle(Request $request, Closure $next): Response
    {
        
        $user = User::find(Auth::id());
        if (Auth::check() && $user->roles()->where('can_access_admin', 1)->exists()) {
            return $next($request);
        }

        return redirect()->route('auth.login')->with(['error' => 'Bạn không có quyền truy cập']);
    }
}

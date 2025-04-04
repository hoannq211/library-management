<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoles = ['Admin', 'Editor', 'Quản lý']; 
        $user = User::find(Auth::id());
        if (Auth::check() && $user->hasAnyRole($allowedRoles)) {
            return $next($request);
        }

        return redirect()->route('auth.login')->with(['error' => 'Bạn không có quyền truy cập']);
    }
}

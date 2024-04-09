<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utilities\checkRoleType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $checkRoleType = new checkRoleType();
    $userRoleType = $checkRoleType->checkType();
        if (auth()->check() && $userRoleType->roleType == "admin") {
            return $next($request);
        }
        else{
        return redirect('login.login');
        }
    }
}
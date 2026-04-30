<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($role === 'super-admin' && !$user->isSuperAdmin()) {
            abort(403, 'غير مصرح لك بالدخول لهذه الصفحة');
        }

        if ($role === 'admin' && !$user->isAdmin()) {
            abort(403, 'غير مصرح لك بالدخول لهذه الصفحة');
        }

        return $next($request);
    }
}

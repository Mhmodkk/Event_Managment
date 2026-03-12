<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictToOrganizer
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول'], 401);
        }

        if (! (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())) {
            return response()->json([
                'error' => 'غير مصرح لهذه العملية. هذه الخاصية للمشرفين والإداريين فقط.'
            ], 403);
        }

        return $next($request);
    }
}

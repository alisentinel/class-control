<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user || !$user->hasAnyRole($roles)) {
            return new JsonResponse(['status' => 'error', 'message' => 'Forbidden'], 403);
        }

        // Prevent the user from changing their own role
        $userId = (int)($request->route('user')['id'] ?? null); // assuming the user ID is passed as 'user_id' in the route
        if ($userId && $user->id === $userId) {
            return new JsonResponse(['status' => 'error', 'message' => 'You cannot change your own role'], 403);
        }

        return $next($request);
    }






}
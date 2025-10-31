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

        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Check if user has the required role
        if ($user->role !== $role) {
            // Log unauthorized access attempt
            \Log::warning('Unauthorized access attempt', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'user_role' => $user->role,
                'required_role' => $role,
                'url' => $request->url(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Redirect based on user role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('error', 'Access denied. You do not have permission to access this area.');
            } elseif ($user->isCandidate()) {
                return redirect()->route('candidate.dashboard')->with('error', 'Access denied. You do not have permission to access this area.');
            } else {
                return redirect()->route('home')->with('error', 'Access denied. Invalid user role.');
            }
        }

        return $next($request);
    }
}



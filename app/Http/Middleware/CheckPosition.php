<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPosition
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$allowedPositions): Response
    {
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Get user's position name
        $userPosition = $user->position?->name;
        
        // Check if user's position is in the allowed positions
        if (!in_array($userPosition, $allowedPositions)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

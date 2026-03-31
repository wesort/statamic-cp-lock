<?php

namespace WeSort\CpLock\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventCpAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        // Only apply to CP routes
        if (! $request->is('cp/*') && ! $request->is('cp')) {
            return $next($request);
        }

        // Check if the lock file exists
        if (! file_exists(storage_path('framework/cp_down'))) {
            return $next($request);
        }

        // Allow GET requests (viewing/navigation)
        if ($request->isMethod('GET')) {
            return $next($request);
        }

        // Block all POST, PUT, PATCH, DELETE requests (saving/modifying data)
        $message = 'The Control Panel is temporarily locked. You cannot save or modify content at this time.';

        \Log::warning('PreventCpAccess blocked modification attempt', [
            'path' => $request->path(),
            'method' => $request->method(),
            'user' => $request->user()?->email,
        ]);

        // Return JSON error for AJAX requests
        if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
            return response()->json([
                'message' => $message,
                'error' => $message,
            ], 403);
        }

        // Redirect back with error message for form submissions
        return redirect()->back()->with('error', $message);
    }
}

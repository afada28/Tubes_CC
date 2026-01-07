<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track GET requests
        if ($request->isMethod('get')) {
            $ipAddress = $request->ip() ?? '0.0.0.0';
            $today = today();

            // Check if this IP has already been tracked today for this page
            $existingVisit = Visitor::where('ip_address', $ipAddress)
                ->where('visit_date', $today)
                ->where('page_visited', $request->path())
                ->first();

            if (!$existingVisit) {
                Visitor::create([
                    'ip_address' => $ipAddress,
                    'user_agent' => $request->userAgent() ?? 'Unknown',
                    'page_visited' => $request->path(),
                    'referrer' => $request->header('referer'),
                    'visit_date' => $today,
                ]);
            }
        }

        return $next($request);
    }
}

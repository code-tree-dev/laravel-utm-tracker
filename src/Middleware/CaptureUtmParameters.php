<?php
declare(strict_types=1);

namespace CodeTreeDev\LaravelUtmTracker\Middleware;

use Closure;
use CodeTreeDev\LaravelUtmTracker\Models\UtmVisit;
use Illuminate\Http\Request;

final class CaptureUtmParameters
{
    public function handle(Request $request, Closure $next)
    {
        $utmKeys = [
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
        ];

        $hasUtm = false;
        $utmData = [];

        foreach ($utmKeys as $key) {
            if ($request->has($key)) {
                $utmData[$key] = $request->get($key);
                $hasUtm = true;
            }
        }

        // Capture custom UTM parameters
        $utmExtra = collect($request->query())
            ->filter(fn ($v, $k) => str_starts_with($k, 'utm_') && !in_array($k, $utmKeys))
            ->toArray();

        // If any UTM parameter exists, save to the database
        if ($hasUtm || !empty($utmExtra)) {
            UtmVisit::create([
                'utm_source'   => $utmData['utm_source'] ?? null,
                'utm_medium'   => $utmData['utm_medium'] ?? null,
                'utm_campaign' => $utmData['utm_campaign'] ?? null,
                'utm_term'     => $utmData['utm_term'] ?? null,
                'utm_content'  => $utmData['utm_content'] ?? null,
                'utm_extra'    => $utmExtra ?: null,
                'page_url'     => $request->fullUrl(),
                'referrer'     => $request->headers->get('referer'),
                'session_id'   => method_exists($request, 'hasSession') && $request->hasSession() ? $request->session()->getId() : null,
                'ip_address'   => $request->ip(),
                'user_agent'   => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use App\Models\UrlClick;

class RedirectUrlController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $short_code)
    {
        $url = ShortUrl::where('short_code', $short_code)->first();

        if ($url === null) {
            abort(404);
        }

        if (
            $url->is_active === false ||
            ($url->expires_at !== null && $url->expires_at->isPast())
        ) {
            abort(410);
        }

        UrlClick::create([
            'short_url_id' => $url->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent() ?? 'Unknown',
            'referer' => $request->header('referer'),
            'clicked_at' => now(),
        ]);

        return redirect()->away($url->original_url);
    }
}

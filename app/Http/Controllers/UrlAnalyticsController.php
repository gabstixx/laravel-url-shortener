<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;

class UrlAnalyticsController extends Controller
{
    public function show(ShortUrl $shortUrl)
    {
        abort_unless((int) $shortUrl->user_id === (int) auth()->id(), 403);

        $dailyClicks = $shortUrl->clicks()
            ->selectRaw('DATE(clicked_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        $topReferrers = $shortUrl->clicks()
            ->selectRaw('referer as ref, COUNT(*) as total')
            ->groupBy('ref')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $recentClicks = $shortUrl->clicks()
            ->orderByDesc('clicked_at')
            ->limit(10)
            ->get();

        return view('analytics', compact(
            'shortUrl',
            'dailyClicks',
            'topReferrers',
            'recentClicks'
        ));
    }
}

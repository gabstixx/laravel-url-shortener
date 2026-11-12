<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Models\UrlClick;

class DashboardController extends Controller
{
    public function index() 
    {
        $urls = ShortUrl::where('user_id', auth()->id())
        ->withCount('clicks')
        ->paginate(10);

        $totalLinks = ShortUrl::where('user_id', auth()->id())->count();
        $totalClicks = UrlClick::whereHas('shortUrl', function ($query) {
            $query->where('user_id', auth()->id());
            })->count();
        $activeLinks = ShortUrl::where('user_id', auth()->id())
        ->where('is_active', true)
        ->where(function ($query) {
            $query->whereNull('expires_at')
            ->orWhere('expires_at', '>', now());
            })
            ->count();

        return view('dashboard', compact(
            'urls',
            'totalLinks',
            'totalClicks',
            'activeLinks'
        ));
    }
}

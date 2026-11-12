<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortUrlRequest;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class StoreShortUrlController extends Controller
{
    public function __invoke(StoreShortUrlRequest $request) 
    {
        $data = $request->validated();

        if (!empty($data['custom_alias'])) {
            $shortCode = $data['custom_alias'];
        } else {
            do {
                $shortCode = Str::random(6);
            } while (ShortUrl::where('short_code', $shortCode)->exists());
        }

        $shortUrl = ShortUrl::create([
            'user_id' => auth()->id(),
            'original_url' => $data['original_url'],
            'short_code' => $shortCode,
            'expires_at' => $data['expires_at'] ?? null,
        ]);

        return back()->with(
            'shortUrl',
            url('/s/' . $shortUrl->short_code)
        );
    }
}

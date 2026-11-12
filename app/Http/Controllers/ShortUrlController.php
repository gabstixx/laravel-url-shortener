<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;

class ShortUrlController extends Controller
{
    public function toggle(ShortUrl $shortUrl) 
    {
        abort_unless((int) $shortUrl->user_id === (int) auth()->id(), 403);
        $shortUrl->is_active = !$shortUrl->is_active;
        $shortUrl->save();
        return redirect()->back();
    }

    public function destroy(ShortUrl $shortUrl)
    {
        abort_unless((int) $shortUrl->user_id === (int) auth()->id(), 403);
        $shortUrl->delete();
        return redirect()->route('dashboard');
    }
}

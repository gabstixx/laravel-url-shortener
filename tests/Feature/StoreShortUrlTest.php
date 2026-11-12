<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ShortUrl;

class StoreShortUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_can_shorten_a_url(): void 
    {
        $response = $this->post('/short-urls', [
            'original_url' => 'https://example.com',
        ]);
        $response->assertRedirect();

        $this->assertDatabaseHas('short_urls', [
            'original_url' => 'https://example.com',
        ]);

        $shortUrl = ShortUrl::where('original_url', 'https://example.com')->first();
        $this->assertEquals(6, strlen($shortUrl->short_code));
    }
}

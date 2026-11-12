<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ShortUrl;

class RedirectUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_short_url_redirects_and_records_a_click(): void
    {
        $url = ShortUrl::create([
            'original_url' => 'https://example.com',
            'short_code' => 'abc123',
            'expires_at' => null,
        ]);

        $response = $this->withHeaders([
            'User-Agent' => 'Test Browser',
        ])->get('/s/abc123');
        $response->assertRedirect('https://example.com');

        $this->assertDatabaseHas('url_clicks', [
            'short_url_id' => $url->id,
        ]);
    }

    public function test_an_expired_short_url_returns_410(): void
    {
        $url = ShortUrl::create([
            'original_url' => 'https://example.com',
            'short_code' => 'expired1',
            'expires_at' => now()->subDays(1),
        ]);

        $response = $this->get('/s/expired1');
        $response->assertStatus(410);

        $this->assertDatabaseMissing('url_clicks', [
            'short_url_id' => $url->id,
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShortUrl extends Model
{
    public function clicks(): HasMany
    {
        return $this->hasMany(UrlClick::class);
    }

    protected $fillable = [
        'user_id',
        'original_url',
        'short_code',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'expires_at' => 'datetime',
        ];
    }
}

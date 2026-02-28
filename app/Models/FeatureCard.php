<?php

namespace App\Models;

use App\Enums\SitePage;
use Illuminate\Database\Eloquent\Model;

class FeatureCard extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'sequence',
        'is_active',
        'page',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'page' => SitePage::class,
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sequence', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

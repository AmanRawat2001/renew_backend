<?php

namespace App\Models;

use App\Enums\SitePage;
use Illuminate\Database\Eloquent\Model;

class MissionSlide extends Model
{
    protected $fillable = ['image', 'title', 'description', 'sequence', 'is_active', 'page'];

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

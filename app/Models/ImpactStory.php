<?php

namespace App\Models;

use App\Enums\SitePage;
use Illuminate\Database\Eloquent\Model;

class ImpactStory extends Model
{
    protected $fillable = ['name', 'designation', 'location', 'image', 'description', 'page', 'sort_order', 'status'];

    protected $casts = [
        'status' => 'boolean',
        'page' => SitePage::class,
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}

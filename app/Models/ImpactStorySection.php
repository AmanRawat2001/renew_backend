<?php

namespace App\Models;

use App\Enums\SitePage;
use Illuminate\Database\Eloquent\Model;

class ImpactStorySection extends Model
{
    protected $fillable = ['title', 'external_url', 'page', 'sort_order', 'status'];

    protected $casts = [
        'status' => 'boolean',
        'page' => SitePage::class,
    ];

    public function stories()
    {
        return $this->hasMany(ImpactStory::class, 'section_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}

<?php

namespace App\Models;

use App\Enums\SitePage;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'button_text',
        'image',
        'sequence',
        'is_active',
        'page',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sequence' => 'integer',
        'page' => SitePage::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sequence', 'asc');
    }
}

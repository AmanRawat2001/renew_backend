<?php

namespace App\Models;

use App\Enums\SitePage;
use Illuminate\Database\Eloquent\Model;

class ContentSection extends Model
{
    protected $fillable = [
        'section_key',
        'title',
        'subtitle',
        'description',
        'page',
    ];

    protected $casts = [
        'page' => SitePage::class,
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc');
    }
}

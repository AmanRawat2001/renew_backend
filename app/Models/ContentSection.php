<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentSection extends Model
{
    protected $fillable = [
        'section_key',
        'title',
        'subtitle',
        'description',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionSlide extends Model
{
    protected $fillable = ['image', 'title', 'description', 'sequence', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
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

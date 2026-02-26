<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impact extends Model
{
    protected $fillable = ['metric_number', 'title', 'description', 'sequence', 'is_active', 'down_arrow'];

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

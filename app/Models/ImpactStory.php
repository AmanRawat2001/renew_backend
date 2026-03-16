<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactStory extends Model
{
    protected $fillable = ['section_id', 'name', 'designation', 'location', 'description', 'sort_order', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(ImpactStorySection::class, 'section_id');
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

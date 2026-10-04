<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'date',
        'time',
        'location',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = ['title','image','description','status','user_id'];
    public function user() { return $this->belongsTo(User::class); }
    public function scopePublished($q) { return $q->where('status','published'); }
}

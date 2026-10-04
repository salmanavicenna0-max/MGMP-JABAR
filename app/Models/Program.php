<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Program extends Model
{
    protected $fillable = ['title','slug','description','icon','image','status','user_id'];
    public function user() { return $this->belongsTo(User::class); }
    protected static function booted() {
        static::creating(function ($m) { if (empty($m->slug)) $m->slug = Str::slug($m->title); });
    }
    public function scopePublished($q) { return $q->where('status','published'); }
}

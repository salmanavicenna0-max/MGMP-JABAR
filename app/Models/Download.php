<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['title','description','file_path','file_size','category','status','is_public','user_id'];
    public function user() { return $this->belongsTo(User::class); }
    public function scopePublished($q) { return $q->where('status','published'); }
    public function getFormattedSizeAttribute() {
        $b = $this->file_size ?? 0;
        return $b >= 1048576 ? round($b/1048576,1).' MB' : round($b/1024,1).' KB';
    }
}

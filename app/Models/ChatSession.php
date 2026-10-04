<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $fillable = ['session_id', 'visitor_name', 'visitor_email', 'status'];

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}

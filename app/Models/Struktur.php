<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    protected $fillable = ['user_id', 'name', 'role', 'image', 'education', 'unit', 'order_num'];

    /**
     * Relasi ke akun user (anggota) yang terhubung.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Nama dinamis: selalu ambil dari user jika ada, fallback ke kolom name.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->user?->name ?? $this->name ?? '';
    }

    /**
     * Sekolah dinamis: selalu ambil dari user jika ada, fallback ke kolom unit.
     */
    public function getDisplayUnitAttribute(): string
    {
        return $this->user?->asal_sekolah ?? $this->unit ?? '';
    }

    /**
     * URL foto dinamis: selalu ambil dari user jika ada, fallback ke kolom image lama.
     * Jika tidak ada, return null (view pakai ui-avatars fallback).
     */
    public function getDisplayImageUrlAttribute(): ?string
    {
        // Prioritas 1: avatar dari user (selalu terbaru)
        if ($this->user && $this->user->avatar) {
            return $this->user->avatar_url;
        }

        // Prioritas 2: image lama di kolom strukturs (legacy)
        if ($this->image) {
            if (str_starts_with($this->image, 'assets/')) {
                return asset($this->image);
            }
            return \Illuminate\Support\Facades\Storage::url($this->image);
        }

        return null;
    }

    /**
     * URL foto dengan fallback ke ui-avatars jika tidak ada foto sama sekali.
     */
    public function getDisplayImageAttribute(): string
    {
        return $this->display_image_url
            ?? 'https://ui-avatars.com/api/?name=' . urlencode($this->display_name) . '&background=0f766e&color=fff&size=256';
    }
}

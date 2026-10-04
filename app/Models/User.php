<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'asal_sekolah',
        'npsn_sekolah',
        'email',
        'password',
        'role',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMember(): bool
    {
        return $this->role === 'member';
    }

    /**
     * Get the full URL for the avatar image.
     * Handles both storage (avatars/) and public (assets/) paths.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if (!$this->avatar) return null;

        // File di storage/app/public/ → akses via /storage/...
        if (str_starts_with($this->avatar, 'avatars/') || str_starts_with($this->avatar, 'struktur/')) {
            return asset('storage/' . $this->avatar);
        }

        // File di public/assets/... → akses langsung via asset()
        if (str_starts_with($this->avatar, 'assets/')) {
            return asset($this->avatar);
        }

        // Fallback: anggap di storage
        return asset('storage/' . $this->avatar);
    }
}
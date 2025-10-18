<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'github_id',
        'avatar',
        'email_verified_at',
        'is_active',
        'activated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'activated_at' => 'datetime',
        ];
    }

    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return $this->is_active === true;
    }

    /**
     * Activate the user
     */
    public function activate(): void
    {
        $this->update([
            'is_active' => true,
            'activated_at' => now(),
        ]);
    }

    /**
     * Deactivate the user
     */
    public function deactivate(): void
    {
        $this->update([
            'is_active' => false,
        ]);
    }

    /**
     * Get user avatar URL (from social login or Gravatar)
     */
    public function getAvatarUrlAttribute(): string
    {
        // If user has avatar from social login
        if ($this->avatar) {
            return $this->avatar;
        }

        // Otherwise, use Gravatar
        $hash = md5(strtolower(trim($this->email)));
        return "https://www.gravatar.com/avatar/{$hash}?d=mp&s=200";
    }
}

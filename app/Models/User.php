<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'bagian_id', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

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
        ];
    }

    /**
     * Relasi: User belongs to Bagian
     */
    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }

    /**
     * Get route redirect dinamis berdasarkan role user.
     */
    public function getHomeRoute(): string
    {
        return match(true) {
            $this->hasRole('admin') => route('admin.dashboard'),
            $this->hasRole('rektor') => route('rektor.dashboard'),
            $this->hasRole('wakil_rektor') => route('warek.dashboard'),
            $this->hasRole('bagian_terkait') => route('bagian.dashboard'),
            default => route('dashboard'), // Fallback 
        };
    }
}

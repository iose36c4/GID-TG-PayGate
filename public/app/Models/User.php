<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'telegram_id',
        'settings', 'timezone', 'locale', 'is_active',
        'onboarding_step', 'onboarding_completed_at',
        'taxpayer_type', 'cuit_cuil', 'tax_province', 'tax_city',
        'tax_zip_code', 'tax_address', 'iibb_number',
        'monotributo_category', 'ganancias_exempt', 'iva_exempt',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string',
        'settings' => 'array',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
        'onboarding_step' => 'integer',
        'onboarding_completed_at' => 'datetime',
        'ganancias_exempt' => 'boolean',
        'iva_exempt' => 'boolean',
    ];

    public function channels(): HasMany
    {
        return $this->hasMany(ChannelPago::class, 'owner_id');
    }

    public function activeChannels(): HasMany
    {
        return $this->channels()->where('status', 'active');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    public function scopeCreadores($query)
    {
        return $query->where('role', 'creador');
    }

    public function scopeStaff($query)
    {
        return $query->whereIn('role', ['staff', 'admin']);
    }

    public function scopeNeedsOnboarding($query)
    {
        return $query->where('role', 'creador')
            ->where('onboarding_step', '<', 5);
    }

    public function isCreador(): bool
    {
        return $this->role === 'creador';
    }

    public function isStaff(): bool
    {
        return in_array($this->role, ['staff', 'admin']);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function hasCompletedOnboarding(): bool
    {
        return $this->onboarding_step >= 5;
    }

    public function getSetting(string $key, mixed $default = null): mixed
    {
        return data_get($this->settings, $key, $default);
    }

    public function setSetting(string $key, mixed $value): void
    {
        $settings = $this->settings ?? [];
        data_set($settings, $key, $value);
        $this->settings = $settings;
        $this->save();
    }
}

<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements FilamentUser
{
    protected $table = 'admin';
    protected $primaryKey = 'adminId';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'adminId',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Filament access control
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true; 
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
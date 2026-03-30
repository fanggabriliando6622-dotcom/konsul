<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customer';
    protected $primaryKey = 'customerId';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; 

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (empty($customer->customerId)) {
                $last = static::orderBy('customerId', 'desc')->first();
                $nextId = $last ? 'CS' . str_pad((int)substr($last->customerId, 2) + 1, 3, '0', STR_PAD_LEFT) : 'CS001';
                $customer->customerId = $nextId;
            }
        });
    }

    protected $fillable = [
        'customerId',
        'name',
        'email',
        'password',
        'alamat',
        'latitude',
        'longitude',
        'customerNoTelp',
        'customerJenisKelamin',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}

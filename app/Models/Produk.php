<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            if (empty($produk->produkId)) {
                $last = static::where('produkId', 'like', 'PA%')
                    ->orderBy('produkId', 'desc')
                    ->value('produkId');

                $nextNumber = $last ? ((int) substr($last, 2)) + 1 : 1;
                $produk->produkId = 'PA' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    // Produk table does not have Laravel timestamps
    public $timestamps = false;

    protected $table = 'produkALKES';
    protected $primaryKey = 'produkId';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'produkId',
        'kategoriId',
        'adminId',
        'produkName',
        'price',
        'qty',
        'gambar',
        'Tanggal_Kadaluwarsa'
    ];

    protected $casts = [
        'Tanggal_Kadaluwarsa' => 'date',
    ];

    /**
     * Relasi ke model Kategori
     * Banyak produk milik satu kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategoriId', 'kategoriId');
    }
}
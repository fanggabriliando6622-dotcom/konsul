<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    // Nama tabel sesuai database
    protected $table = 'pemesanan';

    // Primary key
    protected $primaryKey = 'pemesananId';

    // Primary key bukan auto increment
    public $incrementing = false;

    // Tipe primary key
    protected $keyType = 'string';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'pemesananId',
        'customerId',
        'date',
        'totalPrice',
        'nama_penerima',
        'no_telp_penerima',
        'alamat_pengiriman',
        'latitude',
        'longitude',
    ];

    // Nonaktifkan timestamp jika tabel tidak punya created_at & updated_at
    public $timestamps = false;

    /**
     * Relasi ke model Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId', 'customerId');
    }

    /**
     * Relasi ke model DetailPemesanan
     */
    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'pemesananId', 'pemesananId');
    }

    /**
     * Relasi ke model Pembayaran
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pemesananId', 'pemesananId');
    }
}

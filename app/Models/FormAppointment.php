<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAppointment extends Model
{
    use HasFactory;

    // Nama tabel sesuai database
    protected $table = 'formAppointment';

    // Primary key
    protected $primaryKey = 'appointmentId';

    // Primary key bukan auto increment
    public $incrementing = false;

    // Tipe primary key
    protected $keyType = 'string';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'appointmentId',
        'customerId',
        'namaPasien',
        'dokterId',
        'date',
        'time',
        'pesan'
    ];

    // Aktifkan timestamp karena tabel punya created_at & updated_at
    public $timestamps = true;

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokterId', 'dokterId');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId', 'customerId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transaksi;


class Pelanggan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama_pelanggan',
        'email_pelanggan',
        'no_ktp',
        'no_hp',
        'alamat',
    ];

    // Relasi: Pelanggan punya banyak Transaksi
    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan');
    }
}

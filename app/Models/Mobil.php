<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Admin;
use App\Models\Transaksi;

// use App\Models\User;

class Mobil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mobils';
    protected $primaryKey = 'id_mobil';

    protected $fillable = [
        'id_admin',
        'no_polisi',
        'merek',
        'jenis_mobil',
        'kapasitas',
        'harga_perhari',
        'foto',
        'status'
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    // Mobil punya banyak Transaksi
    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_mobil');
    }
}

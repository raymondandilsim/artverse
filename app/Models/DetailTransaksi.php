<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksis';

    public function transaksis()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function lukisans()
    {
        return $this->belongsTo(Lukisan::class);
    }
}

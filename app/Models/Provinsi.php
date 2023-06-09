<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    
    protected $table = 'provinsis';

    public function kotas()
    {
        return $this->hasMany(Kota::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

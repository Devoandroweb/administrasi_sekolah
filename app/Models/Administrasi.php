<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;
    protected $table = 'administrasi';
    protected $primaryKey = 'id_administrasi';

    protected $casts = [
        'created_at' => 'timestamp',
    ];
    public function siswa()
    {
        return $this->hasOne('App\Models\DataSiswa');
    }
}

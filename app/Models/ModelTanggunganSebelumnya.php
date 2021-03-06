<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTangunganSebelumnya extends Model
{

    use HasFactory;
    protected $table = 'tanggunganprev';
    protected $primaryKey = 'id_tgg_prev';

    protected $casts = [
        'created_at' => 'timestamp',
    ];

    public function siswa()
    {
        return $this->hasOne('App\Models\DataSiswa');
    }
}

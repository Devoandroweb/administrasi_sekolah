<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTangunganSebelumnya extends Model
{

    use HasFactory;
    protected $table = 'tanggunganprev';
    protected $primaryKey = 'id_tgg_prev';

    protected $fillable = [
        
    		'nama','kelas_prev','spp','psb','uts_1','uts_2','pas_1','pas_2','lks_1','lks_2','unas','daftar_ulang','tahun_ajaran','created_at'
        ];
    protected $casts = [
        'created_at' => 'timestamp',
    ];

    public function siswa()
    {
        return $this->hasOne('App\Models\DataSiswa');
    }
}

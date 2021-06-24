<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;
    protected $table = 'administrasi';
    protected $primaryKey = 'id_administrasi';
   
    
    protected $fillable = [
        'no_induk_adm','SPP','PSB','uts_1','uts_2','pas_1','pas_2','lks_1','lks_2','unas','daftar_ulang','tahun_ajaran','created_at'
    ];
    protected $casts = [
        'created_at' => 'timestamp',
    ];
    public function siswa()
    {
        return $this->hasOne('App\Models\DataSiswa');
    }
}

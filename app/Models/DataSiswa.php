<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;
    protected $table = 'data_siswa';
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'id_siswa','nama','tmp_lahir','tgl_lahir','nisn','no_induk','kelas','rombel','no_tlp','alamat','password'
    ];
    protected $casts = [
        'tgl_lahir' => 'timestamp',
    ];
    public function pemasukan()
    {
        return $this->hasOne(Pemasukan::class,'no_induk_siswa');
    }
    
}

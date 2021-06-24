<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';
    protected $primaryKey = 'id_pemasukan';

    protected $fillable = [
        
    		'id_pemasukan','no_induk_siswa','nama', 'uraian','total','created_at'
        ];

    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class);
    }
}

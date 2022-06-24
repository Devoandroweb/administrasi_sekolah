<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKelas extends Model
{
    use HasFactory;
    protected $table = "m_kelas";
    protected $primaryKey = "id_kelas";
    public function tugas()
    {
        return $this->hasOne(MTugas::class,'id_kelas');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MJawaban extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jawaban';
    protected $table = 'jawaban';
    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'id_siswa');
    }
    public function tugas()
    {
        return $this->belongsTo(MTugas::class,'id_tugas');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMapel extends Model
{
    use HasFactory;
    protected $table = "m_mapel";
    protected $primaryKey = "id_mapel";
    static function withDeleted()
    {
        return self::where('deleted',1)->get();
    }
    public function tugas()
    {
        return $this->hasOne(Tugas::class,'id_mapel');
    }
    public function gambar($w = 100,$h = 100)
    {
        $src = url('public/mapel/'.$this->gambar);
        $img = '<img src="'.$src.'" width="'.$w.'px" height="'.$h.'px">';
        return $img;
    }
    public function guru()
    {
        return $this->belongsTo(MGuru::class,'id_mapel');
    }
}

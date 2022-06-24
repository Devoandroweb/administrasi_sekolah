<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MTugas extends Model
{
    use HasFactory;
    protected $table = "tugas";
    protected $primaryKey = "id_tugas";

    public function status()
    {
        $dateNow = date('Y-m-d');
        $dateExpired = date("Y-m-d",strtotime($this->expired));
        if($dateNow == $dateExpired){
            return '<span class="badge bg-danger">Akan di tutup</span>';
        }elseif($dateNow < $dateExpired){
            return '<span class="badge bg-success">Aktif</span>';
        }else{
            return '<span class="badge bg-danger">Tutup</span>';
        }
        
    }
    public function mapel()
    {
        return $this->belongsTo(MMapel::class,'id_mapel');
    }
    public function kelas()
    {
        return $this->belongsTo(MKelas::class,'id_kelas');
    }
    static function whereKelas()
    {
        return self::where('id_kelas',Auth::guard('siswa')->user()->kelas);
    }
    public function withTugasSelesaiLink()
    {
        $jawaban = MJawaban::where('id_tugas',$this->id_tugas)->where('id_siswa',Auth::guard('siswa')->user()->id_siswa)->first();
        if($jawaban == null){
            return ' <a href="'.url('client/tugas-detail/'.$this->id_tugas).'" class="text-info">Selesaikan</a>';
        }else{
            return ' <a href="javascript:;" class="text-muted">Selesai</a>';
        }
    }
    public function withTugasSelesaiBg()
    {
        $jawaban = MJawaban::where('id_tugas',$this->id_tugas)->where('id_siswa',Auth::guard('siswa')->user()->id_siswa)->first();
        if($jawaban == null){
            return 'border border-success';
        }else{
            return 'bg-secondary text-white-important';
        }
    }
    public function link()
    {
        $jawaban = MJawaban::where('id_tugas',$this->id_tugas)->where('id_siswa',Auth::guard('siswa')->user()->id_siswa)->first();
        if($jawaban == null){
            return url('client/tugas-detail/'.$this->id_tugas);
        }else{
            return '#';
        }
    }

}

<?php

namespace App\Http\Traits;

use App\Models\DataSiswa;
use Illuminate\Support\Facades\Storage;

trait Siswa
{
    public function getSiswaWhereKelasAjax($id_kelas)
    {
        $siswa = DataSiswa::where("kelas", $id_kelas)->get();
        return response()->json(['status' => true, 'data' => $siswa]);
    }
}

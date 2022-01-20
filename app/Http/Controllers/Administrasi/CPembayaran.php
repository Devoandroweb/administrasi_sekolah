<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\DataSiswa;
use App\Models\MAdministrasi;
use App\Models\MKelas;
use App\Models\ModelTangunganSebelumnya;
use App\Models\MTanggungaSebelumnya;
use Illuminate\Http\Request;

class CPembayaran extends Controller
{
    public function index()
    {
        $kelas = MKelas::select("m_kelas.*", "m_jurusan.id_jurusan", "m_jurusan.nama as nama_jurusan")
            ->join("m_jurusan", "m_jurusan.id_jurusan", "=", "m_kelas.id_jurusan", "LEFT")->get();
        return view("template.pembayaran")
            ->with('kelas', $kelas)
            ->with('title', 'Pembayaran');
    }
    public function getSiswa($id)
    {
        $mSiswa = DataSiswa::where("kelas", $id)->get();
        return response()->json(['status' => true, 'data' => $mSiswa]);
    }
    public function getDataBiaya($id)
    {
        $mAdm = Administrasi::select("data_siswa.*", "administrasi.*")
            ->join("data_siswa", "data_siswa.id_siswa", "=", "administrasi.id_siswa", "LEFT")
            ->where("administrasi.id_siswa", $id)->first();
        $mAdmBefore = MTanggungaSebelumnya::where("no_induk", $mAdm->no_induk)->get();

        return response()->json(['status' => true, 'data' => json_decode($mAdm->value), 'data_before' => $mAdmBefore]);
    }
    public function save(Request $request)
    {
        dd($request->all());
        $mAdm = MAdministrasi::where("id_siswa", $request->siswa)->first();
    }
}

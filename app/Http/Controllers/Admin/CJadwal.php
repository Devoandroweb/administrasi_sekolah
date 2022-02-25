<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\GF;
use App\Models\MGuru;
use App\Models\MJadwal;
use App\Models\MKelas;
use App\Models\MMapel;

class CJadwal extends Controller
{
    public function index()
    {
        $title = "Jadwal Pelajaran";
        $kelas = MKelas::select("m_kelas.id_kelas", "m_kelas.nama as nama_kelas", "m_jurusan.nama as nama_jurusan", "m_jurusan.*")
            ->join("m_jurusan", "m_jurusan.id_jurusan", "=", "m_kelas.id_jurusan", "left")->get();
        // dd($kelas);
        $jadwal = MJadwal::select("jadwal.*", "m_guru.*", "m_guru.nama as nama_guru", "m_mapel.*", "m_mapel.nama as nama_mapel", "m_guru.kode as kode_guru")
            ->join("m_guru", "jadwal.id_guru", "=", "m_guru.id_guru", "left")
            ->join("m_mapel", "jadwal.id_mapel", "=", "m_mapel.id_mapel", "left")
            ->orderBy("hari", "asc")->get();
        return view("admin.jadwal.index")
            ->with("title", $title)
            ->with("kelas", $kelas)
            ->with("jadwal", $jadwal);
    }
    public function show($id)
    {
        $title = "Edit Jadwal Pelajaran per Hari " . ucwords(GF::convertDayJadwal($id));
        $kelas = MKelas::select("m_kelas.*", "m_jurusan.*", "m_jurusan.nama as nama_jurusan", "m_kelas.nama as nama_kelas")
            ->join("m_jurusan", "m_jurusan.id_jurusan", "=", "m_kelas.id_jurusan", "left")
            ->orderBy("nama_kelas", "asc")
            ->get();
        $guru = MGuru::get();
        $mapel = MMapel::get();
        $jadwal = MJadwal::where("hari", $id)->get();
        return view("admin.jadwal.edit")
            ->with("day", $id)
            ->with("kelas", $kelas)
            ->with("jadwal", $jadwal)
            ->with("guru", $guru)
            ->with("mapel", $mapel)
            ->with("title", $title);
    }
    public function save($day,Request $request)
    {
        // dd($request->all());
        MJadwal::truncate();
        // Kelas
        $data = $request->data;
        // Pengajar
        $pengajar = $request->pengajar;
        $mapel = $request->mapel;

        $i = 0;
        foreach($data as $dat){
            $kelasAndJam = explode("-",$dat);
            $jadwal = new MJadwal;
            $jadwal->hari = $day;
            $jadwal->jam_ke = $kelasAndJam[1];
            $jadwal->id_kelas = $kelasAndJam[0];
            $jadwal->id_guru = $pengajar[$i];
            $jadwal->id_mapel = $mapel[$i];
            $jadwal->save();
            $i++;
        }

        redirect()->back()->with("msg","Sukses Update Jadwal .... ");
    }
}

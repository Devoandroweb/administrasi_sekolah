<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\MAdministrasi;
use App\Models\MJenisAdministrasi;
use App\Models\MKelas;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        $total_siswa = DB::table('data_siswa')->where('kelas', '>=', 10)->count();
        $total_siswa_alumni = DB::table('data_siswa')->where('kelas', '=', 0)->count();

        $data_pemasukan = DB::table('pemasukan')
            ->join('data_siswa', 'pemasukan.id_siswa', '=', 'data_siswa.id_siswa')
            ->select('pemasukan.*', 'data_siswa.nama', 'data_siswa.kelas', 'data_siswa.rombel')
            ->orderBy('id_pemasukan', 'desc')
            ->limit(3)
            ->get();
        $pemasukan = DB::table('pemasukan')->select('*')->get();
        // $date_pemasukan = DB::table('pemasukan')->max('id_pemasukan');
        //select max 
        $date_pemasukan_max = \DB::table('pemasukan')->where('id_pemasukan', \DB::raw("(select max(`id_pemasukan`) from pemasukan)"))->first();
        $date_siswa_max = \DB::table('data_siswa')->where('id_siswa', \DB::raw("(select max(`id_siswa`) from data_siswa)"))->first();
        $date_pengeluaran_max = \DB::table('pengeluaran')->where('id_pengeluaran', \DB::raw("(select max(`id_pengeluaran`) from pengeluaran)"))->first();
        //pengeluaran
        $data_pengeluaran = DB::table('pengeluaran')->select('uraian')->get();

        $json_uraian = json_decode($data_pengeluaran);
        $total_data_pengeluaran = 0;
        if (count($json_uraian) == 0) {
            $json_uraian = "Data Kosong";
        } else {
            for ($i = 0; $i < count($json_uraian); $i++) {
                # code...
                $data = json_decode($json_uraian[$i]->uraian);

                for ($a = 0; $a < count($data); $a++) {
                    $total_data_pengeluaran = $total_data_pengeluaran + intval($data[$a]->value);
                    // $array[] = intval($data[$a]->value);
                }
            }
        }


        $total_pemasukan_all = 0;
        foreach ($pemasukan as $key) {
            $uraian = json_decode($key->uraian);
            $total_pemasukan = 0;
            $total_pemasukan = $total_pemasukan + intval($uraian->spp);
            $total_pemasukan = $total_pemasukan + intval($uraian->psb);
            $total_pemasukan = $total_pemasukan + intval($uraian->uts_1);
            $total_pemasukan = $total_pemasukan + intval($uraian->uts_2);
            $total_pemasukan = $total_pemasukan + intval($uraian->pas_1);
            $total_pemasukan = $total_pemasukan + intval($uraian->pas_2);
            $total_pemasukan = $total_pemasukan + intval($uraian->lks_1);
            $total_pemasukan = $total_pemasukan + intval($uraian->lks_2);

            $total_pemasukan_all = $total_pemasukan_all + $total_pemasukan;
        }




        return view(
            'administrasi.dashboard',
            [
                'active' => '1',
                'total_siswa' => $total_siswa,
                'total_siswa_alumni' => $total_siswa_alumni,
                'data_pemasukan' => $data_pemasukan,
                'data_pengeluaran' => $total_data_pengeluaran,
                'total_pemasukan_all' => $total_pemasukan_all,
                'max_date_pemasukan' => $date_pemasukan_max,
                'max_date_siswa' => $date_siswa_max,
                'max_date_pengeluaran' => $date_pengeluaran_max,
                'title' => 'Dashboard',
            ]
        );
    }
    public function pemasukan()
    {
        return view('administrasi.pemasukan', ['active' => '2', 'title' => 'Pemasukan']);
    }
    public function pengeluaran()
    {
        return view('administrasi.pengeluaran', ['active' => '3', 'title' => 'Pengeluaran']);
    }
    public function administrasi()
    {
        $data = MAdministrasi::get();
        $jenisAdm = MJenisAdministrasi::where('deleted', 1)->get();
        $jenisAdmArray = [];
        foreach ($jenisAdm as $key) {
            array_push($jenisAdmArray, ['id' => $key->id, 'nama' => $key->nama]);
        }
        // dd($jenisAdmArray);
        return view('administrasi.administrasi')
            ->with('active', '4')
            ->with('title', 'Administrasi')
            ->with('jenis_adm_array', $jenisAdmArray)
            ->with('ijazah', $data);
    }
    public function tanggungan_ijazah()
    {
        return view('administrasi.tanggungan_ijazah', ['active' => '4', 'title' => 'Tanggungan Ijazah']);
    }
    public function siswa()
    {
        $kelas = MKelas::select("m_kelas.*", "m_jurusan.id_jurusan", "m_jurusan.nama as nama_jurusan")
            ->join("m_jurusan", "m_jurusan.id_jurusan", "=", "m_kelas.id_jurusan", "left")
            ->get();
        return view('administrasi.siswa')
            ->with("title", "Siswa")
            ->with("active", "5")
            ->with("kelas", $kelas);
    }
    public function alumni()
    {
        return view('administrasi.alumni', ['active' => '5', 'title' => 'Alumni']);
    }
    public function riwayat_laporan()
    {
        return view('administrasi.riwayat_laporan', ['active' => '6', 'title' => 'Riwayat Laporan']);
    }
    public function rekapitulasi()
    {
        return view('administrasi.rekapitulasi', ['active' => '7', 'title' => 'Rekapitulasi']);
    }
    public function tanggungan_lalu()
    {
        return view('administrasi.tanggungan_lalu', ['active' => '8', 'title' => 'Tanggungan Lalu']);
    }
}

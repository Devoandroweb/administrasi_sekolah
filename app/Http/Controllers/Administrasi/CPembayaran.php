<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\DataSiswa;
use App\Models\HTransaksi;
use App\Models\MAdministrasi;
use App\Models\MKelas;
use App\Models\ModelTangunganSebelumnya;
use App\Models\MRekapitulasi;
use App\Models\MTanggungaSebelumnya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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
        // dd($request->all());
$strukWA = "";
$strukWA = "Terima Kasih,
Pembayaran atas nama M. Fathur 
telah kami terima dengan 
Dengan detail pembayaran sebagai berikut:

# Tanggungan Pada Tahun Ajaran 2021 - 2022 # 
1. SPP Rp. 90.000 

# Tanggungan Pada Tahun Ajaran 2019 - 2020 # 
1. SPP Rp. 90.000 

# Total # 
Rp. 160.000 

# Uang Diterima # 
Rp. 200.000 

# Uang Kembalian # 
Rp. 40.000 

------------------------------------------------- 
Tanggungan yang harus di bayar selanjutnya : 
1. SPP (2019-2020) : Rp. 50.000 ";
        $res = Http::get("http://localhost:8000/send-message",[
            'number' => "6282132728556@c.us",
            'msg' => $strukWA
        ]);
        dd($res);
        $siswa = DataSiswa::select("data_siswa.*", "data_siswa.nama as nama_siswa", "m_kelas.id_kelas", "m_kelas.nama as nama_kelas", "m_jurusan.*", "m_jurusan.nama as nama_jurusan")
            ->join("m_kelas", "data_siswa.kelas", "=", "m_kelas.id_kelas", "left")
            ->join("m_jurusan", "m_kelas.id_jurusan", "=", "m_kelas.id_jurusan", "left")
            ->where("data_siswa.id_siswa", $request->siswa)->first();
        $maksIdHT = HTransaksi::max("id_transaksi");
        $tanggal_trans = date("Y-m-d H:i:s");
        $trans_penerima = Auth::user()->name;
        $nama_siswa = $siswa->nama_siswa;
        $nis = $siswa->no_induk;
        $kelas = $siswa->nama_kelas . " " . $siswa->nama_jurusan;
        $tgg_now = [];
        $tgg_prev = [];
        $kode_trans = "TH-" . date("Ymdhis") . $maksIdHT + 1;
        $total_tanggungan_trans = 0;
        $trans_terbayar = 0;

        if (isset($request->bdasarid)) {
            ### ADMINISTRASI NOW ###
            $mAdm = MAdministrasi::where("id_siswa", $request->siswa)->first();
            $value = json_decode($mAdm->value);
            if ($mAdm != null) {
                for ($i = 0; $i < count($request->bdasarid); $i++) {
                    for ($j = 0; $j < count($value); $j++) {
                        $total_tanggungan_trans = $total_tanggungan_trans + intval($value[$j]->value_adm);
                        if ($value[$j]->id_jenis_adm == $request->bdasarid[$i]) {
                            $value[$j]->value_adm =  intval($value[$j]->value_adm) - intval(str_replace(".", "", $request->bdasar[$i]));
                            //set ke session
                            array_push($tgg_now, [
                                "name" => $value[$j]->nama_adm,
                                "value" => intval(str_replace(".", "", $request->bdasar[$i]))
                            ]);
                            $trans_terbayar =  $trans_terbayar + intval(str_replace(".", "", $request->bdasar[$i]));
                        }
                    }
                }
            }
        }
        if (isset($request->bjtid)) {
            ### ADMINISTRASI BEFORE ###

            for ($q = 0; $q < count($request->bjtid_admbefore); $q++) {
                $mAdmBefore = MTanggungaSebelumnya::where("id_tgg_prev", $request->bjtid_admbefore[$q])->first();

                if ($mAdmBefore != null) {
                    $valueBJT = json_decode($mAdmBefore->value);
                    for ($j = 0; $j < count($valueBJT); $j++) {
                        if ($valueBJT[$j]->id_jenis_adm == $request->bjtid[$q]) {
                            $valueBJT[$j]->value_adm =  intval($valueBJT[$j]->value_adm) - intval(str_replace(".", "", $request->bjt[$q]));
                            //set ke session
                            array_push($tgg_prev, [
                                "tahun_ajaran" => $mAdmBefore->tahun_ajaran,
                                "name" => $valueBJT[$j]->nama_adm,
                                "value" => intval(str_replace(".", "", $request->bjt[$q]))
                            ]);
                            $trans_terbayar =  $trans_terbayar + intval(str_replace(".", "", $request->bjt[$q]));
                        }
                    }
                    $mAdmBefore->value = json_encode($valueBJT);
                    $mAdmBefore->update();
                }
                // dd($mAdmBefore);
            }
        }
        $mAdm->value = json_encode($value);
        $mAdm->update();
        $prev_now = array_merge($tgg_now, $tgg_prev);
        $uraian = [
            "nama_siswa" => $nama_siswa,
            "no_induk" => $nis,
            "uraian" => $prev_now
        ];
        //MASUKKAN KE PEMASUKAN
        $pemasukan = new MRekapitulasi;
        $pemasukan->dari = 1;
        $pemasukan->jenis = 1;
        $pemasukan->tanggal = date("Y-m-d H:i:s");

        $pemasukan->uraian = json_encode($uraian);
        $pemasukan->masuk = $trans_terbayar;
        $pemasukan->saldo = $pemasukan->saldo + $trans_terbayar;
        $pemasukan->save();


        # MASUKKAN KE HISTORY TRANSAKSI #
        $hTransaksi = new HTransaksi;
        $hTransaksi->kode = $kode_trans;
        $hTransaksi->tanggal = $tanggal_trans;
        $hTransaksi->penerima = $trans_penerima;
        $hTransaksi->nama_siswa = $nama_siswa;
        $hTransaksi->no_induk = $nis;
        $hTransaksi->kelas = $kelas;
        $hTransaksi->tgg_now = json_encode($tgg_now);
        $hTransaksi->tgg_prev = json_encode($tgg_prev);
        $hTransaksi->total = $total_tanggungan_trans;
        $hTransaksi->terbayar = $trans_terbayar;
        $hTransaksi->save();

        //kirim notif
        

        return redirect(url("cetak_struk/" . Crypt::encryptString($hTransaksi->kode)));
    }
    public function cetakStruk($kode)
    {
        $kodeDec = Crypt::decryptString($kode);
        return view("administrasi.template.cetak_struk")->with("kode", $kodeDec);
    }
}

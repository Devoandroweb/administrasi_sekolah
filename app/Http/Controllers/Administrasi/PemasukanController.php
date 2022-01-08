<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;
use App\Helpers\Time;
use Illuminate\Support\Facades\View;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $data = DB::table('pemasukan')
            ->join('data_siswa', 'pemasukan.no_induk_siswa', '=', 'data_siswa.no_induk')
            ->select('pemasukan.*', 'data_siswa.nama', 'data_siswa.kelas', 'data_siswa.rombel')
            ->get();

        return view('administrasi.template.cetak_pemasukan', ['data_pemasukan' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $time_insert = date('Y-m-d H:i:s');

        DB::table('riwayat_laporan')->insert(['jenis_laporan' => 'Pemasukan', 'created_at' => $time_insert]);
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // date_default_timezone_set('Asia/Jakarta');
        // $date = Carbon::createFromDate(1945, 8, 17);
        // dd($date->diffForHumans());



        // proses simpan data
        $total = 0;

        $spp =  str_replace(",", "", $request->spp);
        $psb =  str_replace(",", "", $request->psb);
        $uts_1 = str_replace(",", "", $request->uts_1);
        $uts_2 = str_replace(",", "", $request->uts_2);
        $pas_1 = str_replace(",", "", $request->pas_1);
        $pas_2 = str_replace(",", "", $request->pas_2);
        $lks_1 =  str_replace(",", "", $request->lks_1);
        $lks_2 =  str_replace(",", "", $request->lks_2);
        $unas =  str_replace(",", "", $request->unas);
        $daftar_ulang =  str_replace(",", "", $request->daftar_ulang);

        $uraian = array(
            'spp' => $spp,
            'psb' => $psb,
            'uts_1' => $uts_1,
            'uts_2' => $uts_2,
            'pas_1' => $pas_1,
            'pas_2' => $pas_2,
            'lks_1' => $lks_1,
            'lks_2' => $lks_2,
            'unas' => $unas,
            'daftar_ulang' => $daftar_ulang,
        );

        $total = $total + intval($spp);
        $total = $total + intval($psb);
        $total = $total + intval($uts_1);
        $total = $total + intval($uts_2);
        $total = $total + intval($pas_1);
        $total = $total + intval($pas_2);
        $total = $total + intval($lks_1);
        $total = $total + intval($lks_2);
        $total = $total + intval($unas);
        $total = $total + intval($daftar_ulang);

        if ($request->tgg_prev != null) {
            for ($i = 0; $i < count($request->tgg_prev); $i++) {
                $total = $total + intval($request->tgg_prev[$i]['value']);
            }
            $uraian['tanggunganprev'] = $request->tgg_prev;
        } else {
            $uraian['tanggunganprev'] = [];
        }

        $id_siswa = $request->no_induk;
        //cetak struk
        $siswa = DB::table('data_siswa')->where('no_induk', $id_siswa)->select('*')->first();
        $trans_administrasi = DB::table('administrasi')->select("*")->where("no_induk_adm", $request->no_induk)->limit(1)->get();
        $trans_tanggungan_prev = DB::table('tanggunganprev')->select("*")->where("no_induk_siswa", $request->no_induk)->get();
        $total_tgg_prev = 0;
        $total_administrasi = 0;

        foreach ($trans_administrasi as $key) {
            $total_administrasi = $total_administrasi + $key->spp;
            $total_administrasi = $total_administrasi + $key->psb;
            $total_administrasi = $total_administrasi + $key->uts_1;
            $total_administrasi = $total_administrasi + $key->uts_2;
            $total_administrasi = $total_administrasi + $key->pas_1;
            $total_administrasi = $total_administrasi + $key->pas_2;
            $total_administrasi = $total_administrasi + $key->lks_1;
            $total_administrasi = $total_administrasi + $key->lks_2;
            $total_administrasi = $total_administrasi + $key->unas;
            $total_administrasi = $total_administrasi + $key->daftar_ulang;
        }
        foreach ($trans_tanggungan_prev as $key) {
            $total_tgg_prev = $total_tgg_prev + $key->spp;
            $total_tgg_prev = $total_tgg_prev + $key->psb;
            $total_tgg_prev = $total_tgg_prev + $key->uts_1;
            $total_tgg_prev = $total_tgg_prev + $key->uts_2;
            $total_tgg_prev = $total_tgg_prev + $key->pas_1;
            $total_tgg_prev = $total_tgg_prev + $key->pas_2;
            $total_tgg_prev = $total_tgg_prev + $key->lks_1;
            $total_tgg_prev = $total_tgg_prev + $key->lks_2;
            $total_tgg_prev = $total_tgg_prev + $key->unas;
            $total_tgg_prev = $total_tgg_prev + $key->daftar_ulang;
        }
        $trans_terbayar = $total;
        $total_tanggungan_all = $total_administrasi + $total_tgg_prev;

        if ($total_tanggungan_all == 0) {
            $trans_terbayar = 0;
        }
        $trans_nama = $siswa->nama;
        $trans_kelas = $siswa->kelas . " " . $siswa->rombel;
        $trans_nis = $siswa->no_induk;
        $trans_penerima = "Uswatun Hasanah";
        $tanggal_trans = Carbon::now()->toDateTimeString();
        $tanggal_cetak_trans = Carbon::now()->toDateTimeString();
        $total_tanggungan_trans = $total_tanggungan_all;

        $uraian_trans = $uraian;

        session([
            'trans_nama' => $trans_nama,
            'trans_kelas' =>  $trans_kelas,
            'trans_nis' => $trans_nis,
            'trans_penerima' => $trans_penerima,
            'tanggal_trans' => $tanggal_trans,
            'tanggal_cetak_trans' => $tanggal_cetak_trans,
            'total_tanggungan_trans' => $total_tanggungan_trans,
            'trans_terbayar' => $trans_terbayar,
            'uraian_trans' => $uraian_trans,
        ]);
        $adm = DB::table('administrasi')
            ->join('data_siswa', 'administrasi.no_induk_adm', '=', 'data_siswa.no_induk')
            ->select('administrasi.*', 'data_siswa.nama')
            ->where('no_induk', $id_siswa)
            ->first();
        if ($adm == null) {
            return json_encode(array('statusCode' => 505));
        } else {


            $nama = str_replace(" ", "_", $adm->nama);
            $pesan = "Siswa_yang_Benama_*" . $nama . "*--Telah_membayar_administrasi_sekolah_sebagai_berikut_:";
            if ($request->spp != 0) {
                $pesan .= "--SPP_(_Rp." . $request->spp . "_)";
            }
            if ($request->psb != 0) {
                $pesan .= "--PSB_(_Rp." . $request->psb . "_)";
            }
            if ($request->uts_1 != 0) {
                $pesan .= "--UTS_1_(_Rp." . $request->uts_1 . "_)";
            }
            if ($request->uts_2 != 0) {
                $pesan .= "--UTS_2_(_Rp." . $request->uts_2 . "_)";
            }
            if ($request->pas_1 != 0) {
                $pesan .= "--PAS_1_(_Rp." . $request->pas_1 . "_)";
            }
            if ($request->pas_2 != 0) {
                $pesan .= "--PAS_2_(_Rp." . $request->pas_2 . "_)";
            }
            if ($request->lks_1 != 0) {
                $pesan .= "--LKS_1_(_Rp." . $request->lks_1 . "_)";
            }
            if ($request->lks_2 != 0) {
                $pesan .= "--LKS_1_(_Rp." . $request->lks_2 . "_)";
            }
            if ($request->unas != 0) {
                $pesan .= "--UNAS_(_Rp." . $request->unas . "_)";
            }
            if ($request->daftar_ulang != 0) {
                $pesan .= "--Daftar_Ulang_(_Rp." . $request->daftar_ulang . "_)";
            }
            // dd($adm);
            //administrasi 
            $up_spp = $adm->spp - intval($spp);
            $up_psb = $adm->psb - intval($psb);
            $up_uts_1 = $adm->uts_1 - intval($uts_1);
            $up_uts_2 = $adm->uts_2 - intval($uts_2);
            $up_pas_1 = $adm->pas_1 - intval($pas_1);
            $up_pas_2 = $adm->pas_2 - intval($pas_2);
            $up_lks_1 = $adm->lks_1 - intval($lks_1);
            $up_lks_2 = $adm->lks_2 - intval($lks_2);
            $up_unas = $adm->unas - intval($unas);
            $up_daftar_ulang = $adm->daftar_ulang - intval($daftar_ulang);


            if ($up_spp < 0) {
                $up_spp = 0;
            }
            if ($up_psb < 0) {
                $up_psb = 0;
            }
            if ($up_uts_1 < 0) {
                $up_uts_1 = 0;
            }
            if ($up_uts_2 < 0) {
                $up_uts_2 = 0;
            }
            if ($up_pas_1 < 0) {
                $up_pas_1 = 0;
            }
            if ($up_pas_2 < 0) {
                $up_pas_2 = 0;
            }
            if ($up_lks_1 < 0) {
                $up_lks_1 = 0;
            }
            if ($up_lks_2 < 0) {
                $up_lks_2 = 0;
            }
            if ($up_unas < 0) {
                $up_unas = 0;
            }
            if ($up_daftar_ulang < 0) {
                $up_daftar_ulang = 0;
            }
            DB::table('administrasi')
                ->where('no_induk_adm', $id_siswa)
                ->update([
                    'spp' => $up_spp,
                    'psb' => $up_psb,
                    'uts_1' =>  $up_uts_1,
                    'uts_2' => $up_uts_2,
                    'pas_1' => $up_pas_1,
                    'pas_2' =>  $up_pas_2,
                    'lks_1' =>  $up_lks_1,
                    'lks_2' =>  $up_lks_2,
                    'unas' => $up_unas,
                    'daftar_ulang' => $up_daftar_ulang
                ]);
            //tgg prev


            if ($request->tgg_prev != null) {
                $data_tgg_prev_from_pemasukan = $request->tgg_prev;

                for ($i = 0; $i < count($data_tgg_prev_from_pemasukan); $i++) {
                    $array_tgg_prev_update = [];
                    $kelas = $data_tgg_prev_from_pemasukan[$i]['kelas'];

                    $tggprev = DB::table('tanggunganprev')
                        ->join('data_siswa', 'tanggunganprev.no_induk_siswa', '=', 'data_siswa.no_induk')
                        ->select('tanggunganprev.*', 'data_siswa.nama')
                        ->where([['no_induk_siswa', $id_siswa], ['kelas_prev', $kelas]])
                        ->first();


                    $key = strtolower(str_replace(" ", "_", $data_tgg_prev_from_pemasukan[$i]['tgg']));

                    $hasil =  $tggprev->$key - intval($data_tgg_prev_from_pemasukan[$i]['value']);
                    if ($hasil < 0) {
                        $array_tgg_prev_update[$key] = 0;
                    } else {
                        $array_tgg_prev_update[$key] = $hasil;
                    }



                    DB::table('tanggunganprev')
                        ->where([['no_induk_siswa', $id_siswa], ['kelas_prev', $kelas]])
                        ->update($array_tgg_prev_update);
                }
            }
            DB::table('pemasukan')->insert(
                ['no_induk_siswa' => $request->no_induk, 'uraian' => json_encode($uraian), 'total' => $total, 'created_at' => Carbon::now()->toDateTimeString()]
            );

            // dd($siswa);

            return json_encode(array(
                "statusCode" => 200,
                "no_tlp" => $siswa->no_tlp,
                "pesan" => $pesan

            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = DB::table('pemasukan')
            ->join('data_siswa', 'pemasukan.no_induk_siswa', '=', 'data_siswa.no_induk')
            ->select('pemasukan.*', 'data_siswa.nama')
            ->where('id_pemasukan', $id)
            ->limit(1)
            ->first();
        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $spp =  str_replace(",", "", $request->up_spp);
        $psb =  str_replace(",", "", $request->up_psb);
        $uts_1 = str_replace(",", "", $request->up_uts_1);
        $uts_2 = str_replace(",", "", $request->up_uts_2);
        $pas_1 = str_replace(",", "", $request->up_pas_1);
        $pas_2 = str_replace(",", "", $request->up_pas_2);
        $lks_1 =  str_replace(",", "", $request->up_lks_1);
        $lks_2 =  str_replace(",", "", $request->up_lks_2);
        $unas =  str_replace(",", "", $request->up_unas);
        $daftar_ulang =  str_replace(",", "", $request->daftar_ulang);
        $total = 0;
        $uraian = array(
            'spp' => $spp,
            'psb' => $psb,
            'uts_1' => $uts_1,
            'uts_2' => $uts_2,
            'pas_1' => $pas_1,
            'pas_2' => $pas_2,
            'lks_1' => $lks_1,
            'lks_2' => $lks_2,
            'unas' => $unas,
            'daftar_ulang' => $daftar_ulang,
            'tanggunganprev' => json_decode($request->up_tanggunganprev)

        );
        $total = $total + intval($spp);
        $total = $total + intval($psb);
        $total = $total + intval($uts_1);
        $total = $total + intval($uts_2);
        $total = $total + intval($pas_1);
        $total = $total + intval($pas_2);
        $total = $total + intval($lks_1);
        $total = $total + intval($lks_2);
        $total = $total + intval($unas);
        $total = $total + intval($daftar_ulang);
        $tgg_prev_json = json_decode($request->up_tanggunganprev);

        for ($i = 0; $i < count($tgg_prev_json); $i++) {
            $total = $total + intval($tgg_prev_json[$i]->value);
        }
        $data = DB::table('pemasukan')
            ->where('id_pemasukan', $id)
            ->update([
                'uraian' => json_encode($uraian),
                'total' => $total
            ]);
        return json_encode($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = DB::table('pemasukan')->where('id_pemasukan', $id)->delete();
        return json_encode($data);
    }
    public function jsonpemasukan($status, $tanggalawal, $tanggalakhir)
    {
        if ($status == 1) {
            $query = DB::table('pemasukan')
                ->join('data_siswa', 'pemasukan.no_induk_siswa', '=', 'data_siswa.no_induk')
                ->select('pemasukan.*', 'data_siswa.nama', 'data_siswa.kelas', 'data_siswa.rombel')
                ->where([
                    ['pemasukan.created_at', '>=', $tanggalawal],
                    ['pemasukan.created_at', '<=', $tanggalakhir],
                ])
                ->get();
        } elseif ($status == 0) {
            $query = DB::table('pemasukan')
                ->join('data_siswa', 'pemasukan.no_induk_siswa', '=', 'data_siswa.no_induk')
                ->select('pemasukan.*', 'data_siswa.nama', 'data_siswa.kelas', 'data_siswa.rombel')
                ->get();
        }

        return DataTables::of($query)
            ->addColumn('tanggalfix', function ($row) {
                $date = $row->created_at;
                $date_indo = Time::time_indo_convert(strtotime($date));
                return $date_indo[0];
            })
            ->addColumn('uraianfix', function ($row) {
                $uraian = json_decode($row->uraian);

                $html = "<ul>";

                if ($uraian->spp != "") {
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>SPP</label><span class='linumeric float-right'>" . $uraian->spp . "</span>";
                }
                if ($uraian->psb != "") {
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>PSB</label><span class='linumeric float-right'>" . $uraian->psb . "</span>";
                }
                if ($uraian->uts_1 != "") {
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>UTS 1</label><span class='linumeric float-right'>" . $uraian->uts_1 . "</span>";
                }
                if ($uraian->uts_2 != "") {
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>UTS 2</label><span class='linumeric float-right'>" . $uraian->uts_2 . "</span>";
                }
                if ($uraian->pas_1 != "") {
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>PAS 1</label><span class='linumeric float-right'>" . $uraian->pas_1 . "</span>";
                }
                if ($uraian->pas_2 != "") {
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>PAS 2</label><span class='linumeric float-right'>" . $uraian->pas_2 . "</span>";
                }
                if ($uraian->lks_1 != "") {
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>LKS 1</label><span class='linumeric float-right'>" . $uraian->lks_1 . "</span>";
                }
                if ($uraian->lks_2 != "") {
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>LKS 2</label><span class='linumeric float-right'>" . $uraian->lks_2 . "</span>";
                }
                if ($uraian->unas != "") {
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>UNAS </label><span class='linumeric float-right'>" . $uraian->unas . "</span>";
                }
                if ($uraian->daftar_ulang != "") {
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>Daftar Ulang</label><span class='linumeric float-right'>" . $uraian->daftar_ulang . "</span>";
                }


                // dd($uraian->tanggunganprev[0]->value);
                if (count($uraian->tanggunganprev) != 0) {
                    $html .= "<div><div class='badge badge-danger'>Tanggungan Sebelumnya :</div><div>";

                    for ($i = 0; $i < count($uraian->tanggunganprev); $i++) {
                        $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>" . $uraian->tanggunganprev[$i]->tgg . "-" . $uraian->tanggunganprev[$i]->kelas . "</label><span class='linumeric float-right'>" . $uraian->tanggunganprev[$i]->value . "</span>";
                    }
                }
                $html .= "</li></ul>";
                return $html;
            })
            ->addColumn('kelas', function ($row) {
                $kelas = $row->kelas . " " . $row->rombel;
                return $kelas;
            })
            ->addColumn('total', function ($row) {
                $uraian = json_decode($row->uraian);
                $total = 0;
                $total = $total + intval($uraian->spp);
                $total = $total + intval($uraian->psb);
                $total = $total + intval($uraian->uts_1);
                $total = $total + intval($uraian->uts_2);
                $total = $total + intval($uraian->pas_1);
                $total = $total + intval($uraian->pas_2);
                $total = $total + intval($uraian->lks_1);
                $total = $total + intval($uraian->lks_2);
                $total = $total + intval($uraian->unas);
                $total = $total + intval($uraian->daftar_ulang);
                if (count($uraian->tanggunganprev) != 0) {


                    for ($i = 0; $i < count($uraian->tanggunganprev); $i++) {
                        $total = $total + $uraian->tanggunganprev[$i]->value;
                    }
                }
                return $total;
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn = $btn . '<a id="' . $row->id_pemasukan . '" href="javascript:void(0)" class="btn btn-primary edit btn-sm"> <i class="material-icons">edit</i> Edit</a>';
                $btn = $btn . '<a id="' . $row->id_pemasukan . '" href="javascript:void(0)" class="btn btn-warning hapus btn-sm"> <i class="material-icons">delete</i> Hapus</a>';

                return $btn;
            })
            ->rawColumns(['tanggalfix', 'kelas', 'action', 'total', 'uraianfix'])
            ->addIndexColumn()
            ->toJson();
    }
    public function chart()
    {
        $pemasukan = DB::table('pemasukan')->select('id_pemasukan', 'total')->orderBy('id_pemasukan', 'desc')->limit(2)->get();
        $data = DB::table('pemasukan')->select('total')->limit('7')->get();
        $array = array('data' => $data, 'pemasukan' => $pemasukan);
        return json_encode($array);
    }
    public function cetak_struk()
    {


        return view('administrasi.template/cetak_struk');
    }
}

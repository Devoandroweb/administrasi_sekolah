<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DataTables;
use PDF;
use Illuminate\Support\Facades\DB;

class TanggunganlaluController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('tanggunganprev')
            ->join('data_siswa', 'tanggunganprev.no_induk_siswa', '=', 'data_siswa.no_induk')
            ->select('tanggunganprev.*', 'data_siswa.nama')
            ->orderBy('kelas_prev')
            ->get();

        return view('administrasi.template.cetak_tanggungan_lalu', ['tanggunganprev' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data = DB::table('tanggunganprev')
            ->where('id_tgg_prev', $id)
            ->update([
                'spp' => str_replace(",", "", $request->spp),
                'psb' => str_replace(",", "", $request->psb),
                'uts_1' => str_replace(",", "", $request->uts_1),
                'uts_2' => str_replace(",", "", $request->uts_2),
                'pas_1' => str_replace(",", "", $request->pas_1),
                'pas_2' => str_replace(",", "", $request->pas_2),
                'lks_1' => str_replace(",", "", $request->lks_1),
                'lks_2' => str_replace(",", "", $request->lks_2),
                'unas' => str_replace(",", "", $request->unas),
                'daftar_ulang' => str_replace(",", "", $request->daftar_ulang),
            ]);
        return json_encode(array(
            "statusCode" => 200
        ));
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

        DB::table('tanggunganprev')->where('id_tgg_prev', $id)->delete();
        return json_encode(array(
            "statusCode" => 200
        ));
    }
    public function json_tanggungan_lalu()
    {
        $query = DB::table('tanggunganprev')
            ->join('data_siswa', 'tanggunganprev.no_induk_siswa', '=', 'data_siswa.no_induk')
            ->select('tanggunganprev.*', 'data_siswa.nama', 'data_siswa.kelas', 'data_siswa.rombel')
            ->get();

        return DataTables::of($query)
            ->addColumn('total', function ($row) {
                $total = 0;
                $total = $total + $row->spp;
                $total = $total + $row->psb;
                $total = $total + $row->uts_1;
                $total = $total + $row->uts_2;
                $total = $total + $row->pas_1;
                $total = $total + $row->pas_2;
                $total = $total + $row->lks_1;
                $total = $total + $row->lks_2;
                $total = $total + $row->unas;
                $total = $total + $row->daftar_ulang;
                return $total;
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn = $btn . '<a id="' . $row->id_tgg_prev . '" data-toggle="tooltip" data-placement="top" title="Edit Data Tanggunga Lalu per Siswa" href="javascript:void(0)" class="btn btn-primary edit btn-sm"> <i class="material-icons">edit</i></a>';
                $btn = $btn . '<a id="' . $row->id_tgg_prev . '" class="btn btn-danger hapus btn-sm" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Hapus Data per Siswa"> <i class="material-icons">delete</i></a>';
                return $btn;
            })
            ->rawColumns(['kelas', 'action', 'total'])
            ->addIndexColumn()
            ->toJson();
    }
    public function get_tanggungan_lalu_by($id)
    {
        $data = DB::table('tanggunganprev')
            ->join('data_siswa', 'data_siswa.no_induk', '=', 'tanggunganprev.no_induk_siswa')
            ->select('tanggunganprev.*', 'data_siswa.nama')
            ->where('id_tgg_prev', $id)
            ->limit(1)
            ->first();

        return json_encode($data);
    }
    public function update_tggprev()
    {

        $siswa = DB::table('data_siswa')->select("*")->get();
        $data_administrasi = DB::table('administrasi')
            ->join('data_siswa', 'administrasi.no_induk_adm', '=', 'data_siswa.no_induk')
            ->select('*', 'data_siswa.nama', 'data_siswa.kelas', 'data_siswa.rombel')
            ->get();
        $tahun_ajaran = DB::table('tahun_ajaran')->select("*")->first();
        $tahun_ajaranfix = $tahun_ajaran->tahun_awal . " - " . $tahun_ajaran->tahun_akhir;
        foreach ($data_administrasi as $key) {
            if ($key->kelas == 12) {
                $kelasfix = "Lulus";
            } else {
                $kelasfix = $key->kelas . " " . $key->rombel;
            }
            DB::table('tanggunganprev')
                ->insert([
                    'no_induk_siswa' => $key->no_induk_adm,
                    'kelas_prev' => $kelasfix,
                    'spp' => $key->spp,
                    'psb' => $key->psb,
                    'uts_1' => $key->uts_1,
                    'uts_2' => $key->uts_2,
                    'lks_1' => $key->lks_1,
                    'lks_2' => $key->lks_2,
                    'pas_1' => $key->pas_1,
                    'pas_2' => $key->pas_2,
                    'unas' => $key->unas,
                    'daftar_ulang' => $key->daftar_ulang,
                    'tahun_ajaran' => $tahun_ajaranfix,
                    'created_at' => $key->created_at
                ]);
            DB::table('administrasi')->where('no_induk_adm', $key->no_induk_adm)->delete();
        }
        foreach ($siswa as $key) {
            if ($key->kelas == 10) {
                DB::table('data_siswa')
                    ->where('id_siswa', $key->id_siswa)
                    ->update([
                        'kelas' => 11
                    ]);
            }
        }
        foreach ($siswa as $key) {
            if ($key->kelas == 11) {
                DB::table('data_siswa')
                    ->where('id_siswa', $key->id_siswa)
                    ->update([
                        'kelas' => 12
                    ]);
            }
        }
        foreach ($siswa as $key) {
            if ($key->kelas == 12) {
                DB::table('data_siswa')
                    ->where('id_siswa', $key->id_siswa)
                    ->update([
                        'kelas' => 0
                    ]);
                DB::table('ijazah')->insert([
                    'no_induk_alumni' => $key->no_induk,
                    'tahun_ajaran' => $tahun_ajaranfix,
                    'created_at' => date("Y-m-d H:i:s")

                ]);
            }
        }

        DB::table('administrasi')->truncate();



        $pesan = "Data Sukses terupdate di Tanggungan Sebelumnya";
        return view('administrasi.template.progressbar');
    }
}

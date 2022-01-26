<?php

namespace App\Http\Controllers\Administrasi;

use App\Helpers\GF;
use App\Http\Controllers\Controller;
use App\Models\DataSiswa;
use App\Models\ModelTangunganSebelumnya;
use App\Models\MTanggungaSebelumnya;
use Illuminate\Http\Request;
use DataTables;
use PDF;
use Illuminate\Support\Facades\DB;

class TanggunganLaluController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('administrasi.tanggunganlalu.index');
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

        DB::table('riwayat_laporan')->insert(['jenis_laporan' => 'Administrasi', 'created_at' => $time_insert]);
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
        $data = MTanggungaSebelumnya::select('tanggunganprev.*', 'data_siswa.nama as nama_siswa', 'data_siswa.*', 'm_kelas.nama as nama_kelas', 'm_kelas.*', 'm_jurusan.nama as nama_jurusan')
            ->join('data_siswa', 'tanggunganprev.no_induk', '=', 'data_siswa.no_induk', 'left')
            ->join('m_kelas', 'data_siswa.kelas', '=', 'm_kelas.id_kelas', 'left')
            ->join('m_jurusan', 'm_jurusan.id_jurusan', '=', 'm_kelas.id_jurusan', 'left')
            ->where('id_tgg_prev', $id)->first();
        return view("administrasi.tanggunganlalu.edit")->with("data", $data);
    }
    public function showByIdSiswa($id)
    {
        //
        $data_administrasi = MAdministrasi::where('id_siswa', $id)
            ->first();
        return json_encode($data_administrasi);
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

        $query = ModelsDataSiswa::select('administrasi.*', 'data_siswa.nama as nama_siswa', 'data_siswa.*', 'm_kelas.nama as nama_kelas', 'm_kelas.*', 'm_jurusan.nama as nama_jurusan')
            ->join('administrasi', 'administrasi.id_siswa', '=', 'data_siswa.id_siswa', 'left')
            ->join('m_kelas', 'data_siswa.kelas', '=', 'm_kelas.id_kelas', 'left')
            ->join('m_jurusan', 'm_jurusan.id_jurusan', '=', 'm_kelas.id_jurusan', 'left')
            ->where("id_administrasi", $id)
            ->first();
        return view("administrasi.administrasi.edit")->with("data", $query);
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
        // dd($request->all());
        $administrasi = MTanggungaSebelumnya::where('id_tgg_prev', $id)->first();
        //looping data administrasi
        //[{"id_jenis_adm":3,"nama_adm":"SPP","value_adm":0}]
        $administrasiArray = [];
        for ($i = 0; $i < count($request->bdasarid); $i++) {
            array_push($administrasiArray, [
                'id_jenis_adm' => $request->bdasarid[$i],
                'nama_adm' => $request->bdasar[$i],
                'value_adm' => intval(str_replace(".", "", $request->bjt[$i])),
            ]);
        }
        $administrasi->value = json_encode($administrasiArray);
        $administrasi->update();

        return redirect(url('tanggungan_lalu'))->with('msg', 'Berhasil Update data Administrasi Siswa !!');
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
    }
    public function datatable()
    {
        $query = MTanggungaSebelumnya::select('tanggunganprev.*', 'data_siswa.nama as nama_siswa', 'data_siswa.*', 'm_kelas.nama as nama_kelas', 'm_kelas.*', 'm_jurusan.nama as nama_jurusan')
            ->join('data_siswa', 'tanggunganprev.no_induk', '=', 'data_siswa.no_induk', 'left')
            ->join('m_kelas', 'data_siswa.kelas', '=', 'm_kelas.id_kelas', 'left')
            ->join('m_jurusan', 'm_jurusan.id_jurusan', '=', 'm_kelas.id_jurusan', 'left')->get();
        // dd($query);
        return DataTables::of($query)
            ->addColumn('kelas_conv', function ($row) {
                if ($row->kelas == 0) {
                    $kelas = "Lulus";
                } else {
                    $kelas = $row->nama_kelas . " " . $row->nama_jurusan;
                }
                return $kelas;
            })
            ->addColumn('uraian_conv', function ($row) {
                $json = json_decode($row->value);
                // dd($json);
                $html = '<div class="">
                <div class="accordion">
                <dl>
                <dt>
                <a href="#accordion1" aria-expanded="false" aria-controls="accordion1" class="accordion-title accordionTitle js-accordionTrigger">
                Nama : ' . $row->nama_siswa . ' | No Induk : ' . $row->no_induk . '
                </a>
                </dt>
                <dd class="accordion-content accordionItem is-collapsed" id="accordion1" aria-hidden="true">
                <ol class="mt-2">';

                foreach ($json as $key) {
                    $html .= '<li>' . $key->nama_adm . ' - ' .  GF::formatRupiah($key->value_adm) . '</li>';
                }
                // dd($json);
                $html .= '</ol>
                            </dd>
                          </dl>
                        </div>
                      </div>';
                return $html;
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a id="' . $row->id_tgg_prev . '" data-toggle="tooltip" data-placement="top" title="Edit Data Administrasi per Siswa" href="' . url('tanggungan_lalu-edit/' . $row->id_tgg_prev) . '" class="btn btn-primary btn-sm"> <i class="material-icons">edit</i></a>';
                $btn .= '<a href="' . url("cetak_administrasi_pers") . "/" . $row->id_tgg_prev . '" class="btn btn-warning print_per_siswa btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Data per Siswa"> <i class="material-icons">print</i></a>';
                $btn .= '<a href="' . url("administrasi-detail/" . $row->id_tgg_prev) . '" class="btn btn-warning print_per_siswa btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="Detail Siswa"> <span class="material-icons">visibility</span></a>';

                return $btn;
            })
            ->rawColumns(['kelas_conv', 'action', 'uraian_conv'])
            ->addIndexColumn()
            ->toJson();
    }
    function get_tgg_prev($id)
    {
        $data = DB::table('tanggunganprev')
            ->join('data_siswa', 'data_siswa.no_induk', '=', 'tanggunganprev.no_induk_siswa')
            ->select('tanggunganprev.*', 'data_siswa.kelas', 'data_siswa.rombel')
            ->where('no_induk_siswa', $id)
            ->get();

        return json_encode($data);
    }
    public function cetak_siswa($id)
    {
        $data = DB::table('administrasi')
            ->join('data_siswa', 'administrasi.no_induk_adm', '=', 'data_siswa.no_induk')
            ->select('*')
            ->where('id_administrasi', $id)
            ->first();

        $total = 0;
        $total = $total + intVal($data->spp);
        $total = $total + intVal($data->psb);
        $total = $total + intVal($data->uts_1);
        $total = $total + intVal($data->uts_2);
        $total = $total + intVal($data->pas_1);
        $total = $total + intVal($data->pas_2);
        $total = $total + intVal($data->lks_1);
        $total = $total + intVal($data->lks_2);
        return view('administrasi.template.cetak_siswa', ['data' => $data, 'total' => $total]);
    }
    public function json_ijazah()
    {
        $query = DB::table('ijazah')
            ->join('data_siswa', 'ijazah.no_induk_alumni', '=', 'data_siswa.no_induk')
            ->select('ijazah.*', 'data_siswa.nama', 'data_siswa.kelas', 'data_siswa.rombel')
            ->get();
        // dd($query)
        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn = $btn . '<button id="' . $row->id_ijazah . '" data-toggle="tooltip" data-placement="top" class="btn btn-primary add-ijazah-5000 btn-sm"> <i class="material-icons">add_circle</i></button>';
                $btn = $btn . '<button id="' . $row->id_ijazah . '" class="btn btn-warning btn-sm edit"> <i class="material-icons">edit</i></button>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function refillable()
    {
        $data_siswa = DB::table('data_siswa')->select("*")->get();
        // dd($data_siswa);
        if (count($data_siswa) != 0) {
            foreach ($data_siswa as $key) {
                if ($key->kelas != 0) {
                    DB::table('administrasi')->insert([
                        'no_induk_adm' => $key->no_induk
                    ]);
                }
            }
        }
        return redirect('/administrasi');
    }
    public function add_ijazah_cepek($id)
    {


        $ijazah = DB::table('ijazah')->select('*')->where('id_ijazah', $id)->first();

        $nominal_ijazah = $ijazah->ijazah + 5000;

        DB::table('ijazah')->where('id_ijazah', $id)->update([
            'ijazah' => $nominal_ijazah
        ]);

        return json_encode(array('statusCode' => 202));
    }
    public function pick_ijazah($id)
    {
        $data = DB::table('ijazah')
            ->join('data_siswa', 'ijazah.no_induk_alumni', '=', 'data_siswa.no_induk')
            ->select('data_siswa.nama', 'ijazah.*')
            ->where('id_ijazah', $id)
            ->first();
        return json_encode($data);
    }
    public function simpan_edit_ijazah(Request $request, $id)
    {
        $nominal_ijazah = str_replace(".", "", $request->nominal_ijazah);

        $data = DB::table('ijazah')->where('id_ijazah', $id)->update([
            'ijazah' => intval($nominal_ijazah)
        ]);

        return json_encode($data);
    }
    public function cetak_ijazah($value = '')
    {
        $ijazah = DB::table('ijazah')
            ->join('data_siswa', 'ijazah.no_induk_alumni', '=', 'data_siswa.no_induk')
            ->select('*')
            ->where('kelas', '=', 0)
            ->get();
        return view('administrasi.template.cetak_tanggungan_ijazah', ['tanggungan_ijazah' => $ijazah]);
    }
}

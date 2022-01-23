<?php

namespace App\Http\Controllers\Administrasi;

use App\Helpers\GF;
use App\Helpers\Time;
use App\Http\Controllers\Controller;
use App\Models\MRekapitulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class RekapitulasiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    return view('rekapitulasi');
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
  public function cetak_rekapitulasi()
  {
    $pemasukan = DB::table('pemasukan')->select("*")->get();
    $pengeluaran = DB::table('pengeluaran')->select("*")->get();


    return view('admnistrasi.template.cetak_rekapitulasi', ['pengeluaran' => $pengeluaran, 'pemasukan' => $pemasukan]);
  }
  public function datatable($status, $tanggalawal, $tanggalakhir)
  {
    if ($status == 1) {

      $model = MRekapitulasi::where("jenis", 1)->whereBetween('tanggal', [$tanggalawal, $tanggalakhir]);
    } else {
      $model = MRekapitulasi::query();
    }
    // dd($model);
    return DataTables::eloquent($model)
      ->addColumn('uraian_conv', function ($row) {
        $json = json_decode($row->uraian);

        $html = '<div class="">
                <div class="accordion">
                  <dl>
                    <dt>
                      <a href="#accordion1" aria-expanded="false" aria-controls="accordion1" class="accordion-title accordionTitle js-accordionTrigger">
                        Nama : ' . $json->nama_siswa . ' | No Induk : ' . $json->no_induk . '
                      </a>
                    </dt>
                    <dd class="accordion-content accordionItem is-collapsed" id="accordion1" aria-hidden="true">
                      <ol class="mt-2">';
        for ($i = 0; $i < count($json->uraian); $i++) {
          if (isset($json->uraian[$i]->tahun_ajaran)) {
            $html .= '<li>' . $json->uraian[$i]->name . ' - ' . GF::formatRupiah($json->uraian[$i]->value) . ' <span class="badge badge-danger">' . $json->uraian[$i]->tahun_ajaran . '</span></li>';
          } else {
            $html .= '<li>' . $json->uraian[$i]->name . ' - ' .  GF::formatRupiah($json->uraian[$i]->value) . '</li>';
          }
        }
        $html .= '</ol>
                    </dd>
                  </dl>
                </div>
              </div>';
        return $html;
      })
      ->addColumn('tanggal_conv', function ($row) {
        $tgl = GF::format_date($row->tanggal, false, false, false);
        return $tgl;
      })
      ->addColumn('saldo_conv', function ($row) {
        $result = GF::formatRupiah($row->saldo);
        return $result;
      })
      // ->addColumn('action', function ($row) {
      //     $btn = '';
      //     $btn = $btn . '<a id="' . $row->id_siswa . '" href="javascript:void(0)" class="btn btn-primary edit btn-sm"> <i class="material-icons">edit</i></a>';
      //     $btn = $btn . '<a id="' . $row->id_siswa . '" href="javascript:void(0)" class="btn btn-danger hapus btn-sm"><i class="material-icons">close</i></a>';
      //     return $btn;
      // })

      ->rawColumns(['uraian_conv', 'tanggal_conv', 'saldo_conv'])
      ->addIndexColumn()
      ->toJson();
  }
}

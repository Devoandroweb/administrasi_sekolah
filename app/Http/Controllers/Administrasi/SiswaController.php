<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\Administrasi;
use Illuminate\Support\Facades\Hash;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Helpers\Time;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = DB::table('data_siswa')->select('*')->get();
        return json_encode($siswa);
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

        DB::table('riwayat_laporan')->insert(['jenis_laporan' => 'data siswa', 'created_at' => $time_insert]);
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

        $siswa = new DataSiswa;
        $siswa->nama = $request->nama;
        $siswa->tmp_lahir = $request->tmp_lahir;
        $siswa->tgl_lahir = $request->tgl_lahir;
        $siswa->nisn = $request->nisn;
        $siswa->no_induk = $request->no_induk;
        $siswa->kelas = $request->kelas;
        $siswa->rombel = $request->rombel;
        $siswa->no_tlp = $request->no_tlp;
        $siswa->alamat = $request->alamat;
        $siswa->password = Hash::make($request->password);
        $siswa->save();

        $administrasi = new Administrasi;
        $administrasi->id_siswa = $siswa->id_siswa;
        $administrasi->save();
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arr = DataSiswa::where('id_administrasi', $id)->first();

        echo json_encode($arr);
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arr = DataSiswa::where('id_siswa', $id)->first();
        $tgl_lahir = date("Y-m-d", $arr['tgl_lahir']);


        $data = array('data_siswa' => $arr, 'tanggal_lahir' => $tgl_lahir);
        echo json_encode($data);
        exit();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_siswa)
    {
        $datasiswa = DataSiswa::find($id_siswa);
        $datasiswa->nama = request('up_nama');
        $datasiswa->tmp_lahir = request('up_tmp_lahir');
        $datasiswa->tgl_lahir = request('up_tgl_lahir');
        $datasiswa->nisn = request('up_nisn');
        $datasiswa->no_tlp = request('up_no_tlp');
        $datasiswa->alamat = request('up_alamat');

        $datasiswa->save();

        return json_encode(array('statusCode' => 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $where = array('id_siswa' => $id);
        DataSiswa::where($where)->delete();
        return json_encode(array('statusCode' => 200));
    }


    public function import_siswa(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file_import_siswa' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file_import_siswa');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move(public_path('/file_siswa'), $nama_file);

        // import data
        Excel::import(new SiswaImport, public_path('/file_siswa/' . $nama_file));

        // notifikasi dengan session
        $request->session()->flash('sukses_import', 'Data Siswa Berhasil Diimport!');
        $request->session()->flash('import_display', 'd-block');


        $siswa = DB::table('data_siswa')->get();
        foreach ($siswa as $key) {
            // dd($key->no_induk);
            $id_siswa_search = DB::table('administrasi')->where('no_induk_adm', $key->no_induk)->count();
            // dd($id_siswa_search);
            if ($id_siswa_search == 0) {
                $administrasi = Administrasi::create(['no_induk_adm' => $key->no_induk]);
                $administrasi->save();
            }
        }

        // alihkan halaman kembali
        return redirect('/siswa');
    }
    /// datatabel json
    public function json_siswa()
    {
        $model = DataSiswa::where('kelas', '>=', 10);
        return DataTables::eloquent($model)
            ->addColumn('tanggal_lahir', function ($row) {

                $tgl_lahir = Time::time_indo_convert($row->tgl_lahir);
                return $tgl_lahir[0];
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn = $btn . '<a id="' . $row->id_siswa . '" href="javascript:void(0)" class="btn btn-primary edit btn-sm"> <i class="material-icons">edit</i></a>';
                $btn = $btn . '<a id="' . $row->id_siswa . '" href="javascript:void(0)" class="btn btn-danger hapus btn-sm"><i class="material-icons">close</i></a>';
                return $btn;
            })

            ->rawColumns(['tanggal_lahir', 'action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function json_siswaalumni()
    {
        $model = DataSiswa::where('kelas', '=', 0);
        return DataTables::eloquent($model)
            ->addColumn('tanggal_lahir', function ($row) {

                $tgl_lahir = Time::time_indo_convert($row->tgl_lahir);
                return $tgl_lahir[0];
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn = $btn . '<a id="' . $row->id_siswa . '" href="javascript:void(0)" class="btn btn-primary edit btn-sm"> <i class="material-icons">edit</i></a>';
                $btn = $btn . '<a id="' . $row->id_siswa . '" href="javascript:void(0)" class="btn btn-danger hapus btn-sm"><i class="material-icons">close</i></a>';
                return $btn;
            })

            ->rawColumns(['tanggal_lahir', 'action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function cetak_siswa($id)
    {
        $data_siswa = DB::table('administrasi')->select('*')->where('id_administrasi', $id)->first();
        return view('administrasi.template.cetak_siswa', ['data_siswa' => $data_siswa]);
    }
    public function cetak_data_siswa()
    {
        $data_siswa = DB::table('data_siswa')->select('*')->get();
        return view('administrasi.template.cetak_data_siswa', ['data_siswa' => $data_siswa]);
    }
}

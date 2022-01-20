<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataSiswa as ModelsDataSiswa;
use App\Models\MGuru;
use App\Models\MJurusan;
use App\Models\MKelas;
use DataSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class CKelas extends Controller
{
    public function index()
    {
        $guru = MGuru::all();
        $jurusan = MJurusan::all();
        return view("admin.kelas.index")
            ->with('title', 'Kelas')
            ->with('guru', $guru)
            ->with('jurusan', $jurusan);
    }
    public function saveCreate(Request $request)
    {
        $kelas = new MKelas;
        $this->credential($kelas, $request);
        $kelas->save();
        return response()->json(['status' => true, 'msg' => 'Sukses menambahkan data kelas']);
    }
    public function show($id)
    {
        $kelas = MKelas::where('id_kelas', $id)->first();
        return response()->json(['status' => true, 'data' => $kelas]);
    }
    public function checkKelas(Request $request)
    {
        $kelas = MKelas::where('nama', $request->nama_kelas)->where('id_jurusan', $request->jurusan)->count();
        // dd($kelas);
        return response()->json(['status' => true, 'data' => $kelas]);
    }
    public function saveUpdate($id, Request $request)
    {
        $kelas = MKelas::where('id_kelas', $id)->first();
        $this->credential($kelas, $request);
        $kelas->update();
        return response()->json(['status' => true, 'msg' => 'Sukses mengubah data kelas']);
    }
    public function destroy($id)
    {
        MKelas::where('id_kelas', $id)->delete();
        return redirect(url('admin/kelas'))->with('msg', 'Sukses menghapus kelas');
    }
    public function credential($kelas, $request)
    {
        $kelas->nama = $request->nama_kelas;
        $kelas->id_wali_kelas = $request->wali_kelas;
        $kelas->id_jurusan = $request->jurusan;
    }
    public function datatable(Request $request)
    {
        $model = MKelas::select(
            "m_kelas.id_kelas",
            "m_kelas.nama as nama_kelas",
            "m_guru.id_guru",
            "m_guru.nama as nama_guru",
            "m_jurusan.id_jurusan",
            "m_jurusan.nama as nama_jurusan",
        )
            ->join("m_guru", "m_guru.id_guru", "=", "m_kelas.id_wali_kelas", "LEFT")
            ->join("m_jurusan", "m_jurusan.id_jurusan", "=", "m_kelas.id_jurusan", "LEFT")
            ->orderBy('nama_kelas', 'ASC');

        return DataTables::of($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a id="' . $row->id_kelas . '" data-type="edit" href="#" class="btn btn-primary btn-edit btn-sm b-modal" title="Edit"> <i class="material-icons">edit</i></a>';
                $btn .= '<a href="' . url("admin/kelas-delete") . "/" . $row->id_kelas . '" class="btn btn-warning btn-delete btn-sm" title="Hapus"> <i class="material-icons">delete_outline</i></a>';
                $btn .= '<a href="' . url("admin/kelas-add-siswa") . "/" . $row->id_kelas . '" class="btn btn-info btn-add-siswa btn-sm" title="Masukkan Siswa"> <i class="material-icons">group_add</i></a>';
                return $btn;
            })
            ->addColumn('total_siswa', function ($row) {
                $siswa = ModelsDataSiswa::where("kelas", $row->id_kelas)->count();

                return '<a href="' . url("admin/kelas-detail-siswa/" . $row->id_kelas) . '"><span class="badge badge-primary">' . $siswa . '</span></a>';
            })

            ->rawColumns(['action', 'total_siswa'])
            ->addIndexColumn()
            ->toJson();;
    }
    public function addSiswa($id)
    {
        $siswa = ModelsDataSiswa::where('kelas', '!=', $id)->orWhereNull('kelas')->get();
        // dd($siswa);
        return view("admin.kelas.add_siswa")
            ->with('siswa', $siswa)
            ->with('id_kelas', $id)
            ->with('title', 'Kelas');
    }
    public function addSiswaSave($id, Request $request)
    {
        $siswa = $request->data;
        foreach ($siswa as $key) {
            $mSiswa = ModelsDataSiswa::where("id_siswa", intval($key))->first();
            $mSiswa->kelas = $id;
            $mSiswa->update();
        }
        return response()->json(['status' => true]);
    }
    public function detailSiswa($id)
    {
        $mSiswa = ModelsDataSiswa::where("kelas", $id)->get();
        return view("admin.kelas.detail_siswa")
            ->with('siswa', $mSiswa)
            ->with('title', 'Kelas');
    }
}

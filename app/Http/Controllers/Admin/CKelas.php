<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class CKelas extends Controller
{
    public function index()
    {
        return view("admin.kelas.index")->with('title', 'Kelas');
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
        $kelas->nama = $request->nama;
        $kelas->id_wali_kelas = $request->id_wali_kelas;
        $kelas->id_jurusan = $request->id_jurusan;
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
            ->join("m_guru", "m_guru.id_guru", "=", "m_kelas.id_kelas")
            ->join("m_jurusan", "m_jurusan.id_jurusan", "=", "m_kelas.id_jurusan")
            ->orderBy('nama_kelas', 'ASC');
        return DataTables::of($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a id="' . $row->id_kelas . '" data-type="edit" href="#" class="btn btn-primary btn-edit btn-sm b-modal"> <i class="material-icons">edit</i></a>';
                $btn .= '<a href="' . url("admin/kelas-delete") . "/" . $row->id_kelas . '" class="btn btn-warning btn-delete btn-sm"> <i class="material-icons">delete_outline</i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();;
    }
}

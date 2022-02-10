<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Siswa;
use App\Http\Traits\UploadFile;
use App\Models\MTugas;
use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\MGuru;
use App\Models\MKelas;
use DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CTugas extends Controller
{
    use UploadFile;
    use Siswa;

    public function index()
    {
        $title = "Tugas";
        return view("admin.tugas.index")->with("title", $title);
    }
    public function create()
    {
        $title = "Tambah Tugas";
        $kelas = MKelas::select("m_kelas.*", "m_jurusan.*", "m_kelas.nama as nama_kelas", "m_jurusan.nama as nama_jurusan")
            ->join("m_jurusan", "m_kelas.id_jurusan", "=", "m_jurusan.id_jurusan", "left")
            ->get();
        $guru = MGuru::get();
        return view("admin.tugas.add")
            ->with("title", $title)
            ->with("kelas", $kelas)
            ->with("guru", $guru);
    }
    public function saveCreate(Request $request)
    {
        $tugas = new MTugas;
        $this->credential($tugas, $request);
        $tugas->save();
        return redirect(url('admin/tugas'))->with('msg', 'Sukses menambahkan data Tugas');
    }
    public function show($id)
    {
        $title = "Edit Tugas";
        $kelas = MKelas::select("m_kelas.*", "m_jurusan.*", "m_kelas.nama as nama_kelas", "m_jurusan.nama as nama_jurusan")
            ->join("m_jurusan", "m_kelas.id_jurusan", "=", "m_jurusan.id_jurusan", "left")
            ->get();
        $guru = MGuru::get();
        $tugas = MTugas::where('id_tugas', $id)->first();
        return view("admin.tugas.edit")
            ->with("title", $title)
            ->with("kelas", $kelas)
            ->with("tugas", $tugas)
            ->with("guru", $guru);
    }
    public function saveShow($id, Request $request)
    {
        $tugas = MTugas::where('id_tugas', $id)->first();
        $this->credential($tugas, $request);
        $tugas->update();
        return redirect(url('admin/tugas'))->with('msg', 'Sukses mengubah data Tugas');
    }
    public function destroy($id)
    {
        MTugas::where('id_tugas', $id)->delete();
        return redirect(url('admin/tugas'))->with('msg', 'Sukses menghapus tugas');
    }
    public function credential($tugas, $request)
    {
        $tugas->kode = $request->kode;
        $tugas->judul = $request->judul;
        $tugas->isi = $request->isi;
        $tugas->type = $request->type;
        if ($request->file('file') != null) {
            if ($request->type == 1) {
                $tugas->file = "all/" . $this->uploadFile("tugas/all", $request);
            } else {
                $tugas->file = "individu/" . $this->uploadFile("tugas/one", $request);
            }
        }
        $tugas->id_kelas = $request->id_kelas;
        $tugas->id_guru = $request->id_guru;
        $tugas->id_siswa = $request->id_siswa;
    }
    public function downloadFile($file)
    {
        $fileS = Crypt::decryptString($file);
        return Storage::download("tugas/" . $fileS);
    }
    public function datatable(Request $request)
    {

        $model = MTugas::select(
            "tugas.*",
            "m_kelas.*",
            "m_guru.*",
            "m_jurusan.*",
            "m_guru.nama as nama_guru",
            "m_jurusan.nama as nama_jurusan",
            "m_kelas.nama as nama_kelas"
        )
            ->join("m_guru", "m_guru.id_guru", "=", "tugas.id_guru", "left")
            ->join("m_kelas", "m_kelas.id_kelas", "=", "tugas.id_kelas", "left")
            ->join("m_jurusan", "m_kelas.id_jurusan", "=", "m_jurusan.id_jurusan", "left");
        return DataTables::of($model)
            ->addColumn('kelas', function ($row) {
                return $row->nama_kelas . " " . $row->nama_jurusan;
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . url('admin/tugas-show/' . $row->id_tugas) . '" class="btn btn-primary btn-edit btn-sm b-modal"> <i class="material-icons">edit</i></a>';
                $btn .= '<a href="' . url("admin/tugas-delete") . "/" . $row->id_tugas . '" class="btn btn-warning btn-delete btn-sm"> <i class="material-icons">delete_outline</i></a>';
                return $btn;
            })
            ->rawColumns(['action', 'kelas'])
            ->addIndexColumn()
            ->toJson();;
    }
}

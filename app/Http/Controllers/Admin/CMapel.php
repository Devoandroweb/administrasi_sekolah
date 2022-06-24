<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MGuru;
use App\Models\MMapel;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class CMapel extends Controller
{
    public function index()
    {
        $title = "Mata Pelajaran";
        $guru = MGuru::all();
        return view("admin.mapel.index")->with("title", $title)->with('guru',$guru);
    }
    public function saveCreate(Request $request)
    {
        $mapel = new MMapel;
        $this->credential($mapel, $request);
        $mapel->save();
        return response()->json(['status' => true, 'msg' => 'Sukses menambahkan data Mapel']);
    }
    public function show($id)
    {
        $mapel = MMapel::where('id_mapel', $id)->first();
        return response()->json(['status' => true, 'data' => $mapel]);
    }
    public function saveUpdate($id, Request $request)
    {
        $mapel = MMapel::where('id_mapel', $id)->first();
        $this->credential($mapel, $request);
        $mapel->update();
        return response()->json(['status' => true, 'msg' => 'Sukses mengubah data Mapel']);
    }
    public function destroy($id)
    {
        MMapel::where('id_mapel', $id)->delete();
        return redirect(url('admin/mapel'))->with('msg', 'Sukses menghapus Mapel');
    }
    public function credential($mapel, $request)
    {
        $mapel->kode = $request->kode;
        $mapel->nama = $request->nama;
        $mapel->id_guru = $request->pengajar;
        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $ext = $file->getClientOriginalExtension();
            $namaFile = time().'.'.$ext;
            $mapel->gambar = $namaFile;
            Storage::putFileAs('/mapel',$file,$namaFile);
        }
    }
    public function datatable(Request $request)
    {
        $model = MMapel::query();
        return DataTables::of($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a id="' . $row->id_mapel . '" data-type="edit" href="#" class="btn btn-primary btn-edit btn-sm b-modal"> <i class="material-icons">edit</i></a>';
                $btn .= '<a href="' . url("admin/mapel-delete") . "/" . $row->id_mapel . '" class="btn btn-warning btn-delete btn-sm"> <i class="material-icons">delete_outline</i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();;
    }
}

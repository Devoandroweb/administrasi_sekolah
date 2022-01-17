<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MJurusan;
use Illuminate\Http\Request;
use DataTables;

class CJurusan extends Controller
{
    public function index()
    {
        return view("admin.jurusan.index")->with('title', 'Jurusan');
    }
    public function saveCreate(Request $request)
    {
        $jurusan = new MJurusan;
        $this->credential($jurusan, $request);
        $jurusan->save();
        return response()->json(['status' => true, 'msg' => 'Sukses menambahkan data jurusan']);
    }
    public function show($id)
    {
        $jurusan = MJurusan::where('id_jurusan', $id)->first();
        return response()->json(['status' => true, 'data' => $jurusan]);
    }
    public function saveUpdate($id, Request $request)
    {
        $jurusan = MJurusan::where('id_jurusan', $id)->first();
        $this->credential($jurusan, $request);
        $jurusan->update();
        return response()->json(['status' => true, 'msg' => 'Sukses mengubah data jurusan']);
    }
    public function destroy($id)
    {
        MJurusan::where('id_jurusan', $id)->delete();
        return redirect(url('admin/jurusan'))->with('msg', 'Sukses menghapus jurusan');
    }
    public function credential($jurusan, $request)
    {
        $jurusan->nama = $request->nama;
    }
    public function datatable(Request $request)
    {
        $model = MJurusan::query();
        return DataTables::of($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a id="' . $row->id_jurusan . '" data-type="edit" href="#" class="btn btn-primary btn-edit btn-sm b-modal"> <i class="material-icons">edit</i></a>';
                $btn .= '<a href="' . url("admin/jurusan-delete") . "/" . $row->id_jurusan . '" class="btn btn-warning btn-delete btn-sm"> <i class="material-icons">delete_outline</i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();;
    }
}

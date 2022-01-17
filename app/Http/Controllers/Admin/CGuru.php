<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MGuru;
use Illuminate\Http\Request;
use DataTables;

class CGuru extends Controller
{
    public function index()
    {
        return view("admin.guru.index")->with('title', 'Guru');
    }
    public function saveCreate(Request $request)
    {
        $guru = new MGuru;
        $this->credential($guru, $request);
        $guru->save();
        return response()->json(['status' => true, 'msg' => 'Sukses menambahkan data guru']);
    }
    public function show($id)
    {
        $guru = MGuru::where('id_guru', $id)->first();
        return response()->json(['status' => true, 'data' => $guru]);
    }
    public function saveUpdate($id, Request $request)
    {
        $guru = MGuru::where('id_guru', $id)->first();
        $this->credential($guru, $request);
        $guru->update();
        return response()->json(['status' => true, 'msg' => 'Sukses mengubah data guru']);
    }
    public function destroy($id)
    {
        MGuru::where('id_guru', $id)->delete();
        return redirect(url('admin/guru'))->with('msg', 'Sukses menghapus guru');
    }
    public function credential($guru, $request)
    {
        $guru->nama = $request->nama;
        $guru->no_telp = $request->no_telp;
    }
    public function datatable(Request $request)
    {
        $model = MGuru::query();
        return DataTables::of($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a id="' . $row->id_guru . '" data-type="edit" href="#" class="btn btn-primary btn-edit btn-sm b-modal"> <i class="material-icons">edit</i></a>';
                $btn .= '<a href="' . url("admin/guru-delete") . "/" . $row->id_guru . '" class="btn btn-warning btn-delete btn-sm"> <i class="material-icons">delete_outline</i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MJenisTanggungan;
use Illuminate\Http\Request;
use DataTables;

class CJenisAdministrasi extends Controller
{
    public function index()
    {
        return view("administrasi.jenis_administrasi")->with('title', 'Jenis Administrasi');
    }
    public function saveCreate(Request $request)
    {
        $jenisTanggungan = new MJenisTanggungan;
        $jenisTanggungan->nama = $request->input("nama");
        $jenisTanggungan->value = $request->input("nilai");
        $jenisTanggungan->save();

        return response()->json(['status' => true, 'msg' => 'Sukses simpan data !!!']);
    }
    public function show($id)
    {
        $jenisTanggungan = MJenisTanggungan::where("id", $id)->first();
        return response()->json(['status' => true, 'data' => $jenisTanggungan]);
    }
    public function destroy($id)
    {
        MJenisTanggungan::where("id", $id)->delete();
        return redirect(url('jenis-tanggungan'))->with("msg", "Suskes hapus data !!!");
    }
    public function datatable(Request $request)
    {
        $model = MJenisTanggungan::query();
        return DataTables::of($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a id="' . $row->id . '" data-type="edit" href="javascript:void(0)" class="btn btn-primary btn-edit btn-sm b-modal"> <i class="material-icons">edit</i></a>';
                $btn .= '<a href="' . url("jenis-administrasi-delete") . "/" . $row->id . '" class="btn btn-warning btn-delete btn-sm" target="_blank"> <i class="material-icons">delete_outline</i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();;
    }
}

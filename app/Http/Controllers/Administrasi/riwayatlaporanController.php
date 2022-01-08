<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Helpers\Time;

class riwayatlaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // DB::table('riwayat_laporan')
        //         ->()
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
        $data = DB::table('riwayat_laporan')->where('id_riwayat_laporan', $id)->delete();
        return json_encode($data);
    }

    /// datatabel json
    public function jsonriwlap()
    {
        $query = DB::table('riwayat_laporan')
            ->select('*')
            ->get();

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $btn = '';

                $btn = $btn . '<a id="' . $row->id_riwayat_laporan . '" href="javascript:void(0)" class="btn btn-warning hapus btn-sm"> <i class="material-icons">delete</i> Hapus</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
}

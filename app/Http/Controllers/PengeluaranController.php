<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Helpers\Time;
use App\Models\ModelPengeluaran;
use App\Imports\PengeluaranImport;
use Maatwebsite\Excel\Facades\Excel;
class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $data = DB::table('pengeluaran')
                    ->select('*')
                    ->get();
        
        return view('template.cetak_pengeluaran',['data_pengeluaran'=>$data]);
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
    
        DB::table('riwayat_laporan')->insert(['jenis_laporan'=>'Pengeluaran','created_at'=>$time_insert]);
        return json_encode(array(
            "statusCode"=>200
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
        //
        $total = $request->total;

        $data = DB::table('pengeluaran')
                ->insert([
                    'uraian' => json_encode($request->uraian), 'total' => $total, 'created_at' => date("Y/m/d h:m:s")
                ]);

        return json_encode($data);
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
        $data = DB::table('pengeluaran')->select('*')->where('id_pengeluaran',$id)->first();
     
        $date_indo = Time::time_indo_convert(strtotime($data->created_at));
        return json_encode(array('data' => $data, 'tanggal_indo' => $date_indo[0] ));
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

        $uraian = [];
        $total = 0;



            

        for ($i=0; $i < count($request->data); $i++) { 
            $total = $total + intval($request->data[$i]['value']);
        }
       

       $data = DB::table('pengeluaran')->where('id_pengeluaran',$id)->update([
            'uraian' => json_encode($request->data),
            'total' => $total
       ]);
       if ($data) {
           $kode = true;
       }else{
            $kode = false;
       }
       return json_encode($kode);
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
        $data = DB::table('pengeluaran')->where('id_pengeluaran',$id)->delete();
        return json_encode($data);
    }
     public function jsonpengeluaran($status,$a,$b)
    {
        if ($status == 1) {
            $query = DB::table('pengeluaran')
                    ->select('*')
                    ->where([
                        ['created_at','>=',$a],
                        ['created_at','<=',$b],
                    ])
                    ->get();
        }elseif($status == 0){
            $query = DB::table('pengeluaran')
                    ->select('*')
                    ->get();
        }
        

        return DataTables::of($query)
        ->addColumn('uraianfix', function($row){
                $uraian = json_decode($row->uraian);
           
              
                $html = "<ul class='mb-0'>";
                for ($i=0; $i < count($uraian); $i++) { 
                   
                    $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>".$uraian[$i]->key."</label><span class='linumeric float-right'>".$uraian[$i]->value."</span>";
                }
                
                
                $html .= "</li></ul>";
                
                return $html;
               

        })
         ->addColumn('total', function($row){
                $uraian = json_decode($row->uraian);
                $total = 0;
                for ($i=0; $i < count($uraian); $i++) { 
                   $total = $total + $uraian[$i]->value;
                }
                return $total;

        })
        ->addColumn('action', function($row){
                $btn = '';

                $btn = $btn.'<a id="'.$row->id_pengeluaran.'" href="javascript:void(0)" class="btn btn-warning hapus btn-sm"> <i class="material-icons">delete</i> Hapus</a>';
                $btn = $btn.'<a id="'.$row->id_pengeluaran.'" href="javascript:void(0)" class="btn btn-primary edit btn-sm"> <i class="material-icons">edit</i> Edit</a>';
                return $btn;

        })
        ->rawColumns(['action','total','uraianfix'])
        ->addIndexColumn()
        ->toJson();
    }
    public function chart()
    {
        $pengeluaran = DB::table('pengeluaran')->select('id_pengeluaran','total')->orderBy('id_pengeluaran','desc')->limit(2)->get();
        $data = DB::table('pengeluaran')->select('total')->limit('7')->get();
        $array = array('data' => $data,'pengeluaran'=>$pengeluaran );
       
        return json_encode($array);
    }
    public function import_pengeluaran(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file_import_pengeluaran' => 'required|mimes:csv,xls,xlsx'
        ]);
 
        // menangkap file excel
        $file = $request->file('file_import_pengeluaran');
 
        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();
 
        // upload ke folder file_siswa di dalam folder public
        $file->move(public_path('/file_pengeluaran'),$nama_file);
 
        // import data
        Excel::import(new PengeluaranImport, public_path('/file_pengeluaran/'.$nama_file));
 
        // notifikasi dengan session
        $request->session()->flash('sukses_import','Data Siswa Berhasil Diimport!');
        $request->session()->flash('import_display', 'd-block');

        return redirect('/pengeluaran');
        

    }
}

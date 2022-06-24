<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadFile;
use App\Models\MJawaban;
use App\Models\MTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CTugas extends Controller
{
    use UploadFile;
    public function index()
    {
        
        $tugas = MTugas::whereKelas()->with('mapel')->get();
        return view("client.tugas.index")->with('tugas',$tugas);
    }
    public function detail($id)
    {
        $tugas = MTugas::with('mapel')->where('id_tugas',$id)->first();
        return view('client.tugas.detail')->with('tugas',$tugas);
    }
    public function saveDetail($id,Request $request)
    {
        $jawaban = new MJawaban;
        $jawaban->id_siswa = $request->id_siswa;
        $jawaban->id_tugas = $id;
        $jawaban->isi = $request->jawaban;
        if($request->hasFile('file')){
            $jawaban->file = $this->uploadFile('tugas/jawaban/'.$id,$request->file('file'));
        }
        $jawaban->save();


        return redirect(url('client/tugas'));
    }
    
}

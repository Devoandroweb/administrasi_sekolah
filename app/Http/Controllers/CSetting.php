<?php

namespace App\Http\Controllers;

use App\Models\MSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ConnectException;
use Throwable;

class CSetting extends Controller
{
    public function index()
    {
        $res = null;
        $biayaUpdater = MSetting::where('kode','biaya')->first();
        // dd($biayaUpdater);
        try {
            $res = Http::get("http://localhost:8000/check-auth")->throw()->json();

            return view("setting.index")->with('title', 'Setting')
                    ->with('data',$res)
                    ->with('biayaUpdater',$biayaUpdater);
        } catch (Throwable $e){
            return view("setting.index")->with('title', 'Setting')
                    ->with('biayaUpdater',$biayaUpdater)
                    ->with('data',$res);
        }
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CAuth extends Controller
{
     function index()
    {

        return view('administrasi.login');
    }
    function aksiLogin(Request $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            
            $request->session()->regenerate();
            $tahun_ajaran = DB::table('tahun_ajaran')->select("*")->first();
            if ($tahun_ajaran == null) {
                return redirect('halaman_tahun_ajaran');
            } else {
                return redirect('/dashboard');
            }

        } else {
            $request->session()->flash('alert', 'Email atau Password salah');
            $request->session()->flash('display', 'd-block');
            return redirect('/admin');
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }
    public function error_connection()
    {
        return view('error.database_not_connection');
    }
}

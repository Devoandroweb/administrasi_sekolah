<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CAuth extends Controller
{
    public function index()
    {
        return view("client.login");
    }
    public function auth(Request $request)
    {
        
        if (Auth::guard("siswa")->attempt($request->only('no_induk', 'password'))) {
           
            $request->session()->regenerate();
            //ke dashboard siswa
            
            return redirect('/client');
        }else{
            return redirect()->back()->with("msg","No Induk atau Password salah !!");
        }
    }
    function logout()
    {
        Auth::guard("siswa")->logout();
        return redirect('/');
    }
}

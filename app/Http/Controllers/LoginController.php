<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{


    function index(){
        $user = Auth::user();
        if ($user == null) {
            return view('login');
         }else{

            return redirect('/dashboard');
         } 
    	
    }
    function aksiLogin(Request $request){
        
    	if(Auth::attempt($request->only('email','password'))){
            $tahun_ajaran = DB::table('tahun_ajaran')->select("*")->first();
            if ($tahun_ajaran == null) {
                return redirect('halaman_tahun_ajaran');
            }else{
            return redirect('/dashboard');
            }
    		
    	}else{
            $request->session()->flash('alert', 'Email atau Password salah');
            $request->session()->flash('display', 'd-block');
            return redirect('/login');
        }
    	
    }
    function logout(){
    	Auth::logout();
    	return redirect('/login');
    }
    public function error_connection()
    {
        return view('error.database_not_connection');
    }
   
}

<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'password_lama' => ['required', new CurrentPassword],
        //     'password_baru' => ['required'],
        //     'konfirm_password_baru' => ['same:password_baru'],
        // ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->password_baru)]);
        Auth::logout();
        return redirect('/login');
    }
    public function checkPass(Request $request)
    {
        if (!Hash::check($request->password_lama, $request->user()->password)) {
            return json_encode(500);
        } else {
            return json_encode(200);
        }
    }
}

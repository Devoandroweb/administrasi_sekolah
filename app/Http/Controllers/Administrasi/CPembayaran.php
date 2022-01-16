<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CPembayaran extends Controller
{
    public function index()
    {
        return view("template.pembayaran")
            ->with('title', 'Pembayaran');
    }
}

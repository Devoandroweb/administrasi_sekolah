<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CIndex extends Controller
{
    public function index()
    {
        return view("client.dashboard.index");
    }
}

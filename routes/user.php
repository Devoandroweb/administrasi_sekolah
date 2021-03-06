<?php

use App\Http\Controllers\Client\CIndex;
use App\Http\Controllers\Client\CTugas;
use Illuminate\Support\Facades\Route;

Route::middleware(['user:siswa'])->group(function() {
    Route::prefix("client")->group(function(){
        Route::get("/",[CIndex::class,"index"]);
        Route::get("/tugas",[CTugas::class,"index"]);
    });
});
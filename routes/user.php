<?php

use App\Http\Controllers\Client\CIndex;
use Illuminate\Support\Facades\Route;

Route::middleware(['user:siswa'])->group(function() {
    Route::prefix("client")->group(function(){
        Route::get("/",[CIndex::class,"index"]);
    });
});
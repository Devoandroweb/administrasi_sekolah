<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HTransaksi extends Model
{
    use HasFactory;
    protected $table = "h_transaksi";
    protected $primaryKey = "id_transaksi";
}

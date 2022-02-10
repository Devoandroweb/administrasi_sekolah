<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MJadwal extends Model
{
    use HasFactory;
    protected $table = "jadwal";
    protected $primaryKey = "id_jadwal";
}

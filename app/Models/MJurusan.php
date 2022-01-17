<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MJurusan extends Model
{
    use HasFactory;
    protected $table = "m_jurusan";
    protected $primaryKey = "id_jurusan";
}

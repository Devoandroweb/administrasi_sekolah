<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MAdministrasi extends Model
{
    use HasFactory;
    protected $table = "administrasi";
    protected $primaryKey = "id_administrasi";
}

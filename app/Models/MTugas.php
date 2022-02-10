<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTugas extends Model
{
    use HasFactory;
    protected $table = "tugas";
    protected $primaryKey = "id_tugas";
}

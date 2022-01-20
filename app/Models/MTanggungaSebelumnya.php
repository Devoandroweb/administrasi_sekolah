<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTanggungaSebelumnya extends Model
{
    use HasFactory;
    protected $table = 'tanggunganprev';
    protected $primaryKey = 'id_tgg_prev';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';

    protected $fillable = [
        
    		'id_pengeluaran','uraian','total','created_at'
        ];
     protected $casts = [
        'created_at' => 'timestamp',
    ];
}

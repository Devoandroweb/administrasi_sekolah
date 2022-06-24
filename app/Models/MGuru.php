<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MGuru extends Model
{
    use HasFactory;
    protected $table = "m_guru";
    protected $primaryKey = "id_guru";
    public function mapel()
    {
        return $this->hasOne(MMapel::class,'id_guru');
    }
}

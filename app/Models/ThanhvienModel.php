<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanhvienModel extends Model
{
    use HasFactory;
    protected $table = 'thanhvien';
    protected $primaryKey = 'id_tv';
    protected $fillable = [
        'id_detai',
        'id_ttcn',
        'tenthanhvien',
        'nhiemvu',
        'vaitro',
        'sogiothamgia',
    ];
    public $timestamps = true;
    public function Detai()
    {
        return $this->belongsTo(DetaiModel::class, 'id_detai');
    }
    public function ThanhvienDT()
    {
        return $this->belongsTo(ThongtincanhanModel::class, 'id_ttcn');
    }
}

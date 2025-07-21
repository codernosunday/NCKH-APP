<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KinhphiModel extends Model
{
    use HasFactory;
    protected $table = 'kinhphi';
    protected $primaryKey = 'id_kp';
    protected $fillable = [
        'id_detai',
        'id_tiendo',
        'ctkhoanchi',
        'donvitinh',
        'soluong',
        'dongia',
        'thanhtien'
    ];
    public $timestamps = true;
    public function Detai()
    {
        return $this->belongsTo(DetaiModel::class, 'id_detai');
    }
    public function Tiendo()
    {
        return $this->belongsTo(TiendoModel::class, 'id_tiendo');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TVhoidongModel extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'tvhoidong';
    protected $primaryKey = 'id_tvhd';
    protected $fillable = [
        'id_detai',
        'id_ttcn',
        'tenthanhvien',
        'chucdanh',
        'tenhoidong',
        'sogiohoidong'
    ];
    public $timestamps = true;
    public function Detai()
    {
        return $this->belongsTo(DetaiModel::class, 'id_detai');
    }
    public function ThanhvienHT()
    {
        return $this->belongsTo(ThongtincanhanModel::class, 'id_ttcn');
    }
}

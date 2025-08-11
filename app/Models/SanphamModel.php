<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanphamModel extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $primaryKey = 'id_sanpham';
    protected $fillable = [
        'id_detai',
        'linkSP',
        'loaiSP',
        'tenSP',
        'trangthai',
    ];
    public $timestamps = true;
    public function Detai()
    {
        return $this->belongsTo(DetaiModel::class, 'id_detai');
    }
}

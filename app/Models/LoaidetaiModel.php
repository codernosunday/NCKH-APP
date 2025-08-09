<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaidetaiModel extends Model
{
    use HasFactory;
    protected $table = 'loaidetai';
    protected $primaryKey = 'id_loaidt';

    protected $fillable = [
        'tenloaidetai',
        'sogioTGtoida',
        'sogioTVtoida',
        'soTVtoida',
        'nam',
        'ghichu',
        'trangthai',
    ];
    public $timestamps = true;
    public function Detai()
    {
        return $this->hasMany(DetaiModel::class, 'id_loaidt', 'id_loaidt');
    }
    public function Sogiotheonam()
    {
        return $this->hasMany(SogiotheonamModel::class, 'id_loaidt', 'id_loaidt');
    }
}

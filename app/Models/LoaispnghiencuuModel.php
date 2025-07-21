<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaispnghiencuuModel extends Model
{
    use HasFactory;
    protected $table = 'loaispnghiencuu';
    protected $primaryKey = 'id_loai';
    protected $fillable = [
        'tenloaispnc',
    ];
    public $timestamps = true;

    public function Sanpham()
    {
        return $this->hasMany(SanphamModel::class, 'id_loai');
    }
}

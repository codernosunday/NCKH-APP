<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoaModel extends Model
{
    use HasFactory;
    protected $table = 'khoa';
    protected $primaryKey = 'id_khoa';
    protected $fillable = [
        'tenkhoa',
        'trangthai',
    ];
    public $timestamps = true;
    public function Detai()
    {
        return $this->hasMany(DetaiModel::class, 'id_khoa', 'id_khoa');
    }
}

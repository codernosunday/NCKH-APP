<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinhvucnghiencuuModel extends Model
{
    use HasFactory;
    protected $table = 'linhvucnghiencuu';
    protected $primaryKey = 'id_lvnc';
    protected $fillable = [
        'tenlvnc',
        'ghichu'
    ];
    public $timestamps = true;
    public function Detai()
    {
        return $this->hasMany(DetaiModel::class, 'id_lvnc', 'id_lvnc');
    }
}

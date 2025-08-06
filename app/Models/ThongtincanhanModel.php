<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongtincanhanModel extends Model
{
    use HasFactory;
    protected $table = 'thongtincanhan';
    protected $primaryKey = 'id_ttcn';
    protected $fillable = [
        'user_id',
        'hovaten',
        'dvcongtac',
        'email',
        'trangthai'
    ];
    public $timestamps = true;
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Detai()
    {
        return $this->hasMany(DetaiModel::class, 'id_ttcn', 'id_ttcn');
    }
}

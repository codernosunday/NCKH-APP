<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SogiotheonamModel extends Model
{
    use HasFactory;
    protected $table = 'sogionckh';
    protected $primaryKey = 'id_sogio';
    protected $fillable = [
        'sogioNC',
        'sogioTVtoida',
        'soTVtoida',
        'nam'
    ];
    public $timestamps = true;
    public function Sogiotheonam()
    {
        return $this->hasMany(SogiotheonamModel::class, 'id_sogio', 'id_sogio');
    }
}

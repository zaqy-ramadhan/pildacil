<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_suara extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tps',
        'id_partai',
        'suara_partai',
    ];

    public function tps()
    {
        return $this->belongsTo(Tps::class, 'id_tps', 'id');
    }

    public function partai()
    {
        return $this->belongsTo(Partai::class, 'id_partai', 'id');
    }
}

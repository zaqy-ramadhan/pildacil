<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tps extends Model
{
    use HasFactory;

    protected $fillable = [
        'alamat',
        'id_user',
        'id_dapil',
        'nama_tps',
        'perolehan_suara',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function dapil()
    {
        return $this->belongsTo(Dapil::class, 'id_dapil', 'id');
    }

    public function suara()
    {
        return $this->hasMany(detail_suara::class);
    }
}

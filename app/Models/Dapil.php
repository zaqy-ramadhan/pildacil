<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dapil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dapil'
    ];

    public function tps()
    {
        return $this->hasMany(tps::class);
    }
}

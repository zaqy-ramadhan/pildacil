<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    public function suara()
    {
        return $this->hasMany(detail_suara::class);
    }
}

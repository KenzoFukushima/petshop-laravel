<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{

    use HasFactory;
    protected $fillable = [
        'id_dono',
        'nome',
        'especie',
        'raça',
        'peso',
        'idade',
    ];

    public function dono()
    {   
        return $this->belongsTo(Dono::class);   
    }
}
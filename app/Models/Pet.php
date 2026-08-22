<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{

    protected $fillable = [
        'id_dono',
        'nome',
        'especie',
        'raça',
        'peso',
        'idade',
    ];

    public function tutor()
    {
        return $this->belongsTo(Dono::class);   
    }
}
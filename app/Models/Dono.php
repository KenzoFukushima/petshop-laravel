<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dono extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cpf',
        'endereco',
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class, 'id_dono');
    }
}

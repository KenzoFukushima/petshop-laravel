<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dono extends Model
{
    use HasFactory;
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

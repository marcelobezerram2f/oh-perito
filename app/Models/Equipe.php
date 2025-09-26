<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $table = 'equipe';
    protected $id = 'id';
    protected $fillable = [
        'nome',
        'telefone',
        'ativo',
        'dados_bancarios',
        'email'
    ];
}

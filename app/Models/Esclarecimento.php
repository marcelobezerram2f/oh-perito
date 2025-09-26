<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Esclarecimento extends Model
{
    protected $table = 'esclarecimentos';
    protected $id = 'id';
    protected $fillable = [
        'carga',
        'entrega_judicial',
        'processo_id',
        'advogado',
        'observacao'
    ];
}

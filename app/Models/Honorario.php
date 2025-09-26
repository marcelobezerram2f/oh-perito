<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Honorario extends Model
{
    protected $table = 'honorarios';
    protected $id = 'id';
    protected $fillable = [
        'equipe_id',
        'processo_id',
        'valor_total',
        'data_liquidacao',
        'status',
    ];
}

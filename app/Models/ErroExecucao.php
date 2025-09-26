<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErroExecucao extends Model
{
    protected $table = 'erros_execucao';
    protected $id = 'id';
    protected $fillable = [
        'processo_id',
        'tipo_erro',
        'data_erro',
        'custo_apoio',
        'observacao',
    ];
}

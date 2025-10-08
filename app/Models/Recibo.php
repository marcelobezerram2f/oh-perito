<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{

    protected $table = 'recibos';
    protected $id = 'id';
    protected $fillable = [
        'pagamento_id',
        'nome_arquivo',
        'blob'

    ];
}

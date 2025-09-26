<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table = 'pagamentos';
    protected $id = 'id';
    protected $fillable = [
        'processo_id',
        'data',
        'valor',
        'observacao'
    ];

    public function processo()
    {
        return $this->hasOne(Processo::class, 'id', 'processo_id');
    }
}

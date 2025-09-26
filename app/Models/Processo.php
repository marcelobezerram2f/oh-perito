<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    protected $table = 'processos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'numero_processo',
        'mes_ano',
        'pasta',
        'vara',
        'reclamante',
        'doc_reclamante',
        'status',
        'reclamada',
        'doc_reclamada',
        'carga',
        'prazo',
        'laudo_judicial',
        'equipe_id',
        'honorario',
        'liquidado',
        'calculo_conforme_erro',
        'observacoes'
    ];


    public function equipe()
    {
        return $this->hasOne(Equipe::class, 'id', 'equipe_id');
    }

    public function esclarecimentos()
    {
        return $this->hasMany(Esclarecimento::class, 'processo_id', 'id');
    }

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class, 'processo_id', 'id');
    }

    public function errosExecucao()
    {
        return $this->hasMany(ErroExecucao::class, 'processo_id', 'id');
    }

}

<?php

namespace App\Repositories;

use App\Models\Pagamento;
use Exception;
use Illuminate\Support\Facades\DB;


class PagamentosRepository
{

    private $pagamento;


    public function __construct()
    {
        $this->pagamento = new Pagamento();
    }


    public function getMonth($month = null)
    {
        try {
            if (is_null($month)){
                $year =  date('Y');
                $monthNumber =  date('m');
                $month = date('Y-m');
            } else{
                $parts = explode('-', $month); // separa "YYYY" e "m"
                $year = $parts[0];
                $monthNumber = $parts[1];
            }

            $pagamentosEquipe = $this->pagamento
                ->select('processo_id', DB::raw('SUM(valor) as total_valor'))
                ->whereYear('data', $year)
                ->whereMonth('data', $monthNumber)
                ->groupBy('processo_id')
                ->with(['processo', 'processo.equipe'])
                ->get()
                ->toArray();

            $response = agruparPorEquipe($pagamentosEquipe, $month);
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na coleta de pagamentos da equipe, contate o suporte.', 'code' => 400, 'erro' => $e->getMessage()];
        }
        return $response;


    }

}
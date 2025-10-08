<?php

namespace App\Repositories;

use App\Models\Pagamento;
use App\Models\Recibo;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PagamentosRepository
{

    private $pagamento;
    private $reciboRepository;


    public function __construct()
    {
        $this->pagamento = new Pagamento();
        $this->reciboRepository = new ReciboRepository();
    }


    public function create($data)
    {
        try {
            if (isset($data['id']) && !is_null($data['id'])) {
                return $this->update($data);
            } else {
                $novoPagamento = [
                    'processo_id' => $data['processo_id'],
                    'data' => $data['data_pagamento'],
                    'valor' => str_replace(",", ".", str_replace(".", "", $data['valor_pagamento'])),
                    'observacao' => $data['observacao_pagamento']
                ];

                $addPagamento = $this->pagamento->create($novoPagamento);

                if (isset($data['recibo'])) {
                    $upload = $this->reciboRepository->create($data, $addPagamento->id);
                    if ($upload['code'] == 400) {
                        return ['message' => 'O pagamento foi registrado com sucesso, porem houve uma falha no upload do arquivo. Contate o suporte', 'code' => 400, 'erro' => $upload['erro']];
                    }
                }
                $response = 200;
            }

        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na inclusão de pagamentos no processo, contate o suporte.', 'code' => 400, 'erro' => $e->getMessage()];
        }
        return $response;

    }


    public function getMonth($month = null)
    {
        try {
            if (is_null($month)) {
                $year = date('Y');
                $monthNumber = date('m');
                $month = date('Y-m');
            } else {
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

    public function update($data)
    {
        try {
            $somaPagamento = $this->pagamento->select('processo_id', DB::raw('SUM(valor) as total_valor'))->where('processo_id', $data['processo_id'])->groupBy('processo_id')->with(['processo'])->get()->toArray();
            $pagamento = $this->pagamento->find($data['id']);
            $calculo = (floatVal($pagamento->valor) - floatval($somaPagamento[0]['total_valor'])) + floatVal($data['valor_pagamento']);

            if ($calculo > floatval($somaPagamento[0]['processo']['calculo_conforme_erro'])) {
                $saldo = floatVal($pagamento->valor) - floatval($somaPagamento[0]['total_valor']);
                return ['message' => "Valor de pagamento excede ao valor ao saldo devedor de R$ " . number_format($saldo, 2, ',', '.'), "code" => 400];
            } else {
                $pagamento->data = $data['data_pagamento'];
                $pagamento->observacao = $data['observacao_pagamento'];
                $pagamento->valor = floatVal($data['valor_pagamento']);
                $pagamento->save();
                if (isset($data['recibo'])) {
                    $upload = $this->reciboRepository->create($data, $data['id']);
                    if ($upload['code'] == 400) {
                        return ['message' => 'O pagamento foi alterado com sucesso, porem houve uma falha no upload do arquivo. Contate o suporte', 'code' => 400, 'erro' => $upload['erro']];
                    }
                }
                $response = ["code", 200];
            }
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na alteração de pagamento, contate o suporte.', 'code' => 400, 'erro' => $e->getMessage()];
        }
        return $response;

    }


    public function delete($id)
    {
        try {
            $recibos = Recibo::where('pagamento_id', $id)->get();
            if($recibos) {
                $reciboRepository =  new ReciboRepository();
                foreach($recibos as $recibo) {
                    $reciboRepository->delete($recibo->id);
                }
            }
            $pagamentoDelete =  $this->pagamento->find($id);
            $pagamentoDelete->delete();
            $response =  ['code'=>200];
            Log::info('Exclusão de pagamento ocorreu com sucesso.');

        }
        catch (Exception $e) {
            $response = ['message' => 'Falha fatal na exclusão de pagamento, contate o suporte.', 'code' => 400, 'erro' => $e->getMessage()];
            Log::error('Falha fatal na exclusão de pagamento . '.$e->getMessage());
        }
        return $response;

    }

}
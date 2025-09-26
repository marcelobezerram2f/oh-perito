<?php

namespace App\Repositories;

use App\Models\ErroExecucao;
use App\Models\Esclarecimento;
use App\Models\Pagamento;
use App\Models\Processo;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Log;

class ProcessosRepository
{

    private $processo;
    private $esclarecimento;
    private $pagamento;
    private $erroExecucao;



    public function __construct()
    {
        $this->processo = new Processo();
        $this->esclarecimento = new Esclarecimento();
        $this->pagamento = new Pagamento();
        $this->erroExecucao = new ErroExecucao();
    }



    public function getAll()
    {

        try {
            $processos = $this->processo->whereNotNull('id')->with('equipe')->orderBy('created_at', 'DESC'  )->get();
            $response = $processos;
        } catch (Exception $e) {

            $response = ['message' => 'Falha fatal na coleta dos processos, Contate o suporte!', 'code' => 400, 'erro' => $e->getMessage()];
        }

        return $response;


    }


    public function create($data)
    {
        try {
            $data['pasta'] = !is_null($data['carga']) ? 1 : 0;
            $data['honorario'] = !is_null($data['honorario'])? str_replace(',','.',str_replace('.', '',$data['honorario'])): $data['honorario'];
            $data['calculo_conforme_erro'] =  !is_null($data['honorario'])? floatval($data['honorario']*0.3): null;

            $processos = $this->processo->create($data);

            $response = ['message' => 'Processo cadastrado com sucesso!', 'code' => 200];
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na coleta dos processos, Contate o suporte!', 'code' => 400, 'erro' => $e->getMessage()];
        }
        return $response;
    }

    public function getById($id)
    {

        try {
            $processo = $this->processo->where('id', $id)->with(['esclarecimentos','pagamentos','errosExecucao'])->get();
            $response = $processo;
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na coleta dos processos, Contate o suporte!', 'code' => 400, 'erro' => $e->getMessage()];
        }

        return $response;


    }

    public function getByDue()
    {

        try {
            $today = date('Y-m-d');
            $dateLimit =  date('Y-m-d', strtotime('+5 days'));
            $processos = $this->processo->whereBetween('prazo', [$today,$dateLimit])->where('status', 'andamento')->with('equipe')->get();
            $result =[];
            foreach ($processos as $processo) {
                $array = [
                    "id"=> $processo->id,
                    "numero_processo"=> $processo->numero_processo,
                    "calculista" => $processo->equipe->nome,
                    "prazo" => date('d/m/Y', strtotime($processo->prazo)),
                    "dias" => diasRestantes($processo->prazo)
                ];

                array_push($result, $array);
                unset($array);

            }
            $response = $result;
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na coleta dos processos, Contate o suporte!', 'code' => 400, 'erro' => $e->getMessage()];
        }

        return $response;


    }

    public function inIds($ids)
    {
        try {

            $processos = $this->processo->whereIn('id', $ids['ids'])->get();
            $result =[];
            foreach ($processos as $processo) {
                $array = [
                    "id"=> $processo->id,
                    "numero_processo"=> $processo->numero_processo,
                    "reclamante" => $processo->reclamante,
                    "reclamada" =>$processo->reclamada,
                    "honorario" => "R$ ". number_format($processo->honorario,2,',','.'),
                    "calculo_conforme_erro" =>"R$ ". number_format($processo->calculo_conforme_erro,2,',','.'),
                ];

                array_push($result, $array);
                unset($array);

            }
            $response = $result;
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na coleta dos processos, Contate o suporte!', 'code' => 400, 'erro' => $e->getMessage()];
        }

        return $response;


    }

    public function update($data)
    {
        try {

            $data['honorario'] = !is_null($data['honorario'])? str_replace(',','.',str_replace('.', '',$data['honorario'])): $data['honorario'];

            $erros = $this->erroExecucao->where('processo_id', $data['id'])->count();
            if ($erros > 0 || isset($data['data_erro_1']) ) {
                $calculo_erro =  floatval($data['honorario']*0.20);
            } else{
                $calculo_erro =  floatval($data['honorario']*0.30) ;
            }

            $dataUpdate = [
                "id" => $data['id'],
                "numero_processo" => $data['numero_processo'],
                "vara" => $data['vara'],
                "mes_ano" => $data['mes_ano'],
                "reclamante" => $data['reclamante'],
                "doc_reclamante" => $data['doc_reclamante'],
                "reclamada" => $data['reclamada'],
                "doc_reclamada" => $data['doc_reclamada'],
                "carga" => $data['carga'],
                "prazo" => $data['prazo'],
                "laudo_judicial" => $data['laudo_judicial'],
                "equipe_id" => $data['equipe_id'],
                "status" => $data['status'],
                "honorario" => $data['honorario'],
                "liquidado" => $data['liquidado'],
                "calculo_conforme_erro"=> $calculo_erro,
                "observacoes" => $data['observacoes']
            ];


            $processo = $this->processo->find($data['id']);
            $processo->update($dataUpdate);
            $controle =  $this->processControl($data);
            if($controle['code'] == 400) {
                $response = ['message' => $controle['message'], 'code'=>400];
            } else {
                $response = ['code'=>200, 'id'=>$data['id']];
            }
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na atualização dos processos, Contate o suporte!', 'code' => 400, 'erro' => $e->getMessage(), 'trace'=>$e->getTraceAsString()];
        }
        return $response;
    }

    public function processControl($data)
    {
        $falhaPersistência = [];
        if (isset($data['carga_esclarecimento_1'])) {
            try {
                $esclarecimentos = contarEsclarecimentos($data);
                for ($i = 1; $i <= $esclarecimentos; $i++) {
                    $novoEsclarecimento = [
                        "carga" => $data["carga_esclarecimento_$i"],
                        "entrega_judicial" => $data["entrega_judicial_esclarecimento_$i"],
                        "processo_id" => $data["id"],
                        "advogado" => $data["advogado_$i"],
                    ];
                    $this->esclarecimento->create($novoEsclarecimento);
                }
            } catch (Exception $e) {
                array_push($falhaPersistência, ["falha_add_exclarecimento" => "Falha fatal na persistência de novo esclarecimento."]);
                Log::error("Ocorreu uma falha fatal na persistencia de novo esclarecimento. Error->" . $e->getMessage());
            }
        }

        if (isset($data['valor_pagamento_1'])) {
            try {
                $pagamentos = contarPagamentos($data);
                for ($i = 1; $i <= $pagamentos; $i++) {
                    $novoPagamento = [
                        "processo_id" => $data["id"],
                        "valor" => str_replace(',', '.',str_replace('.','',$data["valor_pagamento_$i"])),
                        "data" => $data["data_pagamento_$i"],
                        "observacao" => $data["observacao_pagamento_$i"],

                    ];
                    $this->pagamento->create($novoPagamento);
                }
            } catch (Exception $e) {
                array_push($falhaPersistência, ["falha_add_pagamento" => "Falha fatal na persistência de novo pagamento."]);
                Log::error("Ocorreu uma falha fatal na persistencia de novo pagamento. Error->" . $e->getMessage());
            }
        }

        if (isset($data['data_erro_1'])) {
            try {

                $erros = contarErros($data);
                for ($i = 1; $i <= $erros; $i++) {
                    $novoErro = [
                        "tipo_erro" => $data["tipo_erro_$i"],
                        "data_erro" => $data["data_erro_$i"],
                        "processo_id" => $data["id"],
                        "custo_apoio" => $data["custo_apoio_$i"],
                        "observacao" => $data["observacao_erro_$i"]

                    ];
                    $this->erroExecucao->create($novoErro);
                }
            } catch (Exception $e) {
                array_push($falhaPersistência, ["falha_add_erro" => "Falha fatal na persistência de novo erro de execução do processo."]);
                Log::error("Ocorreu uma falha fatal na persistencia de novo erro de execução do processo. Error->" . $e->getMessage());
            }
        }
        if (empty($falhaPersistência)) {
            return ['code' => 200];
        } else {
            return ['message' => $falhaPersistência, 'code' => 200];
        }
    }


}
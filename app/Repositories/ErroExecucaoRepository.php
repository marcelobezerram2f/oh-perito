<?php

namespace App\Repositories;

use App\Models\ErroExecucao;
use App\Models\Processo;
use Exception;


class ErroExecucaoRepository
{


    private $erroExecucao;

    public function __construct()
    {
        $this->erroExecucao = new ErroExecucao();
    }

    public function create($data)
    {
        try {
            if (isset($data['id']) && !is_null($data['id'])) {
                return $this->update($data);
            } else {
                $novoErro = [
                    "tipo_erro" => $data["tipo_erro"],
                    "data_erro" => $data["data_erro"],
                    "processo_id" => $data["processo_id"],
                    "custo_apoio" => $data["custo_apoio"],
                    "observacao" => $data["observacao"]

                ];
                $persist = $this->erroExecucao->create($novoErro);
                if ($persist->id) {
                    $processo =  Processo::find($data["processo_id"]);
                    $processo->calculo_conforme_erro = floatval($processo->honorario * 0.20);
                    $processo->save();
                    $response = ['code' => 200];
                }
            }
        } catch (Exception $e) {
            $response = ["message" => "Falha fatal na persistência de novo erro de execução.", "code" => 400];
            \Log::error("Ocorreu uma falha fatal na persistencia de novo erro de execução. Error->" . $e->getMessage());
        }

        return $response;
    }

    public function update($data)
    {
        try {
            $erroUpdate = $this->erroExecucao->find($data['id']);
            $erroUpdate->tipo_erro = $data['tipo_erro'];
            $erroUpdate->data_erro = $data['data_erro'];
            $erroUpdate->processo_id = $data['processo_id'];
            $erroUpdate->custo_apoio = $data['custo_apoio'];
            $erroUpdate->observacao = $data['observacao'];
            $erroUpdate->save();
            $response = ["code" => 200];
        } catch (Exception $e) {
            $response = ["message" => "Falha fatal na alteração de erro de execução.", "code" => 400];
            \Log::error("Ocorreu uma falha fatal na alteração de erro de execução. Error->" . $e->getMessage());
        }

        return $response;
    }


    public function delete($id)
    {
        try {
            $erroDelete = $this->erroExecucao->find($id);
            $processoId = $erroDelete->processo_id;
            $erroDelete->delete();
            $erros = $this->erroExecucao->where('processo_id', $processoId)->count();
            if($erros == 0) {
                $processo =  Processo::find($processoId);
                $processo->calculo_conforme_erro = floatval($processo->honorario * 0.30);
                $processo->save();
            }
            $response = ['code' => 200];
        } catch (Exception $e) {
            $response = ["message" => "Falha fatal na esclusão de erro de execução.", "code" => 400];
            \Log::error("Ocorreu uma falha fatal na esclusão de erro de execução. Error->" . $e->getMessage());
        }

        return $response;
    }



}

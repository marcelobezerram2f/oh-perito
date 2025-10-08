<?php

namespace App\Repositories;

use App\Models\Esclarecimento;
use Exception;

class EsclarecimentoRepository
{


    private $esclarecimento;

    public function __construct()
    {
        $this->esclarecimento = new Esclarecimento();
    }

    public function create($data)
    {

        try {
            if(isset($data['id']) && !is_null($data['id'])) {
                return $this->update($data);
            } else {
                $novoEsclarecimento = [
                    "carga" => $data["carga_esclarecimento"],
                    "entrega_judicial" => $data["entrega_judicial_esclarecimento"],
                    "prazo" => $data["prazo_esclarecimento"],
                    "processo_id" => $data["processo_id"],
                    "observacao" => $data["observacao_esclarecimento"],
                ];
            }
            $persist = $this->esclarecimento->create($novoEsclarecimento);
            if ($persist->id) {
                $response = ['code' => 200];
            }


        } catch (Exception $e) {
            $respponse = ["message" => "Falha fatal na persistência de novo esclarecimento.", "code" => 400];
            \Log::error("Ocorreu uma falha fatal na persistencia de novo esclarecimento. Error->" . $e->getMessage());
        }

        return $response;

    }


    public function update($data)
    {
        try {
            $esclarecimentoUpdate = $this->esclarecimento->find($data['id']);
            $esclarecimentoUpdate->carga = $data['carga_esclarecimento'];
            $esclarecimentoUpdate->entrega_judicial = $data['entrega_judicial_esclarecimento'];
            $esclarecimentoUpdate->prazo = $data['prazo_esclarecimento'];
            $esclarecimentoUpdate->processo_id = $data['processo_id'];
            $esclarecimentoUpdate->observacao = $data['observacao_esclarecimento'];
            $esclarecimentoUpdate->save();
            $response = ["code" => 200];
        } catch (Exception $e) {
            $response = ["message" => "Falha fatal na alteração de esclarecimento.", "code" => 400];
            \Log::error("Ocorreu uma falha fatal na alteração de esclarecimento. Error->" . $e->getMessage());
        }

        return $response;
    }


    public function delete($id)
    {
        try {
            $esclarecimentoDelete = $this->esclarecimento->find($id);
            $esclarecimentoDelete->delete();
            $response = ['code' => 200];
        } catch (Exception $e) {
            $response = ["message" => "Falha fatal na esclusão de esclarecimento.", "code" => 400];
            \Log::error("Ocorreu uma falha fatal na esclusão de esclarecimento. Error->" . $e->getMessage());
        }

        return $response;
    }
}
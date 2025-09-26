<?php

namespace App\Repositories;

use App\Models\Equipe;
use App\Models\Processo;
use DateTime;
use Exception;
use IntlDateFormatter;

class EquipeRepository
{


    private $equipe;
    private $processo;

    public function __construct()
    {
        $this->equipe = new Equipe();
        $this->processo = new Processo();

    }


    public function getAll()
    {

        try {
            $calculistas = $this->equipe->all();
            $response = $calculistas;
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na coleta de nomnes da equipe, contate o suporte.', 'code' => 400];
        }
        return $response;
    }

    public function create($data)
    {

        try {

            $novoMembro = [
                'nome' => $data['nome'],
                'telefone' => $data['telefone'],
                'ativo' => 1,
                'dados_bancarios' => json_encode([
                    'banco' => $data['banco'],
                    'agencia' => $data['agencia'],
                    'conta_corrente' => $data['conta_corrente'],
                    'chave_pix' => $data['chave_pix']
                ]),
                'email' => $data['email']
            ];


            $calculista = $this->equipe->create($novoMembro);
            $response = $calculista;
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na inclusão de novo membro na equipe, contate o suporte.', 'code' => 400];
        }
        return $response;
    }

    public function getById($id)
    {

        try {
            $calculista = $this->equipe->find($id);
            $dadosBancarios = json_decode($calculista->dados_bancarios, true);
            $response = [
                'id' => $calculista->id,
                'nome' => $calculista->nome,
                'telefone' => $calculista->telefone,
                'ativo' => $calculista->ativo,
                'email' => $calculista->email,
                'banco' => $dadosBancarios['banco'],
                'agencia' => $dadosBancarios['agencia'],
                'conta_corrente' => $dadosBancarios['conta_corrente'],
                'chave_pix' => $dadosBancarios['chave_pix'],
            ];
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na coleta de membro da equipe, contate o suporte.', 'code' => 400, 'erro' => $e->getMessage()];
        }
        return $response;
    }

    public function update($data)
    {
        try {
            $dadosBancarios = json_encode([
                'banco' => $data['banco'],
                'agencia' => $data['agencia'],
                'conta_corrente' => $data['conta_corrente'],
                'chave_pix' => $data['chave_pix']
            ]);
            $updateMembro = $this->equipe->find($data['id']);
            $updateMembro->nome = $data['nome'];
            $updateMembro->telefone = $data['telefone'];
            $updateMembro->ativo = $data['ativo'];
            $updateMembro->email = $data['email'];
            $updateMembro->dados_bancarios = $dadosBancarios;
            $updateMembro->save();
            $response = ['message' => 'Dados de membro da equipe ' . $data['nome'] . ', alterado com sucesso, contate o suporte.', 'code' => 200];
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na alteração de membro na equipe, contate o suporte.', 'code' => 400];
        }
        return $response;
    }

    public function delete($id)
    {

        try {
            $calculista = $this->equipe->find($id);
            $nome = $calculista->nome;
            $calculista->delete();
            $response = ['message' => 'Dados de membro da equipe ' . $nome . ', excluido com sucesso, contate o suporte.', 'code' => 200];

        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na exclusão de membro da equipe, contate o suporte.', 'code' => 400, 'erro' => $e->getMessage()];
        }
        return $response;
    }

    public function failReport()
    {
        try {
            $firstDay = new DateTime('first day of this month');
            $lastDay = new DateTime('last day of this month');
            $fmt = new IntlDateFormatter(
                'pt_BR',                // idioma/região
                IntlDateFormatter::LONG, // formato longo (setembro 2025)
                IntlDateFormatter::NONE, // sem hora
                'America/Sao_Paulo',    // timezone
                IntlDateFormatter::GREGORIAN,
                'MMMM yyyy'             // formato personalizado
            );

            $periodo = $fmt->format($firstDay);
            $initial_date = $firstDay->format('Y-m-d');
            $end_date = $lastDay->format('Y-m-d');
            $calculistas = $this->equipe->all();
            $result = [];
            foreach ($calculistas as $calculista) {
                $processos = $this->processo->whereBetween('carga', [$initial_date, $end_date])->where('equipe_id', $calculista->id)->with('errosExecucao');
                $qtdProcessos = $processos->count();
                $qtdErros = 0;
                $processos = $processos->get();
                foreach ($processos as $processo) {
                    if ($processo->errosExecucao->count() > 0) {
                        $qtdErros = $processo->errosExecucao->count() + $qtdErros;
                    }
                }

                $array = [
                    "id" => $calculista->id,
                    "nome" => $calculista->nome,
                    "qtd_processos" => $qtdProcessos,
                    "qtd_erros" => $qtdErros,
                    "percert_erros" => $qtdErros > 0 ? ($qtdErros / $qtdProcessos) * 100 : 0
                ];
                array_push($result, $array);
                unset($array);
                $qtdErros = 0;
            }

            $performance = analisarPropostasErros(['dados'=>$result]);
            $response = ["periodo" => $periodo, "dados" => $result, "performance"=>$performance];

        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na coleta de erros da equipe, contate o suporte.', 'code' => 400, 'erro' => $e->getMessage()];
        }
        return $response;


    }

}
<?php

namespace App\Repositories;

use App\Models\ErroExecucao;
use App\Models\Esclarecimento;
use App\Models\Pagamento;
use App\Models\Processo;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Foreach_;

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



    public function getAll($data)
    {
        try {
            $query = $this->processo->with('equipe');

            // filtro opcional: número do processo
            if (!empty($data['numero_processo'])) {
                $query->where('numero_processo', $data['numero_processo']);
            }

            // filtro opcional: prazo
            if (!empty($data['prazo'])) {
                $query->whereDate('prazo', $data['prazo']);
            }

            // filtro opcional: equipe
            if (!empty($data['equipe_id'])) {
                $query->where('equipe_id', $data['equipe_id']);
            }
            // filtro opcional: Reclamante / Reclamada
            if (!empty($data['reclamante_reclamado'])) {
                $query->where('reclamante', 'like', '%' . $data['reclamante_reclamado'] . '%')
                    ->orWhere('reclamada', 'like', '%' . $data['reclamante_reclamado'] . '%');
                }

            $processos = $query->orderBy('created_at', 'DESC')->get();
            return $processos;

        } catch (\Exception $e) {
            return [
                'message' => 'Falha fatal na coleta dos processos, Contate o suporte!',
                'code' => 400,
                'erro' => $e->getMessage()
            ];
        }
    }




    public function create($data)
    {
        try {
            $data['pasta'] = !is_null($data['carga']) ? 1 : 0;
            $data['honorario'] = !is_null($data['honorario']) ? str_replace(',', '.', str_replace('.', '', $data['honorario'])) : $data['honorario'];
            $data['calculo_conforme_erro'] = !is_null($data['honorario']) ? floatval($data['honorario'] * 0.3) : null;

            $processos = $this->processo->create($data);

            $response = ['message' => 'Processo cadastrado com sucesso!', 'code' => 200];
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na gravação do processo, Contate o suporte!', 'code' => 400, 'erro' => $e->getMessage()];
        }
        return $response;
    }

    public function getById($id)
    {

        try {
            $processo = $this->processo->where('id', $id)->with(['esclarecimentos', 'pagamentos', 'pagamentos.recibos', 'errosExecucao'])->get();
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
            //$dateLimit = date('Y-m-d', strtotime('+5 days'));
            $processos = $this->processo
                ->where('prazo', '<=', $today)
                ->where('status', 'andamento')
                ->with('equipe')
                ->get();
            $result = [];
            foreach ($processos as $processo) {
                $array = [
                    "id" => $processo->id,
                    "numero_processo" => $processo->numero_processo,
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
            $result = [];
            foreach ($processos as $processo) {
                $array = [
                    "id" => $processo->id,
                    "numero_processo" => $processo->numero_processo,
                    "reclamante" => $processo->reclamante,
                    "reclamada" => $processo->reclamada,
                    "honorario" => "R$ " . number_format($processo->honorario, 2, ',', '.'),
                    "calculo_conforme_erro" => "R$ " . number_format($processo->calculo_conforme_erro, 2, ',', '.'),
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

            $data['honorario'] = !is_null($data['honorario']) ? str_replace(',', '.', str_replace('.', '', $data['honorario'])) : $data['honorario'];

            $erros = $this->erroExecucao->where('processo_id', $data['id'])->count();
            if ($erros > 0 || isset($data['data_erro_1'])) {
                $calculo_erro = floatval($data['honorario'] * 0.20);
            } else {
                $calculo_erro = floatval($data['honorario'] * 0.30);
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
                "calculo_conforme_erro" => $calculo_erro,
                "observacoes" => $data['observacoes']
            ];


            $processo = $this->processo->find($data['id']);
            $processo->update($dataUpdate);
            $response = ['code' => 200, 'id' => $data['id']];
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na atualização dos processos, Contate o suporte!', 'code' => 400, 'erro' => $e->getMessage(), 'trace' => $e->getTraceAsString()];
        }
        return $response;
    }

    public function delete($id)
    {
        try {

            $this->erroExecucao->where('processo_id', $id)->delete();
            $this->esclarecimento->where('processo_id', $id)->delete();
            $pagamentos = $this->pagamento->where('processo_id', $id)->get();
            $pagamentoRepository = new PagamentosRepository();
            if ($pagamentos) {
                foreach ($pagamentos as $pagamentoItem)
                $pagamentoRepository->delete($pagamentoItem->id);
            }
            $processoDelete = $this->processo->find($id);
            $processoDelete->delete();

            $response = ['code' => 200];
        } catch (Exception $e) {
            $response = ['message' => 'Falha fatal na exclusão do processo, Contate o suporte!', 'code' => 400, 'erro' => $e->getMessage(), 'trace' => $e->getTraceAsString()];
        }
        return $response;
    }

}
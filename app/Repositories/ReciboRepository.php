<?php

namespace App\Repositories;

use App\Models\Recibo;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ReciboRepository
{


    private $recibo;


    public function __construct()
    {
        $this->recibo = new Recibo();
    }

    public function create($data, $pagamentoId, )
    {
        try {
            dd(removerAcentos($data['tecnico']));
            foreach($data['recibo'] as $recibo){
                $file = $recibo;
                $path = $file->storeAs(
                    'recibos/' . removerAcentos($data['tecnico']) . '/' . date('M_Y', strtotime($data['data_pagamento'])),
                    $file->getClientOriginalName(),
                    'public'
                );
                       $this->recibo->create([
                    'pagamento_id' => $pagamentoId,
                    'nome_arquivo' => $file->getClientOriginalName(),
                    'blob' =>  asset('storage/' . $path),
                ]);
            }
            $response = ['code' => 200];
        } catch (Exception $e) {
            Log::error("falha no upload de recibos. Arquivo(s) ".json_encode($data) ." ERRO -> ". $e->getMessage());
            $response = ['code' => 400, 'erro' => $e->getMessage()];
        }
        return $response;
    }

    // Recuperar o BLOB e retornar como download
    public function getById($id)
    {
        return $this->recibo->findOrFail($id);

    }


    public function delete($reciboId)
{
    try {

        // Busca o registro do recibo
        $recibo = $this->recibo->findOrFail($reciboId);

        $reciboBlob =  $recibo->blob;
        // Extrai o path relativo a partir da URL salva em 'blob'
        // Exemplo: "http://127.0.0.1:8000/storage/recibos/MARCELLA/Oct_2025/eu.png"
        // vira: "recibos/MARCELLA/Oct_2025/eu.png"
        $path = str_replace(asset('storage') . '/', '', $recibo->blob);
        // Remove o arquivo do disco (storage/app/public/...)
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        // Remove o registro no banco
        $recibo->delete();
        Log::error("Exclusão do recibo executada com sucesso: " . $reciboBlob);

        return ['code' => 200, 'message' => 'Arquivo excluído com sucesso'];
    } catch (Exception $e) {
        Log::error("Falha na exclusão do recibo: " . $e->getMessage());
        return ['code' => 400, 'erro' => $e->getMessage()];
    }
}
}
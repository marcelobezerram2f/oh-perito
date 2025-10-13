<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Processo;
use App\Models\Equipe;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportarProcessos extends Command
{
    protected $signature = 'processos:importar {caminho_csv}';
    protected $description = 'Importa registros do CSV para a tabela processos';

    public function handle()
    {
        $caminho = $this->argument('caminho_csv');

        if (!file_exists($caminho)) {
            $this->error("Arquivo não encontrado: {$caminho}");
            return 1;
        }

        $handle = fopen($caminho, 'r');
        if (!$handle) {
            $this->error("Não foi possível abrir o arquivo CSV.");
            return 1;
        }

        $header = fgetcsv($handle, 0, ','); // supondo separador ";"
        $importados = 0;

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($handle, 0, ',')) !== false) {
                $dados = array_combine($header, $row);
                if (!$dados) continue;
                    /*if(is_null($dados['status']) || empty($dados['status'])) {
                        $dados['status'] = "andamento";
                    }*/
                    $processo= Processo::where('numero_processo', $dados['numero_processo'])->first();
                    $processo->carga =$dados['carga'];
                    $processo->save();
                $importados++;
            }

            DB::commit();
            fclose($handle);

            $this->info("Importação concluída. Registros importados: {$importados}");
            return 0;
        } catch (\Throwable $e) {
            DB::rollBack();
            fclose($handle);
            $this->error("Erro durante a importação: " . $e->getMessage());
            return 1;
        }
    }

    private static function validaData($valor, &$observacoes, $campo)
    {
        $valor = trim($valor);
        if (empty($valor)) return null;

        try {
            $data = Carbon::createFromFormat('d/m/Y', $valor)->format('Y-m-d');
            return $data;
        } catch (\Exception $e) {
            $observacoes .= "\n{$campo} inválido: {$valor}";
            return null;
        }
    }

    public function mesParaNumero(string $mes): ?string
    {
        $mapa = [
            'jan' => '01',
            'fev' => '02',
            'mar' => '03',
            'abr' => '04',
            'mai' => '05',
            'jun' => '06',
            'jul' => '07',
            'ago' => '08',
            'set' => '09',
            'out' => '10',
            'nov' => '11',
            'dez' => '12',
        ];

        $mes = mb_strtolower(trim($mes));

        return $mapa[$mes] ?? null; // retorna null se não encontrar
    }

}

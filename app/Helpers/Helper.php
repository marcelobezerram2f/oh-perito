<?php


function removerAcentos($string) {
    // Substitui ç/Ç por c/C
    $string = str_replace(
        ['ç', 'Ç'],
        ['c', 'C'],
        $string
    );

    // Remove acentuação
    $mapaAcentos = [
        'á'=>'a','à'=>'a','ã'=>'a','â'=>'a','ä'=>'a',
        'Á'=>'A','À'=>'A','Ã'=>'A','Â'=>'A','Ä'=>'A',
        'é'=>'e','è'=>'e','ê'=>'e','ë'=>'e',
        'É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E',
        'í'=>'i','ì'=>'i','î'=>'i','ï'=>'i',
        'Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I',
        'ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o',
        'Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O',
        'ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u',
        'Ú'=>'U','Ù'=>'U','Û'=>'U','Ü'=>'U',
        'ñ'=>'n','Ñ'=>'N'
    ];

    return strtr($string, $mapaAcentos);
}


function contarEsclarecimentos(array $array): int {
    $contador = 0;
    foreach ($array as $chave => $valor) {
        if (strpos($chave, 'carga_esclarecimento_') === 0) {
            $contador++;
        }
    }
    return $contador;
}

function contarPagamentos(array $array): int {
    $contador = 0;
    foreach ($array as $chave => $valor) {
        if (strpos($chave, 'valor_pagamento_') === 0) {
            $contador++;
        }
    }
    return $contador;
}

function contarErros(array $array): int {
    $contador = 0;
    foreach ($array as $chave => $valor) {
        if (strpos($chave, 'tipo_erro_') === 0) {
            $contador++;
        }
    }
    return $contador;
}

function analisarPropostasErros($data) {
    $dados = $data['dados'];

    // Ordena por nome para desempate alfabético
    usort($dados, function($a, $b) {
        return strcmp($a['nome'], $b['nome']);
    });

    // 1. Encontrar maior número de propostas com menor número de erros
    $maiorProposta = null;
    foreach ($dados as $item) {
        if ($maiorProposta === null) {
            $maiorProposta = $item;
        } else {
            if ($item['qtd_processos'] > $maiorProposta['qtd_processos']) {
                $maiorProposta = $item;
            } elseif ($item['qtd_processos'] == $maiorProposta['qtd_processos']) {
                if ($item['qtd_erros'] < $maiorProposta['qtd_erros']) {
                    $maiorProposta = $item;
                }
            }
        }
    }

    // 2. Encontrar menor número de propostas ou número de erros elevado
    $minPropostas = min(array_column($dados, 'qtd_processos'));
    $maxErros = max(array_column($dados, 'qtd_erros'));

    $candidatos = [];
    foreach ($dados as $item) {
        if ($item['qtd_processos'] == $minPropostas || $item['qtd_erros'] == $maxErros) {
            $candidatos[] = $item;
        }
    }

    // Se houver mais de um, agregamos em "VARIOS"
    if (count($candidatos) > 1) {
        $menorPropostaErro = [[
            'nome' => 'VARIOS',
            'qtd_processos' => $minPropostas,
            'qtd_erros' => $maxErros
        ]];
    } else {
        $menorPropostaErro = array_map(function($item) {
            return [
                'nome' => $item['nome'],
                'qtd_processos' => $item['qtd_processos'],
                'qtd_erros' => $item['qtd_erros']
            ];
        }, $candidatos);
    }

    return [
        'maior_proposta_menor_erro' => [
            'nome' => $maiorProposta['nome'],
            'qtd_processos' => $maiorProposta['qtd_processos'],
            'qtd_erros' => $maiorProposta['qtd_erros']
        ],
        'menor_proposta_ou_erro_elevado' => $menorPropostaErro
    ];
}

function diasRestantes($data)
{
    // Tenta os formatos mais comuns: Y-m-d e d/m/Y
    $formats = ['Y-m-d', 'd/m/Y'];
    $dataAlvo = null;

    foreach ($formats as $fmt) {
        $d = DateTime::createFromFormat($fmt, $data);
        // Verifica se o parsing bate exatamente com a string informada
        if ($d && $d->format($fmt) === $data) {
            $dataAlvo = $d;
            break;
        }
    }

    // Se não foi possível pelo formato acima, tenta strtotime() como fallback
    if (!$dataAlvo) {
        $ts = strtotime($data);
        if ($ts === false) {
            return null; // ou "Data inválida!" se preferir string
        }
        $dataAlvo = (new DateTime())->setTimestamp($ts);
    }

    // Zera horas, minutos e segundos para comparar só a data
    $dataAlvo->setTime(0, 0, 0);
    $hoje = new DateTime();
    $hoje->setTime(0, 0, 0);

    // Calcula diferença em segundos e converte para dias
    $diffSeconds = $dataAlvo->getTimestamp() - $hoje->getTimestamp();
    $dias = (int) ($diffSeconds / 86400); // 86400 segundos = 1 dia

    return $dias;
}


function agruparPorEquipe(array $dados, $mes): array {
    $resultado = [];

    foreach ($dados as $item) {
        $equipeId = $item['processo']['equipe_id'];
        $nomeEquipe = $item['processo']['equipe']['nome'];
        $processoId = $item['processo_id'];
        $valor = (float) $item['total_valor'];

        if (!isset($resultado[$equipeId])) {
            $resultado[$equipeId] = [
                'mes' => $mes,
                'nome' => $nomeEquipe,
                'valor' => 0,
                'processos_ids' => []
            ];
        }

        $resultado[$equipeId]['valor'] += $valor;
        $resultado[$equipeId]['processos_ids'][] = $processoId;
    }

    // Reorganiza para array simples
    return array_values($resultado);
}
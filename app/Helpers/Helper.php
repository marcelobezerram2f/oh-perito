<?php


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

function diasRestantes($data) {
    // Data atual (sem horas para não atrapalhar a contagem)
    $hoje = new DateTime(date('Y-m-d'));

    // Data informada
    $dataAlvo = DateTime::createFromFormat('Y-m-d', $data);

    if (!$dataAlvo) {
        return "Data inválida!";
    }

    // Diferença entre as datas
    $diff = $hoje->diff($dataAlvo);

    // Se a data já passou, retorna negativo
    $dias = (int)$diff->format('%r%a');

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
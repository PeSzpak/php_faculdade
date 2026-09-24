<?php

// Pra rodar: php sistema-controle-colheita.php

// Dados que entram: responsavel, quantidade de culturas e, para cada cultura, nome, quantidade produzida (kg) e valor por kg.
// Armazenados: culturas validas (array) para o relatorio final.
// Calculados: valor da producao de cada cultura e totais.
// Validados: quantidade produzida e valor por kg maiores que zero.
// Operacao que se repete: cadastro de cada cultura (for).
// Acumulados: culturas validas, total em kg e valor total.
// Funcoes: calculo, classificacao, cadastro e exibicao.

function calcularValorProducao($quantidadeKg, $valorPorKg)
{
    return $quantidadeKg * $valorPorKg;
}

function classificarProducao($valorProducao)
{
    if ($valorProducao < 5000) {
        return 'PRODUCAO DE PEQUENO PORTE';
    } elseif ($valorProducao < 20000) {
        return 'PRODUCAO DE MEDIO PORTE';
    }
    return 'PRODUCAO DE GRANDE PORTE';
}

function formatarMoeda($valor)
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

// quantidade ou valor por kg invalidos sao avisados e ignorados,
// sem interromper o cadastro das demais.
function cadastrarCulturas($quantidadeCulturas)
{
    $culturas = [];

    for ($i = 1; $i <= $quantidadeCulturas; $i++) {
        echo PHP_EOL . '--- Cultura ' . $i . ' de ' . $quantidadeCulturas . ' ---' . PHP_EOL;

        echo 'Nome da cultura: ';
        $nome = readline();

        echo 'Quantidade produzida (kg): ';
        $quantidadeKg = (float) readline();

        echo 'Valor estimado de venda por kg (R$): ';
        $valorPorKg = (float) readline();

        if ($quantidadeKg <= 0 || $valorPorKg <= 0) {
            echo 'Registro invalido (quantidade e valor por kg devem ser maiores que zero). Ignorado.' . PHP_EOL;
            continue;
        }

        $valorProducao = calcularValorProducao($quantidadeKg, $valorPorKg);

        $culturas[] = [
            'nome' => $nome,
            'quantidadeKg' => $quantidadeKg,
            'valorPorKg' => $valorPorKg,
            'valorProducao' => $valorProducao,
            'classificacao' => classificarProducao($valorProducao),
        ];
    }

    return $culturas;
}

function calcularTotais($culturas)
{
    $totalKg = 0;
    $valorTotal = 0;

    foreach ($culturas as $cultura) {
        $totalKg += $cultura['quantidadeKg'];
        $valorTotal += $cultura['valorProducao'];
    }

    return [
        'quantidadeValidas' => count($culturas),
        'totalKg' => $totalKg,
        'valorTotal' => $valorTotal,
    ];
}

function exibirCulturas($culturas)
{
    echo PHP_EOL;
    echo '==================================================' . PHP_EOL;
    echo '              CULTURAS CADASTRADAS                ' . PHP_EOL;
    echo '==================================================' . PHP_EOL;

    foreach ($culturas as $cultura) {
        echo 'Cultura: ' . $cultura['nome'] . PHP_EOL;
        echo '  Quantidade produzida: ' . number_format($cultura['quantidadeKg'], 2, ',', '.') . ' kg' . PHP_EOL;
        echo '  Valor por kg: ' . formatarMoeda($cultura['valorPorKg']) . PHP_EOL;
        echo '  Valor estimado da producao: ' . formatarMoeda($cultura['valorProducao']) . PHP_EOL;
        echo '  Classificacao: ' . $cultura['classificacao'] . PHP_EOL;
        echo '--------------------------------------------------' . PHP_EOL;
    }
}

function exibirResumo($codigoColheita, $data, $responsavel, $totais)
{
    echo PHP_EOL;
    echo '==================================================' . PHP_EOL;
    echo '                  RESUMO GERAL                    ' . PHP_EOL;
    echo '==================================================' . PHP_EOL;
    echo 'Codigo da colheita: ' . $codigoColheita . PHP_EOL;
    echo 'Data: ' . $data . PHP_EOL;
    echo 'Responsavel: ' . $responsavel . PHP_EOL;
    echo 'Quantidade de culturas validas: ' . $totais['quantidadeValidas'] . PHP_EOL;
    echo 'Quantidade total produzida: ' . number_format($totais['totalKg'], 2, ',', '.') . ' kg' . PHP_EOL;
    echo 'Valor total estimado da colheita: ' . formatarMoeda($totais['valorTotal']) . PHP_EOL;
    echo 'Classificacao da colheita: ' . classificarProducao($totais['valorTotal']) . PHP_EOL;
}


$codigoColheita = 'COL-' . rand(1000, 9999);
$data = date('d/m/Y');

echo '==================================================' . PHP_EOL;
echo '        SISTEMA DE CONTROLE DE COLHEITA           ' . PHP_EOL;
echo '==================================================' . PHP_EOL;
echo 'Codigo da colheita: ' . $codigoColheita . PHP_EOL;
echo 'Data: ' . $data . PHP_EOL . PHP_EOL;

echo 'Nome do responsavel: ';
$responsavel = readline();

echo 'Quantas culturas serao registradas? ';
$quantidadeCulturas = (int) readline();

if ($quantidadeCulturas <= 0) {
    echo 'Quantidade de culturas invalida. Encerrando.' . PHP_EOL;
    exit;
}

$culturas = cadastrarCulturas($quantidadeCulturas);

if (count($culturas) === 0) {
    echo PHP_EOL . 'Nenhuma cultura valida foi cadastrada.' . PHP_EOL;
    exit;
}

exibirCulturas($culturas);
exibirResumo($codigoColheita, $data, $responsavel, calcularTotais($culturas));

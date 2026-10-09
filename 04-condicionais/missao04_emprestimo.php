<?php
// ============================================================
// Missao 04 - Simulador de Emprestimo
// Executar via terminal: php missao04_emprestimo.php
// ============================================================

echo 'Nome do cliente: ';
$cliente = readline();

echo 'Salario mensal (R$): ';
$salario = (float) readline();

echo 'Valor do emprestimo solicitado (R$): ';
$valorSolicitado = (float) readline();

echo 'Quantidade de parcelas: ';
$quantidadeParcelas = (int) readline();

echo PHP_EOL;

// ------------------------------------------------------------
// Validacao ANTES de qualquer calculo. So chegamos a dividir
// pelo numero de parcelas depois de garantir que ele e > 0,
// evitando divisao por zero.
// ------------------------------------------------------------
if ($salario <= 0 || $valorSolicitado <= 0 || $quantidadeParcelas <= 0) {
    echo 'DADOS INVALIDOS: salario, valor solicitado e quantidade de parcelas devem ser maiores que zero.' . PHP_EOL;
} else {
    $valorParcela = $valorSolicitado / $quantidadeParcelas;
    $limiteParcela = $salario * 0.30;

    if ($valorParcela <= $limiteParcela) {
        $resultado = 'EMPRESTIMO PRE-APROVADO';
    } else {
        $resultado = 'EMPRESTIMO NAO APROVADO';
    }

    // Codigo da simulacao gerado automaticamente.
    $codigoSimulacao = rand(10000, 99999);

    echo '--- RESULTADO DA SIMULACAO ---' . PHP_EOL;
    echo 'Codigo da simulacao: ' . $codigoSimulacao . PHP_EOL;
    echo 'Cliente: ' . $cliente . PHP_EOL;
    echo 'Salario: R$ ' . number_format($salario, 2, ',', '.') . PHP_EOL;
    echo 'Valor solicitado: R$ ' . number_format($valorSolicitado, 2, ',', '.') . PHP_EOL;
    echo 'Quantidade de parcelas: ' . $quantidadeParcelas . PHP_EOL;
    echo 'Valor da parcela: R$ ' . number_format($valorParcela, 2, ',', '.') . PHP_EOL;
    echo 'Limite de comprometimento (30% do salario): R$ ' . number_format($limiteParcela, 2, ',', '.') . PHP_EOL;
    echo 'Resultado da analise: ' . $resultado . PHP_EOL;
}

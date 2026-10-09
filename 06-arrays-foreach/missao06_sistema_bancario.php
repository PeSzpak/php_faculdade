<?php
// ============================================================
// Missao 06 - Sistema Bancario
// Executar via terminal: php missao06_sistema_bancario.php
// ============================================================

$movimentacoes = [
    ['tipo' => 'deposito', 'valor' => 1000],
    ['tipo' => 'saque', 'valor' => 250],
    ['tipo' => 'deposito', 'valor' => 500],
    ['tipo' => 'saque', 'valor' => 120],
];

function listarExtrato($movimentacoes)
{
    echo '===== EXTRATO =====' . PHP_EOL;
    foreach ($movimentacoes as $movimentacao) {
        if ($movimentacao['tipo'] === 'deposito') {
            $rotulo = 'Deposito';
            $sinal = '+';
        } else {
            $rotulo = 'Saque';
            $sinal = '-';
        }

        echo $rotulo . ': ' . $sinal . ' R$ ' . number_format($movimentacao['valor'], 2, ',', '.') . PHP_EOL;
    }
}

function calcularDepositos($movimentacoes)
{
    $total = 0;
    foreach ($movimentacoes as $movimentacao) {
        if ($movimentacao['tipo'] === 'deposito') {
            $total += $movimentacao['valor'];
        }
    }

    return $total;
}

function calcularSaques($movimentacoes)
{
    $total = 0;
    foreach ($movimentacoes as $movimentacao) {
        if ($movimentacao['tipo'] === 'saque') {
            $total += $movimentacao['valor'];
        }
    }

    return $total;
}

function calcularSaldo($movimentacoes)
{
    return calcularDepositos($movimentacoes) - calcularSaques($movimentacoes);
}

listarExtrato($movimentacoes);

echo PHP_EOL;
echo 'Total depositado: R$ ' . number_format(calcularDepositos($movimentacoes), 2, ',', '.') . PHP_EOL;
echo 'Total sacado: R$ ' . number_format(calcularSaques($movimentacoes), 2, ',', '.') . PHP_EOL;
echo 'Saldo final: R$ ' . number_format(calcularSaldo($movimentacoes), 2, ',', '.') . PHP_EOL;

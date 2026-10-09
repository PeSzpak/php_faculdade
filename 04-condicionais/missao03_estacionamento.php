<?php
// ============================================================
// Missao 03 - Sistema de Estacionamento
// Executar via terminal: php missao03_estacionamento.php
// ============================================================

echo 'Nome do cliente: ';
$cliente = readline();

echo 'Placa do veiculo: ';
$placa = readline();

echo 'Tipo do veiculo (moto, carro ou suv): ';
$tipo = readline();

echo 'Quantidade de horas estacionadas: ';
$horas = (float) readline();

echo PHP_EOL;

// Comparacao estrita (===) porque o tipo digitado precisa bater
// exatamente com uma das tres opcoes validas.
$tipoValido = ($tipo === 'moto' || $tipo === 'carro' || $tipo === 'suv');
$horasValidas = ($horas > 0);

if (!$horasValidas && !$tipoValido) {
    echo 'ERRO: quantidade de horas invalida e tipo de veiculo invalido.' . PHP_EOL;
} elseif (!$horasValidas) {
    echo 'ERRO: a quantidade de horas deve ser maior que zero.' . PHP_EOL;
} elseif (!$tipoValido) {
    echo 'ERRO: tipo de veiculo invalido. Use moto, carro ou suv.' . PHP_EOL;
} else {
    // Numero de atendimento e data gerados automaticamente.
    $numeroAtendimento = rand(1000, 9999);
    $dataAtendimento = date('d/m/Y');

    if ($tipo === 'moto') {
        $valorHora = 5.00;
    } elseif ($tipo === 'carro') {
        $valorHora = 8.00;
    } else {
        $valorHora = 12.00;
    }

    $subtotal = $valorHora * $horas;

    // Mais de 8 horas = 10% de desconto.
    if ($horas > 8) {
        $percentualDesconto = 10;
    } else {
        $percentualDesconto = 0;
    }

    $valorDesconto = $subtotal * ($percentualDesconto / 100);
    $totalFinal = $subtotal - $valorDesconto;

    echo '--- COMPROVANTE DE ESTACIONAMENTO ---' . PHP_EOL;
    echo 'Atendimento numero: ' . $numeroAtendimento . PHP_EOL;
    echo 'Data: ' . $dataAtendimento . PHP_EOL;
    echo 'Cliente: ' . $cliente . PHP_EOL;
    echo 'Placa: ' . $placa . PHP_EOL;
    echo 'Tipo do veiculo: ' . $tipo . PHP_EOL;
    echo 'Horas estacionadas: ' . $horas . PHP_EOL;
    echo 'Valor por hora: R$ ' . number_format($valorHora, 2, ',', '.') . PHP_EOL;
    echo 'Subtotal: R$ ' . number_format($subtotal, 2, ',', '.') . PHP_EOL;
    echo 'Percentual de desconto: ' . $percentualDesconto . '%' . PHP_EOL;
    echo 'Valor do desconto: R$ ' . number_format($valorDesconto, 2, ',', '.') . PHP_EOL;
    echo 'TOTAL FINAL: R$ ' . number_format($totalFinal, 2, ',', '.') . PHP_EOL;
}

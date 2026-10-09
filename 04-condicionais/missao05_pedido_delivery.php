<?php
// ============================================================
// Missao 05 - Sistema de Pedido Delivery
// Executar via terminal: php missao05_pedido_delivery.php
// ============================================================

echo 'Nome do cliente: ';
$cliente = readline();

echo 'Produto: ';
$produto = readline();

echo 'Valor unitario (R$): ';
$valorUnitario = (float) readline();

echo 'Quantidade: ';
$quantidade = (int) readline();

echo 'Forma de pagamento: ';
$formaPagamento = readline();

echo 'Distancia da entrega (km): ';
$distancia = (float) readline();

echo PHP_EOL;

// ------------------------------------------------------------
// Validacao ANTES de qualquer calculo.
// ------------------------------------------------------------
if ($valorUnitario <= 0 || $quantidade <= 0 || $distancia < 0) {
    echo 'DADOS INVALIDOS: verifique valor unitario, quantidade e distancia.' . PHP_EOL;
} else {
    // Numero do pedido e data gerados automaticamente.
    $codigoPedido = rand(1000, 9999);
    $dataPedido = date('d/m/Y');

    // Subtotal do pedido.
    $subtotal = $valorUnitario * $quantidade;

    // Regra de frete por faixa de distancia.
    if ($distancia <= 3) {
        $frete = 5.00;
    } elseif ($distancia <= 8) {
        $frete = 10.00;
    } else {
        $frete = 18.00;
    }

    // Regra de desconto pelo valor do subtotal.
    if ($subtotal >= 200) {
        $percentualDesconto = 10;
    } elseif ($subtotal >= 100) {
        $percentualDesconto = 5;
    } else {
        $percentualDesconto = 0;
    }

    // Desconto adicional de 2% para pagamento em PIX.
    // A comparacao precisa ser estrita (===) para exigir que o
    // texto digitado seja exatamente "pix".
    if ($formaPagamento === 'pix') {
        $percentualDesconto = $percentualDesconto + 2;
    }

    $valorDesconto = $subtotal * ($percentualDesconto / 100);
    $totalPedido = ($subtotal - $valorDesconto) + $frete;

    echo '--- COMPROVANTE DO PEDIDO ---' . PHP_EOL;
    echo 'Codigo do pedido: ' . $codigoPedido . PHP_EOL;
    echo 'Data: ' . $dataPedido . PHP_EOL;
    echo 'Cliente: ' . $cliente . PHP_EOL;
    echo 'Produto: ' . $produto . PHP_EOL;
    echo 'Quantidade: ' . $quantidade . PHP_EOL;
    echo 'Valor unitario: R$ ' . number_format($valorUnitario, 2, ',', '.') . PHP_EOL;
    echo 'Subtotal: R$ ' . number_format($subtotal, 2, ',', '.') . PHP_EOL;
    echo 'Distancia: ' . number_format($distancia, 2, ',', '.') . ' km' . PHP_EOL;
    echo 'Frete: R$ ' . number_format($frete, 2, ',', '.') . PHP_EOL;
    echo 'Forma de pagamento: ' . $formaPagamento . PHP_EOL;
    echo 'Percentual de desconto: ' . $percentualDesconto . '%' . PHP_EOL;
    echo 'Valor do desconto: R$ ' . number_format($valorDesconto, 2, ',', '.') . PHP_EOL;
    echo 'VALOR TOTAL DO PEDIDO: R$ ' . number_format($totalPedido, 2, ',', '.') . PHP_EOL;
}

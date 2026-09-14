<?php
// ============================================================
// Missao 07 - Delivery SENAC
// Executar via terminal: php missao07_delivery_senac.php
// ============================================================

$pedido = [
    ['produto' => 'Hamburguer', 'preco' => 25, 'quantidade' => 2],
    ['produto' => 'Refrigerante', 'preco' => 8, 'quantidade' => 1],
];

function calcularSubtotal($item)
{
    return $item['preco'] * $item['quantidade'];
}

function listarPedido($pedido)
{
    echo '===== PEDIDO =====' . PHP_EOL;
    foreach ($pedido as $item) {
        $subtotal = calcularSubtotal($item);

        echo $item['produto'] . ' ' . $item['quantidade'] . ' x R$ ' . number_format($item['preco'], 2, ',', '.') . PHP_EOL;
        echo 'Subtotal: R$ ' . number_format($subtotal, 2, ',', '.') . PHP_EOL;
    }
}

function calcularTotal($pedido)
{
    $total = 0;
    foreach ($pedido as $item) {
        $total += calcularSubtotal($item);
    }

    return $total;
}

function calcularDesconto($total)
{
    if ($total >= 100) {
        return $total * 0.10;
    }

    return 0;
}

function mostrarResumo($total, $desconto)
{
    $totalFinal = $total - $desconto;

    echo PHP_EOL;
    echo 'Total: R$ ' . number_format($total, 2, ',', '.') . PHP_EOL;
    echo 'Desconto: R$ ' . number_format($desconto, 2, ',', '.') . PHP_EOL;
    echo 'Total com desconto: R$ ' . number_format($totalFinal, 2, ',', '.') . PHP_EOL;
}

listarPedido($pedido);

$total = calcularTotal($pedido);
$desconto = calcularDesconto($total);
mostrarResumo($total, $desconto);

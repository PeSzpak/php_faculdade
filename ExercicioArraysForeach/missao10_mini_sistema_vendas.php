<?php
// ============================================================
// Missao 10 - Mini Sistema de Vendas
// Executar via terminal: php missao10_mini_sistema_vendas.php
// ============================================================

$produtos = [
    ['nome' => 'Notebook', 'preco' => 3500],
    ['nome' => 'Mouse', 'preco' => 80],
    ['nome' => 'Teclado', 'preco' => 150],
];

$vendas = [
    ['produto' => 'Notebook', 'quantidade' => 2],
    ['produto' => 'Mouse', 'quantidade' => 5],
];

function buscarProduto($nomeProduto, $produtos)
{
    foreach ($produtos as $produto) {
        if ($produto['nome'] === $nomeProduto) {
            return $produto;
        }
    }

    return null;
}

function calcularVenda($venda, $produtos)
{
    $produto = buscarProduto($venda['produto'], $produtos);
    if ($produto === null) {
        return null;
    }

    return [
        'produto' => $produto['nome'],
        'quantidade' => $venda['quantidade'],
        'valorUnitario' => $produto['preco'],
        'total' => $produto['preco'] * $venda['quantidade'],
    ];
}

function listarVendas($vendas, $produtos)
{
    echo '========== VENDAS ==========' . PHP_EOL;
    foreach ($vendas as $venda) {
        $vendaCalculada = calcularVenda($venda, $produtos);

        if ($vendaCalculada === null) {
            echo $venda['produto'] . ' - produto nao encontrado' . PHP_EOL;
            continue;
        }

        echo $vendaCalculada['produto'] . PHP_EOL;
        echo 'Quantidade: ' . $vendaCalculada['quantidade'] . PHP_EOL;
        echo 'Valor unitario: R$ ' . number_format($vendaCalculada['valorUnitario'], 2, ',', '.') . PHP_EOL;
        echo 'Total: R$ ' . number_format($vendaCalculada['total'], 2, ',', '.') . PHP_EOL;
    }
}

function calcularFaturamento($vendas, $produtos)
{
    $faturamento = 0;
    foreach ($vendas as $venda) {
        $vendaCalculada = calcularVenda($venda, $produtos);
        if ($vendaCalculada !== null) {
            $faturamento += $vendaCalculada['total'];
        }
    }

    return $faturamento;
}

function mostrarRelatorio($faturamento)
{
    echo '============================' . PHP_EOL;
    echo 'Faturamento: R$ ' . number_format($faturamento, 2, ',', '.') . PHP_EOL;
}

listarVendas($vendas, $produtos);
mostrarRelatorio(calcularFaturamento($vendas, $produtos));

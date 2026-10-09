<?php
// ============================================================
// Missao 05 - Controle de Estoque
// Executar via terminal: php missao05_controle_estoque.php
// ============================================================

function cadastrarProdutos($quantidade)
{
    $produtos = [];

    for ($i = 1; $i <= $quantidade; $i++) {
        echo PHP_EOL . 'Produto ' . $i . PHP_EOL;

        echo 'Nome: ';
        $nome = readline();

        echo 'Preco (R$): ';
        $preco = (float) readline();

        echo 'Quantidade em estoque: ';
        $quantidadeEstoque = (int) readline();

        $produtos[] = [
            'nome' => $nome,
            'preco' => $preco,
            'quantidade' => $quantidadeEstoque,
        ];
    }

    return $produtos;
}

function calcularValorProduto($produto)
{
    return $produto['preco'] * $produto['quantidade'];
}

function listarEstoque($produtos)
{
    echo PHP_EOL . '===== ESTOQUE =====' . PHP_EOL;
    foreach ($produtos as $produto) {
        $valorProduto = calcularValorProduto($produto);

        echo $produto['nome'] . PHP_EOL;
        echo 'Preco: R$ ' . number_format($produto['preco'], 2, ',', '.') . PHP_EOL;
        echo 'Quantidade: ' . $produto['quantidade'] . PHP_EOL;
        echo 'Valor em estoque: R$ ' . number_format($valorProduto, 2, ',', '.') . PHP_EOL;
        echo '---------------------' . PHP_EOL;
    }
}

function calcularValorEstoque($produtos)
{
    $total = 0;
    foreach ($produtos as $produto) {
        $total += calcularValorProduto($produto);
    }

    return $total;
}

$produtos = cadastrarProdutos(5);
listarEstoque($produtos);

echo PHP_EOL . 'Valor financeiro total do estoque: R$ ' . number_format(calcularValorEstoque($produtos), 2, ',', '.') . PHP_EOL;

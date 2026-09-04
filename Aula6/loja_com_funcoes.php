<?php

function exibirCabecalho()
{
    echo "==================================================" . PHP_EOL;
    echo "                   LOJA SENAC                     " . PHP_EOL;
    echo "==================================================" . PHP_EOL;
}

function lerProduto()
{
    return $produto = readline("Nome do produto: ");
}

function lerPreco()
{
    return $preco   = (float) readline("Preço do produto: R$ ");
}

function lerQtd()
{
    return     $qtd     = (int) readline("Quantidade de produtos: ");
}

function calcularTotal($preco,  $qtd)
{
    return  $preco * $qtd;
}

function calcularDesconto($total)
{

    if ($total >= 500) {
        return $desconto = $total * 0.10;
    }
    return  0;
}

function exibirResumo($produto, $qtd, $total, $desconto)
{
    $totalFinal = $total - $desconto;

    echo "==================================================" . PHP_EOL;
    echo "                   RESUMO DA VENDA                " . PHP_EOL;
    echo "==================================================" . PHP_EOL;
    echo "Produto     : $produto" . PHP_EOL;
    echo "QTD         : $qtd" . PHP_EOL;
    echo "Valor Bruto : R$" . number_format($total, 2,  ",", ".") . PHP_EOL;
    echo "Desconto    : R$" . number_format($desconto, 2,  ",", ".") . PHP_EOL;
    echo "Valor Total : R$" . number_format($totalFinal, 2,  ",", ".") . PHP_EOL;
    echo "==================================================" . PHP_EOL;
}


exibirCabecalho();

$produto = lerProduto();
$preco = lerPreco();
$qtd = lerQtd();

$total = calcularTotal($preco, $qtd);
$desconto = calcularDesconto($total);

exibirResumo($produto,  $qtd,  $total,  $desconto);

<?php

echo "==================================================" . PHP_EOL;
echo "                   LOJA SENAC                     " . PHP_EOL;
echo "==================================================" . PHP_EOL;


//armazenar variaveis : preco, quantidade , produto e total = (preco * quantidade) 
//Se o valor total for maior ou igual a 500 reais = desconto de 10% 
//total final mais relatorio das variaveis

$produto = readline("Nome do produto: ");
$preco   = (float) readline("Preço do produto: R$ ");
$qtd     = (int) readline("Quantidade de produtos: ");


/* Preco de venda sem descontos */

$total = $preco * $qtd;

if ($total >= 500) {
    $desconto = $total * 0.10;
} else {
    $desconto = 0;
}

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

<?php
// ============================================================
// SENAC MARKET (modularizado) - Desafio Final do 1o Bimestre
// Mesma logica de senac_market.php, mas dividida em modulos por
// responsabilidade: cadastro, calculo e exibicao. Este arquivo so
// orquestra a venda, chamando as funcoes de cada modulo na ordem
// correta.
// Executar via terminal: php senac_market.php
// ============================================================

require_once __DIR__ . '/cadastro.php';
require_once __DIR__ . '/calculo.php';
require_once __DIR__ . '/exibicao.php';

// ------------------------------------------------------------
// PROGRAMA PRINCIPAL
// ------------------------------------------------------------

$idVenda = rand(1000, 9999);
$data = date('d/m/Y H:i');

echo '==================================================' . PHP_EOL;
echo '                 SENAC MARKET                     ' . PHP_EOL;
echo '==================================================' . PHP_EOL;

echo 'Nome do cliente: ';
$nomeCliente = readline();

echo 'Idade do cliente: ';
$idadeCliente = (int) readline();

echo 'Cliente premium? (sim/nao): ';
$clientePremium = readline() === 'sim';

echo 'Forma de pagamento (pix/cartao/dinheiro): ';
$formaPagamento = readline();

$cliente = [
    'nome' => $nomeCliente,
    'idade' => $idadeCliente,
    'premium' => $clientePremium,
    'formaPagamento' => $formaPagamento,
];

$produtos = cadastrarProdutos();

if (count($produtos) === 0) {
    echo PHP_EOL . 'Nenhum produto valido foi cadastrado. Venda cancelada.' . PHP_EOL;
    exit;
}

$resumo = calcularResumoProdutos($produtos);
$percentualDesconto = calcularPercentualDesconto(
    $resumo['valorBruto'],
    $clientePremium,
    $formaPagamento,
    $idadeCliente
);
$valorDesconto = calcularValorDesconto($resumo['valorBruto'], $percentualDesconto);
$valorFinal = $resumo['valorBruto'] - $valorDesconto;

exibirComprovante($idVenda, $data, $cliente, $produtos);
exibirRelatorioGerencial($resumo, $percentualDesconto, $valorDesconto, $valorFinal);

if ($formaPagamento === 'cartao') {
    simularParcelas($valorFinal);
}

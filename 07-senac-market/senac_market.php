<?php
// ============================================================
// SENAC MARKET - Desafio Final do 1o Bimestre
// Registra uma venda completa: cadastro de produtos, calculo de
// descontos, comprovante e relatorio gerencial.
// Executar via terminal: php senac_market.php
// ============================================================

function calcularSubtotal($preco, $quantidade)
{
    return $preco * $quantidade;
}

// Cadastra produtos ate o atendente digitar ENCERRAR no nome.
// Produtos com preco ou quantidade invalidos sao avisados e
// ignorados, sem interromper o cadastro dos demais.
function cadastrarProdutos()
{
    $produtos = [];

    echo 'Cadastro de produtos (digite ENCERRAR no nome para finalizar)' . PHP_EOL;

    while (true) {
        echo PHP_EOL . 'Nome do produto: ';
        $nome = readline();

        if ($nome === 'ENCERRAR') {
            break;
        }

        echo 'Categoria: ';
        $categoria = readline();

        echo 'Preco unitario (R$): ';
        $preco = (float) readline();

        echo 'Quantidade: ';
        $quantidade = (int) readline();

        if ($preco <= 0 || $quantidade <= 0) {
            echo 'Produto invalido (preco e quantidade devem ser maiores que zero). Ignorado.' . PHP_EOL;
            continue;
        }

        $produtos[] = [
            'nome' => $nome,
            'categoria' => $categoria,
            'preco' => $preco,
            'quantidade' => $quantidade,
            'subtotal' => calcularSubtotal($preco, $quantidade),
        ];
    }

    return $produtos;
}

// Percorre os produtos validos uma unica vez e devolve tudo que
// o relatorio gerencial precisa: quantidades, valor bruto e os
// produtos mais caro e mais barato.
function calcularResumoProdutos($produtos)
{
    $quantidadeUnidades = 0;
    $valorBruto = 0;
    $maisCaro = $produtos[0];
    $maisBarato = $produtos[0];

    foreach ($produtos as $produto) {
        $quantidadeUnidades += $produto['quantidade'];
        $valorBruto += $produto['subtotal'];

        if ($produto['preco'] > $maisCaro['preco']) {
            $maisCaro = $produto;
        }

        if ($produto['preco'] < $maisBarato['preco']) {
            $maisBarato = $produto;
        }
    }

    return [
        'quantidadeProdutos' => count($produtos),
        'quantidadeUnidades' => $quantidadeUnidades,
        'valorBruto' => $valorBruto,
        'maisCaro' => $maisCaro,
        'maisBarato' => $maisBarato,
    ];
}

// O percentual pelo valor da compra usa apenas a faixa mais alta
// atingida (nao e cumulativo entre faixas). Premium, pix e idade
// 60+ sao regras adicionais e essas sim se somam ao percentual.
function calcularPercentualDesconto($valorBruto, $clientePremium, $formaPagamento, $idadeCliente)
{
    $percentual = 0;

    if ($valorBruto >= 1000) {
        $percentual = 15;
    } elseif ($valorBruto >= 500) {
        $percentual = 10;
    } elseif ($valorBruto >= 200) {
        $percentual = 5;
    }

    if ($clientePremium) {
        $percentual += 3;
    }

    if ($formaPagamento === 'pix') {
        $percentual += 2;
    }

    if ($idadeCliente >= 60) {
        $percentual += 2;
    }

    return $percentual;
}

function calcularValorDesconto($valorBruto, $percentualDesconto)
{
    return $valorBruto * $percentualDesconto / 100;
}

function classificarVenda($valorFinal)
{
    if ($valorFinal < 300) {
        return 'VENDA PEQUENA';
    } elseif ($valorFinal < 1000) {
        return 'VENDA MEDIA';
    }

    return 'VENDA DE ALTO VALOR';
}

function simularParcelas($valorFinal)
{
    echo PHP_EOL . 'Simulacao de parcelamento no cartao:' . PHP_EOL;
    for ($parcelas = 1; $parcelas <= 6; $parcelas++) {
        $valorParcela = $valorFinal / $parcelas;
        echo $parcelas . 'x de R$ ' . number_format($valorParcela, 2, ',', '.') . PHP_EOL;
    }
}

function exibirComprovante($idVenda, $data, $cliente, $produtos)
{
    echo PHP_EOL;
    echo '==================================================' . PHP_EOL;
    echo '                 SENAC MARKET                     ' . PHP_EOL;
    echo '==================================================' . PHP_EOL;
    echo 'Venda: ' . $idVenda . PHP_EOL;
    echo 'Data: ' . $data . PHP_EOL;
    echo '--------------------------------------------------' . PHP_EOL;
    echo 'Cliente: ' . $cliente['nome'] . PHP_EOL;
    echo 'Idade: ' . $cliente['idade'] . PHP_EOL;
    echo 'Tipo: ' . ($cliente['premium'] ? 'Premium' : 'Comum') . PHP_EOL;
    echo 'Forma de pagamento: ' . $cliente['formaPagamento'] . PHP_EOL;
    echo '--------------------------------------------------' . PHP_EOL;
    echo 'PRODUTOS' . PHP_EOL;
    foreach ($produtos as $produto) {
        echo $produto['nome'] . ' (' . $produto['categoria'] . ')' . PHP_EOL;
        echo '  Preco: R$ ' . number_format($produto['preco'], 2, ',', '.') . PHP_EOL;
        echo '  Quantidade: ' . $produto['quantidade'] . PHP_EOL;
        echo '  Subtotal: R$ ' . number_format($produto['subtotal'], 2, ',', '.') . PHP_EOL;
    }
}

function exibirRelatorioGerencial($resumo, $percentualDesconto, $valorDesconto, $valorFinal)
{
    echo PHP_EOL;
    echo '==================================================' . PHP_EOL;
    echo '              RELATORIO GERENCIAL                 ' . PHP_EOL;
    echo '==================================================' . PHP_EOL;
    echo 'Quantidade de produtos diferentes: ' . $resumo['quantidadeProdutos'] . PHP_EOL;
    echo 'Quantidade total de unidades vendidas: ' . $resumo['quantidadeUnidades'] . PHP_EOL;
    echo 'Produto mais caro: ' . $resumo['maisCaro']['nome'] . PHP_EOL;
    echo 'Produto mais barato: ' . $resumo['maisBarato']['nome'] . PHP_EOL;
    echo 'Valor bruto: R$ ' . number_format($resumo['valorBruto'], 2, ',', '.') . PHP_EOL;
    echo 'Percentual de desconto: ' . $percentualDesconto . '%' . PHP_EOL;
    echo 'Valor concedido em desconto: R$ ' . number_format($valorDesconto, 2, ',', '.') . PHP_EOL;
    echo 'Valor final recebido: R$ ' . number_format($valorFinal, 2, ',', '.') . PHP_EOL;
    echo 'Classificacao: ' . classificarVenda($valorFinal) . PHP_EOL;
    echo '==================================================' . PHP_EOL;
}

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

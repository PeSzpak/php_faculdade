<?php
// ============================================================
// SENAC MARKET (modularizado) - Regras de calculo e desconto
// ============================================================

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

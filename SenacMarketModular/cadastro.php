<?php
// ============================================================
// SENAC MARKET (modularizado) - Cadastro de produtos
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

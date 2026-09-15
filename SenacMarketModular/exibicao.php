<?php
// ============================================================
// SENAC MARKET (modularizado) - Comprovante, relatorio e parcelas
// ============================================================

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

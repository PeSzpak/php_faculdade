# SENAC Market — Documentação do Desafio Final (1º Bimestre)

## Entradas

- Dados do cliente: nome, idade, se é premium (sim/não), forma de pagamento (pix, cartao ou dinheiro).
- Para cada produto (repetido até digitar `ENCERRAR` no nome): nome, categoria, preço unitário, quantidade.

## Dados calculados

- Subtotal de cada item: `preco * quantidade`.
- Quantidade de produtos diferentes, quantidade total de unidades, valor bruto da compra.
- Produto de maior e de menor preço unitário entre os itens válidos.
- Percentual de desconto (ver regras abaixo) e valor de desconto em reais.
- Valor final da venda (`valor bruto - valor do desconto`).
- Simulação de 1 a 6 parcelas, apenas quando a forma de pagamento é `cartao`.

## Principais regras

- Produto com preço ou quantidade menor ou igual a zero é inválido: o sistema avisa e ignora aquele item, sem parar o cadastro.
- Digitar `ENCERRAR` como nome do produto termina o cadastro imediatamente.
- Desconto pelo valor da compra usa apenas a faixa mais alta atingida (não soma faixa por faixa): sem desconto até R$ 199,99; 5% a partir de R$ 200,00; 10% a partir de R$ 500,00; 15% a partir de R$ 1.000,00.
- Depois da faixa, três bônus cumulativos podem se somar ao percentual: +3% cliente premium, +2% pagamento em pix (comparado com `===`), +2% cliente com 60 anos ou mais.
- Classificação final da venda pelo valor final: abaixo de R$ 300,00 é VENDA PEQUENA; de R$ 300,00 a R$ 999,99 é VENDA MÉDIA; a partir de R$ 1.000,00 é VENDA DE ALTO VALOR.

## Estruturas utilizadas

- `while (true)` com `break` para o cadastro de produtos (não se sabe de antemão quantos produtos serão cadastrados).
- Array indexado de arrays associativos para armazenar os produtos válidos.
- `foreach` para percorrer os produtos ao calcular o resumo, montar o comprovante e o relatório.
- `for` para simular as parcelas de 1 a 6.
- `if/elseif/else` para as faixas de desconto e para a classificação da venda.
- Comparação estrita (`===`) para validar a forma de pagamento pix e a palavra `ENCERRAR`.

## Funções criadas

- `calcularSubtotal($preco, $quantidade)`
- `cadastrarProdutos()`
- `calcularResumoProdutos($produtos)`
- `calcularPercentualDesconto($valorBruto, $clientePremium, $formaPagamento, $idadeCliente)`
- `calcularValorDesconto($valorBruto, $percentualDesconto)`
- `classificarVenda($valorFinal)`
- `simularParcelas($valorFinal)`
- `exibirComprovante($idVenda, $data, $cliente, $produtos)`
- `exibirRelatorioGerencial($resumo, $percentualDesconto, $valorDesconto, $valorFinal)`

## Testes realizados

- Venda com um produto de baixo valor (sem desconto) e pagamento em dinheiro.
- Venda acima de R$ 1.000,00 com cliente premium, pagamento pix e idade acima de 60 anos, para confirmar que os três bônus se somam à faixa de 15%.
- Cadastro com um produto de preço zero, para confirmar que ele é rejeitado e o cadastro continua.
- Cadastro finalizado digitando `ENCERRAR` como primeiro produto, para confirmar que a venda é cancelada quando não há produtos válidos.
- Pagamento em `cartao`, para confirmar a simulação de parcelas de 1x a 6x.

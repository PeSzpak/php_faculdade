<?php
// ============================================================
// AutoTech - Orcamento de Servico
// Executar via terminal: php orcamento_autotech.php
// ============================================================

// RF01 - numero do orcamento e data gerados automaticamente.
$numeroOrcamento = rand(1000, 9999);
$dataOrcamento = date('d/m/Y');

// RF02 - dados do cliente.
echo 'Nome do cliente: ';
$nomeCliente = readline();

echo 'Telefone: ';
$telefone = readline();

echo PHP_EOL;

// RF03 - dados do veiculo.
echo 'Modelo do veiculo: ';
$modelo = readline();

echo 'Marca: ';
$marca = readline();

echo 'Ano: ';
$ano = (int) readline();

echo 'Placa: ';
$placa = readline();

echo 'Quilometragem atual: ';
$km = (int) readline();

echo PHP_EOL;

// RF04 - servico. Mao de obra = valor da hora x quantidade de horas.
echo 'Descricao do servico: ';
$descricaoServico = readline();

echo 'Valor da hora (R$): ';
$valorHora = (float) readline();

echo 'Quantidade de horas previstas: ';
$horas = (float) readline();

$valorMaoDeObra = $valorHora * $horas;

echo PHP_EOL;

// RF05 - pecas (nesta primeira versao, apenas uma peca por orcamento).
// Custo das pecas = valor unitario x quantidade.
echo 'Nome da peca: ';
$nomePeca = readline();

echo 'Valor unitario da peca (R$): ';
$valorUnitarioPeca = (float) readline();

echo 'Quantidade necessaria: ';
$quantidadePeca = (int) readline();

$custoPecas = $valorUnitarioPeca * $quantidadePeca;

echo PHP_EOL;

// RF06 - materiais adicionais, informados diretamente pelo atendente.
echo 'Estimativa de materiais adicionais (R$): ';
$materiaisAdicionais = (float) readline();

echo PHP_EOL;

// RF07 - total do orcamento e parcelamento em 3x.
$total = $valorMaoDeObra + $custoPecas + $materiaisAdicionais;
$valorParcela = $total / 3;

// RF08 - comprovante.
echo '==================================================' . PHP_EOL;
echo '        AUTOTECH - ORCAMENTO DE SERVICO           ' . PHP_EOL;
echo '==================================================' . PHP_EOL;
echo 'Numero do orcamento: ' . $numeroOrcamento . PHP_EOL;
echo 'Data: ' . $dataOrcamento . PHP_EOL;
echo '--------------------------------------------------' . PHP_EOL;
echo 'Cliente: ' . $nomeCliente . PHP_EOL;
echo 'Telefone: ' . $telefone . PHP_EOL;
echo '--------------------------------------------------' . PHP_EOL;
echo 'Veiculo: ' . $marca . ' ' . $modelo . ' (' . $ano . ')' . PHP_EOL;
echo 'Placa: ' . $placa . PHP_EOL;
echo 'Quilometragem: ' . $km . ' km' . PHP_EOL;
echo '--------------------------------------------------' . PHP_EOL;
echo 'Servico: ' . $descricaoServico . PHP_EOL;
echo 'Mao de obra: R$ ' . number_format($valorMaoDeObra, 2, ',', '.') . PHP_EOL;
echo 'Peca (' . $nomePeca . '): R$ ' . number_format($custoPecas, 2, ',', '.') . PHP_EOL;
echo 'Materiais adicionais: R$ ' . number_format($materiaisAdicionais, 2, ',', '.') . PHP_EOL;
echo '--------------------------------------------------' . PHP_EOL;
echo 'VALOR TOTAL: R$ ' . number_format($total, 2, ',', '.') . PHP_EOL;
echo '3 parcelas de R$ ' . number_format($valorParcela, 2, ',', '.') . PHP_EOL;
echo '==================================================' . PHP_EOL;

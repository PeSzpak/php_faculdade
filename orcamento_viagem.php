<?php

// Sistema de Orçamento de Viagem


function lerTexto($mensagem)
{
    echo $mensagem;
    return trim(fgets(STDIN));
}

function lerInteiro($mensagem)
{
    echo $mensagem;
    return (int) trim(fgets(STDIN));
}

function lerDecimal($mensagem)
{
    echo $mensagem;
    $valor = trim(fgets(STDIN));
    $valor = str_replace(',', '.', $valor); // aceita vírgula ou ponto
    return (float) $valor;
}

function moeda($valor)
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

echo "=====================================\n";
echo "         SENAC TOUR - VIAGENS        \n";
echo "=====================================\n\n";

// input
$cliente  = lerTexto("Nome do cliente: ");
$origem   = lerTexto("Cidade de origem: ");
$destino  = lerTexto("Cidade de destino: ");

$qtdViajantes = lerInteiro("Quantidade de viajantes: ");
$qtdDias      = lerInteiro("Quantidade de dias: ");

$valorPassagem     = lerDecimal("Valor da passagem por pessoa: ");
$valorDiaria       = lerDecimal("Valor da diária de hospedagem: ");
$valorAlimentacao  = lerDecimal("Gasto diário estimado com alimentação por pessoa: ");
$valorTransporte   = lerDecimal("Valor estimado de transporte por dia: ");
$valorPasseio      = lerDecimal("Valor do passeio turístico por pessoa: ");

//processamento 
$totalPassagens   = $valorPassagem * $qtdViajantes;
$totalHospedagem  = $valorDiaria * $qtdDias;
$totalAlimentacao = $valorAlimentacao * $qtdDias * $qtdViajantes;
$totalTransporte  = $valorTransporte * $qtdDias;
$totalPasseios    = $valorPasseio * $qtdViajantes;

$totalViagem   = $totalPassagens + $totalHospedagem + $totalAlimentacao + $totalTransporte + $totalPasseios;
$valorPorPessoa = $totalViagem / $qtdViajantes;

$numeroOrcamento = rand(10000, 99999);
$dataOrcamento    = date('d/m/Y H:i');

// output
echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n";
echo "        ORÇAMENTO DE VIAGEM          \n";
echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n";
echo "Nº do orçamento: $numeroOrcamento\n";
echo "Data de emissão: $dataOrcamento\n";
echo "-------------------------------------\n";
echo "Cliente: $cliente\n";
echo "Trajeto: $origem -> $destino\n";
echo "Viajantes: $qtdViajantes\n";
echo "Duração: $qtdDias dia(s)\n";
echo "-------------------------------------\n";
echo "Passagens.....: " . moeda($totalPassagens) . "\n";
echo "Hospedagem....: " . moeda($totalHospedagem) . "\n";
echo "Alimentação...: " . moeda($totalAlimentacao) . "\n";
echo "Transporte....: " . moeda($totalTransporte) . "\n";
echo "Passeios......: " . moeda($totalPasseios) . "\n";
echo "-------------------------------------\n";
echo "TOTAL DA VIAGEM: " . moeda($totalViagem) . "\n";
echo "Valor por viajante: " . moeda($valorPorPessoa) . "\n";
echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n";

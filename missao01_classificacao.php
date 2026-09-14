<?php
// ============================================================
// Missao 01 - Classificacao Etaria
// Executar via terminal: php missao01_classificacao.php
// ============================================================

echo "Nome: ";
$nome = readline();

echo "Idade: ";
$idade = (int) readline();

echo PHP_EOL;

// ------------------------------------------------------------
// A ordem das condicoes importa: cada "elseif" so e avaliado se
// o anterior for falso, entao os casos mais restritivos (idade
// invalida, depois crianca) precisam vir primeiro.
// ------------------------------------------------------------
if ($idade <= 0) {
    $classificacao = "IDADE INVALIDA";
} elseif ($idade < 12) {
    $classificacao = "CRIANCA";
} elseif ($idade <= 17) {
    $classificacao = "ADOLESCENTE";
} elseif ($idade <= 59) {
    $classificacao = "ADULTO";
} else {
    $classificacao = "IDOSO";
}

echo "--- RESULTADO ---" . PHP_EOL;
echo "Nome: " . $nome . PHP_EOL;
echo "Idade: " . $idade . PHP_EOL;
echo "Classificacao: " . $classificacao . PHP_EOL;

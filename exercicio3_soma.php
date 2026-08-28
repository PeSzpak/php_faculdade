<?php
// ============================================================
// Exercicio 03 - Soma de 1 ate N
// Executar via terminal: php exercicio3_soma.php
// ============================================================

echo 'Informe um numero: ';
$numero = (int) readline();

if ($numero <= 0) {
    echo 'O numero informado deve ser maior que zero.' . PHP_EOL;
} else {
    // Acumulador que vai receber a soma de cada volta do laco.
    $soma = 0;

    for ($contador = 1; $contador <= $numero; $contador++) {
        $soma = $soma + $contador;
    }

    echo PHP_EOL;
    echo 'A soma de 1 ate ' . $numero . ' e ' . $soma . '.' . PHP_EOL;
}

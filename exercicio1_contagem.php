<?php
// ============================================================
// Exercicio 01 - Contagem crescente
// Executar via terminal: php exercicio1_contagem.php
// ============================================================

echo 'Informe um numero: ';
$numero = (int) readline();

if ($numero <= 0) {
    echo 'O numero informado deve ser maior que zero.' . PHP_EOL;
} else {
    echo PHP_EOL;
    echo 'Sera apresentado:' . PHP_EOL;

    // Contador comecando em 1 ate o numero informado.
    $contador = 1;
    while ($contador <= $numero) {
        echo $contador . PHP_EOL;
        $contador = $contador + 1;
    }
}

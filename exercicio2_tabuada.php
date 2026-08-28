<?php
// ============================================================
// Exercicio 02 - Tabuada
// Executar via terminal: php exercicio2_tabuada.php
// ============================================================

echo 'Informe um numero para a tabuada: ';
$numero = (int) readline();

echo PHP_EOL;

// Ja sabemos exatamente quantas vezes o laco vai repetir (1 a 10),
// entao o for e a estrutura mais adequada aqui.
for ($multiplicador = 1; $multiplicador <= 10; $multiplicador++) {
    $resultado = $numero * $multiplicador;
    echo $numero . ' x ' . $multiplicador . ' = ' . $resultado . PHP_EOL;
}

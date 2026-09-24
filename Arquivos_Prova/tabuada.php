<?php
// Pra rodar: php tabuada.php


// Dado que entra: um numero inteiro usuario que informa
// Valor que se repete: o proprio numero (multiplicando)
// Repeticoes: 10 (multiplicador de 1 ate 10)
// Calculo em cada repeticao: numero x multiplicador
// Estrutura: for (simples)

echo 'Informe um numero: ';
$numero = (int) readline();

echo PHP_EOL;

for ($multiplicador = 1; $multiplicador <= 10; $multiplicador++) {
    $resultado = $numero * $multiplicador;
    echo $numero . ' x ' . $multiplicador . ' = ' . $resultado . PHP_EOL;
}

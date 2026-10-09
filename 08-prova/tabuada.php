<?php
// Pra rodar: php tabuada.php


// Dado que entra: um numero inteiro usuario que informa
// Valor que se repete: o proprio numero (multiplicando)
// Repeticoes: 10 (multiplicador de 1 ate 10)
// Calculo em cada repeticao: numero x multiplicador
// Estrutura: for (simples)
//validacao de so numero so de raiva 

echo 'Informe um numero: ';
$entrada = trim(readline());

// Validacao: aceita apenas numeros inteiros.
if (filter_var($entrada, FILTER_VALIDATE_INT) === false) {
    echo 'Valor invalido. Digite apenas numeros inteiros.' . PHP_EOL;
    exit;
}

$numero = (int) $entrada;

echo PHP_EOL;

for ($multiplicador = 1; $multiplicador <= 10; $multiplicador++) {
    $resultado = $numero * $multiplicador;
    echo $numero . ' x ' . $multiplicador . ' = ' . $resultado . PHP_EOL;
}

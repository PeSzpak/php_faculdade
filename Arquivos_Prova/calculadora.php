<?php
// Pra rodar: php calculadora.php

// Dados que entram: primeiro numero, segundo numero e operacao.
// Convertidos para numero: numeros de entrada (float).
// Decisoes: qual operacao foi informada (+, -, *, /) ou invalida.
// Validacao antes da divisao: segundo numero diferente de zero.

echo 'Primeiro numero: ';
$primeiroNumero = (float) readline();

echo 'Segundo numero: ';
$segundoNumero = (float) readline();

echo 'Operacao (+, -, *, /): ';
$operacao = trim(readline());

echo PHP_EOL;

switch ($operacao) {
    case '+':
        $resultado = $primeiroNumero + $segundoNumero;
        echo 'Resultado:' . PHP_EOL;
        echo $primeiroNumero . ' + ' . $segundoNumero . ' = ' . $resultado . PHP_EOL;
        break;

    case '-':
        $resultado = $primeiroNumero - $segundoNumero;
        echo 'Resultado:' . PHP_EOL;
        echo $primeiroNumero . ' - ' . $segundoNumero . ' = ' . $resultado . PHP_EOL;
        break;

    case '*':
        $resultado = $primeiroNumero * $segundoNumero;
        echo 'Resultado:' . PHP_EOL;
        echo $primeiroNumero . ' * ' . $segundoNumero . ' = ' . $resultado . PHP_EOL;
        break;

    case '/':
        // Validacao simples para ser diferente de 0
        if ($segundoNumero == 0) {
            echo 'Operacao nao pode ser realizada: divisao por zero' . PHP_EOL;
        } else {
            $resultado = $primeiroNumero / $segundoNumero;
            echo 'Resultado:' . PHP_EOL;
            echo $primeiroNumero . ' / ' . $segundoNumero . ' = ' . $resultado . PHP_EOL;
        }
        break;

    default:
        echo 'Operacao invalida utilize apenas +, -, * ou /.' . PHP_EOL;
}

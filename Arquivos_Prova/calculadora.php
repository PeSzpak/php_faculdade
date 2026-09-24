<?php
// Pra rodar: php calculadora.php

// Dados que entram: primeiro numero, segundo numero e operacao.
// Convertidos para numero: numeros de entrada (float).
// Decisoes: qual operacao foi informada (+, -, *, /) ou invalida.
// Validacao antes da divisao: segundo numero diferente de zero.
//adicionada a validacao para apenas numeros

echo 'Primeiro numero: ';
$primeiroNumero = str_replace(',', '.', trim(readline()));

echo 'Segundo numero: ';
$segundoNumero = str_replace(',', '.', trim(readline()));

echo 'Operacao (+, -, *, /): ';
$operacao = trim(readline());

echo PHP_EOL;

if (!is_numeric($primeiroNumero) || !is_numeric($segundoNumero)) {
    echo 'Valor invalido. Digite apenas numeros.' . PHP_EOL;
    exit;
}

$primeiroNumero = (float) $primeiroNumero;
$segundoNumero = (float) $segundoNumero;

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

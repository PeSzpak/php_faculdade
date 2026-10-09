<?php
// ============================================================
// Exercicio 04 - Media de valores (com sentinela)
// Executar via terminal: php exercicio4_media.php
// ============================================================

// Contador de quantos valores validos foram informados.
$quantidade = 0;
// Acumulador da soma dos valores informados.
$soma = 0;

echo 'Informe um numero (digite 0 para encerrar): ';
$valor = (float) readline();

// O valor 0 e apenas o sinal de parada: ele nao entra na soma
// nem na contagem.
while ($valor != 0) {
    $soma = $soma + $valor;
    $quantidade = $quantidade + 1;

    echo 'Informe um numero (digite 0 para encerrar): ';
    $valor = (float) readline();
}

echo PHP_EOL;

if ($quantidade > 0) {
    $media = $soma / $quantidade;

    echo 'Quantidade de valores: ' . $quantidade . PHP_EOL;
    echo 'Soma: ' . number_format($soma, 2, ',', '.') . PHP_EOL;
    echo 'Media: ' . number_format($media, 2, ',', '.') . PHP_EOL;
} else {
    echo 'Nenhum valor valido foi informado.' . PHP_EOL;
}

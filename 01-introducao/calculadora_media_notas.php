<?php
    echo "=====================================================" . PHP_EOL;
    echo "               CALCULADORA DE MEDIAS                 " . PHP_EOL;
    echo "=====================================================" . PHP_EOL;

    //solicita o nome do aluno que vamos consultar a media 
    $nomeAluno = readline("Informe o nome do aluno: ");

    $nota1 = (float) readline("Informe a nota 1: "); 
    $nota2 = (float) readline("Informe a nota 2: ");
    $nota3 = (float) readline("Informe a nota 3: ");
    $nota4 = (float) readline("Informe a nota 4: ");

    $somaNotas = $nota1 + $nota2 + $nota3 + $nota4;
    $media = $somaNotas / 4;

    echo PHP_EOL;

    echo "=====================================================" . PHP_EOL;
    echo "                      BOLETIM                        " . PHP_EOL;
    echo "=====================================================" . PHP_EOL;

    echo "Nome do Aluno: {$nomeAluno}" . PHP_EOL;
    echo "Nota 1: ".number_format($nota1, 1, ",", ".") . PHP_EOL;
    echo "Nota 2: ".number_format($nota2, 1, ",", ".") . PHP_EOL;
    echo "Nota 3: ".number_format($nota3, 1, ",", ".") . PHP_EOL;
    echo "Nota 4: ".number_format($nota4, 1, ",", ".") . PHP_EOL;    

    echo "Soma das Notas: " .number_format($somaNotas, 1, ",", "."). PHP_EOL;

    echo "Média das Notas: " .number_format($media, 1, ",", "."). PHP_EOL;

    echo "=====================================================" . PHP_EOL;

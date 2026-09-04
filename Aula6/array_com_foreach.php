<?php

$alunos = [];

$qtd = (int) readline("Quantos alunos você vai cadastrar?");

for ($i = 0; $i < $quantidade; $i++) {
    $nome = readline("nome do Aluno");
    $alunos[] = $nome;
}

echo "==================================================" . PHP_EOL;
echo "                   LISTA ALUNOS                   " . PHP_EOL;
echo "==================================================" . PHP_EOL;

foreach ($alunos as $aluno) {
    echo $aluno . PHP_EOL;
}
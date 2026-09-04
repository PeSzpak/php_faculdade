<?php 

$alunos = [];

$qtd = (int) readline("Quantos alunos você vai cadastrar?");

for ($i = 0; $i < $quantidade; $i++) {
    $nome = readline("nome do Aluno");
    $alunos[] = $nome;
}


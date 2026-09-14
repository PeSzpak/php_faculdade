<?php
// ============================================================
// Missao 01 - Lista de Funcionarios
// Executar via terminal: php missao01_lista_funcionarios.php
// ============================================================

function cadastrarFuncionarios($quantidade)
{
    $funcionarios = [];

    for ($i = 1; $i <= $quantidade; $i++) {
        echo 'Nome do funcionario ' . $i . ': ';
        $funcionarios[] = readline();
    }

    return $funcionarios;
}

function listarFuncionarios($funcionarios)
{
    echo PHP_EOL . '===== FUNCIONARIOS =====' . PHP_EOL;
    foreach ($funcionarios as $nome) {
        echo '- ' . $nome . PHP_EOL;
    }
}

function contarFuncionarios($funcionarios)
{
    return count($funcionarios);
}

$funcionarios = cadastrarFuncionarios(5);
listarFuncionarios($funcionarios);

echo PHP_EOL . 'Total cadastrado: ' . contarFuncionarios($funcionarios) . PHP_EOL;

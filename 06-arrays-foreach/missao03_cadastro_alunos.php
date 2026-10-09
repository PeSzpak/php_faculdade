<?php
// ============================================================
// Missao 03 - Cadastro Completo de Alunos (array associativo)
// Executar via terminal: php missao03_cadastro_alunos.php
// ============================================================

function cadastrarAlunos($quantidade)
{
    $alunos = [];

    for ($i = 1; $i <= $quantidade; $i++) {
        echo PHP_EOL . 'Aluno ' . $i . PHP_EOL;

        echo 'Nome: ';
        $nome = readline();

        echo 'Idade: ';
        $idade = (int) readline();

        echo 'Nota: ';
        $nota = (float) readline();

        $alunos[] = [
            'nome' => $nome,
            'idade' => $idade,
            'nota' => $nota,
        ];
    }

    return $alunos;
}

function verificarSituacao($nota)
{
    return $nota >= 7 ? 'APROVADO' : 'REPROVADO';
}

function listarAlunos($alunos)
{
    echo PHP_EOL . '===== ALUNOS =====' . PHP_EOL;
    foreach ($alunos as $aluno) {
        echo 'Nome: ' . $aluno['nome'] . PHP_EOL;
        echo 'Idade: ' . $aluno['idade'] . PHP_EOL;
        echo 'Nota: ' . number_format($aluno['nota'], 1, ',', '.') . PHP_EOL;
        echo 'Situacao: ' . verificarSituacao($aluno['nota']) . PHP_EOL;
        echo '---------------------' . PHP_EOL;
    }
}

$alunos = cadastrarAlunos(4);
listarAlunos($alunos);

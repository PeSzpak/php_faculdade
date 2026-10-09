<?php
// ============================================================
// Exercicio 05 - Analise da turma
// Executar via terminal: php exercicio5_analise_turma.php
// ============================================================

echo 'Quantidade de alunos: ';
$quantidadeAlunos = (int) readline();

echo PHP_EOL;

// Acumulador das notas, para calcular a media da turma.
$somaNotas = 0;
// Contadores de aprovados e reprovados.
$aprovados = 0;
$reprovados = 0;
// Comecam nulos e sao definidos na primeira volta do laco.
$maiorNota = null;
$menorNota = null;

for ($i = 1; $i <= $quantidadeAlunos; $i++) {
    echo 'Nome: ';
    $nome = readline();

    echo 'Nota: ';
    $nota = (float) readline();

    $somaNotas = $somaNotas + $nota;

    if ($nota >= 7) {
        $aprovados = $aprovados + 1;
    } else {
        $reprovados = $reprovados + 1;
    }

    // Na primeira volta, maior e menor nota ainda sao nulas,
    // entao a primeira nota lida vira a referencia inicial.
    if ($maiorNota === null || $nota > $maiorNota) {
        $maiorNota = $nota;
    }
    if ($menorNota === null || $nota < $menorNota) {
        $menorNota = $nota;
    }

    echo PHP_EOL;
}

if ($quantidadeAlunos > 0) {
    $mediaTurma = $somaNotas / $quantidadeAlunos;

    echo '--- RESULTADO DA TURMA ---' . PHP_EOL;
    echo 'Media da turma: ' . number_format($mediaTurma, 2, ',', '.') . PHP_EOL;
    echo 'Maior nota: ' . number_format($maiorNota, 2, ',', '.') . PHP_EOL;
    echo 'Menor nota: ' . number_format($menorNota, 2, ',', '.') . PHP_EOL;
    echo 'Aprovados: ' . $aprovados . PHP_EOL;
    echo 'Reprovados: ' . $reprovados . PHP_EOL;
} else {
    echo 'Nenhum aluno foi informado.' . PHP_EOL;
}

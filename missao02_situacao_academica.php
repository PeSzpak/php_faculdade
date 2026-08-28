<?php
// ============================================================
// Missao 02 - Situacao Academica
// Executar via terminal: php missao02_situacao_academica.php
// ============================================================

echo 'Nome do aluno: ';
$aluno = readline();

echo 'Primeira nota (0 a 10): ';
$nota1 = (float) readline();

echo 'Segunda nota (0 a 10): ';
$nota2 = (float) readline();

echo 'Frequencia (0 a 100): ';
$frequencia = (float) readline();

echo PHP_EOL;

// ------------------------------------------------------------
// Validacao dos dados ANTES de qualquer calculo.
// Usamos || porque qualquer uma das condicoes ja torna os
// dados invalidos.
// ------------------------------------------------------------
$notasInvalidas = ($nota1 < 0 || $nota1 > 10 || $nota2 < 0 || $nota2 > 10);
$frequenciaInvalida = ($frequencia < 0 || $frequencia > 100);

if ($notasInvalidas || $frequenciaInvalida) {
    echo 'DADOS INVALIDOS: verifique as notas (0 a 10) e a frequencia (0 a 100).' . PHP_EOL;
} else {
    $media = ($nota1 + $nota2) / 2;

    // A regra de frequencia e avaliada ANTES da media: mesmo com
    // media alta, quem nao tem frequencia minima e reprovado.
    // (Ex.: media 9 com frequencia 60% = REPROVADO POR FREQUENCIA,
    // nao APROVADO.)
    if ($frequencia < 75) {
        $situacao = 'REPROVADO POR FREQUENCIA';
    } elseif ($media >= 7) {
        $situacao = 'APROVADO';
    } elseif ($media >= 4) {
        $situacao = 'RECUPERACAO';
    } else {
        $situacao = 'REPROVADO POR NOTA';
    }

    echo '--- RESULTADO ---' . PHP_EOL;
    echo 'Aluno: ' . $aluno . PHP_EOL;
    echo 'Nota 1: ' . number_format($nota1, 2, ',', '.') . PHP_EOL;
    echo 'Nota 2: ' . number_format($nota2, 2, ',', '.') . PHP_EOL;
    echo 'Media: ' . number_format($media, 2, ',', '.') . PHP_EOL;
    echo 'Frequencia: ' . number_format($frequencia, 2, ',', '.') . '%' . PHP_EOL;
    echo 'Situacao: ' . $situacao . PHP_EOL;
}

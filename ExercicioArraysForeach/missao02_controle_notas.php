<?php
// ============================================================
// Missao 02 - Controle de Notas
// Executar via terminal: php missao02_controle_notas.php
// ============================================================

function cadastrarNotas($quantidade)
{
    $notas = [];

    for ($i = 1; $i <= $quantidade; $i++) {
        echo 'Nota ' . $i . ': ';
        $notas[] = (float) readline();
    }

    return $notas;
}

function listarNotas($notas)
{
    echo PHP_EOL . '===== NOTAS =====' . PHP_EOL;
    foreach ($notas as $nota) {
        echo number_format($nota, 1, ',', '.') . PHP_EOL;
    }
}

// O calculo da media usa foreach para somar as notas uma a uma,
// em vez de um somatorio pronto.
function calcularMedia($notas)
{
    $soma = 0;
    foreach ($notas as $nota) {
        $soma += $nota;
    }

    return $soma / count($notas);
}

function mostrarSituacao($media)
{
    if ($media >= 7) {
        echo 'Situacao da turma: Bom desempenho' . PHP_EOL;
    } else {
        echo 'Situacao da turma: Turma precisa melhorar' . PHP_EOL;
    }
}

$notas = cadastrarNotas(5);
listarNotas($notas);

$media = calcularMedia($notas);

echo PHP_EOL;
echo 'Quantidade de notas: ' . count($notas) . PHP_EOL;
echo 'Media da turma: ' . number_format($media, 1, ',', '.') . PHP_EOL;
mostrarSituacao($media);

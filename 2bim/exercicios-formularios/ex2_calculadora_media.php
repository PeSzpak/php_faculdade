<?php
// Exercício 2 — Calculadora de Média
// Convertidos para número: nota1 e nota2 (aceita vírgula ou ponto).
// A validação acontece antes do cálculo: nota fora de 0..10 não gera situação.
// Ordem das condições: da maior média para a menor (>= 7, depois >= 4, senão reprovado).

$nome = "";
$nota1 = "";
$nota2 = "";
$erro = "";
$media = null;
$situacao = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome  = trim($_POST["nome"] ?? "");
    $nota1 = trim($_POST["nota1"] ?? "");
    $nota2 = trim($_POST["nota2"] ?? "");

    $n1 = str_replace(",", ".", $nota1);
    $n2 = str_replace(",", ".", $nota2);

    if ($nome === "") {
        $erro = "Informe o nome do aluno.";
    } elseif (!is_numeric($n1) || !is_numeric($n2) || $n1 < 0 || $n1 > 10 || $n2 < 0 || $n2 > 10) {
        $erro = "Existe uma nota inválida. As notas devem estar entre 0 e 10.";
    } else {
        $media = ((float) $n1 + (float) $n2) / 2;

        if ($media >= 7) {
            $situacao = "APROVADO";
        } elseif ($media >= 4) {
            $situacao = "RECUPERAÇÃO";
        } else {
            $situacao = "REPROVADO";
        }
    }
}

function h(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculadora de Média</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f4f5; margin: 0; padding: 24px 16px; }
        main { max-width: 440px; margin: 0 auto; background: #fff; padding: 24px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        label { display: block; margin-top: 14px; font-weight: 600; }
        input { width: 100%; box-sizing: border-box; padding: 8px 10px; margin-top: 4px; font-size: 1rem; border: 1px solid #ccc; border-radius: 6px; }
        button { margin-top: 20px; width: 100%; padding: 10px; font-size: 1rem; background: #2563eb; color: #fff; border: 0; border-radius: 6px; cursor: pointer; }
        .erro { background: #fee2e2; color: #991b1b; padding: 10px 14px; border-radius: 6px; }
        .resumo { background: #eff6ff; padding: 10px 14px; border-radius: 6px; }
    </style>
</head>
<body>
<main>
    <h1>Calculadora de Média</h1>

    <form method="POST" novalidate>
        <label for="nome">Nome do aluno</label>
        <input type="text" id="nome" name="nome" value="<?= h($nome) ?>">

        <label for="nota1">Nota 1</label>
        <input type="text" id="nota1" name="nota1" inputmode="decimal" value="<?= h($nota1) ?>">

        <label for="nota2">Nota 2</label>
        <input type="text" id="nota2" name="nota2" inputmode="decimal" value="<?= h($nota2) ?>">

        <button type="submit">Calcular</button>
    </form>

    <?php if ($erro !== ""): ?>
        <p class="erro"><?= h($erro) ?></p>
    <?php elseif ($media !== null): ?>
        <div class="resumo">
            <p><strong>Aluno:</strong> <?= h($nome) ?></p>
            <p><strong>Média:</strong> <?= number_format($media, 2, ",", ".") ?></p>
            <p><strong>Situação:</strong> <?= $situacao ?></p>
        </div>
    <?php endif; ?>
</main>
</body>
</html>

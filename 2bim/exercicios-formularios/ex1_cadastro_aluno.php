<?php
// Exercício 1 — Cadastro de Aluno
// Chegam pelo formulário: nome, curso e idade.
// Validados: nome (obrigatório) e idade (maior que zero).
// Permanecem preenchidos após o envio: os três campos.

$nome = "";
$curso = "";
$idade = "";
$enviado = $_SERVER["REQUEST_METHOD"] === "POST";
$valido = false;

if ($enviado) {
    // receber → preservar
    $nome  = trim($_POST["nome"] ?? "");
    $curso = trim($_POST["curso"] ?? "");
    $idade = trim($_POST["idade"] ?? "");

    // validar
    $idadeNumero = filter_var($idade, FILTER_VALIDATE_INT);
    $valido = $nome !== "" && $idadeNumero !== false && $idadeNumero > 0;
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
    <title>Cadastro de Aluno</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f4f5; margin: 0; padding: 24px 16px; }
        main { max-width: 440px; margin: 0 auto; background: #fff; padding: 24px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        label { display: block; margin-top: 14px; font-weight: 600; }
        input { width: 100%; box-sizing: border-box; padding: 8px 10px; margin-top: 4px; font-size: 1rem; border: 1px solid #ccc; border-radius: 6px; }
        button { margin-top: 20px; width: 100%; padding: 10px; font-size: 1rem; background: #2563eb; color: #fff; border: 0; border-radius: 6px; cursor: pointer; }
        .erro { background: #fee2e2; color: #991b1b; padding: 10px 14px; border-radius: 6px; }
        .resumo { background: #dcfce7; color: #166534; padding: 10px 14px; border-radius: 6px; }
    </style>
</head>
<body>
<main>
    <h1>Cadastro de Aluno</h1>

    <form method="POST" novalidate>
        <label for="nome">Nome do aluno</label>
        <input type="text" id="nome" name="nome" value="<?= h($nome) ?>">

        <label for="curso">Curso</label>
        <input type="text" id="curso" name="curso" value="<?= h($curso) ?>">

        <label for="idade">Idade</label>
        <input type="number" id="idade" name="idade" value="<?= h($idade) ?>">

        <button type="submit">Enviar</button>
    </form>

    <?php if ($enviado && !$valido): ?>
        <p class="erro">Existem dados inválidos: o nome é obrigatório e a idade deve ser maior que zero.</p>
    <?php elseif ($valido): ?>
        <div class="resumo">
            <h2>Resumo</h2>
            <p><strong>Nome:</strong> <?= h($nome) ?></p>
            <p><strong>Curso:</strong> <?= h($curso) ?></p>
            <p><strong>Idade:</strong> <?= h($idade) ?> anos</p>
        </div>
    <?php endif; ?>
</main>
</body>
</html>

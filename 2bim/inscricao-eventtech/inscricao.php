<?php
// Missão da Noite — Inscrição Workshop EventTech

$cursos = ["Desenvolvimento Web", "Banco de Dados", "Inteligência Artificial"];

// Missão 5: começam vazios e, após o envio, guardam o que foi digitado
$nome = "";
$email = "";
$idade = "";
$cidade = "";
$curso = "";
$mensagem = "";
$sucesso = false;

// Missão 2: só processa quando o formulário foi enviado por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Os nomes batem exatamente com os atributos name do HTML
    $nome   = trim($_POST["nome"] ?? "");
    $email  = trim($_POST["email"] ?? "");
    $idade  = trim($_POST["idade"] ?? "");
    $cidade = trim($_POST["cidade"] ?? "");
    $curso  = $_POST["curso"] ?? "";

    $idadeNumero = filter_var($idade, FILTER_VALIDATE_INT);

    // Missão 3: validações na ordem pedida
    if ($nome === "") {
        $mensagem = "O nome é obrigatório.";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $mensagem = "Informe um e-mail válido.";
    } elseif ($idadeNumero === false || $idadeNumero < 16) {
        $mensagem = "A idade mínima é 16 anos.";
    } elseif ($cidade === "") {
        $mensagem = "Informe a cidade.";
    } elseif (!in_array($curso, $cursos, true)) {
        $mensagem = "Selecione um curso.";
    } else {
        $mensagem = "Inscrição realizada com sucesso!";
        $sucesso = true;
    }
}

// Missão 4: todo valor exibido passa por htmlspecialchars
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
    <title>Inscrição — Workshop EventTech</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #0f172a; margin: 0; padding: 24px 16px; color: #0f172a; }
        main { max-width: 460px; margin: 0 auto; background: #fff; padding: 24px; border-radius: 12px; }
        h1 { margin-top: 0; font-size: 1.35rem; }
        label { display: block; margin-top: 14px; font-weight: 600; }
        input, select { width: 100%; box-sizing: border-box; padding: 8px 10px; margin-top: 4px; font-size: 1rem; border: 1px solid #cbd5e1; border-radius: 6px; }
        button { margin-top: 20px; width: 100%; padding: 10px; font-size: 1rem; background: #7c3aed; color: #fff; border: 0; border-radius: 6px; cursor: pointer; }
        .erro { background: #fee2e2; color: #991b1b; padding: 10px 14px; border-radius: 6px; }
        .sucesso { background: #dcfce7; color: #166534; padding: 10px 14px; border-radius: 6px; }
    </style>
</head>
<body>
<main>
    <h1>Inscrição — Workshop EventTech</h1>

    <?php if ($sucesso): ?>
        <div class="sucesso">
            <strong><?= h($mensagem) ?></strong>
            <p>Participante: <?= h($nome) ?></p>
            <p>Cidade: <?= h($cidade) ?></p>
            <p>Curso: <?= h($curso) ?></p>
        </div>
    <?php elseif ($mensagem !== ""): ?>
        <p class="erro"><?= h($mensagem) ?></p>
    <?php endif; ?>

    <form method="POST" novalidate>
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" value="<?= h($nome) ?>">

        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" value="<?= h($email) ?>">

        <label for="idade">Idade</label>
        <input type="number" id="idade" name="idade" value="<?= h($idade) ?>">

        <label for="cidade">Cidade</label>
        <input type="text" id="cidade" name="cidade" value="<?= h($cidade) ?>">

        <label for="curso">Curso desejado</label>
        <select id="curso" name="curso">
            <option value="">Selecione um curso</option>
            <?php foreach ($cursos as $opcao): ?>
                <option value="<?= h($opcao) ?>" <?= $curso === $opcao ? "selected" : "" ?>><?= h($opcao) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Inscrever-se</button>
    </form>
</main>
</body>
</html>

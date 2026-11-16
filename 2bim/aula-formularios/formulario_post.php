<?php
// Exemplo de aula: formulário com POST que calcula o total do produto
$produto = "";
$preco = "";
$quantidade = "";
$total = null;

// Só lê o $_POST depois que o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produto = trim($_POST["produto"] ?? "");
    $preco = $_POST["preco"] ?? "";
    $quantidade = $_POST["quantidade"] ?? "";

    $total = (float) $preco * (float) $quantidade;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exemplo de formulário com POST</title>
</head>
<body>
    <h1>Informe os dados do produto</h1>
    <form method="POST">
        <label for="produto">Produto:</label>
        <input type="text" id="produto" name="produto" value="<?= htmlspecialchars($produto, ENT_QUOTES) ?>">
        <br><br>
        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" value="<?= htmlspecialchars($preco, ENT_QUOTES) ?>">
        <br><br>
        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" value="<?= htmlspecialchars($quantidade, ENT_QUOTES) ?>">
        <br><br>
        <button type="submit">Enviar</button>
    </form>

    <?php if ($total !== null): ?>
        <h2>Resultado</h2>
        <p>Produto: <?= htmlspecialchars($produto, ENT_QUOTES) ?></p>
        <p>Total: R$ <?= number_format($total, 2, ",", ".") ?></p>
    <?php endif; ?>
</body>
</html>

<?php
// Exercício 3 — Simulador de Pedido
// Dados do formulário: nome, produto, preco, quantidade, tipo (comum/premium).
// Convertidos: preco (float) e quantidade (int).
// Regras com condição: faixa de desconto pelo subtotal e +2% para premium.
// Valores calculados: subtotal, percentual total, valor do desconto e total final.

$nome = "";
$produto = "";
$preco = "";
$quantidade = "";
$tipo = "comum";
$erros = [];
$resultado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome       = trim($_POST["nome"] ?? "");
    $produto    = trim($_POST["produto"] ?? "");
    $preco      = trim($_POST["preco"] ?? "");
    $quantidade = trim($_POST["quantidade"] ?? "");
    $tipo       = $_POST["tipo"] ?? "comum";

    $precoNumero = str_replace(",", ".", $preco);
    $quantidadeNumero = filter_var($quantidade, FILTER_VALIDATE_INT);

    if ($nome === "") {
        $erros[] = "Informe o nome do cliente.";
    }
    if ($produto === "") {
        $erros[] = "Informe o produto.";
    }
    if (!is_numeric($precoNumero) || (float) $precoNumero <= 0) {
        $erros[] = "O preço unitário deve ser maior que zero.";
    }
    if ($quantidadeNumero === false || $quantidadeNumero <= 0) {
        $erros[] = "A quantidade deve ser um número inteiro maior que zero.";
    }
    if ($tipo !== "comum" && $tipo !== "premium") {
        $erros[] = "Tipo de cliente inválido.";
    }

    if (count($erros) === 0) {
        $subtotal = (float) $precoNumero * $quantidadeNumero;

        if ($subtotal >= 500) {
            $percentual = 10;
        } elseif ($subtotal >= 200) {
            $percentual = 5;
        } else {
            $percentual = 0;
        }

        if ($tipo === "premium") {
            $percentual += 2;
        }

        $desconto = $subtotal * $percentual / 100;

        $resultado = [
            "subtotal"   => $subtotal,
            "percentual" => $percentual,
            "desconto"   => $desconto,
            "total"      => $subtotal - $desconto,
        ];
    }
}

function h(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, "UTF-8");
}

function reais(float $valor): string
{
    return "R$ " . number_format($valor, 2, ",", ".");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simulador de Pedido</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f4f5; margin: 0; padding: 24px 16px; }
        main { max-width: 460px; margin: 0 auto; background: #fff; padding: 24px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        label { display: block; margin-top: 14px; font-weight: 600; }
        input, select { width: 100%; box-sizing: border-box; padding: 8px 10px; margin-top: 4px; font-size: 1rem; border: 1px solid #ccc; border-radius: 6px; }
        button { margin-top: 20px; width: 100%; padding: 10px; font-size: 1rem; background: #2563eb; color: #fff; border: 0; border-radius: 6px; cursor: pointer; }
        .erros { background: #fee2e2; color: #991b1b; padding: 10px 14px; border-radius: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        td { padding: 6px 4px; border-bottom: 1px solid #eee; }
        td:last-child { text-align: right; }
        tr.total td { font-weight: 700; border-bottom: 0; }
    </style>
</head>
<body>
<main>
    <h1>Simulador de Pedido</h1>

    <?php if (count($erros) > 0): ?>
        <div class="erros">
            <strong>Existem informações inválidas:</strong>
            <ul>
                <?php foreach ($erros as $erro): ?>
                    <li><?= h($erro) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" novalidate>
        <label for="nome">Nome do cliente</label>
        <input type="text" id="nome" name="nome" value="<?= h($nome) ?>">

        <label for="produto">Produto</label>
        <input type="text" id="produto" name="produto" value="<?= h($produto) ?>">

        <label for="preco">Preço unitário (R$)</label>
        <input type="text" id="preco" name="preco" inputmode="decimal" placeholder="99,90" value="<?= h($preco) ?>">

        <label for="quantidade">Quantidade</label>
        <input type="number" id="quantidade" name="quantidade" value="<?= h($quantidade) ?>">

        <label for="tipo">Tipo de cliente</label>
        <select id="tipo" name="tipo">
            <option value="comum" <?= $tipo === "comum" ? "selected" : "" ?>>Comum</option>
            <option value="premium" <?= $tipo === "premium" ? "selected" : "" ?>>Premium</option>
        </select>

        <button type="submit">Simular</button>
    </form>

    <?php if ($resultado !== null): ?>
        <h2>Resumo do pedido</h2>
        <table>
            <tr><td>Cliente</td><td><?= h($nome) ?></td></tr>
            <tr><td>Produto</td><td><?= h($produto) ?></td></tr>
            <tr><td>Preço unitário</td><td><?= reais((float) str_replace(",", ".", $preco)) ?></td></tr>
            <tr><td>Quantidade</td><td><?= h($quantidade) ?></td></tr>
            <tr><td>Subtotal</td><td><?= reais($resultado["subtotal"]) ?></td></tr>
            <tr><td>Desconto total</td><td><?= $resultado["percentual"] ?>%</td></tr>
            <tr><td>Valor do desconto</td><td>- <?= reais($resultado["desconto"]) ?></td></tr>
            <tr class="total"><td>Total a pagar</td><td><?= reais($resultado["total"]) ?></td></tr>
        </table>
    <?php endif; ?>
</main>
</body>
</html>

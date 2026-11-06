<?php
require __DIR__ . "/conexao.php";

// Valores que voltam para o formulário quando há erro
$nome = "";
$categoria = "";
$preco = "";
$quantidade = "";

$erros = [];
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 1. RECEBER os dados, removendo espaços desnecessários
    $nome       = trim($_POST["nome"] ?? "");
    $categoria  = trim($_POST["categoria"] ?? "");
    $preco      = trim($_POST["preco"] ?? "");
    $quantidade = trim($_POST["quantidade"] ?? "");

    // 2. TRATAR os números: aceita "250,00" ou "250.00"
    $precoNumero = str_replace(",", ".", $preco);
    $quantidadeNumero = filter_var($quantidade, FILTER_VALIDATE_INT);

    // 3. VALIDAR
    if ($nome === "") {
        $erros[] = "O nome do produto é obrigatório.";
    }
    if ($categoria === "") {
        $erros[] = "A categoria é obrigatória.";
    }
    if (!is_numeric($precoNumero) || (float) $precoNumero <= 0) {
        $erros[] = "O preço deve ser um número maior que zero.";
    }
    if ($quantidadeNumero === false || $quantidadeNumero < 0) {
        $erros[] = "A quantidade em estoque deve ser um número inteiro e não pode ser negativa.";
    }

    // 4. Só acessa o banco se NÃO houver erros: primeiro validar, depois gravar
    if (count($erros) === 0) {
        try {
            $pdo = conectar();

            $sql = "INSERT INTO produtos (nome, categoria, preco, quantidade)
                    VALUES (:nome, :categoria, :preco, :quantidade)";

            $comando = $pdo->prepare($sql);                                   // PREPARE
            $comando->bindValue(":nome", $nome);                              // BIND
            $comando->bindValue(":categoria", $categoria);
            $comando->bindValue(":preco", round((float) $precoNumero, 2));
            $comando->bindValue(":quantidade", $quantidadeNumero, PDO::PARAM_INT);
            $comando->execute();                                              // EXECUTE

            $sucesso = "Produto cadastrado com sucesso! (id " . $pdo->lastInsertId() . ")";

            // Limpa o formulário para o próximo cadastro
            $nome = $categoria = $preco = $quantidade = "";
        } catch (PDOException $e) {
            $erros[] = "Não foi possível gravar no banco de dados: " . $e->getMessage();
        }
    }
}

// Escapa o texto antes de devolver ao HTML
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
    <title>Cadastro de Produtos</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f4f5; margin: 0; padding: 24px 16px; }
        main { max-width: 440px; margin: 0 auto; background: #fff; padding: 24px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        h1 { margin-top: 0; font-size: 1.4rem; }
        label { display: block; margin-top: 14px; font-weight: 600; }
        input { width: 100%; box-sizing: border-box; padding: 8px 10px; margin-top: 4px; font-size: 1rem; border: 1px solid #ccc; border-radius: 6px; }
        button { margin-top: 20px; width: 100%; padding: 10px; font-size: 1rem; background: #2563eb; color: #fff; border: 0; border-radius: 6px; cursor: pointer; }
        .erros { background: #fee2e2; color: #991b1b; padding: 10px 14px; border-radius: 6px; }
        .erros ul { margin: 4px 0 0; padding-left: 18px; }
        .sucesso { background: #dcfce7; color: #166534; padding: 10px 14px; border-radius: 6px; font-weight: 600; }
    </style>
</head>
<body>
<main>
    <h1>Cadastro de Produtos</h1>

    <?php if ($sucesso !== ""): ?>
        <p class="sucesso"><?= h($sucesso) ?></p>
    <?php endif; ?>

    <?php if (count($erros) > 0): ?>
        <div class="erros">
            <strong>Corrija os dados abaixo:</strong>
            <ul>
                <?php foreach ($erros as $erro): ?>
                    <li><?= h($erro) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- novalidate: deixa a validação para o PHP, que é a regra da atividade -->
    <form method="POST" novalidate>
        <label for="nome">Nome do produto</label>
        <input type="text" id="nome" name="nome" value="<?= h($nome) ?>">

        <label for="categoria">Categoria</label>
        <input type="text" id="categoria" name="categoria" value="<?= h($categoria) ?>">

        <label for="preco">Preço (R$)</label>
        <input type="text" id="preco" name="preco" inputmode="decimal" placeholder="250,00" value="<?= h($preco) ?>">

        <label for="quantidade">Quantidade em estoque</label>
        <input type="text" id="quantidade" name="quantidade" inputmode="numeric" value="<?= h($quantidade) ?>">

        <button type="submit">Cadastrar</button>
    </form>
</main>
</body>
</html>

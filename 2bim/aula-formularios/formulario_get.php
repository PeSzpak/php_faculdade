<?php
if (isset($_GET["nome"])) {
    $nome = $_GET["nome"];
} else {
    $nome = "";
}

?>

<!DOCTYPE html>

<head>
    <title>Exemplo de formulario com Get</title>
</head>

<body>
    <h1>Digite seu nome</h1>
    <form method="GET">
        <label>
            Nome:
        </label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome, ENT_QUOTES) ?>">
        <button>Clique aqui para Enviar</button>
    </form>
    <?php
    if ($nome != "") {
        echo "<h2>Olá, " . htmlspecialchars($nome, ENT_QUOTES) . "</h2>";
    }
    ?>
</body>
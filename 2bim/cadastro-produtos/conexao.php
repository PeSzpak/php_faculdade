<?php
// Dados da conexão. Troque aqui ou defina as variáveis de ambiente DB_DSN, DB_USER e DB_PASS.
$dsn     = getenv("DB_DSN") ?: "mysql:host=127.0.0.1;dbname=loja;charset=utf8mb4";
$usuario = getenv("DB_USER") ?: "root";
$senha   = getenv("DB_PASS") ?: "";

function conectar(): PDO
{
    global $dsn, $usuario, $senha;

    return new PDO($dsn, $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // erro de SQL vira exceção, não falha em silêncio
    ]);
}

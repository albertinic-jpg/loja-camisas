<?php
// banco.php: o MODELO.
function conectar(): PDO
{
    $pdo = new PDO('sqlite:' . __DIR__ . '/mini-loja.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec('CREATE TABLE IF NOT EXISTS produtos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        preco REAL NOT NULL
    )');

    $colunas = $pdo->query('PRAGMA table_info(produtos)')->fetchAll(PDO::FETCH_COLUMN, 1);
    if (!in_array('imagem', $colunas)) {
        $pdo->exec('ALTER TABLE produtos ADD COLUMN imagem TEXT');
    }

    $pdo->exec('CREATE TABLE IF NOT EXISTS funcionarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        senha TEXT NOT NULL
    )');

    // Banco vazio? Entram exatamente 3 camisas de futebol como exemplo
    $total = $pdo->query('SELECT COUNT(*) FROM produtos')->fetchColumn();
    if ($total == 0) {
        $pdo->exec("INSERT INTO produtos (nome, preco) VALUES
            ('Camisa Fluminense I 2026 - Torcedor', 349.90),
            ('Camisa Seleção Brasileira I 2026', 399.90),
            ('Camisa Retrô Brasil 2002 - Ronaldo #9', 279.90)");
    }

    return $pdo;
}

function listarProdutos(): array
{
    $pdo = conectar();
    return $pdo->query('SELECT id, nome, preco, imagem FROM produtos ORDER BY nome')->fetchAll(PDO::FETCH_ASSOC);
}

function inserirProduto(string $nome, float $preco, string $imagem): void
{
    $pdo = conectar();
    $stmt = $pdo->prepare('INSERT INTO produtos (nome, preco, imagem) VALUES (:nome, :preco, :imagem)');
    $stmt->execute([':nome' => $nome, ':preco' => $preco, ':imagem' => $imagem]);
}

function excluirProduto(int $id): void
{
    $pdo = conectar();
    $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = :id');
    $stmt->execute([':id' => $id]);
}

function buscarProduto(int $id): ?array
{
    $pdo = conectar();
    $stmt = $pdo->prepare('SELECT id, nome, preco, imagem FROM produtos WHERE id = :id');
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function atualizarProduto(int $id, string $nome, float $preco, string $imagem): void
{
    $pdo = conectar();
    $stmt = $pdo->prepare('UPDATE produtos SET nome = :nome, preco = :preco, imagem = :imagem WHERE id = :id');
    $stmt->execute([':nome' => $nome, ':preco' => $preco, ':imagem' => $imagem, ':id' => $id]);
}

function inserirFuncionario(string $nome, string $email, string $hash): void
{
    $pdo = conectar();
    $stmt = $pdo->prepare('INSERT INTO funcionarios (nome, email, senha) VALUES (:nome, :email, :senha)');
    $stmt->execute([':nome' => $nome, ':email' => $email, ':senha' => $hash]);
}

function buscarFuncionario(string $email): ?array
{
    $pdo = conectar();
    $stmt = $pdo->prepare('SELECT id, nome, email, senha FROM funcionarios WHERE email = :email');
    $stmt->execute([':email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function contarFuncionarios(): int
{
    $pdo = conectar();
    return (int) $pdo->query('SELECT COUNT(*) FROM funcionarios')->fetchColumn();
}
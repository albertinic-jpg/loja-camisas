<?php
// produtos.php: o CONTROLE da vitrine (produtos adicionados).
session_start();
require __DIR__ . '/banco.php';

$logado = $_SESSION['funcionario'] ?? '';
$produtos = listarProdutos();

require __DIR__ . '/tela-produtos.php';
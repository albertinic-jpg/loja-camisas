<?php // tela-funcionario.php: a VISÃO da página de login. ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Manto Sagrado · Login</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <div class="container">
    <div class="topbar">
      <a href="index.html">← Página inicial</a>
      <a href="produtos.php">Ver camisas</a>
    </div>

    <h1>Login · Área do Funcionário</h1>

    <?php if ($erro): ?>
      <p class="alerta-erro"><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>
    <?php if ($aviso): ?>
      <p class="alerta-sucesso"><?= htmlspecialchars($aviso) ?></p>
    <?php endif; ?>

    <?php if ($logado): ?>
      <p class="alerta-sucesso">Você está logado como <strong><?= htmlspecialchars($logado) ?></strong>.</p>
      <p>
        <a class="btn" href="cadastro.php">Gerenciar camisas</a>
        <a class="btn-cancelar" href="funcionario.php?sair=1">Sair da conta</a>
      </p>
    <?php else: ?>
      <h2>Entrar no sistema</h2>
      <form class="form-box" method="post" action="funcionario.php">
        <input type="hidden" name="acao" value="entrar">

        <label for="email-entrar">E-mail</label>
        <input id="email-entrar" name="email" type="email" required>

        <label for="senha-entrar">Senha</label>
        <input id="senha-entrar" name="senha" type="password" required>

        <button type="submit">Entrar</button>
      </form>
    <?php endif; ?>

    <?php if ($podeCadastrar): ?>
      <h2><?= $logado ? 'Cadastrar novo funcionário' : 'Primeiro acesso: cadastre o administrador' ?></h2>
      <form class="form-box" method="post" action="funcionario.php">
        <input type="hidden" name="acao" value="cadastrar">

        <label for="nome">Nome</label>
        <input id="nome" name="nome" type="text" required>

        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" required>

        <label for="senha">Senha (mínimo 8 caracteres)</label>
        <input id="senha" name="senha" type="password" minlength="8" required>

        <button type="submit">Cadastrar</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
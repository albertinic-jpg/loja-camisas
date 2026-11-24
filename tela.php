<?php // tela.php: a VISÃO de gerenciamento (CRUD). ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Manto Sagrado · Gerenciar Camisas</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <div class="container">
    <div class="topbar">
      <div>
        <a href="index.html">← Página inicial</a> · 
        <a href="produtos.php">Ver vitrine pública</a>
      </div>
      <div>
        <?php if ($logado): ?>
          Olá, <strong><?= htmlspecialchars($logado) ?></strong>! · 
          <a href="funcionario.php">Área do funcionário</a> · 
          <a href="funcionario.php?sair=1">Sair</a>
        <?php else: ?>
          É funcionário? <a href="funcionario.php">Faça login</a>
        <?php endif; ?>
      </div>
    </div>

    <h1>Gerenciar Estoque de Camisas</h1>

    <?php if ($logado): ?>
      <h2><?= !empty($produto['id']) ? 'Editar camisa' : 'Adicionar nova camisa' ?></h2>

      <?php if ($erro): ?>
        <p class="alerta-erro"><strong>Foto recusada:</strong> <?= htmlspecialchars($erro) ?></p>
      <?php endif; ?>

      <form class="form-box" method="post" action="cadastro.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $produto['id'] ?? '' ?>">

        <label for="nome">Modelo da Camisa</label>
        <input id="nome" name="nome" type="text" required value="<?= htmlspecialchars($produto['nome'] ?? '') ?>">

        <label for="preco">Preço (R$)</label>
        <input id="preco" name="preco" type="number" step="0.01" min="0" required value="<?= $produto['preco'] ?? '' ?>">

        <?php if (!empty($produto['imagem'])): ?>
          <p>Foto atual:<br><img src="uploads/<?= htmlspecialchars($produto['imagem']) ?>" alt="" width="80" style="border-radius:6px; margin-top:5px;"></p>
        <?php endif; ?>

        <label for="imagem"><?= !empty($produto['id']) ? 'Trocar a foto (opcional)' : 'Foto da camisa' ?></label>
        <input id="imagem" name="imagem" type="file" accept="image/jpeg, image/png, image/webp">
        <small>JPG, PNG ou WEBP, até 2 MB.</small>

        <div class="acoes">
          <button type="submit"><?= !empty($produto['id']) ? 'Salvar alterações' : 'Cadastrar Camisa' ?></button>
          <?php if (!empty($produto['id'])): ?>
            <a class="btn-cancelar" href="cadastro.php">Cancelar</a>
          <?php endif; ?>
        </div>
      </form>
    <?php else: ?>
      <p class="alerta-erro">Faça login na <a href="funcionario.php">Área do Funcionário</a> para adicionar, editar ou excluir camisas.</p>
    <?php endif; ?>

    <h2>Camisas no Sistema (<?= count($produtos) ?>)</h2>
    <ul class="lista-admin">
      <?php foreach ($produtos as $item): ?>
        <li class="item-admin">
          <div class="item-info">
            <?php if ($item['imagem']): ?>
              <img src="uploads/<?= htmlspecialchars($item['imagem']) ?>" alt="">
            <?php else: ?>
              <span>👕</span>
            <?php endif; ?>
            <div>
              <strong><?= htmlspecialchars($item['nome']) ?></strong><br>
              <span>R$ <?= number_format($item['preco'], 2, ',', '.') ?></span>
            </div>
          </div>

          <?php if ($logado): ?>
            <div class="acoes">
              <a class="btn-editar" href="cadastro.php?editar=<?= $item['id'] ?>">Editar</a>
              <form method="post" action="cadastro.php" style="display: inline">
                <button class="btn-excluir" name="excluir" value="<?= $item['id'] ?>">Excluir</button>
              </form>
            </div>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>
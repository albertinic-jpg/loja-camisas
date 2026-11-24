<?php // tela-produtos.php: a VISÃO da vitrine pública de camisas. ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Manto Sagrado · Catálogo de Camisas</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <div class="container">
    <div class="topbar">
      <a href="index.html">← Página inicial</a>
      <div>
        <?php if ($logado): ?>
          Olá, <strong><?= htmlspecialchars($logado) ?></strong>! · 
          <a href="cadastro.php">Gerenciar produtos</a> · 
          <a href="funcionario.php?sair=1">Sair</a>
        <?php else: ?>
          <a href="funcionario.php">Fazer Login</a>
        <?php endif; ?>
      </div>
    </div>

    <h1>Camisas Adicionadas (<?= count($produtos) ?>)</h1>

    <?php if (empty($produtos)): ?>
      <p>Nenhuma camisa cadastrada no momento.</p>
    <?php else: ?>
      <ul class="grid-produtos">
        <?php foreach ($produtos as $item): ?>
          <li class="card-produto">
            <?php if (!empty($item['imagem'])): ?>
              <img src="uploads/<?= htmlspecialchars($item['imagem']) ?>" alt="<?= htmlspecialchars($item['nome']) ?>">
            <?php else: ?>
              <div class="sem-foto">👕 Sem foto</div>
            <?php endif; ?>
            
            <span class="nome"><?= htmlspecialchars($item['nome']) ?></span>
            <span class="preco">R$ <?= number_format($item['preco'], 2, ',', '.') ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</body>
</html>
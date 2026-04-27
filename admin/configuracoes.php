<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
exigirPerfil(['administrador']);
$tituloPagina='Configurações'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2>Configurações da Escola</h2>
<div class="card p-4">
  <p>Este módulo está preparado para armazenar nome da escola, logotipo, contactos, NIF e texto padrão dos comprovativos.</p>
  <p class="mb-0 text-muted">Na próxima iteração, pode ser ligado à tabela <code>configuracoes_escola</code>.</p>
</div>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

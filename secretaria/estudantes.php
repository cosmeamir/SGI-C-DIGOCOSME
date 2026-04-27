<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);
$alunos = $pdo->query('SELECT id,numero_estudante,nome_completo,sexo,telefone,estado FROM alunos ORDER BY id DESC')->fetchAll();
$tituloPagina='Estudantes'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2>Gestão de Estudantes</h2>
<table class="table table-striped bg-white"><thead><tr><th>Nº estudante</th><th>Nome</th><th>Sexo</th><th>Telefone</th><th>Estado</th></tr></thead><tbody><?php foreach($alunos as $a): ?><tr><td><?= htmlspecialchars($a['numero_estudante']) ?></td><td><?= htmlspecialchars($a['nome_completo']) ?></td><td><?= htmlspecialchars($a['sexo']) ?></td><td><?= htmlspecialchars($a['telefone']) ?></td><td><?= htmlspecialchars($a['estado']) ?></td></tr><?php endforeach; ?></tbody></table>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

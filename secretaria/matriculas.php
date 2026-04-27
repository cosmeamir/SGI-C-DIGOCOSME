<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);
$lista = $pdo->query('SELECT m.*,a.nome_completo,t.nome turma FROM matriculas m LEFT JOIN alunos a ON a.id=m.aluno_id LEFT JOIN turmas t ON t.id=m.turma_id ORDER BY m.id DESC')->fetchAll();
$tituloPagina='Matrículas'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2>Matrículas</h2>
<table class="table bg-white"><thead><tr><th>Nº matrícula</th><th>Aluno</th><th>Turma</th><th>Estado</th><th>PDF</th></tr></thead><tbody><?php foreach($lista as $m): ?><tr><td><?= htmlspecialchars($m['numero_matricula']) ?></td><td><?= htmlspecialchars($m['nome_completo']) ?></td><td><?= htmlspecialchars($m['turma'] ?? '-') ?></td><td><?= htmlspecialchars($m['estado']) ?></td><td><a href="/pdf/comprovativo_matricula.php?id=<?= $m['id'] ?>" class="btn btn-sm btn-outline-primary">Comprovativo</a></td></tr><?php endforeach; ?></tbody></table>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

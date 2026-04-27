<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);
$stats = [
    'Pré-inscrições' => (int) $pdo->query('SELECT COUNT(*) FROM pre_inscricoes')->fetchColumn(),
    'Pendentes' => (int) $pdo->query("SELECT COUNT(*) FROM pre_inscricoes WHERE estado='Pendente'")->fetchColumn(),
    'Inscritos' => (int) $pdo->query('SELECT COUNT(*) FROM inscricoes')->fetchColumn(),
    'Matriculados' => (int) $pdo->query("SELECT COUNT(*) FROM matriculas WHERE estado='Matriculado'")->fetchColumn(),
];
$tituloPagina='Dashboard da Secretaria'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2 class="mb-3">Dashboard da Secretaria</h2><div class="row g-3"><?php foreach($stats as $k=>$v): ?><div class="col-md-3"><div class="card card-kpi p-3"><div class="text-muted"><?= $k ?></div><div class="display-6 fw-bold"><?= $v ?></div></div></div><?php endforeach; ?></div></main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

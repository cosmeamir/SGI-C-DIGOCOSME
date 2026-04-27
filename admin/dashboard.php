<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['administrador']);

$stats = [
    'Pré-inscrições' => (int) $pdo->query('SELECT COUNT(*) FROM pre_inscricoes')->fetchColumn(),
    'Inscrições' => (int) $pdo->query('SELECT COUNT(*) FROM inscricoes')->fetchColumn(),
    'Matrículas' => (int) $pdo->query('SELECT COUNT(*) FROM matriculas')->fetchColumn(),
    'Estudantes' => (int) $pdo->query('SELECT COUNT(*) FROM alunos')->fetchColumn(),
];
$tituloPagina = 'Dashboard do Administrador';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout">
  <?php include __DIR__ . '/../includes/sidebar.php'; ?>
  <main class="content-wrap">
    <h2 class="mb-4">Dashboard do Administrador</h2>
    <div class="row g-3">
      <?php foreach ($stats as $label => $valor): ?>
      <div class="col-md-3">
        <div class="card card-kpi p-3">
          <div class="text-muted"><?= $label ?></div>
          <div class="display-6 fw-bold"><?= $valor ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </main>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>

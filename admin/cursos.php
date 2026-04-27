<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['administrador']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO cursos (nome, descricao, duracao, estado) VALUES (:nome,:descricao,:duracao,:estado)');
    $stmt->execute([
        'nome' => $_POST['nome'],
        'descricao' => $_POST['descricao'],
        'duracao' => $_POST['duracao'],
        'estado' => $_POST['estado'],
    ]);
    header('Location: /admin/cursos.php');
    exit;
}
$cursos = $pdo->query('SELECT * FROM cursos ORDER BY id DESC')->fetchAll();
$tituloPagina = 'Cursos';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap">
<h2 class="mb-3">Gestão de Cursos</h2>
<form method="post" class="card p-3 mb-4">
  <div class="row g-2">
    <div class="col-md-4"><input name="nome" class="form-control" placeholder="Nome do curso" required></div>
    <div class="col-md-4"><input name="descricao" class="form-control" placeholder="Descrição"></div>
    <div class="col-md-2"><input name="duracao" class="form-control" type="number" min="1" placeholder="Duração"></div>
    <div class="col-md-2"><select name="estado" class="form-select"><option value="ativo">Ativo</option><option value="inativo">Inativo</option></select></div>
  </div>
  <button class="btn btn-school mt-3">Guardar curso</button>
</form>
<table class="table table-striped bg-white">
  <thead><tr><th>ID</th><th>Curso</th><th>Duração</th><th>Estado</th></tr></thead>
  <tbody><?php foreach($cursos as $c): ?><tr><td><?= $c['id'] ?></td><td><?= htmlspecialchars($c['nome']) ?></td><td><?= htmlspecialchars($c['duracao']) ?> anos</td><td><?= htmlspecialchars($c['estado']) ?></td></tr><?php endforeach; ?></tbody>
</table>
</main></div>
<?php include __DIR__ . '/../includes/footer.php'; ?>

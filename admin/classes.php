<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['administrador']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare('INSERT INTO classes (nome, nivel, estado) VALUES (:nome,:nivel,:estado)')->execute([
        'nome' => $_POST['nome'],
        'nivel' => $_POST['nivel'],
        'estado' => $_POST['estado'],
    ]);
    header('Location: /admin/classes.php');
    exit;
}
$classes = $pdo->query('SELECT * FROM classes ORDER BY nivel')->fetchAll();
$tituloPagina = 'Classes'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap">
<h2 class="mb-3">Gestão de Classes</h2>
<form method="post" class="card p-3 mb-3"><div class="row g-2"><div class="col"><input name="nome" class="form-control" placeholder="10ª Classe" required></div><div class="col"><input name="nivel" type="number" class="form-control" required></div><div class="col"><select name="estado" class="form-select"><option>ativo</option><option>inativo</option></select></div></div><button class="btn btn-school mt-3">Guardar</button></form>
<table class="table table-bordered bg-white"><thead><tr><th>Nome</th><th>Nível</th><th>Estado</th></tr></thead><tbody><?php foreach($classes as $classe): ?><tr><td><?= htmlspecialchars($classe['nome']) ?></td><td><?= $classe['nivel'] ?></td><td><?= htmlspecialchars($classe['estado']) ?></td></tr><?php endforeach; ?></tbody></table>
</main></div>
<?php include __DIR__ . '/../includes/footer.php'; ?>

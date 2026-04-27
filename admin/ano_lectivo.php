<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['administrador']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['activar_id'])) {
        $pdo->exec("UPDATE ano_lectivo SET estado='inativo'");
        $pdo->prepare("UPDATE ano_lectivo SET estado='ativo' WHERE id=?")->execute([$_POST['activar_id']]);
    } else {
        $pdo->prepare('INSERT INTO ano_lectivo (nome,data_inicio,data_fim,estado) VALUES (?,?,?,?)')->execute([
            $_POST['nome'], $_POST['data_inicio'], $_POST['data_fim'], 'inativo'
        ]);
    }
    header('Location: /admin/ano_lectivo.php'); exit;
}
$anos = $pdo->query('SELECT * FROM ano_lectivo ORDER BY id DESC')->fetchAll();
$tituloPagina='Ano Lectivo'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2>Ano Lectivo</h2>
<form method="post" class="card p-3 mb-3"><div class="row g-2"><div class="col"><input name="nome" class="form-control" placeholder="2026/2027" required></div><div class="col"><input type="date" name="data_inicio" class="form-control" required></div><div class="col"><input type="date" name="data_fim" class="form-control" required></div></div><button class="btn btn-school mt-3">Criar ano lectivo</button></form>
<table class="table bg-white"><thead><tr><th>Nome</th><th>Período</th><th>Estado</th><th>Ação</th></tr></thead><tbody><?php foreach($anos as $a): ?><tr><td><?= htmlspecialchars($a['nome']) ?></td><td><?= $a['data_inicio'] ?> até <?= $a['data_fim'] ?></td><td><?= $a['estado'] ?></td><td><form method="post"><input type="hidden" name="activar_id" value="<?= $a['id'] ?>"><button class="btn btn-sm btn-outline-primary">Definir ativo</button></form></td></tr><?php endforeach; ?></tbody></table>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

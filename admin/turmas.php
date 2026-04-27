<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['administrador']);
$cursos = $pdo->query('SELECT id,nome FROM cursos WHERE estado="ativo"')->fetchAll();
$classes = $pdo->query('SELECT id,nome FROM classes WHERE estado="ativo"')->fetchAll();
$anos = $pdo->query('SELECT id,nome FROM ano_lectivo ORDER BY id DESC')->fetchAll();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare('INSERT INTO turmas (nome, curso_id, classe_id, turno, sala, limite_alunos, ano_lectivo_id, estado) VALUES (?,?,?,?,?,?,?,?)')
        ->execute([$_POST['nome'], $_POST['curso_id'], $_POST['classe_id'], $_POST['turno'], $_POST['sala'], $_POST['limite_alunos'], $_POST['ano_lectivo_id'], 'ativo']);
    header('Location: /admin/turmas.php'); exit;
}
$turmas = $pdo->query('SELECT t.*,c.nome curso,cl.nome classe,a.nome ano FROM turmas t LEFT JOIN cursos c ON c.id=t.curso_id LEFT JOIN classes cl ON cl.id=t.classe_id LEFT JOIN ano_lectivo a ON a.id=t.ano_lectivo_id ORDER BY t.id DESC')->fetchAll();
$tituloPagina='Turmas'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2>Gestão de Turmas</h2>
<form method="post" class="card p-3 mb-3"><div class="row g-2"><div class="col-md-2"><input name="nome" class="form-control" placeholder="INF10A" required></div><div class="col-md-2"><select name="curso_id" class="form-select" required><?php foreach($cursos as $c): ?><option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option><?php endforeach; ?></select></div><div class="col-md-2"><select name="classe_id" class="form-select" required><?php foreach($classes as $c): ?><option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option><?php endforeach; ?></select></div><div class="col-md-2"><select name="turno" class="form-select"><option>Manhã</option><option>Tarde</option><option>Noite</option></select></div><div class="col-md-1"><input name="sala" class="form-control" placeholder="A1"></div><div class="col-md-1"><input name="limite_alunos" type="number" class="form-control" value="35"></div><div class="col-md-2"><select name="ano_lectivo_id" class="form-select"><?php foreach($anos as $a): ?><option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nome']) ?></option><?php endforeach; ?></select></div></div><button class="btn btn-school mt-3">Criar turma</button></form>
<table class="table table-striped bg-white"><thead><tr><th>Turma</th><th>Curso</th><th>Classe</th><th>Turno</th><th>Ano</th></tr></thead><tbody><?php foreach($turmas as $t): ?><tr><td><?= htmlspecialchars($t['nome']) ?></td><td><?= htmlspecialchars($t['curso']) ?></td><td><?= htmlspecialchars($t['classe']) ?></td><td><?= htmlspecialchars($t['turno']) ?></td><td><?= htmlspecialchars($t['ano']) ?></td></tr><?php endforeach; ?></tbody></table>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);
$lista = $pdo->query('SELECT i.*, p.nome_candidato FROM inscricoes i LEFT JOIN pre_inscricoes p ON p.id = i.pre_inscricao_id ORDER BY i.id DESC')->fetchAll();
$tituloPagina='Inscrições'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2>Inscrições</h2>
<table class="table table-hover bg-white"><thead><tr><th>Nº inscrição</th><th>Aluno</th><th>Turno</th><th>Estado</th><th>Ação</th></tr></thead><tbody><?php foreach($lista as $i): ?><tr><td><?= htmlspecialchars($i['numero_inscricao']) ?></td><td><?= htmlspecialchars($i['nome_candidato']) ?></td><td><?= htmlspecialchars($i['turno']) ?></td><td><?= htmlspecialchars($i['estado']) ?></td><td><form method="post" action="/actions/gerar_matricula.php" class="d-inline"><input type="hidden" name="inscricao_id" value="<?= $i['id'] ?>"><button class="btn btn-sm btn-school">Matricular</button></form> <a class="btn btn-sm btn-outline-secondary" href="/pdf/comprovativo_inscricao.php?id=<?= $i['id'] ?>">PDF</a></td></tr><?php endforeach; ?></tbody></table>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

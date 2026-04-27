<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);
$lista = $pdo->query('SELECT * FROM pre_inscricoes ORDER BY id DESC')->fetchAll();
$tituloPagina='Pré-inscrições'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2>Pré-inscrições</h2>
<table class="table table-striped bg-white"><thead><tr><th>Código</th><th>Candidato</th><th>Curso</th><th>Classe</th><th>Estado</th><th>Ações</th></tr></thead><tbody>
<?php foreach($lista as $item): ?><tr><td><?= htmlspecialchars($item['codigo_pre_inscricao']) ?></td><td><?= htmlspecialchars($item['nome_candidato']) ?></td><td><?= htmlspecialchars($item['curso_pretendido']) ?></td><td><?= htmlspecialchars($item['classe_pretendida']) ?></td><td><?= htmlspecialchars($item['estado']) ?></td><td>
<form method="post" action="/actions/validar_pre_inscricao.php" class="d-inline"><input type="hidden" name="id" value="<?= $item['id'] ?>"><input type="hidden" name="estado" value="Aprovado para inscrição"><button class="btn btn-sm btn-success">Aprovar</button></form>
<form method="post" action="/actions/validar_pre_inscricao.php" class="d-inline"><input type="hidden" name="id" value="<?= $item['id'] ?>"><input type="hidden" name="estado" value="Documentos incompletos"><button class="btn btn-sm btn-warning">Incompletos</button></form>
<form method="post" action="/actions/converter_inscricao.php" class="d-inline"><input type="hidden" name="pre_inscricao_id" value="<?= $item['id'] ?>"><button class="btn btn-sm btn-primary">Converter</button></form>
</td></tr><?php endforeach; ?></tbody></table>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);
$docs = $pdo->query('SELECT * FROM documentos ORDER BY id DESC')->fetchAll();
$tituloPagina='Documentos'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2>Documentos</h2>
<form method="post" action="/actions/upload_documento.php" enctype="multipart/form-data" class="card p-3 mb-3"><div class="row g-2"><div class="col-md-3"><input name="aluno_id" class="form-control" placeholder="ID aluno"></div><div class="col-md-3"><input name="pre_inscricao_id" class="form-control" placeholder="ID pré-inscrição"></div><div class="col-md-3"><select name="tipo_documento" class="form-select"><option>BI</option><option>Certificado</option><option>Fotografia</option><option>Atestado médico</option><option>Declaração</option><option>Outros</option></select></div><div class="col-md-3"><input type="file" name="ficheiro" class="form-control" required></div></div><button class="btn btn-school mt-3">Upload</button></form>
<table class="table bg-white"><thead><tr><th>Tipo</th><th>Ficheiro</th><th>Estado</th><th>Data</th></tr></thead><tbody><?php foreach($docs as $d): ?><tr><td><?= htmlspecialchars($d['tipo_documento']) ?></td><td><a href="/assets/uploads/documentos/<?= urlencode($d['ficheiro']) ?>" target="_blank"><?= htmlspecialchars($d['ficheiro']) ?></a></td><td><?= htmlspecialchars($d['estado']) ?></td><td><?= htmlspecialchars($d['data_upload']) ?></td></tr><?php endforeach; ?></tbody></table>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

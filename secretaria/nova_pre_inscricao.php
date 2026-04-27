<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);
$cursos = $pdo->query("SELECT id,nome FROM cursos WHERE estado='ativo' ORDER BY nome")->fetchAll();
$classes = $pdo->query("SELECT id,nome FROM classes WHERE estado='ativo' ORDER BY nivel")->fetchAll();
$tituloPagina='Nova Pré-inscrição'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2>Nova Pré-inscrição</h2>
<form method="post" action="/actions/salvar_pre_inscricao.php" class="card p-4">
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Nome completo</label><input name="nome_candidato" class="form-control" required></div>
<div class="col-md-3"><label class="form-label">Nascimento</label><input type="date" name="data_nascimento" class="form-control" required></div>
<div class="col-md-3"><label class="form-label">Sexo</label><select name="sexo" class="form-select"><option>Masculino</option><option>Feminino</option></select></div>
<div class="col-md-4"><label class="form-label">Telefone</label><input name="telefone" class="form-control"></div>
<div class="col-md-4"><label class="form-label">Curso pretendido</label><select name="curso_pretendido" class="form-select"><?php foreach($cursos as $c): ?><option><?= htmlspecialchars($c['nome']) ?></option><?php endforeach; ?></select></div>
<div class="col-md-4"><label class="form-label">Classe pretendida</label><select name="classe_pretendida" class="form-select"><?php foreach($classes as $c): ?><option><?= htmlspecialchars($c['nome']) ?></option><?php endforeach; ?></select></div>
<div class="col-md-6"><label class="form-label">Escola anterior</label><input name="escola_anterior" class="form-control"></div>
<div class="col-md-6"><label class="form-label">Observações</label><input name="observacoes" class="form-control"></div>
</div>
<button class="btn btn-school mt-4">Guardar Pré-inscrição</button>
</form>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

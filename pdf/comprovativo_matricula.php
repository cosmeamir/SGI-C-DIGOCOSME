<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT m.*,a.nome_completo,c.nome curso,cl.nome classe,t.nome turma FROM matriculas m LEFT JOIN alunos a ON a.id=m.aluno_id LEFT JOIN cursos c ON c.id=m.curso_id LEFT JOIN classes cl ON cl.id=m.classe_id LEFT JOIN turmas t ON t.id=m.turma_id WHERE m.id=? LIMIT 1');
$stmt->execute([$id]);
$m = $stmt->fetch();
if (!$m) { die('Matrícula não encontrada'); }
?>
<!doctype html><html><head><meta charset="utf-8"><title>Comprovativo Matrícula</title><style>body{font-family:Arial,sans-serif;padding:40px}.box{border:2px solid #1ed8e9;padding:20px;border-radius:12px}</style></head><body>
<h2>COMPROVATIVO DE MATRÍCULA</h2>
<div class="box">
<p><strong>Nº de Estudante:</strong> <?= htmlspecialchars($m['numero_matricula']) ?></p>
<p><strong>Nome:</strong> <?= htmlspecialchars($m['nome_completo']) ?></p>
<p><strong>Curso:</strong> <?= htmlspecialchars($m['curso']) ?></p>
<p><strong>Classe:</strong> <?= htmlspecialchars($m['classe']) ?></p>
<p><strong>Turma:</strong> <?= htmlspecialchars($m['turma']) ?></p>
<p><strong>Ano Lectivo:</strong> <?= htmlspecialchars($m['ano_lectivo_id']) ?></p>
<p><strong>Estado:</strong> <?= htmlspecialchars($m['estado']) ?></p>
</div>
<script>window.print();</script>
</body></html>

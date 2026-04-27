<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT i.*,a.nome_completo,a.data_nascimento,p.telefone,c.nome curso,cl.nome classe,al.nome encarregado FROM inscricoes i LEFT JOIN alunos a ON a.id=i.aluno_id LEFT JOIN pre_inscricoes p ON p.id=i.pre_inscricao_id LEFT JOIN cursos c ON c.id=i.curso_id LEFT JOIN classes cl ON cl.id=i.classe_id LEFT JOIN encarregados al ON al.aluno_id=a.id WHERE i.id=? LIMIT 1');
$stmt->execute([$id]);
$ins = $stmt->fetch();
if (!$ins) { die('Inscrição não encontrada'); }
?>
<!doctype html><html><head><meta charset="utf-8"><title>Comprovativo</title><style>body{font-family:Arial,sans-serif;padding:40px} .header{display:flex;align-items:center;gap:15px}.title{color:#2563eb} .box{border:2px solid #4e6ff2;padding:20px;border-radius:12px}</style></head><body>
<div class="header"><img src="/assets/img/logo.svg" width="60"><div><h2 class="title">INSTITUTO MÉDIO INTERNACIONAL YARA JANDIRA</h2><strong>COMPROVATIVO DE INSCRIÇÃO</strong></div></div>
<div class="box">
<p><strong>Nº de Inscrição:</strong> <?= htmlspecialchars($ins['numero_inscricao']) ?></p>
<p><strong>Nome do Aluno:</strong> <?= htmlspecialchars($ins['nome_completo']) ?></p>
<p><strong>Data de Nascimento:</strong> <?= htmlspecialchars($ins['data_nascimento']) ?></p>
<p><strong>Curso:</strong> <?= htmlspecialchars($ins['curso'] ?? $ins['curso_id']) ?></p>
<p><strong>Classe:</strong> <?= htmlspecialchars($ins['classe'] ?? $ins['classe_id']) ?></p>
<p><strong>Turno:</strong> <?= htmlspecialchars($ins['turno']) ?></p>
<p><strong>Ano Lectivo:</strong> <?= htmlspecialchars($ins['ano_lectivo_id']) ?></p>
<p><strong>Contacto:</strong> <?= htmlspecialchars($ins['telefone']) ?></p>
<p><strong>Data da Inscrição:</strong> <?= htmlspecialchars($ins['data_inscricao']) ?></p>
<p><strong>Funcionário:</strong> <?= htmlspecialchars($_SESSION['utilizador']['nome']) ?></p>
</div>
<script>window.print();</script>
</body></html>

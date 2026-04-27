<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);

$inscricaoId = (int) ($_POST['inscricao_id'] ?? 0);
$ins = $pdo->prepare('SELECT * FROM inscricoes WHERE id=? LIMIT 1');
$ins->execute([$inscricaoId]);
$row = $ins->fetch();
if (!$row) {
    header('Location: /secretaria/inscricoes.php');
    exit;
}

$seq = (int) $pdo->query('SELECT COUNT(*) FROM matriculas')->fetchColumn() + 1;
$numMat = sprintf('ALU-%s-%04d', date('Y'), $seq);
$turmaId = $pdo->query('SELECT id FROM turmas ORDER BY id DESC LIMIT 1')->fetchColumn();
$anoAtivo = $pdo->query("SELECT id FROM ano_lectivo WHERE estado='ativo' LIMIT 1")->fetchColumn();

$pdo->beginTransaction();
try {
    $pdo->prepare('INSERT INTO matriculas (numero_matricula,aluno_id,inscricao_id,curso_id,classe_id,turma_id,ano_lectivo_id,estado,data_matricula,criado_por) VALUES (?,?,?,?,?,?,?,?,NOW(),?)')
        ->execute([$numMat, $row['aluno_id'], $row['id'], $row['curso_id'], $row['classe_id'], $turmaId, $anoAtivo, 'Matriculado', $_SESSION['utilizador']['id']]);
    $pdo->prepare('UPDATE alunos SET numero_estudante=?, estado=? WHERE id=?')->execute([$numMat, 'Matriculado', $row['aluno_id']]);
    $pdo->commit();
} catch (Throwable $e) {
    $pdo->rollBack();
}

header('Location: /secretaria/matriculas.php');
exit;

<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);

$preId = (int) ($_POST['pre_inscricao_id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM pre_inscricoes WHERE id = :id LIMIT 1');
$stmt->execute(['id' => $preId]);
$pre = $stmt->fetch();
if (!$pre || $pre['estado'] !== 'Aprovado para inscrição') {
    header('Location: /secretaria/pre_inscricoes.php');
    exit;
}

$anoAtivo = $pdo->query("SELECT id FROM ano_lectivo WHERE estado='ativo' LIMIT 1")->fetchColumn();
$cursoId = $pdo->prepare('SELECT id FROM cursos WHERE nome=:nome LIMIT 1');
$cursoId->execute(['nome' => $pre['curso_pretendido']]);
$curso = $cursoId->fetchColumn() ?: null;
$classeId = $pdo->prepare('SELECT id FROM classes WHERE nome=:nome LIMIT 1');
$classeId->execute(['nome' => $pre['classe_pretendida']]);
$classe = $classeId->fetchColumn() ?: null;

$seq = (int) $pdo->query('SELECT COUNT(*) FROM inscricoes')->fetchColumn() + 1;
$numIns = sprintf('INS-%s-%04d', date('Y'), $seq);

$pdo->beginTransaction();
try {
    $pdo->prepare('INSERT INTO alunos (nome_completo,data_nascimento,sexo,telefone,estado,data_criacao) VALUES (?,?,?,?,?,NOW())')
        ->execute([$pre['nome_candidato'], $pre['data_nascimento'], $pre['sexo'], $pre['telefone'], 'Inscrito']);
    $alunoId = (int) $pdo->lastInsertId();

    $pdo->prepare('INSERT INTO inscricoes (numero_inscricao,pre_inscricao_id,aluno_id,curso_id,classe_id,ano_lectivo_id,turno,estado,data_inscricao,criado_por) VALUES (?,?,?,?,?,?,?,?,NOW(),?)')
        ->execute([$numIns, $preId, $alunoId, $curso, $classe, $anoAtivo, 'Manhã', 'Inscrição confirmada', $_SESSION['utilizador']['id']]);

    $pdo->prepare("UPDATE pre_inscricoes SET estado='Convertido em inscrição' WHERE id=?")->execute([$preId]);
    $pdo->commit();
} catch (Throwable $e) {
    $pdo->rollBack();
}

header('Location: /secretaria/inscricoes.php');
exit;

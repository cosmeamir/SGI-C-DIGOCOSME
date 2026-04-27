<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);

$ano = date('Y');
$seq = (int) $pdo->query('SELECT COUNT(*) FROM pre_inscricoes')->fetchColumn() + 1;
$codigo = sprintf('PRE-%s-%04d', $ano, $seq);

$stmt = $pdo->prepare('INSERT INTO pre_inscricoes (codigo_pre_inscricao,nome_candidato,data_nascimento,sexo,telefone,curso_pretendido,classe_pretendida,escola_anterior,estado,observacoes,criado_por,data_criacao) VALUES (:codigo,:nome,:nascimento,:sexo,:telefone,:curso,:classe,:escola,:estado,:obs,:criado_por,NOW())');
$stmt->execute([
    'codigo' => $codigo,
    'nome' => $_POST['nome_candidato'],
    'nascimento' => $_POST['data_nascimento'],
    'sexo' => $_POST['sexo'],
    'telefone' => $_POST['telefone'] ?: null,
    'curso' => $_POST['curso_pretendido'],
    'classe' => $_POST['classe_pretendida'],
    'escola' => $_POST['escola_anterior'] ?: null,
    'estado' => 'Pendente',
    'obs' => $_POST['observacoes'] ?: null,
    'criado_por' => $_SESSION['utilizador']['id'],
]);

header('Location: /secretaria/pre_inscricoes.php');
exit;

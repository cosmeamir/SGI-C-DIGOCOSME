<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);

$id = (int) ($_POST['id'] ?? 0);
$estado = $_POST['estado'] ?? 'Pendente';
$permitidos = ['Pendente','Documentos incompletos','Aprovado para inscrição','Rejeitado'];
if (!in_array($estado, $permitidos, true)) {
    $estado = 'Pendente';
}
$pdo->prepare('UPDATE pre_inscricoes SET estado = :estado WHERE id = :id')->execute(['estado' => $estado, 'id' => $id]);
header('Location: /secretaria/pre_inscricoes.php');
exit;

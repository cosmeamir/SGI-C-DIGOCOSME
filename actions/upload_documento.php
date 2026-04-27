<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['secretaria','administrador']);

if (!isset($_FILES['ficheiro']) || $_FILES['ficheiro']['error'] !== UPLOAD_ERR_OK) {
    header('Location: /secretaria/documentos.php');
    exit;
}

$nomeOriginal = basename($_FILES['ficheiro']['name']);
$nomeSeguro = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $nomeOriginal);
$destino = __DIR__ . '/../assets/uploads/documentos/' . $nomeSeguro;
move_uploaded_file($_FILES['ficheiro']['tmp_name'], $destino);

$pdo->prepare('INSERT INTO documentos (aluno_id,pre_inscricao_id,tipo_documento,ficheiro,estado,observacao,data_upload,validado_por) VALUES (?,?,?,?,?,?,NOW(),?)')
    ->execute([
        $_POST['aluno_id'] ?: null,
        $_POST['pre_inscricao_id'] ?: null,
        $_POST['tipo_documento'],
        $nomeSeguro,
        'Pendente',
        null,
        $_SESSION['utilizador']['id'],
    ]);

header('Location: /secretaria/documentos.php');
exit;

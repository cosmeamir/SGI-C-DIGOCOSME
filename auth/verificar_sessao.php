<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['utilizador'])) {
    header('Location: /auth/login.php');
    exit;
}

function exigirPerfil(array $perfis): void
{
    $perfil = $_SESSION['utilizador']['perfil'] ?? '';
    if (!in_array($perfil, $perfis, true)) {
        http_response_code(403);
        die('Acesso negado.');
    }
}

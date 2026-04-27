<?php
session_start();
if (!isset($_SESSION['utilizador'])) {
    header('Location: /auth/login.php');
    exit;
}

$perfil = $_SESSION['utilizador']['perfil'] ?? '';
$destino = $perfil === 'administrador' ? '/admin/dashboard.php' : '/secretaria/dashboard.php';
header("Location: {$destino}");
exit;

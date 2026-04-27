<?php
$host = 'localhost';
$dbname = 'u914400496_sistema';
$user = 'u914400496_sistema_gestao';
$pass = 'InstitutoMYJ2@26';

try {
    $pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Erro de conexão com a base de dados: ' . $e->getMessage());
}

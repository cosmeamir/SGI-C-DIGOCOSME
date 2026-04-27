<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $stmt = $pdo->prepare('SELECT id, nome, username, email, senha, perfil, estado FROM usuarios WHERE username = :username LIMIT 1');
    $stmt->execute(['username' => $username]);
    $utilizador = $stmt->fetch();

    if ($utilizador && $utilizador['estado'] === 'ativo' && password_verify($senha, $utilizador['senha'])) {
        $_SESSION['utilizador'] = [
            'id' => $utilizador['id'],
            'nome' => $utilizador['nome'],
            'username' => $utilizador['username'],
            'email' => $utilizador['email'],
            'perfil' => $utilizador['perfil'],
        ];

        $destino = $utilizador['perfil'] === 'administrador' ? '/admin/dashboard.php' : '/secretaria/dashboard.php';
        header("Location: {$destino}");
        exit;
    }

    $erro = 'Credenciais inválidas ou utilizador inativo.';
}
?>
<!doctype html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Sistema de Gestão Escolar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-gradient-school min-vh-100 d-flex align-items-center justify-content-center">
<div class="card shadow-lg border-0 login-card">
  <div class="card-body p-4 p-md-5">
    <div class="text-center mb-4">
      <img src="/assets/img/logo.svg" alt="Logo" width="72">
      <h1 class="h4 mt-3 fw-bold">Sistema de Gestão Escolar</h1>
      <p class="text-muted mb-0">Ensino Médio</p>
    </div>

    <?php if ($erro): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <label class="form-label">Utilizador</label>
        <input type="text" name="username" class="form-control" placeholder="Ex.: Admin ou SEC_IMYJ" required>
      </div>
      <div class="mb-4">
        <label class="form-label">Palavra-passe</label>
        <input type="password" name="senha" class="form-control" required>
      </div>
      <button class="btn btn-school w-100" type="submit">Entrar</button>
    </form>
  </div>
</div>
</body>
</html>

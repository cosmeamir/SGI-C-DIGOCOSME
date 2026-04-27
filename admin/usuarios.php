<?php
require_once __DIR__ . '/../auth/verificar_sessao.php';
require_once __DIR__ . '/../config/database.php';
exigirPerfil(['administrador']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare('INSERT INTO usuarios (username,nome,email,senha,perfil,estado,data_criacao) VALUES (?,?,?,?,?,?,NOW())')->execute([
        $_POST['username'], $_POST['nome'], $_POST['email'] ?: null, password_hash($_POST['senha'], PASSWORD_DEFAULT), $_POST['perfil'], $_POST['estado']
    ]);
    header('Location: /admin/usuarios.php'); exit;
}
$usuarios = $pdo->query('SELECT id,username,nome,email,perfil,estado,data_criacao FROM usuarios ORDER BY id DESC')->fetchAll();
$tituloPagina='Utilizadores'; include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php';
?>
<div class="app-layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content-wrap"><h2>Gestão de Utilizadores</h2>
<form method="post" class="card p-3 mb-3"><div class="row g-2"><div class="col"><input name="username" class="form-control" placeholder="Utilizador (ex: SEC_IMYJ)" required></div><div class="col"><input name="nome" class="form-control" placeholder="Nome" required></div><div class="col"><input name="email" class="form-control" type="email" placeholder="Email (opcional)"></div><div class="col"><input name="senha" class="form-control" type="password" required></div><div class="col"><select name="perfil" class="form-select"><option value="administrador">Administrador</option><option value="secretaria">Secretaria</option></select></div><div class="col"><select name="estado" class="form-select"><option value="ativo">Ativo</option><option value="inativo">Inativo</option></select></div></div><button class="btn btn-school mt-3">Criar utilizador</button></form>
<table class="table table-striped bg-white"><thead><tr><th>Utilizador</th><th>Nome</th><th>Email</th><th>Perfil</th><th>Estado</th></tr></thead><tbody><?php foreach($usuarios as $u): ?><tr><td><?= htmlspecialchars($u['username']) ?></td><td><?= htmlspecialchars($u['nome']) ?></td><td><?= htmlspecialchars((string) $u['email']) ?></td><td><?= $u['perfil'] ?></td><td><?= $u['estado'] ?></td></tr><?php endforeach; ?></tbody></table>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>

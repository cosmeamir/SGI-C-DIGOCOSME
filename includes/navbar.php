<nav class="navbar navbar-expand-lg navbar-dark bg-school shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/index.php">
      <img src="/assets/img/logo.svg" alt="Logo" width="28" height="28">
      SGE Médio
    </a>
    <div class="ms-auto text-white small">
      <?= htmlspecialchars($_SESSION['utilizador']['nome'] ?? '') ?>
      (<?= htmlspecialchars($_SESSION['utilizador']['perfil'] ?? '') ?>)
      <a href="/auth/logout.php" class="btn btn-sm btn-outline-light ms-3">Sair</a>
    </div>
  </div>
</nav>

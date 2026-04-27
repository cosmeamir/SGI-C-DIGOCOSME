<nav class="navbar navbar-expand-lg navbar-dark topbar shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/index.php">
      <img src="/assets/img/logo.svg" alt="Logo" width="28" height="28">
      <span>SGE Médio</span>
    </a>
    <div class="ms-auto d-flex align-items-center gap-3 text-white small">
      <span class="d-none d-md-inline"><i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['utilizador']['nome'] ?? '') ?></span>
      <span class="badge text-bg-light text-uppercase"><?= htmlspecialchars($_SESSION['utilizador']['perfil'] ?? '') ?></span>
      <a href="/auth/logout.php" class="btn btn-sm btn-outline-light"><i class="bi bi-box-arrow-right me-1"></i>Sair</a>
    </div>
  </div>
</nav>

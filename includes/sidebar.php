<?php
$perfil = $_SESSION['utilizador']['perfil'] ?? '';
$pathAtual = $_SERVER['REQUEST_URI'] ?? '';
function navClass(string $url, string $pathAtual): string {
    return str_contains($pathAtual, $url) ? 'nav-link active' : 'nav-link';
}
?>
<aside class="sidebar p-3">
  <div class="brand-mini mb-4">
    <div class="small text-uppercase text-secondary">Navegação</div>
  </div>
  <ul class="nav nav-pills flex-column gap-2">
    <li class="nav-item"><a class="<?= navClass('/dashboard.php', $pathAtual) ?>" href="/<?= $perfil === 'administrador' ? 'admin' : 'secretaria' ?>/dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
    <?php if ($perfil === 'administrador'): ?>
      <li class="nav-item"><a class="<?= navClass('/admin/usuarios.php', $pathAtual) ?>" href="/admin/usuarios.php"><i class="bi bi-people me-2"></i>Utilizadores</a></li>
      <li class="nav-item"><a class="<?= navClass('/admin/cursos.php', $pathAtual) ?>" href="/admin/cursos.php"><i class="bi bi-journal-bookmark me-2"></i>Cursos</a></li>
      <li class="nav-item"><a class="<?= navClass('/admin/classes.php', $pathAtual) ?>" href="/admin/classes.php"><i class="bi bi-mortarboard me-2"></i>Classes</a></li>
      <li class="nav-item"><a class="<?= navClass('/admin/turmas.php', $pathAtual) ?>" href="/admin/turmas.php"><i class="bi bi-diagram-3 me-2"></i>Turmas</a></li>
      <li class="nav-item"><a class="<?= navClass('/admin/ano_lectivo.php', $pathAtual) ?>" href="/admin/ano_lectivo.php"><i class="bi bi-calendar3 me-2"></i>Ano Lectivo</a></li>
      <li class="nav-item"><a class="<?= navClass('/admin/configuracoes.php', $pathAtual) ?>" href="/admin/configuracoes.php"><i class="bi bi-gear me-2"></i>Configurações</a></li>
    <?php else: ?>
      <li class="nav-item"><a class="<?= navClass('/secretaria/nova_pre_inscricao.php', $pathAtual) ?>" href="/secretaria/nova_pre_inscricao.php"><i class="bi bi-file-earmark-plus me-2"></i>Nova Pré-inscrição</a></li>
      <li class="nav-item"><a class="<?= navClass('/secretaria/pre_inscricoes.php', $pathAtual) ?>" href="/secretaria/pre_inscricoes.php"><i class="bi bi-card-checklist me-2"></i>Pré-inscrições</a></li>
      <li class="nav-item"><a class="<?= navClass('/secretaria/inscricoes.php', $pathAtual) ?>" href="/secretaria/inscricoes.php"><i class="bi bi-pencil-square me-2"></i>Inscrições</a></li>
      <li class="nav-item"><a class="<?= navClass('/secretaria/matriculas.php', $pathAtual) ?>" href="/secretaria/matriculas.php"><i class="bi bi-patch-check me-2"></i>Matrículas</a></li>
      <li class="nav-item"><a class="<?= navClass('/secretaria/estudantes.php', $pathAtual) ?>" href="/secretaria/estudantes.php"><i class="bi bi-person-vcard me-2"></i>Estudantes</a></li>
      <li class="nav-item"><a class="<?= navClass('/secretaria/documentos.php', $pathAtual) ?>" href="/secretaria/documentos.php"><i class="bi bi-folder2-open me-2"></i>Documentos</a></li>
    <?php endif; ?>
  </ul>
</aside>

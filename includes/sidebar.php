<?php $perfil = $_SESSION['utilizador']['perfil'] ?? ''; ?>
<aside class="sidebar p-3">
  <ul class="nav nav-pills flex-column gap-2">
    <li class="nav-item"><a class="nav-link" href="/<?= $perfil === 'administrador' ? 'admin' : 'secretaria' ?>/dashboard.php">Dashboard</a></li>
    <?php if ($perfil === 'administrador'): ?>
      <li class="nav-item"><a class="nav-link" href="/admin/usuarios.php">Utilizadores</a></li>
      <li class="nav-item"><a class="nav-link" href="/admin/cursos.php">Cursos</a></li>
      <li class="nav-item"><a class="nav-link" href="/admin/classes.php">Classes</a></li>
      <li class="nav-item"><a class="nav-link" href="/admin/turmas.php">Turmas</a></li>
      <li class="nav-item"><a class="nav-link" href="/admin/ano_lectivo.php">Ano Lectivo</a></li>
      <li class="nav-item"><a class="nav-link" href="/admin/configuracoes.php">Configurações</a></li>
    <?php else: ?>
      <li class="nav-item"><a class="nav-link" href="/secretaria/nova_pre_inscricao.php">Nova Pré-inscrição</a></li>
      <li class="nav-item"><a class="nav-link" href="/secretaria/pre_inscricoes.php">Pré-inscrições</a></li>
      <li class="nav-item"><a class="nav-link" href="/secretaria/inscricoes.php">Inscrições</a></li>
      <li class="nav-item"><a class="nav-link" href="/secretaria/matriculas.php">Matrículas</a></li>
      <li class="nav-item"><a class="nav-link" href="/secretaria/estudantes.php">Estudantes</a></li>
      <li class="nav-item"><a class="nav-link" href="/secretaria/documentos.php">Documentos</a></li>
    <?php endif; ?>
  </ul>
</aside>

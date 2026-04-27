# Sistema de Gestão Escolar (Ensino Médio)

MVP completo em **PHP + MySQL + Bootstrap** para gerir o ciclo de:

1. Pré-inscrição
2. Validação
3. Inscrição
4. Matrícula
5. Comprovativos de inscrição e matrícula

## Stack
- Frontend: HTML, CSS, JS, Bootstrap 5
- Backend: PHP 8+
- BD: MySQL 8+

## Instalação rápida
1. Criar base de dados e tabelas:
   ```bash
   mysql -u root -p < database/schema.sql
   ```
2. Ajustar credenciais em `config/database.php`.
3. Servir a aplicação no Apache/Nginx/PHP embutido:
   ```bash
   php -S localhost:8000
   ```
4. Aceder `http://localhost:8000/auth/login.php`.

## Utilizadores padrão
- **Administrador**: `Admin` / `codigocosme2026`
- **Secretaria**: `SEC_IMYJ` / `Secret@ria2026`

## Paleta visual aplicada (com base no logo)
- Ciano: `#1ED8E9`
- Azul: `#4E6FF2`
- Gradiente principal: ciano → azul

## Módulos entregues no MVP
- Login com perfis (Administrador/Secretaria)
- Dashboard (Admin e Secretaria)
- Gestão de Utilizadores
- Gestão de Cursos, Classes, Turmas, Ano Lectivo
- Pré-inscrição (criar/listar/validar)
- Conversão para inscrição
- Conversão para matrícula
- Upload de documentos
- Emissão de comprovativos (modo de impressão)

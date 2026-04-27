-- DB pronta para importar no Hostinger/cPanel sem DROP DATABASE
-- Importar dentro da base já criada: u914400496_sistema

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(60) NOT NULL UNIQUE,
  nome VARCHAR(150) NOT NULL,
  email VARCHAR(120) NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  perfil ENUM('administrador','secretaria') NOT NULL,
  estado ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo',
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS alunos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  numero_estudante VARCHAR(30) NULL,
  nome_completo VARCHAR(180) NOT NULL,
  data_nascimento DATE NULL,
  sexo VARCHAR(20) NULL,
  nacionalidade VARCHAR(70) NULL,
  naturalidade VARCHAR(70) NULL,
  bi_numero VARCHAR(50) NULL,
  bi_data_emissao DATE NULL,
  bi_local_emissao VARCHAR(80) NULL,
  telefone VARCHAR(25) NULL,
  morada VARCHAR(180) NULL,
  estado VARCHAR(40) DEFAULT 'Ativo',
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS encarregados (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id INT NOT NULL,
  nome_completo VARCHAR(180) NOT NULL,
  grau_parentesco VARCHAR(50) NULL,
  telefone VARCHAR(25) NULL,
  email VARCHAR(120) NULL,
  bi_numero VARCHAR(50) NULL,
  morada VARCHAR(180) NULL,
  profissao VARCHAR(100) NULL,
  local_trabalho VARCHAR(120) NULL,
  FOREIGN KEY (aluno_id) REFERENCES alunos(id)
);

CREATE TABLE IF NOT EXISTS cursos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  descricao VARCHAR(255) NULL,
  duracao INT NULL,
  estado ENUM('ativo','inativo') DEFAULT 'ativo'
);

CREATE TABLE IF NOT EXISTS classes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  nivel INT NOT NULL,
  estado ENUM('ativo','inativo') DEFAULT 'ativo'
);

CREATE TABLE IF NOT EXISTS ano_lectivo (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(20) NOT NULL,
  data_inicio DATE NOT NULL,
  data_fim DATE NOT NULL,
  estado ENUM('ativo','inativo') DEFAULT 'inativo'
);

CREATE TABLE IF NOT EXISTS pre_inscricoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  codigo_pre_inscricao VARCHAR(30) NOT NULL,
  nome_candidato VARCHAR(180) NOT NULL,
  data_nascimento DATE NULL,
  sexo VARCHAR(20) NULL,
  telefone VARCHAR(25) NULL,
  curso_pretendido VARCHAR(120) NULL,
  classe_pretendida VARCHAR(100) NULL,
  escola_anterior VARCHAR(180) NULL,
  estado VARCHAR(60) NOT NULL,
  observacoes TEXT NULL,
  criado_por INT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (criado_por) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS turmas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(80) NOT NULL,
  curso_id INT NULL,
  classe_id INT NULL,
  turno VARCHAR(40) NULL,
  sala VARCHAR(20) NULL,
  limite_alunos INT NULL,
  ano_lectivo_id INT NULL,
  estado VARCHAR(40) DEFAULT 'ativo',
  FOREIGN KEY (curso_id) REFERENCES cursos(id),
  FOREIGN KEY (classe_id) REFERENCES classes(id),
  FOREIGN KEY (ano_lectivo_id) REFERENCES ano_lectivo(id)
);

CREATE TABLE IF NOT EXISTS inscricoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  numero_inscricao VARCHAR(30) NOT NULL,
  pre_inscricao_id INT NOT NULL,
  aluno_id INT NOT NULL,
  curso_id INT NULL,
  classe_id INT NULL,
  ano_lectivo_id INT NULL,
  turno VARCHAR(40) NULL,
  estado VARCHAR(60) NOT NULL,
  data_inscricao DATETIME NOT NULL,
  criado_por INT NULL,
  FOREIGN KEY (pre_inscricao_id) REFERENCES pre_inscricoes(id),
  FOREIGN KEY (aluno_id) REFERENCES alunos(id),
  FOREIGN KEY (curso_id) REFERENCES cursos(id),
  FOREIGN KEY (classe_id) REFERENCES classes(id),
  FOREIGN KEY (ano_lectivo_id) REFERENCES ano_lectivo(id),
  FOREIGN KEY (criado_por) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS matriculas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  numero_matricula VARCHAR(30) NOT NULL,
  aluno_id INT NOT NULL,
  inscricao_id INT NOT NULL,
  curso_id INT NULL,
  classe_id INT NULL,
  turma_id INT NULL,
  ano_lectivo_id INT NULL,
  estado VARCHAR(40) NOT NULL,
  data_matricula DATETIME NOT NULL,
  criado_por INT NULL,
  FOREIGN KEY (aluno_id) REFERENCES alunos(id),
  FOREIGN KEY (inscricao_id) REFERENCES inscricoes(id),
  FOREIGN KEY (curso_id) REFERENCES cursos(id),
  FOREIGN KEY (classe_id) REFERENCES classes(id),
  FOREIGN KEY (turma_id) REFERENCES turmas(id),
  FOREIGN KEY (ano_lectivo_id) REFERENCES ano_lectivo(id),
  FOREIGN KEY (criado_por) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS documentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id INT NULL,
  pre_inscricao_id INT NULL,
  tipo_documento VARCHAR(60) NOT NULL,
  ficheiro VARCHAR(255) NOT NULL,
  estado VARCHAR(50) DEFAULT 'Pendente',
  observacao VARCHAR(255) NULL,
  data_upload DATETIME NOT NULL,
  validado_por INT NULL,
  FOREIGN KEY (aluno_id) REFERENCES alunos(id),
  FOREIGN KEY (pre_inscricao_id) REFERENCES pre_inscricoes(id),
  FOREIGN KEY (validado_por) REFERENCES usuarios(id)
);

INSERT INTO usuarios (username, nome, email, senha, perfil, estado) VALUES
('Admin', 'Administrador do Sistema', 'admin@escola.ao', '$2y$12$KxWi2pMujS5SxiH9kdl3yeV3CQK1FPpG5V0Wv84WrwtFU.NIUOqzy', 'administrador', 'ativo'),
('SEC_IMYJ', 'Secretaria IMYJ', 'secretaria@escola.ao', '$2y$12$72.KDxfaqlDVj53Do8Ugw.FV6GbHdZe9q95VZyLY39/.tlaurSLA6', 'secretaria', 'ativo');
-- credenciais padrão:
-- Administrador -> user: Admin | senha: codigocosme2026
-- Secretaria    -> user: SEC_IMYJ | senha: Secret@ria2026

INSERT INTO cursos (nome, descricao, duracao, estado) VALUES
('Curso de Informática', 'Tecnologias de informação e programação', 3, 'ativo'),
('Curso de Gestão Empresarial', 'Administração e gestão de negócios', 3, 'ativo'),
('Curso de Contabilidade e Gestão', 'Contabilidade financeira e gestão', 3, 'ativo'),
('Curso de Electricidade', 'Instalações eléctricas e manutenção', 3, 'ativo'),
('Curso de Construção Civil', 'Projecto, materiais e obra', 3, 'ativo'),
('Curso de Ciências Económicas e Jurídicas', 'Economia, direito e cidadania', 3, 'ativo'),
('Curso de Ciências Físicas e Biológicas', 'Base científica para áreas técnicas', 3, 'ativo');

INSERT INTO classes (nome, nivel, estado) VALUES
('10ª Classe', 10, 'ativo'),
('11ª Classe', 11, 'ativo'),
('12ª Classe', 12, 'ativo'),
('13ª Classe', 13, 'ativo');

INSERT INTO ano_lectivo (nome, data_inicio, data_fim, estado) VALUES
('2026/2027', '2026-02-01', '2026-12-15', 'ativo');

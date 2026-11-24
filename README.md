# ⚽ Manto Sagrado — Loja de Camisas de Futebol

Sistema web completo para gerenciamento e vitrine de uma loja de camisas de futebol, desenvolvido em **PHP puro** com banco de dados **SQLite**, seguindo a arquitetura **MVC** (Modelo, Controle e Visão).

---

## 🚀 Funcionalidades

* **Vitrine Pública (`produtos.php`):** Exibição em cards das camisas cadastradas no estoque, com foto, modelo e preço formatado.
* **Autenticação e Controle de Acesso (`funcionario.php`):**
  * Sistema de login com sessões seguras (`session_regenerate_id`) e senhas criptografadas (`password_hash` / `password_verify`)[cite: 3].
  * Primeiro acesso liberado automaticamente para criação do administrador quando o banco está vazio[cite: 1, 3].
  * Apenas funcionários autenticados podem cadastrar novos colaboradores ou gerenciar o estoque[cite: 2, 3].
* **Gerenciamento de Estoque — CRUD (`cadastro.php`):**
  * **Cadastro e Edição:** Adição de novas camisas e atualização de nome, preço ou imagem de itens existentes[cite: 1, 2].
  * **Exclusão Segura:** Remoção do registro no banco de dados junto com a exclusão automática do arquivo de imagem correspondente no servidor[cite: 1, 2].
* **Upload e Validação de Imagens:**
  * Aceita apenas arquivos reais nos formatos **JPG**, **PNG** ou **WEBP** (verificação via `getimagesize`)[cite: 2].
  * Limite máximo de **2 MB** por arquivo[cite: 2].
  * Renomeação automática com hash aleatório (`random_bytes`) para evitar conflitos e falhas de segurança[cite: 2].
* **Banco de Dados Autônomo (`banco.php`):** Criação automática do arquivo `mini-loja.sqlite`, das tabelas (`produtos` e `funcionarios`) e inserção inicial de 3 camisas de exemplo na primeira execução.

---

## 🛠️ Tecnologias Utilizadas

* **Back-end:** PHP 8+ (PDO)
* **Banco de Dados:** SQLite 3
* **Front-end:** HTML5 e CSS3 puro (estilização separada em `estilo.css`)

---

## 📁 Estrutura de Arquivos

```text
mini_loja/
├── banco.php             # Modelo: conexão SQLite, criação de tabelas e queries SQL
├── cadastro.php          # Controle: regras do CRUD e validação/upload de imagens
├── estilo.css            # Estilização global das páginas, formulários e cards
├── funcionario.php       # Controle: autenticação, sessões e cadastro de funcionários
├── index.html            # Página inicial de navegação
├── produtos.php          # Controle: carregamento da vitrine pública
├── tela.php              # Visão: painel administrativo de gerenciamento de camisas
├── tela-funcionario.php  # Visão: tela de login e registro de funcionários
├── tela-produtos.php     # Visão: vitrine pública de camisas
└── uploads/              # Diretório criado automaticamente para armazenar as fotos

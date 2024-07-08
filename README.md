# Fundamentos de Programação Web

Este projeto foi desenvolvido para a matéria de Fundamentos de Programação Web, com o objetivo de demonstrar conhecimentos em HTML, CSS, JavaScript e PHP, criando um site funcional com tratamento completo para front-end e back-end.

## Estrutura do Projeto

### Arquivos HTML

- **índice.html**: Página inicial do site com introdução e navegação principal.
- **entrarconta.html**: Página de login para usuários.
- **sobre.html**: Página de conteúdo informativo sobre o site.
- **criarconta.html**: Página para criação de conta de usuários.

### Arquivos PHP

- **login.php**: Script PHP para processamento do login dos usuários.
- **sistema.php**: Página principal do sistema acessível após login, com funcionalidades restritas a usuários autenticados.
- **edit_coleta.php**: Página para edição de dados de coleta.
- **salvarEditar.php**: Script PHP para salvar edições feitas nos dados de coleta.
- **novousuario.php**: Script PHP para adicionar novos usuários.
- **excluir.php**: Script PHP para exclusão de dados.
- **configuração.php**: Arquivo para configurações do projeto.

### Arquivos JavaScript

- **script.js**: Contém scripts JavaScript para validação de formulários e interações dinâmicas com o usuário.

### Arquivos CSS

- **estilo.css**: Arquivo de estilos CSS para padronizar a aparência do site.

## Banco de Dados

O projeto utiliza um banco de dados MySQL para armazenar dados dos usuários e informações necessárias para o funcionamento do sistema. A estrutura do banco de dados inclui tabelas relacionadas para armazenar informações de coleta e usuários.

## Funcionalidades

- **Navegação Padrão**: Menu de navegação presente em todas as páginas do site.
- **Formulário de Login**: Validação e autenticação de usuários.
- **Sistema de Coleta**: Edição e salvamento de dados de coleta.
- **Página Informativa**: Detalhes sobre o site e seu autor.
- **Interatividade**: Uso de JavaScript para validação de formulários e outras interações dinâmicas.

## Como Rodar o Projeto

1. Clone o repositório para sua máquina local:

git clone https://github.com/seuusuario/seurepositorio.git


2. Configure um servidor web local (ex: XAMPP, WAMP) e coloque os arquivos do projeto na pasta apropriada.

3. Importe o banco de dados MySQL utilizando os arquivos de script SQL fornecidos.

4. Acesse o site localmente através do endereço `http://localhost/nome-do-projeto`.

## Tecnologias Utilizadas

- **Front-End**: HTML, CSS, JavaScript
- **Back-End**: PHP
- **Banco de Dados**: MySQL

## Autor

Nome: Igor Fiori

## Apresentação do Projeto

### Roteiro para Defesa em Vídeo

1. **Introdução**
- Apresente-se (diga seu nome e apareça no vídeo).

2. **Navegação pelo Site**
- Mostre a página inicial (`índice.html`) rodando localmente (localhost).
- Navegue pelo menu padrão que está presente em todas as páginas.

3. **Página de Login (`entrarconta.html`)** 
- Mostre a página de login e explique como ela valida os dados recebidos.

4. **Página de Sistema (`sistema.php`)** 
- Demonstre a página principal do sistema que é acessada após o login.
- Mostre a funcionalidade de edição de dados de coleta e como o script `salvarEditar.php` salva as alterações.

5. **Sobre o Projeto (`sobre.html`)** 
- Apresente a página informativa sobre o projeto, evidenciando o uso de HTML, CSS e JavaScript.

6. **Banco de Dados**
- Mostre a estrutura do banco de dados no MySQL, incluindo tabelas e seus relacionamentos.
- Demonstre como os dados de login são armazenados de forma segura (senha criptografada).

7. **Funcionalidades CRUD**
- Mostre as funcionalidades de CRUD (Create, Read, Update, Delete) para os dados de coleta.
- Demonstre como as operações são realizadas através da interface da aplicação.

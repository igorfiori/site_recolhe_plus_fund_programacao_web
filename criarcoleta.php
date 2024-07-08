<?php
// Inicia a sessão apenas se não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Processamento do formulário de criação de coleta
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Inclui o arquivo de configuração do banco de dados
    include_once('config.php');

    // Verificar se o campo cliente_id foi enviado pelo formulário
    if (isset($_POST['cliente_id'])) {
        // Recebendo os dados do formulário
        $cliente_id = $_POST['cliente_id'];
        $data_hora_agendada = $_POST['data_hora_agendada'];
        $status = $_POST['status'];
        $tipo_residuo = $_POST['tipo_residuo'];
        $peso_real = isset($_POST['peso_real']) ? $_POST['peso_real'] : NULL;

        // Validar e limpar os dados recebidos, se necessário
        // Exemplo de limpeza básica usando mysqli_real_escape_string
        $cliente_id = mysqli_real_escape_string($conexao, $cliente_id);
        $data_hora_agendada = date('Y-m-d H:i:s', strtotime($data_hora_agendada));

        // Preparar a consulta SQL com parâmetros seguros
        $sql = "INSERT INTO coletas (cliente_id, data_hora_agendada, status, tipo_residuo, peso_real) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);

        // Verificar se a preparação da consulta foi bem-sucedida
        if ($stmt) {
            // Ligando os parâmetros aos placeholders e definindo os tipos
            // 'issss' indica respectivamente: inteiro, string, string, string, string
            $stmt->bind_param('issss', $cliente_id, $data_hora_agendada, $status, $tipo_residuo, $peso_real);

            // Executando a consulta
            if ($stmt->execute()) {
                echo "<script>
                    alert('Sua coleta foi criada com sucesso! 😊');
                    window.location.href = 'entrarconta.html';
                  </script>";
                exit; // Termina o script após redirecionamento
            } else {
                echo "Erro ao cadastrar coleta: " . $stmt->error;
            }

            // Fechando o statement após o uso
            $stmt->close();
        } else {
            // Lidando com erros na preparação da consulta
            echo "Erro na preparação da consulta: " . $conexao->error;
        }

        // Fechando a conexão com o banco de dados após o uso
        $conexao->close();
    } else {
        echo "Erro: Chave do array 'cliente_id' indefinida.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Agendamento de Coleta</title>
</head>
<body>
    <section>
        <!--HEADER-->
        <header>
            <a href="index.html"><img src="img/recolhe+.png" alt="logotype" class="logotype"></a>
            <nav class="navegation">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#section2">Serviços</a></li>
                    <li><a href="criarcoleta.php">Coleta</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="#" id="loginBtn">Login</a></li>
                </ul>
            </nav>
            <!-- Modal de Login -->
            <div id="loginDropdown" class="dropdown-content">
                <br>
                <h2>Que bom ver você aqui!</h2>
                <br>
                <button class="modal-button" id="entrarConta">Entrar na Conta</button>
                <button class="modal-button" id="criarConta">Criar Conta</button>
            </div>
        </header>
        <!--HEADER END-->

        <div class="criarconta">
            <h1 class="titulo_login">Agendamento de coleta</h1>
            <br><br>
            <form action="criarcoleta.php" method="post" autocomplete="off">
                <input class="input_criarconta" type="text" id="cliente_id" name="cliente_id" placeholder="Qual é o seu ID cliente?" required>
                <br><br>
                <input class="input_criarconta" id="data_hora_agendada" type="datetime-local" name="data_hora_agendada" placeholder="Data e hora agendada" required>
                <br><br>
                <select class="input_criarconta" id="status" name="status" required>
                    <option value="agendada">Agendada</option>
                </select>
                <br><br>
                <select class="input_criarconta" id="tipo_residuo" name="tipo_residuo" required>
                    <option value="industriais">Industriais</option>
                    <option value="químicos">Químicos</option>
                    <option value="sólidos">Sólidos</option>
                    <option value="líquidos">Líquidos</option>
                    <option value="perigosos">Perigosos</option>
                    <option value="eletroeletrônicos">Eletroeletrônicos</option>
                    <option value="inservíveis">Inservíveis</option>
                    <option value="lâmpadas">Lâmpadas</option>
                </select>
                <br><br>
                <input class="input_criarconta" id="peso_real" type="number" step="0.01" name="peso_real" placeholder="Peso Real (em kg)">
                <br><br>
                <button class="button_criarconta submit" type="submit" name="submit"><b>Finalizar Coleta</b></button>
            </form>
        </div>
    </section>
    <script>
        // Script para abrir e fechar o dropdown de login
        var loginBtn = document.getElementById("loginBtn");
        var loginDropdown = document.getElementById("loginDropdown");

        loginBtn.onclick = function (e) {
            e.preventDefault();
            loginDropdown.classList.toggle("show");
        }

        window.onclick = function (event) {
            if (!event.target.matches('#loginBtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        // Redirecionar para entrarconta.html ao clicar no botão "Entrar na Conta"
        document.getElementById("entrarConta").addEventListener("click", function () {
            window.location.href = "entrarconta.html";
        });
    </script>
    <!--FOOTER-->
    <footer>
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-col">
                    <h4>Sobre Nós</h4>
                    <p>A RECOLHE+ é uma empresa líder em gestão global de resíduos, comprometida com a sustentabilidade
                        e a responsabilidade ambiental.</p>
                </div>
                <div class="footer-col">
                    <h4>Navegação</h4>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#section2">Serviços</a></li>
                        <li><a href="criarcoleta.php">Coleta</a></li>
                        <li><a href="about.html">About</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contato</h4>
                    <ul>
                        <li><a href="mailto:contato@recolhemais.com">hello@recolhemais.com</a></li>
                        <li><a href="tel:+5511999999999">(41) 99579-8587 </a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Siga-nos</h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><img src="img/facebook.png" alt="Facebook" height="30" width="30"></a>
                        <a href="https://x.com/?lang=pt-br"><img src="img/twitter.png" alt="Twitter" height="30" width="30"></a>
                        <a href="https://www.instagram.com/"><img src="img/instagram.png" alt="Instagram" height="30" width="30"></a>
                        <a href="https://www.linkedin.com/"><img src="img/linkedin.png" alt="LinkedIn" height="30" width="30"></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 RECOLHE+. <i>Trabalho Somativo 01 - Aluno: Igor David Loyola Fiori - Todos os direitos
                        reservados à matéria Fundamentos de Programação Web - PUC PR </i></p>
            </div>
        </div>
    </footer>
    <!--END FOOTER-->
</body>
</html>

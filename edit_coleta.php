<?php
session_start();
include_once('config.php');

// Verifica se o usuário está logado
if ((!isset($_SESSION['email']) || empty($_SESSION['email'])) && (!isset($_SESSION['senha']) || empty($_SESSION['senha']))) {
    header('Location: login.php');
    exit;
}

// Verifica se foi passado o parâmetro 'id' via GET
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Recupera os dados da coleta pelo ID
    $sqlSelect = "SELECT * FROM coletas WHERE id = $id";
    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        $coleta_data = $result->fetch_assoc();
    } else {
        // Se não encontrar a coleta, redireciona para a página principal
        header('Location: sistema.php');
        exit;
    }
} else {
    // Se o parâmetro 'id' não foi passado, redireciona para a página principal
    header('Location: sistema.php');
    exit;
}

// Processamento do formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aqui você deve validar e salvar os dados atualizados da coleta
    $cliente_id = $_POST['cliente_id'];
    $data_hora_agendada = $_POST['data_hora_agendada'];
    $status = $_POST['status'];
    $tipo_residuo = $_POST['tipo_residuo'];
    $peso_real = $_POST['peso_real'];

    // Atualiza os dados da coleta no banco de dados
    $sqlUpdate = "UPDATE coletas SET cliente_id = '$cliente_id', data_hora_agendada = '$data_hora_agendada', status = '$status', tipo_residuo = '$tipo_residuo', peso_real = '$peso_real' WHERE id = $id";

    if ($conexao->query($sqlUpdate) === TRUE) {
        // Redireciona para a página de sistema após a atualização
        header('Location: sistema.php');
        exit;
    } else {
        echo 'Erro ao atualizar a coleta: ' . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Coleta</title>
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
            <h1 class="titulo_login">Vamos atualizar a sua coleta</h1>
            <br><br>
            <form action="edit_coleta.php?id=<?php echo $id; ?>" method="post" autocomplete="off">
            <input class="input_criarconta" type="text" id="cliente_id" name="cliente_id" placeholder="ID do Cliente" value="<?php echo htmlspecialchars($coleta_data['cliente_id']); ?>" readonly required>
                <br><br>
                <input class="input_criarconta" id="data_hora_agendada" type="datetime-local" name="data_hora_agendada" value="<?php echo date('Y-m-d\TH:i', strtotime($coleta_data['data_hora_agendada'])); ?>" required>
                <br><br>
                <select class="input_criarconta" id="status" name="status" required>
                    <option value="agendada" <?php echo ($coleta_data['status'] == 'Agendada') ? 'selected' : ''; ?>>Agendada</option>
                </select>
                <br><br>
                <select class="input_criarconta" id="tipo_residuo" name="tipo_residuo" required>
                    <option value="industriais" <?php echo ($coleta_data['tipo_residuo'] == 'Industriais') ? 'selected' : ''; ?>>Industriais</option>
                    <option value="químicos" <?php echo ($coleta_data['tipo_residuo'] == 'Químicos') ? 'selected' : ''; ?>>Químicos</option>
                    <option value="sólidos" <?php echo ($coleta_data['tipo_residuo'] == 'Sólidos') ? 'selected' : ''; ?>>Sólidos</option>
                    <option value="líquidos" <?php echo ($coleta_data['tipo_residuo'] == 'Líquidos') ? 'selected' : ''; ?>>Líquidos</option>
                    <option value="perigosos" <?php echo ($coleta_data['tipo_residuo'] == 'Perigosos') ? 'selected' : ''; ?>>Perigosos</option>
                    <option value="eletroeletrônicos" <?php echo ($coleta_data['tipo_residuo'] == 'Eletroeletrônicos') ? 'selected' : ''; ?>>Eletroeletrônicos</option>
                    <option value="inservíveis" <?php echo ($coleta_data['tipo_residuo'] == 'Inservíveis') ? 'selected' : ''; ?>>Inservíveis</option>
                    <option value="lâmpadas" <?php echo ($coleta_data['tipo_residuo'] == 'Lâmpadas') ? 'selected' : ''; ?>>Lâmpadas</option>
                </select>
                <br><br>
                <input class="input_criarconta" id="peso_real" type="number" step="0.01" name="peso_real" placeholder="Peso Real (em kg)" value="<?php echo $coleta_data['peso_real']; ?>">
                <br><br>
                <button class="button_criarconta submit" type="submit" name="submit"><b>Atualizar Coleta</b></button>
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

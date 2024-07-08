<?php
session_start();
include_once('config.php');

// Verifica se o usuário está logado
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
    exit;
}
$logado = $_SESSION['email'];

// Recuperar as informações do usuário logado
$sql_usuario = "SELECT * FROM usuarios WHERE email = '$logado'";
$result_usuario = $conexao->query($sql_usuario);

if ($result_usuario->num_rows > 0) {
    $user_data = $result_usuario->fetch_assoc();
} else {
    // Se o usuário não for encontrado, redirecione para a página de login
    header('Location: login.php');
    exit;
}

// Recuperar informações da última coleta do usuário
$sql_coleta = "SELECT * FROM coletas WHERE cliente_id = " . $user_data['id'] . " ORDER BY id DESC LIMIT 1";
$result_coleta = $conexao->query($sql_coleta);

if ($result_coleta->num_rows > 0) {
    $coleta_data = $result_coleta->fetch_assoc();
} else {
    $coleta_data = null;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Sistema</title>
</head>

<body class="sistema4">
    <section class="sitema4">
        <!--HEADER-->
        <header>
            <a href="index.html"><img src="img/recolhe+.png" alt="logotype" class="logotype img-fluid mb-3"></a>
            <nav>
                <ul class="list-inline">
                    <li class="list-inline-item"><input class="buttonsair btn btn-danger" type="button" value="SAIR DO SISTEMA" onclick="sairDoSistema()"></li>
                </ul>
            </nav>
        </header>

        <script>
            function sairDoSistema() {
                window.location.href = 'index.html';
            }
        </script>

<div class="container2">

<?php echo "<h1 class='bemvindo'><b>Olá, seja bem-vindo <u>" . $user_data['nome'] . "</u> ♻️🌍</b></h1>"; ?>


<br>

        <!-- Tabela de Editar Dados -->
        <div class="m-1">
            <table class="table table-bg">
                <h1 class="editarperil" id="editarperil" style="color: white; font-size: 24px; text-align: center; background-color: #69ad2b; padding: 10px; border-radius: 5px 5px 0 0;"><b>EDITAR DADOS DO PERFIL</b></h1>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nascimento</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Nº</th>
                        <th scope="col">Cep</th>
                        <th scope="col">Senha</th>
                        <th scope="col">...</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    echo "<tr>";
                    echo "<td>" . $user_data['id'] . "</td>";
                    echo "<td>" . $user_data['nome'] . "</td>";
                    echo "<td>" . $user_data['email'] . "</td>";
                    echo "<td>" . $user_data['data_nascimento'] . "</td>";
                    echo "<td>" . $user_data['celular'] . "</td>";
                    echo "<td>" . $user_data['endereco'] . "</td>";
                    echo "<td>" . $user_data['numero'] . "</td>";
                    echo "<td>" . $user_data['cep'] . "</td>";
                    echo "<td>" . $user_data['senha'] . "</td>";
                    echo "<td>
                        <a class='btn btn-sm btn-primary' href='edit.php?id=" . $user_data['id'] . "'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                            </svg>
                        </a>
                        <a class='btn btn-sm btn-danger' href='delete.php?id=" . $user_data['id'] . "'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
                                <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
                            </svg>
                        </a>
                    </td>";
                    echo "</tr>";
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tabela de Informações da Coleta -->
        <div class="mt-4"> <!-- Adicionei margem top para separação visual -->
            <table class="table table-bg" >
                <h1 class="editarperil" id="editarperil" style="color: WHITE; font-size: 24px; text-align: center; background-color: #69ad2b; padding: 10px; border-radius: 5px 5px 0 0; "><b>SUAS COLETAS AGENDADAS</b></h1>
                <thead>
                    <tr>
                        <th scope="col">Cliente ID</th>
                        <th scope="col">Nº COLETA</th>
                        <th scope="col">Agendamento</th>
                        <th scope="col">Status</th>
                        <th scope="col">Resíduo</th>
                        <th scope="col">Kg</th>
                        <th scope="col">...</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($coleta_data) {
                        echo "<tr>";
                        echo "<td>" . $coleta_data['cliente_id'] . "</td>";
                        echo "<td>" . $coleta_data['id'] . "</td>";
                        echo "<td>" . $coleta_data['data_hora_agendada'] . "</td>";
                        echo "<td>" . $coleta_data['status'] . "</td>";
                        echo "<td>" . $coleta_data['tipo_residuo'] . "</td>";
                        echo "<td>" . ($coleta_data['peso_real'] ? $coleta_data['peso_real'] : '-') . "</td>";
                        echo "<td>
                            <a class='btn btn-sm btn-primary' href='edit_coleta.php?id=" . $coleta_data['id'] . "'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                                </svg>
                            </a>
                            <a class='btn btn-sm btn-danger' href='delete_coleta.php?id=" . $coleta_data['id'] . "'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
                                    <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
                                </svg>
                            </a>
                        </td>";
                        echo "</tr>";
                    } else {
                        echo "<tr><td colspan='6'>Nenhuma coleta encontrada.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <!--SCRIPTS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-+3WziY2Pmd/jE9NPEFXWcw8Bf2dcVuAKbOB4j+Xs1F5xhFkA4vgGzvcltb4mfs7b" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-DbT52L1XE0JkWu/3+RXVusRcTJIb+6sANvYs/6FrVr9XHn6Y4oUuWu1Kw2so4A1A" crossorigin="anonymous"></script>
    <!--END SCRIPTS-->
</body>

    </section>

    <!--FOOTER-->
    <footer>
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-col">
                    <h4>Sobre Nós</h4>
                    <p>A RECOLHE+ é uma empresa líder em gestão global de resíduos, comprometida com a sustentabilidade e a responsabilidade ambiental.</p>
                </div>
                <div class="footer-col">
                    <h4>Contato</h4>
                    <ul>
                        <li><a href="mailto:contato@recolhemais.com">hello@recolhemais.com</a></li>
                        <li><a href="tel:+5511999999999">(41) 99579-8587</a></li>
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
                <p>&copy; 2024 RECOLHE+. <i>Trabalho Somativo 01 - Aluno: Igor David Loyola Fiori - Todos os direitos reservados a matéria Fundamentos de Programação Web - PUC PR</i></p>
            </div>
        </div>
    </footer>
    <!--END FOOTER-->
</body>

</html>
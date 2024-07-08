<?php
if (!empty($_GET['id']))
{
    include_once('config.php'); // Incluir o arquivo de configuração corretamente

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
  
    $result = $conexao->query($sqlSelect);

    if($result->num_rows > 0)
    {
      while($user_data = mysqli_fetch_assoc($result))
      {
      $nome = $user_data['nome'];
      $email = $user_data['email'];
      $data_nascimento = $user_data['data_nascimento'];
      $celular = $user_data['celular'];
      $endereco = $user_data['endereco'];
      $numero = $user_data['numero'];
      $cep = $user_data['cep'];
      $senha = $user_data['senha'];
      }
      
    }
    else
    {
    header('location sistema.php');
    }

}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Criar Conta</title>


</head>
<section>

    <body>

        <!--HEADER-->
        <header>
            <a href="index.html"><img src="img/recolhe+.png" alt="logotype" class="logotype"></a>
            <nav class="navegation">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#section2">Serviços</a></li>
                    <li><a href="#section3">App</a></li>
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
            <h1 class="titulo_login">Vamos atualizar o seu acesso?</h1>
            <br><br>
            <form action="saveEdit.php" method="POST" >
                <input class="input_criarconta" type="text" id="nome" name="nome" value="<?php echo $nome ?>" placeholder="Qual é o seu nome?"
                    required>
                <br><br>
                <input class="input_criarconta" type="email" id="email" name="email" value="<?php echo $email ?>" placeholder="E-mail" required>
                <br><br>
                <input class="input_criarconta" id="data_nascimento" type="text" name="data_nascimento" value="<?php echo $data_nascimento ?>"
                    placeholder="Data de nascimento " required>
                <br><br>
                <input class="input_criarconta" id="celular" type="tel" name="celular" placeholder="Seu celular" value="<?php echo $celular ?>"
                    required>
                <br><br>
                <input class="input_criarconta" id="endereco" type="endereco" name="endereco" value="<?php echo $endereco ?>"
                    placeholder="Endereço Completo" required>
                <br><br>
                <input class="input_criarconta" id="numero" type="numero" name="numero" value="<?php echo $numero ?>" placeholder="Número" required>
                <br><br>
                <input class="input_criarconta" id="cep" type="cep" name="cep" value="<?php echo $cep ?>" placeholder="CEP" required>
                <br><br>
                <input class="input_criarconta" type="text" name="senha" value="<?php echo $senha ?>" placeholder="Crie uma nova senha" required>
                <br><br>
                <input class="button_criarconta" type="submit" id="update" name="update"><b></b></button>
                <input type="hidden" name="id" value="<?php echo $id ?>"  >
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

    // Redirecionar para entrarnaconta.html ao clicar no botão "Entrar na Conta"
    document.getElementById("entrarConta").addEventListener("click", function () {
        window.location.href = "entrarconta.html";
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Validação de Nome Completo
        const nomeInput = document.getElementById('nome');
        nomeInput.addEventListener('input', function () {
            // Aceita letras, espaços e acentos
            const nomeRegex = /^[A-Za-zÀ-ú\s]+$/;
            if (!nomeRegex.test(nomeInput.value)) {
                nomeInput.setCustomValidity('Por favor, insira um nome válido (somente letras, espaços e acentos).');
            } else {
                nomeInput.setCustomValidity('');
            }
        });


        // Validação de Email
        const emailInput = document.getElementById('email');
        emailInput.addEventListener('input', function () {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                emailInput.setCustomValidity('Por favor, insira um email válido.');
            } else {
                emailInput.setCustomValidity('');
            }
        });

        // Máscara e Validação de Data de Nascimento
        const dataNascimentoInput = document.getElementById('data_nascimento');
        dataNascimentoInput.addEventListener('input', function () {
            let value = dataNascimentoInput.value.replace(/\D/g, '');
            if (value.length > 8) value = value.slice(0, 8);

            if (value.length >= 5) {
                dataNascimentoInput.value = `${value.slice(0, 2)}/${value.slice(2, 4)}/${value.slice(4)}`;
            } else if (value.length >= 3) {
                dataNascimentoInput.value = `${value.slice(0, 2)}/${value.slice(2)}`;
            } else if (value.length >= 1) {
                dataNascimentoInput.value = value;
            }
        });

        // Máscara e Validação de Número de Telefone
        const celularInput = document.getElementById('celular');
        celularInput.addEventListener('input', function () {
            let value = celularInput.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);

            if (value.length > 6) {
                celularInput.value = `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
            } else if (value.length > 2) {
                celularInput.value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
            } else if (value.length > 0) {
                celularInput.value = `(${value.slice(0, 2)}`;
            }
        });
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
                    <li><a href="#section3">Aplicativo</a></li>
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
                    <a href="https://www.facebook.com/"><img src="img/facebook.png" alt="Facebook" height="30"
                            width="30"></a>
                    <a href="https://x.com/?lang=pt-br"><img src="img/twitter.png" alt="Twitter" height="30"
                            width="30"></a>
                    <a href="https://www.instagram.com/"><img src="img/instagram.png" alt="Instagram" height="30"
                            width="30"></a>
                    <a href="https://www.linkedin.com/"><img src="img/linkedin.png" alt="LinkedIn" height="30"
                            width="30"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 RECOLHE+. <i>Trablho Somativo 01 - Aluno: Igor David Loyola Fiori - Todos os direitos
                    reservados a matéria Fundamentos de Programação Web - PUC PR </i></p>
        </div>
    </div>
</footer>
<!--END FOOTER-->
</div>
</html>
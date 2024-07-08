<?php
if (isset($_POST['submit_usuario'])) {
    include_once('config.php'); // Incluir o arquivo de configuração corretamente

    // Formulario usuarios
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $celular = $_POST['celular'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $senha = $_POST['senha'];

    // Converter a data de nascimento para o formato yyyy-mm-dd
    $data_nascimento_formatada = date('Y-m-d', strtotime(str_replace('/', '-', $data_nascimento)));

    // Preparar e executar a query SQL para inserir os dados
    $query = "INSERT INTO usuarios (nome, email, data_nascimento, celular, endereco, numero, cep, senha) VALUES ('$nome', '$email', '$data_nascimento_formatada', '$celular', '$endereco', '$numero', '$cep', '$senha')";
    $result = mysqli_query($conexao, $query);

    if ($result) {
        echo "<script>
                alert('Sua conta foi criada com sucesso! 😊');
                window.location.href = 'entrarconta.html';
              </script>";
    } else {
        $error = mysqli_error($conexao);
        echo "<script>
                alert('Erro ao criar a sua conta, tente novamente: 🙁" . addslashes($error) . "');
                window.location.href = 'criarconta.html';
              </script>";
    }
}
?>

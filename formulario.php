<?php
if (isset($_POST['submit_orcamento'])) {
  include_once('config.php'); // Incluir o arquivo de configuração corretamente

  // Obter os dados do formulário usando $_POST
  $name = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $descricao = $_POST['descricao'];

  // Preparar e executar a query SQL para inserir os dados
  $result = mysqli_query($conexao, "INSERT INTO orcamentos (name, email, telefone, descricao) VALUES ('$name', '$email', '$telefone', '$descricao')");

  if ($result) {
    echo "<script>
                alert('Seu formulário foi enviado com sucesso!😎');
                window.location.href = 'index.html';
              </script>";
  } else {
    $error = mysqli_error($conexao);
    echo "<script>
                alert('Erro ao inserir dados: 🙁" . addslashes($error) . "');
                window.location.href = 'index.html';
              </script>";
  }
}
?>

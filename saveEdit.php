<?php

include_once('config.php');

if(isset($_POST['update']))
  // Preparar e executar a query SQL para recuperar a senha hasheada do banco de dados
  $sql = "SELECT * FROM usuarios WHERE email = '$email'";
  $result = $conexao->query($sql);

{
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $celular = $_POST['celular'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $senha = $_POST['senha'];  


    $sqlUpdate = "UPDATE usuarios SET nome ='$nome',email='$email',data_nascimento = '$data_nascimento',celular = '$celular',endereco = '$endereco',
    numero = '$numero',cep = '$cep', senha = '$senha' WHERE id='$id' ";

    $result = $conexao->query($sqlUpdate);
}
header('Location: sistema.php');

?>
<?php

if(!empty($_GET['id']))
{
    include_once('config.php'); // Incluir o arquivo de configuração corretamente

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM coletas WHERE id=$id";
  
    $result = $conexao->query($sqlSelect);

    if($result->num_rows > 0)
    {
      $sqlDelete = "DELETE FROM coletas WHERE id=$id"; 
      $resultDelete = $conexao->query($sqlDelete);
    }
}
header('Location: sistema.php');

?>
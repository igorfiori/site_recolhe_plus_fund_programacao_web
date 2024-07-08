<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Acessa
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar e executar a query SQL para recuperar a senha do banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $senhaArmazenada = $row['senha'];

        // Verificar a senha
        if ($senha === $senhaArmazenada) {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: sistema.php');
        } else {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: entrarconta.html?erro=senha');
        }
    } else {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: entrarconta.html?erro=email');
    }
} else {
    // Não acessa
    header('Location: entrarconta.html?erro=campos');
}
?>

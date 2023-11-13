<?php

include("config.php");

$erro = ""; // Inicialize a variável $erro

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];


        $sql = "SELECT id_usuario, email_usuario, senha_usuario FROM tb_usuario WHERE email_usuario = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch();

        if ($usuario) {

            $senha_md5 = md5($senha);

            if ($senha_md5 === $usuario['senha_usuario']) {
                // Redirecione para a página de boas-vindas
                header("Location: adm/inicial.php");
                exit();
            } else {
                header("Location: login.php");
                $erro = "Credenciais inválidas. Tente novamente.";
            }
        } else {
            $erro = "Credenciais inválidas. Tente novamente.";
        }
    }
}
?>



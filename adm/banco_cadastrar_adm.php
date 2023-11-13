<?php
session_start();

include("config2.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $nome = $_POST["nome"];
    $nascimento = $_POST["nascimento"];
    $email = $_POST["email"];
    $senha = $_POST['senha'];
    $senha_md5 = md5($senha);
    $selecao_pais = $_POST['selecao_pais'];
    $adm = isset($_POST['adm']) ? true : false;

    // Inserir os dados no banco de dados
    $sql = "INSERT INTO TB_USUARIO (nm_usuario, email_usuario, senha_usuario, dt_nascimento, id_pais, fl_adm) VALUES (:nome, :email, :senha_md5, :nascimento, :selecao_pais, :adm)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':nascimento', $nascimento);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha_md5', $senha_md5);
    $stmt->bindParam(':selecao_pais', $selecao_pais);
    $stmt->bindParam(':adm', $adm);
    $stmt->execute();

    header("Location: inicial.php"); // Redirecione para a página de filmes ou outra página desejada
    exit();
}

?>

<?php
session_start();
include("config3.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nome = $_POST["nome"];
    $nascimento = $_POST["nascimento"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $senha_md5 = md5($senha);
    $pais = $_POST["selecao_pais"];

    // Con
    $conn = pg_connect("host='200.19.1.18' dbname='isadoramartins' user='isadoramartins' password='123456'");

    if (!$conn) {
        echo "Erro ao conectar ao PostgreSQL.";
    } else {
    
        $id_usuario = $_SESSION['id_usuario'];
        $query = "UPDATE tb_usuario SET nm_usuario = '$nome', dt_nascimento = '$nascimento', email_usuario = '$email', senha_usuario = '$senha_md5', id_pais = '$pais' WHERE id_usuario = $id_usuario";
        $result = pg_query($conn, $query);

        if ($result) {
            header("Location: perfil.php");
            exit();
        } else {
            echo "Erro ao atualizar os dados: " . pg_last_error($conn);
        }

        pg_close($conn);
    }
} else {
    echo "Método de requisição inválido.";
}
?>

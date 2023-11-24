<?php
session_start();
include("config3.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_review'])) {
    $id_review = $_GET['id_review'];

    // SQL para excluir a revisão
    $sql = "DELETE FROM tb_review WHERE id_review = :id_review AND id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);

    if ($stmt) {
        // Executar a consulta SQL
        $stmt->bindParam(':id_review', $id_review, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: minhas_reviews.php");
        exit();
        } else {
            echo "Erro ao excluir revisão.";
        }
    } else {
        echo "Erro ao preparar a consulta.";
    }
} else {
    echo "ID da review não fornecido.";
}
?>





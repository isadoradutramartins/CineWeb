<?php
session_start();
include("config3.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_filme = $_POST['id_filme'];
    $id_review = $_POST['id_review'];
    $nota = $_POST['nota'];
    $nm_review = $_POST['nm_review'];
    $ds_review = $_POST['ds_review'];

    // SQL para atualizar a revisão
    $sql_update_review = "UPDATE tb_review SET nota_review = :nota, nm_review = :nm_review, ds_review = :ds_review WHERE id_review = :id_review";
    $stmt_update_review = $pdo->prepare($sql_update_review);
    $stmt_update_review->bindParam(':nota', $nota, PDO::PARAM_INT);
    $stmt_update_review->bindParam(':nm_review', $nm_review, PDO::PARAM_STR);
    $stmt_update_review->bindParam(':ds_review', $ds_review, PDO::PARAM_STR);
    $stmt_update_review->bindParam(':id_review', $id_review, PDO::PARAM_INT);

    if ($stmt_update_review->execute()) {
        header("Location: minhas_reviews.php");
        exit();
    } else {
        echo "Erro ao atualizar revisão: " . print_r($stmt_update_review->errorInfo(), true);
    }
} else {
    echo "Método de requisição inválido.";
}
?>

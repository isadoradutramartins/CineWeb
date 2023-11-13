<?php
session_start();

include("config3.php");
$filme_id = $_POST['id_filme']; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_usuario = $_SESSION['id_usuario'];

    $nota = $_POST['nota'];
    $nm_review = $_POST['nm_review'];
    $ds_review = $_POST['ds_review'];

    // Adapte essa consulta para inserir os dados no seu banco de dados
    $sql_insert = "INSERT INTO tb_review (id_filme, id_usuario, nota_review, nm_review, ds_review) 
                   VALUES (:id_filme, :id_usuario, :nota, :nm_review, :ds_review)";
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->bindParam(':id_filme', $filme_id, PDO::PARAM_INT);
    $stmt_insert->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_insert->bindParam(':nota', $nota, PDO::PARAM_INT);
    $stmt_insert->bindParam(':nm_review', $nm_review, PDO::PARAM_STR);
    $stmt_insert->bindParam(':ds_review', $ds_review, PDO::PARAM_STR);

    try {
        $stmt_insert->execute();
        header("Location: minhas_reviews.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao inserir dados: " . $e->getMessage();
    }
}

?>

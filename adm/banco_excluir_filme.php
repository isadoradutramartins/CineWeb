<?php
session_start();

include("config2.php");

if (isset($_GET['id'])) {
    $id_filme = $_GET['id'];

    // Verifique se o filme existe antes de excluí-lo
    $sql = "SELECT * FROM tb_filme WHERE id_filme = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_filme, PDO::PARAM_INT);
    $stmt->execute();
    $filme = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($filme) {
        // O filme existe, agora exclua-o
        $sqlDelete = "DELETE FROM tb_filme WHERE id_filme = :id";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->bindParam(':id', $id_filme, PDO::PARAM_INT);

        if ($stmtDelete->execute()) {
            // Exclusão bem-sucedida
            header("Location: filmes.php"); // Redirecione para a página de filmes ou outra página desejada
            exit();
        } else {
            // Erro ao excluir o filme
            echo "Erro ao excluir o filme no banco de dados.";
        }
    } else {
        // Filme não encontrado
        echo "Filme não encontrado.";
    }
}
?>

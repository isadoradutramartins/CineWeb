<?php
include("config2.php");

if (isset($_GET['id'])) {
    $id_filme = $_GET['id'];

    // Verifica se o filme existe antes de excluir
    $sql = "SELECT * FROM tb_filme WHERE id_filme = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_filme, PDO::PARAM_INT);
    $stmt->execute();
    $filme = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($filme) {
       
        $sqlDelete = "DELETE FROM tb_filme WHERE id_filme = :id";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->bindParam(':id', $id_filme, PDO::PARAM_INT);

        if ($stmtDelete->execute()) {
            // Exclusão bem-sucedida
            header("Location: filmes.php"); // Redirecionando para a página de filmes 
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

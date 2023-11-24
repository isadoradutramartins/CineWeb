<?php
session_start();

include("config2.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_filme = $_POST["id"];
    $nm_filme = $_POST["nm_filme"];
    $dt_lancamento = $_POST["dt_lancamento"];
    $diretor = $_POST["selecao_diretor"];
    $pais = $_POST["selecao_pais"];
    $opcoes = isset($_POST["opcoes"]) ? $_POST["opcoes"] : array();

    try {
        // Iniciando uma transação
        $pdo->beginTransaction();

        // 1. Atualizando as informações do filme na tabela tb_filme
        $sql = "UPDATE tb_filme SET nm_filme = :nm_filme, dt_lancamento = :dt_lancamento, id_diretor = :diretor, id_pais = :pais WHERE id_filme = :id_filme";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nm_filme', $nm_filme);
        $stmt->bindParam(':dt_lancamento', $dt_lancamento);
        $stmt->bindParam(':diretor', $diretor);
        $stmt->bindParam(':pais', $pais);
        $stmt->bindParam(':id_filme', $id_filme);

        if ($stmt->execute()) {
            // 2. Deletando todos os registros da tabela tb_genero_filme para o filme em questão
            $sqlDelete = "DELETE FROM tb_genero_filme WHERE id_filme = :id_filme";
            $stmtDelete = $pdo->prepare($sqlDelete);
            $stmtDelete->bindParam(':id_filme', $id_filme);
            $stmtDelete->execute();

            // 3. Inserindo os novos registros na tabela tb_genero_filme
            $sqlInsert = "INSERT INTO tb_genero_filme (id_filme, id_genero) VALUES (:id_filme, :id_genero)";
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(':id_filme', $id_filme);

            foreach ($opcoes as $id_genero) {
                $stmtInsert->bindParam(':id_genero', $id_genero);
                $stmtInsert->execute();
            }

            // Confirmando a transação
            $pdo->commit();

            // Atualização bem-sucedida
            header("Location: filmes.php"); // Redirecionando para a página de filmes
            exit();
        } else {
            // Erro ao atualizar o registro
            echo "Erro ao atualizar o filme no banco de dados.";
        }
    } catch (PDOException $e) {
        // Em caso de erro, desfazer a transação
        $pdo->rollBack();
        echo "Erro: " . $e->getMessage();
    }
}
?>

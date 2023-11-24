<?php
session_start();

include("config2.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $nm_filme = $_POST['nm_filme'];
    $dt_lancamento = $_POST['dt_lancamento'];
    $opcoes = isset($_POST['opcoes']) ? $_POST['opcoes'] : array();
    $selecao_diretor = $_POST['selecao_diretor'];
    $selecao_pais = $_POST['selecao_pais'];

    // Inserindo os dados na tabela do filme
    $sql = "INSERT INTO tb_filme (nm_filme, dt_lancamento, id_diretor, id_pais) VALUES (:nm_filme, :dt_lancamento, :id_diretor, :id_pais)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nm_filme', $nm_filme);
    $stmt->bindParam(':dt_lancamento', $dt_lancamento);
    $stmt->bindParam(':id_diretor', $selecao_diretor);
    $stmt->bindParam(':id_pais', $selecao_pais);
    $stmt->execute();

    // Recuperando o ID do filme recém-inserido
    $id_filme = $pdo->lastInsertId();

    // Inserindo as relações entre o filme e os gêneros
    if (!empty($opcoes)) {
        foreach ($opcoes as $id_genero) {
            $sql = "INSERT INTO tb_genero_filme (id_filme, id_genero) VALUES (:id_filme, :id_genero)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_filme', $id_filme);
            $stmt->bindParam(':id_genero', $id_genero);
            $stmt->execute();
        }
    }

    // upload da imagem do filme
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $imagem_tmp = $_FILES['imagem']['tmp_name'];
        $imagem_nome = $_FILES['imagem']['name'];
        $destino = '..//img/' . $imagem_nome;

        if (move_uploaded_file($imagem_tmp, $destino)) {
            // Atualizando o registro do filme com o caminho da imagem no banco de dados
            $sql = "UPDATE tb_filme SET poster_filme = :imagem WHERE id_filme = :id_filme";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':imagem', $destino);
            $stmt->bindParam(':id_filme', $id_filme);
            $stmt->execute();
        }
    }

    // Redirecionanod para página de filmes
    header("Location: filmes.php");
    exit();
}
?>

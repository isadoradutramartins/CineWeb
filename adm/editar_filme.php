<?php
session_start();

// Verifica se a variável de sessão existe
if (isset($_SESSION['id_usuario'])) {
    // O usuário está autenticado
    $id_usuario_autenticado = $_SESSION['id_usuario'];
} else {
    // Redireciona para a página de login se não estiver autenticado
    header("Location: ..//login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title> Editar Filme </title>
    <link rel="icon" type="imagem/png" href="cineweb.png" width="900" height="1000" />
    <link href="css/estiloCadastrarFilme.css" rel="stylesheet" />
    <link href="css/estilo.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta charset="utf-8">

    <script>
function sair() {
        if (confirm('Tem certeza que deseja sair?')) {
            window.location.href = '..//index.php';
        }
    }
</script>
</head>
<body bgcolor="#f8e1e1">
<div class="background">
    <header><!--menu no topo da pagina-->
        <div class="centro">
           <h2>CINE<span>WEB</span></h2>
            <nav class="menu">
                <a class="link" href="inicial.php">Home</a>
                <a class="link" href="filmes.php">Filmes</a>
                <a class="link" href="cadastrar_filme.php">Cadastrar Filme</a>
                <a class="link" href="cadastrar_adm.php">Cadastrar Administrador</a>
                <a class="link" onclick="sair()">Sair</a>
            </nav>
        </div>
    </header>
    <div class="centro" id="centroTrabalhe">
    <form action="banco_editar_filme.php" method="post" enctype="multipart/form-data">
            <div class="form-header">
                <div class="titulo">
                    <h1> Edite as informações </h1>
                </div>
            </div> 


    <?php
    include("config2.php");
    $generoSelecionado = array();
    $filme_id = isset($_GET['id']) ? $_GET['id'] : null;


    $sql = "SELECT * FROM tb_filme WHERE id_filme = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $filme_id, PDO::PARAM_INT);
    $stmt->execute();
    $filme = $stmt->fetch(PDO::FETCH_ASSOC);

    //formulário

    if ($filme) {
    ?>

       <!-- <form action="banco_editar_filme.php" method="post" enctype="multipart/form-data">-->
            <input type="hidden" name="id" value="<?php echo $filme['id_filme']; ?>">

            <div class="todosInputs">
                <div class="inputBox">
                    <label for="titulo">Título do filme:</label>
                    <input type="text" name="nm_filme" value="<?php echo $filme['nm_filme']; ?>"><br>
                </div>

                <div class="inputBox">
                <label for="dt_lancamento">Data de lançamento:</label>
                <input type="date" id="dt_lancamento" name="dt_lancamento" value="<?php echo $filme['dt_lancamento']; ?>"><br><br>
            </div>


            <?php
            // Execute uma consulta SQL para obter os gêneros associados a este filme
             $sqlGenerosFilme = "SELECT id_genero FROM tb_genero_filme WHERE id_filme = :id_filme";
             $stmtGenerosFilme = $pdo->prepare($sqlGenerosFilme);
             $stmtGenerosFilme->bindParam(':id_filme', $filme_id, PDO::PARAM_INT);
             $stmtGenerosFilme->execute();
             $generosAssociados = $stmtGenerosFilme->fetchAll(PDO::FETCH_COLUMN);

             $query = "SELECT id_genero, nm_genero FROM tb_genero";
             $stmt = $pdo->query($query);
             $dados = $stmt->fetchAll();
             
             echo '<div class="inputgenero">';
             foreach ($dados as $item) {
                 $id = $item['id_genero'];
                 $nome = $item['nm_genero'];
                 $checked = in_array($id, $generosAssociados) ? 'checked' : '';
                 echo '<input type="checkbox" name="opcoes[]" value="' . $id . '" ' . $checked . '>';
                 echo '<label>' . $nome . '</label><br>';
             }
             echo '</div>';             

            $sql_diretor = "SELECT id_diretor, nm_diretor FROM tb_diretor";
            $result_diretor = $pdo->query($sql_diretor);
            $sql_pais = "SELECT id_pais, nm_pais FROM tb_pais";
            $result_pais = $pdo->query($sql_pais);
            ?>

            <!-- CONTINUAÇÃO DO FORMULÁRIO --> 
          <div class="todosInputs">
            <div class="inputBox">
                <label for="selecao_diretor">Diretor(a)</label>
                <select name="selecao_diretor" id="selecao_diretor">
                    <?php
                    while ($row = $result_diretor->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($row['id_diretor'] == $filme['id_diretor']) ? 'selected' : '';
                        echo '<option value="' . $row['id_diretor'] . '" ' . $selected . '>' . $row['nm_diretor'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="inputBox">
                <label for="selecao_pais">País:</label>
                <select name="selecao_pais" id="selecao_pais">
                    <?php
                    while ($row = $result_pais->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($row['id_pais'] == $filme['id_pais']) ? 'selected' : '';
                        echo '<option value="' . $row['id_pais'] . '" ' . $selected . '>' . $row['nm_pais'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="todosInputs">
            <div class="inputBox">
                <label for="imagem">Poster do filme:</label>
                <input type="file" name="imagem" accept="image/*">
            </div>
                </div>
                </div>
            
            <div class="botaoEnviar">
                <input type="submit" value="Atualizar">
            </div> 
        </form>
                </div>
    </div>
    <?php
    }
?>
</body>
</html>


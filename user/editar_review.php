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

include("config3.php");

// Verifica se o ID do filme foi fornecido
if (isset($_GET['id'])) {
    $filme_id = $_GET['id'];

    // Consulta SQL para obter as informações do filme
    $sql_filme = "SELECT * FROM tb_filme WHERE id_filme = :id";
    $stmt_filme = $pdo->prepare($sql_filme);
    $stmt_filme->bindParam(':id', $filme_id, PDO::PARAM_INT);
    $stmt_filme->execute();
    $filme = $stmt_filme->fetch(PDO::FETCH_ASSOC);

    // Consulta SQL para obter as informações da revisão
    $sql_review = "SELECT * FROM tb_review WHERE id_filme = :id AND id_usuario = :id_usuario";
    $stmt_review = $pdo->prepare($sql_review);
    $stmt_review->bindParam(':id', $filme_id, PDO::PARAM_INT);
    $stmt_review->bindParam(':id_usuario', $id_usuario_autenticado, PDO::PARAM_INT);
    $stmt_review->execute();
    $review = $stmt_review->fetch(PDO::FETCH_ASSOC);

    $sql_diretor = "SELECT nm_diretor FROM tb_diretor A, tb_filme B WHERE A.id_diretor = B.id_diretor AND id_filme = :id";
$stmt_diretor = $pdo->prepare($sql_diretor);
$stmt_diretor->bindParam(':id', $filme_id, PDO::PARAM_INT);
$stmt_diretor->execute();
$diretor = $stmt_diretor->fetch(PDO::FETCH_ASSOC);

$sql_pais = "SELECT nm_pais FROM tb_pais A, tb_filme B WHERE A.id_pais = B.id_pais AND id_filme = :id";
$stmt_pais = $pdo->prepare($sql_pais);
$stmt_pais->bindParam(':id', $filme_id, PDO::PARAM_INT);
$stmt_pais->execute();
$pais = $stmt_pais->fetch(PDO::FETCH_ASSOC);

    if ($filme) {
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <title> Editar Review </title>
            <link rel="icon" type="imagem/png" href="cineweb.png" width="900" height="1000" />
            <link href="css/estiloReview.css" rel="stylesheet" />
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
<header><!--menu no topo da pagina-->
        <div class="centro">
           <h2>CINE<span>WEB</span></h2>
            <nav class="menu">
                <a class="link" href="home.php">Home</a>
                <a class="link" href="filmes_user.php">Filmes</a>
                <a class="link" href="minhas_reviews.php">Minhas reviews</a>
                <a class="link" href="perfil.php">Perfil</a>
                <a class="link" onclick="sair()">Sair</a>
            </div>
            </nav>
        </div>
    </header>

            <div class="centro" id="centroTrabalhe">
                <form action="banco_editar_review.php" method="POST" enctype="multipart/form-data">
                    <!-- Adicione os campos do formulário preenchidos com as informações atuais do filme e da revisão -->
                    <input type="hidden" name="id_filme" value="<?php echo $filme['id_filme']; ?>">
                    <input type="hidden" name="id_review" value="<?php echo $review['id_review']; ?>">
                    <div class="form-header">
                <div class="titulo">
                    <h1> <?php echo $filme['nm_filme']; ?></h1>
                </div><!-- titulo -->
            </div> <!-- form-header -->

            <div class="info">
           <p><strong>Data de lançamento:</strong> <?php echo $filme['dt_lancamento']; ?></p><br>
           <p><strong>Diretor(a):</strong> <?php echo $diretor['nm_diretor']?></p><br>
            <p><strong>País:</strong> <?php echo $pais['nm_pais']?></p>
    </div>

    <div class="todosInputs">
    <div class="inputBox">
        <!-- Adicione os campos do formulário preenchidos com as informações atuais do filme e da revisão -->
        <label id="tituloGenero" for="nota">Nota:</label>
        <div class="inputGenero">

            <input type="radio" id="1" name="nota" value="1" <?php echo (isset($review['nota_review']) && $review['nota_review'] == 1) ? 'checked' : ''; ?>>
            <label for="1">1</label>
        </div>

        <div class="inputGenero">
            <input type="radio" id="2" name="nota" value="2" <?php echo (isset($review['nota_review']) && $review['nota_review'] == 2) ? 'checked' : ''; ?>>
            <label for="2">2</label>
        </div>

        <div class="inputGenero">
            <input type="radio" id="3" name="nota" value="3" <?php echo (isset($review['nota_review']) && $review['nota_review'] == 3) ? 'checked' : ''; ?>>
            <label for="3">3</label>
        </div>

        <div class="inputGenero">
            <input type="radio" id="4" name="nota" value="4" <?php echo (isset($review['nota_review']) && $review['nota_review'] == 4) ? 'checked' : ''; ?>>
            <label for="4">4</label>
        </div>

        <div class="inputGenero">
            <input type="radio" id="5" name="nota" value="5" <?php echo (isset($review['nota_review']) && $review['nota_review'] == 5) ? 'checked' : ''; ?>>
            <label for="5">5</label>
        </div>
    </div>
</div>
<div class="todosInputs">
                        <div class="inputBox">

                    <label for="nm_review">Título da avaliação:</label>
                    <input type="text" name="nm_review" value="<?php echo $review['nm_review']; ?>">

                    <div class="inputBox">
                    <label for="ds_review">Escreva aqui sua review:</label>
                    <textarea name="ds_review" rows="5" cols="33" required><?php echo $review['ds_review']; ?></textarea>

                    <input type="submit" value="Atualizar">
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Filme não encontrado.";
    }
} else {
    echo "ID de filme não fornecido.";
}
?>

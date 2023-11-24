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
include ("config3.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title> Filmes </title>
    <link rel="icon" type="imagem/png" href="imagens/MiaBoutique_logo.png" width="900" height="1000" />
    <link href="css/estiloFilmes.css" rel="stylesheet" />
    <link href="css/estilo.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <script type="text/javascript" src="js/arq.js"></script>
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
                <a class="link" onclick="sair()" href="logout.php">Sair</a>
            </div>
            </nav>
        </div>
    </header>

<section class="filmes">
    <h1 class="titulo">Filmes</h1>
    <div class="centro" id="centroProduto">
        <?php
            // Conexão com o banco de dados
            $conn = pg_connect("host='200.19.1.18' dbname='isadoramartins' user='isadoramartins' password='123456'");

            if (!$conn) {
                die("Erro na conexão com o banco de dados: " . pg_last_error());
            }

            // Query para obter informações dos filmes
            $query = "SELECT id_filme, nm_filme, dt_lancamento, poster_filme FROM tb_filme
            ORDER BY id_filme DESC";
            $result = pg_query($conn, $query);

            // Exibir os cards com base nos resultados do banco de dados
            if ($result) {
                while ($row = pg_fetch_assoc($result)) {
                    echo "<a href='#filme" . $row['id_filme'] . "'>";
                    echo "<div class='card'>";
                    echo "<img id='filme" . $row['id_filme'] . "' src='" . $row['poster_filme'] . "' alt='" . $row['nm_filme'] . "'>";
                    echo "<p>" . $row['nm_filme'] . "</p>";
                    echo "<a class='button' href='review.php?id=" . $row['id_filme'] . "'>Fazer Review</a>";
                    echo "</div></a>";
                }
            } else {
                echo "Nenhum filme encontrado.";
            }

            // Fecha a conexão com o banco de dados
            pg_close($conn);
        ?>
    </div>
</section>
</body>
</html>


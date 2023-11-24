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
    <title> Home </title>
    <link rel="icon" type="imagem/png" href="cineweb.png" width="900" height="1000" />
    <link href="css/estiloFilmes.css" rel="stylesheet" />
    <link href="css/estiloMinhasReviews.css" rel="stylesheet" />
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
                <a class="link" onclick="sair()" href="logout.php">Sair</a>
            </div>
            </nav>
        </div>
    </header>
    <section class="filmes">
    <h1 class="titulo">Últimas reviews</h1> 
    <?php
// conexão com o PostgreSQL
$conn = pg_connect("host='200.19.1.18' dbname='isadoramartins' user='isadoramartins' password='123456'");

if (!$conn) {
    echo "Erro ao conectar ao PostgreSQL.";
} else {

    $query = "SELECT A.id_filme, A.nm_filme, A.poster_filme, B.id_review, B.nm_review, B.nota_review, B.ds_review, B.dt_review, C.nm_usuario
    FROM tb_filme A, tb_review B, tb_usuario C
    WHERE A.id_filme = B.id_filme AND 
          B.id_usuario = C.id_usuario
    ORDER BY B.id_review DESC
    LIMIT 10";

    $result = pg_query_params($conn, $query, []);

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            
                $nomeCompleto = $row['nm_usuario'];
                $partesNome = explode(' ', $nomeCompleto);

                $primeiroNome = $partesNome[0];

?>
<div class="container">
        <div class="wrapper">
        <img src="<?php echo $row['poster_filme']; ?>">
        </div>
         <div class="button-wrapper"> 
            <h1><?php echo $row['nm_filme']; ?></h1>
            <h2>Nota: <?php echo $row['nota_review'];?></h2><br>
            <h3><?php echo $row['nm_review'];?></h3><br>
          <p><?php echo $row['ds_review'];?></p><br>
         </div>
         <div class="nome">
            <p><?php echo $primeiroNome;?></p><br>
            <p><?php echo date('d/m/y', strtotime($row['dt_review'])); ?></p><br>
        </div>
           </div>
       </div>
<?php
        }
    }
    //fechando a conexão
    pg_close($conn);
}
?>
</section>

</body>

        </html>
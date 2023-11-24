<?php
session_start();
include ("config3.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title> Filmes </title>
    <link rel="icon" type="imagem/png" href="imagens/MiaBoutique_logo.png" width="900" height="1000" />
    <link href="css/estiloFilmes.css" rel="stylesheet" />
    <link href="css/estiloMinhasReviews.css" rel="stylesheet" />
    <link href="css/estilo.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <script type="text/javascript" src="js/arq.js"></script>
    <meta charset="utf-8">

    <script>
    function excluirReview(idReview) {
        if (confirm('Tem certeza que deseja excluir essa review?')) {
            window.location.href = 'banco_excluir_review.php?id_review=' + idReview;
        }
    }

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

    <section class="filmes">
    <h1 class="titulo">Minhas reviews</h1>

<?php
// conexão com o PostgreSQL
$conn = pg_connect("host='200.19.1.18' dbname='isadoramartins' user='isadoramartins' password='123456'");

if (!$conn) {
    echo "Erro ao conectar ao PostgreSQL.";
} else {
    $id_usuario = $_SESSION['id_usuario'];

    $query = "SELECT A.id_filme, A.nm_filme, A.poster_filme, B.id_review, B.nm_review, B.nota_review, B.ds_review, B.dt_review FROM tb_filme A, tb_review B
    WHERE A.id_filme = B.id_filme AND
    B.id_usuario = $id_usuario AND
    B.id_usuario = $1
    ORDER BY B.id_review DESC";
    $result = pg_query_params($conn, $query, array($id_usuario));

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {

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
          <div class="botao">
          <a class="button" href="editar_review.php?id=<?php echo $row['id_filme']; ?>">Editar</a>
          <a class="button" href="#" onclick="excluirReview(<?php echo $row['id_review']; ?>)">Excluir</a>
        </div>
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
</body>
</html>


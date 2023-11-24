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
    <title> Review </title>
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
                <a class="link" onclick="sair()" href="logout.php">Sair</a>
            </div>
            </nav>
        </div>
    </header>
    <?php
    include("config3.php");
    $filme_id = $_GET['id']; // passando o ID do filme na URL


    $sql = "SELECT * FROM tb_filme WHERE id_filme = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $filme_id, PDO::PARAM_INT);
    $stmt->execute();
    $filme = $stmt->fetch(PDO::FETCH_ASSOC);

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

    //formulário

    if ($filme) {
    ?>
      <div class="centro" id="centroTrabalhe">
        <form action="banco_review.php" method="POST" enctype="multipart/form-data"> 
        <input type="hidden" name="id_filme" value="<?php echo $filme['id_filme'];?>">
            <div class="form-header">
                <div class="titulo">
                    <h1> <?php echo $filme['nm_filme']; ?></h1>
                </div><!-- titulo -->
            </div> <!-- form-header -->

           <div class="info">
           <p><strong>Data de lançamento:</strong> <?php echo date('d/m/y', strtotime($filme['dt_lancamento'])); ?></p><br>
           <p><strong>Diretor(a):</strong> <?php echo $diretor['nm_diretor']?></p><br>
            <p><strong>País:</strong> <?php echo $pais['nm_pais']?></p>
    </div>

                <!--RADIO NOTA-->
                <div class="todosInputs">
                    
                    <div class="inputBox">
                    
                        <label id="tituloGenero" for="nota">Nota:</label>
                        <div class="inputGenero">
                            <input type="radio" id="1" name="nota" value="1">
                            <label for="1">1</label>
                        </div>
                
                        <div class="inputGenero">
                            <input type="radio" id="2" name="nota" value="2">
                            <label for="2">2</label>
                        </div>
                
                        <div class="inputGenero">
                            <input type="radio" id="3" name="nota" value="3">
                            <label for="nota">3</label>
                        </div>
                
                        <div class="inputGenero">
                            <input type="radio" id="4" name="nota" value="4">
                            <label for="nota">4</label>
                        </div>
                
                        <div class="inputGenero">
                            <input type="radio" id="5" name="nota" value="5">
                            <label for="nota">5</label>
                        </div>
                    </div>
        
                <!--TÍTULO REVIEW-->
                <div class="todosInputs">
                        <div class="inputBox">
                            <label for="titulo"> Título da avaliação: (opcional) </label>
                            <input id="titulo" type="text" name="nm_review" placeholder="Digite o título da sua avaliação:" 
                                onkeyup="maiuscula(this)"> <!--EVENTO QUE ATIVA A FUNÇÃO PARA DEIXAR O QUE O USUARIO DIGITAR EM MAIUSCULO-->
                        </div> <!-- inputBox -->

                        <div class="inputBox">
                            <label for="review">Escreva aqui sua review:</label>
                            <textarea id="review" name="ds_review" rows="5" cols="33" required="required"> </textarea> <!--EVENTO QUE ATIVA A FUNÇÃO (quando o usuário sair do campo do formulário).-->
                        </div> <!-- inputBox -->


            <div class="botaoEnviar">
                <input type="submit" value="Enviar"  id="<?php echo $row['id_filme']?>">
            </div> <!-- botaoEnviar -->

                

    
    <?php
    }
?>

        </form>


    <div class="footer-bottom">
      
</body>
</html>
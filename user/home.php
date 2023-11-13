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
    <title> TESTE CRUD </title>
    <link rel="icon" type="imagem/png" href="cineweb.png" width="900" height="1000" />
    <link href="css/estiloHome.css" rel="stylesheet" />
    <link href="css/estilo.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta charset="utf-8">
</head>
<body bgcolor="#f8e1e1" >
   
<div class="background">
    <header><!--menu no topo da pagina-->
        <div class="centro">
           <h2>CINE<span>WEB</span></h2>
            <nav class="menu">
                <a class="link" href="inicial.php">Home</a>
                <a class="link" href="filmes_user.php">Filmes</a>
                <a class="link" href="minhas_reviews.php">Minhas reviews</a>
                <a class="link" href="cadastrar_adm.php">Perfil</a>
                <a class="link" href="..//index.php">Sair</a>
            </nav>
        </div>
    </header>

    <?php
    include ("config3.php");
      switch(@$_REQUEST["page"]) {
        case "novo":
            include("formularios/nova_review.php");
            break;
        case "listar": 
            include("listar/listar_review.php");
            break;
        case "salvar":
            include("salvar/salvar_review.php");
            break;
        case "update":
            include ("salvar/update_review.php");
            break;
        case "cadastrar":
            include ("formularios/cadastrar_filme.php");
            break;
        default:
        print("<h1>Bem vindos!</h1>");
        
      }
    ?>
</body>

        </html>
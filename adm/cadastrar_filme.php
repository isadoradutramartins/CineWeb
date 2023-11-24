<?php
session_start();
include ("config2.php");

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

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title> Cadastrar Filme </title>
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
                <a class="link" onclick="sair()" href="logout.php">Sair</a>
            </nav>
        </div>
    </header>

      <div class="centro" id="centroTrabalhe">
        <form action="banco_cadastrar_filme.php" method="POST" enctype="multipart/form-data"> 
            <div class="form-header">
                <div class="titulo">
                    <h1> Cadastre o filme: </h1>
                </div><!-- titulo -->
            </div> <!-- form-header -->


           <!--TÍTULO-->
           <div class="todosInputs">
                <div class="inputBox">


                    <label for="titulo"> Título do filme: </label>
                    <input id="titulo" type="text" name="nm_filme" placeholder="Digite o título do filme:" required="required"
                        onkeyup="maiuscula(this)"> <!--EVENTO QUE ATIVA A FUNÇÃO PARA DEIXAR O QUE O USUARIO DIGITAR EM MAIUSCULO-->
                   </div>

                 <!-- inputBox -->
        
                <!--RADIO NOTA-->
                <div class="todosInputs">
                    <div class="inputBox">
                
                <label for="data">Data de lançamento:</label>
                <input type="date" id="data" name="dt_lancamento" required><br><br>
        

<?php

$query = "SELECT id_genero, nm_genero FROM tb_genero";
$stmt = $pdo->query($query);
$dados = $stmt->fetchAll();

// Inicie o formulário
echo '<form method="post" action="banco_cadastrar_filme.php">';
echo '<div class="inputgenero">';

// Gere as checkboxes a partir dos dados do banco de dados
foreach ($dados as $item) {
    $id = $item['id_genero'];
    $nome = $item['nm_genero'];

    echo '<input type="checkbox" name="opcoes[]" value="' . $id . '">';
    echo '<label>' . $nome . '</label><br>';
}


$sql_diretor = "SELECT id_diretor, nm_diretor FROM tb_diretor";
$result_diretor = $pdo->query($sql_diretor);

$sql_pais = "SELECT id_pais, nm_pais FROM tb_pais";
$result_pais = $pdo->query($sql_pais);


echo '</form>';
?>

    </div>

    <div class="todosInputs">
    <label for="selecao_diretor">Diretor(a)</label>
    <select name="selecao_diretor" id="selecao_diretor">
        <?php
        while ($row = $result_diretor->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['id_diretor'] . '">' . $row['nm_diretor'] . '</option>';
        }
        ?>
    </select>
</div>

<div class="todosInputs">
    <label for="selecao_pais">País:</label>
    <select name="selecao_pais" id="selecao_pais">
        <?php
        while ($row = $result_pais->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['id_pais'] . '">' . $row['nm_pais'] . '</option>';
        }
        ?>
    </select>
</div>

    <!--POSTER-->
            
                <div class="inputBox">  
                <label for="poster"> Poster do filme: </label>      
                    <input type="file" name="imagem" accept="image/*">                           
            </div>
        </div>


            <div class="botaoEnviar">
                <input type="submit" value="Enviar">
            </div> <!-- botaoEnviar -->
        </form>


    <div class="footer-bottom">
      
</body>
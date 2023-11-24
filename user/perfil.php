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
    <link href="css/estiloReview.css" rel="stylesheet" />
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
                <a class="link" onclick="sair()" href="logout.php">Sair</a>
            </div>
            </nav>
        </div>
    </header>
<?php
// conexão com o banco
$conn = pg_connect("host='200.19.1.18' dbname='isadoramartins' user='isadoramartins' password='123456'");

if (!$conn) {
    echo "Erro ao conectar ao PostgreSQL.";
} else {
    $id_usuario = $_SESSION['id_usuario'];

    
    $query = "SELECT * FROM tb_usuario WHERE id_usuario = $id_usuario";
    $result = pg_query($conn, $query);
    
    if ($result) {
        $usuario = pg_fetch_assoc($result);

?>

<div class="centro" id="centroTrabalhe">
        <form action="banco_perfil.php" method="post" onsubmit="enviarForm()"> <!--EVENTO QUE ATIVA A FUNÇÃO NA HORA DE ENVIAR O FORMULARIO-->
            <div class="form-header">
                <div class="titulo">
                    <h1> Cadastre-se </h1>
                </div><!-- titulo -->
            </div> <!-- form-header -->

            <div class="todosInputs">
            <div class="inputBox">
                <label for="nome"> Nome: </label>
                <input id="nome" type="text" name="nome" placeholder="Digite seu nome" required="required"
                value="<?php echo $usuario['nm_usuario']; ?>">
            </div>

            <div class="inputBox">
                <label for="nascimento"> Data de nascimento: </label>
                <input id="nascimento" type="date" name="nascimento" required="required" value="<?php echo $usuario['dt_nascimento']; ?>">
            </div>

            <div class="inputBox">
                <label for="email"> Email: </label>
                <input id="email" type="email" name="email" placeholder="Digite seu email" required="required" value="<?php echo $usuario['email_usuario']; ?>">
            </div>

            <div class="inputBox">
                <label for="senha"> Senha: </label>
                <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required="required">
            </div>

            <?php
                include ("config3.php");

                $sql_pais = "SELECT id_pais, nm_pais FROM tb_pais";
                $result_pais = $pdo->query($sql_pais);
                ?>
                </div>
                <div class="inputBox">
                <label for="selecao_pais">País:</label>
                <select name="selecao_pais" id="selecao_pais">
                    <?php
                    while ($row = $result_pais->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($row['id_pais'] == $usuario['id_pais']) ? 'selected' : '';
                        echo '<option value="' . $row['id_pais'] . '" ' . $selected . '>' . $row['nm_pais'] . '</option>';
                    }
                    ?>
                </select>
                    <br>
                </div>

            <div class="botaoEnviar">
                <input type="submit" value="Atualizar">
            </div>
        </form>
    </div>

    <?php
        }
        //fechando a conexão
        pg_close($conn);
    }
    ?>
</body>
</html>
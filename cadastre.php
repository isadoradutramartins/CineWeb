
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Cadastre-se </title>
        <link rel="icon" type="imagem/png" href="imagens/MiaBoutique_logo.png" width="900" height="1000" />
        <link href="css/estilo.css" rel="stylesheet" />
        <link href="css/estiloCadastre.css" rel="stylesheet" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <script type="text/javascript" src="js/arq.js"></script>
        <meta charset="utf-8">
        </script>
    </head>

<body bgcolor="#f8e1e1">
<header><!--menu no topo da pagina-->
        <div class="centro">
           <h2>CINE<span>WEB</span></h2>
            <nav class="menu">
                <a class="link" href="login.php">Log in</a>
                <a class="link" href="cadastre.php">Cadastre-se</a>
            </nav>
        </div>
    </header>
    <div class="centro" id="centroTrabalhe">
        <form action="banco_cadastre.php" method="post" onsubmit="enviarForm()"> <!--EVENTO QUE ATIVA A FUNÇÃO NA HORA DE ENVIAR O FORMULARIO-->
            <div class="form-header">
                <div class="titulo">
                    <h1> Cadastre-se </h1>
                </div><!-- titulo -->
            </div> <!-- form-header -->

            <div class="todosInputs">
                <div class="inputBox">
                    <label for="nome"> Nome: </label>
                    <input id="nome" type="text" name="nome" placeholder="Digite seu nome" required="required">
                </div> <!-- inputBox -->

                <div class="inputBox">
                    <label for="nascimento"> Data de nascimento: </label>
                    <input id="nascimento" type="date" name="nascimento" required="required">
                </div> <!-- inputBox -->

                <div class="inputBox">
                    <label for="email"> Email: </label>
                    <input id="email" type="email" name="email" placeholder="Digite seu email" required="required">
                </div>

                <div class="inputBox">
                    <label for="senha"> Senha: </label>
                    <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required="required">
                </div> <!-- inputBox -->

                <?php
                include ("config.php");

                $sql_pais = "SELECT id_pais, nm_pais FROM tb_pais";
                $result_pais = $pdo->query($sql_pais);
                ?>
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
                    <br>
                </div>
            
            <div class="botaoEnviar">
                <input type="submit" value="Enviar">
            </div> <!-- botaoEnviar -->
        </form>
    </div> <!-- centro -->
    <div class="footer-bottom">
        <div class="box">
          <a id="nomes" onmouseover="MudarCor()" onmouseout="CorNormal()"> &copy; | Site criado por Isadora Martins</a>
        </div>
      </div>
</body>

</html>
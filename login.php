<?php

//include("banco_login.php");


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Trabalhe Conosco </title>
        <link rel="icon" type="imagem/png" href="imagens/MiaBoutique_logo.png" width="900" height="1000" />
        <link href="css/estilo.css" rel="stylesheet" />
        <link href="css/estiloCadastre.css" rel="stylesheet" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <script type="text/javascript" src="js/arq.js"></script>
        <meta charset="utf-8">
        </script>
    </head>

<body bgcolor="#f8e1e1">
    
    <header>
           <div class="centro">
           <h2>CINE<span>WEB</span></h2>
    </div>
    </header>
    <div class="centro" id="centroTrabalhe">
        <form action="banco_login.php" method="post" onsubmit="enviarForm()"> <!--EVENTO QUE ATIVA A FUNÇÃO NA HORA DE ENVIAR O FORMULARIO-->
            <div class="form-header">
                <div class="titulo">
                    <h1> Log in </h1>
                </div><!-- titulo -->
            </div> <!-- form-header -->
             
            <div class="todosInputs">

                <div class="inputBox">
                    <label for="email"> Email: </label>
                    <input id="email" type="email" name="email" placeholder="Digite seu email" required="required">
                </div>

                <div class="inputBox">
                    <label for="senha"> Senha: </label>
                    <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required="required">
                </div> <!-- inputBox -->

                <?php if (!empty($erro)) { ?>
                   <div class="erro">
                   <?php echo $erro; ?>
                   </div>
                <?php } ?>


            <div class="botaoEnviar">
                <input type="submit" value="Enviar">
            </div> <!-- botaoEnviar -->
        </form>

    
    </div> <!-- centro -->
    <div class="footer-bottom">
      </div>
</body>

</html>
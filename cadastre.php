
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Cadastre-se </title>
        <link rel="icon" type="imagem/png" href="imagens/cineweb.png" width="1500" height="1500" />
        <link href="css/estilo.css" rel="stylesheet" />
        <link href="css/estiloCadastre.css" rel="stylesheet" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <script type="text/javascript" src="js/arq.js"></script>
        <meta charset="utf-8">
        </script>
    </head>

<body bgcolor="#f8e1e1">
    <script>
         /*MUDANDO A COR DOS NOMES QUANDO O MOUSE PASSA POR CIMA*/
         function MudarCor(){
            var nomes = document.getElementById("nomes");
            nomes.style.color = "#A0522D";
        }

        function CorNormal() {
            var nomes = document.getElementById("nomes");
            nomes.style.color = "black";
        }
    </script>
    <header>
        <div class="centro">
            <h2>CINE<span>WEB</span></h2>
            <nav class="menu">
                <a class="link" href="inicial.html">Home</a>
                <a class="link" href="info.html">Informações</a>
                <a class="link" href="filmes.html">Reviews</a>
                <a class="link" href="cadastre.php">Cadastre-se</a>
            </nav>
        </div>
    </header>
    <div class="centro" id="centroTrabalhe">
        <form onsubmit="enviarForm()"> 
            <div class="form-header">
                <div class="titulo">
                    <h1> Cadastre-se </h1>
                </div><!-- titulo -->
            </div> <!-- form-header -->
        

            <div class="todosInputs">
                <div class="inputBox">
                    <label for="nome"> Nome: </label>
                    <input id="nome" type="text" name="nome" placeholder="Digite seu nome" required="required"
                        onkeyup="maiuscula(this)"> <!--EVENTO QUE ATIVA A FUNÇÃO PARA DEIXAR O QUE O USUARIO DIGITAR EM MAIUSCULO-->
                </div> <!-- inputBox -->

                <div class="inputBox">
                    <label for="email"> Email: </label>
                    <input id="email" type="email" name="email" placeholder="Digite seu email" required="required"
                        onkeyup="maiuscula(this)"><!--EVENTO QUE ATIVA A FUNÇÃO PARA DEIXAR O QUE O USUARIO DIGITAR EM MAIUSCULO-->
                </div> <!-- inputBox -->

                <div class="inputBox">
            
            <?php
            echo radio_genero();
            ?>
            </div>

                <div class="inputBox">
                    <label for="tel"> Telefone: </label>
                    <input id="tel" type="tel" name="tel" placeholder="(xx) xxxx-xxxxx" required="required">
                </div> <!-- inputBox -->

                <div class="inputBox">
                    <label for="nascimento"> Data de nascimento: </label>
                    <input id="nascimento" type="date" name="nascimento" required="required">
                </div> <!-- inputBox -->

                <div class="inputBox">
                    <label for="foto"> Foto de perfil </label>
                    <input id="foto" type="file" name="foto">
                </div> <!-- inputBox -->



                <div class="inputBox">

            <?php

            echo checkbox_filmes();

            ?>

        <!--
            <legend id="tituloGenero">Gêneros de filme preferidos</legend>

        <div class="inputgenero"> 

        <label for="dia_1">Ação</label>
        <input type="checkbox" name="filme" value="1" id="filme_1"><br>
        
        <label for="dia_2">Aventura</label>
        <input type="checkbox" name="filme" value="2" id="filme_2"><br>
        
        <label for="dia_3">Comédia</label>
        <input type="checkbox" name="filme" value="3" id="filme_3"><br>

        <label for="dia_4">Comédia Romântica</label>
        <input type="checkbox" name="filme" value="4" id="filme_4"><br>

        <label for="dia_5">Comédia Dramática</label>
        <input type="checkbox" name="filme" value="5" id="filme_5"><br>

        <label for="dia_6">Drama</label>
        <input type="checkbox" name="filme" value="6" id="filme_6"><br>

        <label for="dia_7">Biográfico</label>
        <input type="checkbox" name="filme" value="7" id="filme_7"><br>

        <label for="dia_8">Histórico</label>
        <input type="checkbox" name="filme" value="8" id="filme_8"><br>

        <label for="dia_9">Fantasia</label>
        <input type="checkbox" name="filme" value="9" id="filme_9"><br>
    </div>-->
    </div>
    

                <!--
                    <label id="tituloGenero" for="genero">Gênero:</label>
                    <div class="inputGenero">
                        <input type="radio" id="feminino" name="genero">
                        <label for="feminino">Feminino</label>
                    </div>

                    <div class="inputGenero">
                        <input type="radio" id="masculino" name="genero">
                        <label for="masculino">Masculino</label>
                    </div>

                    <div class="inputGenero">
                        <input type="radio" id="nenhum" name="genero">
                        <label for="nenhum">Prefiro não dizer</label>
                    </div>
                </div> -->
    

            <div class="botaoEnviar">
                <input type="submit" value="Enviar">
            </div> <!-- botaoEnviar -->
        </form>
    </div> <!-- centro -->
    <div class="footer-bottom">
        <div class="box">
          <a id="nomes" onmouseover="MudarCor()" onmouseout="CorNormal()"> &copy; | Site criado por Isadora Dutra</a>
        </div>
      </div>
</body>

</html>

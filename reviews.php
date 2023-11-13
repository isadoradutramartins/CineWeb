<?php

$nota = array (
    array (1,1),
    array(2,2),
    array(3,3),
    array(4,4),
    array(5,5)
);

function radio($nota, $dados) {
    $html = "";
    echo"<label id=\"tituloGenero\" for=\"name\">Nota</label>";
    for ($i = 0; $i <= count($dados)-1; $i++) {
        $html.= "<div class=\"inputGenero\">";
        $html.= "<input type=\"radio\" name=\"$nota\" value=\"".$dados[$i][0]."\" id=\"$nota".$dados[$i][0]."\">\n";
        $html .= "<label for=\"$nota".$dados[$i][0]."\">".$dados[$i][1]."</label>";
        $html.= "</div>";
    }

    return $html;
}

function radio_nota() {
    global $nota;
    return radio("nota", $nota);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Produtos </title>
        <link rel="icon" type="imagem/png" href="imagens/MiaBoutique_logo.png" width="900" height="1000" />
        <link href="css/estiloReviews.css" rel="stylesheet" />
        <link href="css/estilo.css" rel="stylesheet" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <script type="text/javascript" src="js/arq.js"></script>
        <meta charset="utf-8">
    </head>
<body bgcolor="#f8e1e1">
    <script>

         /*MUDANDO A COR DOS NOMES QUANDO O MOUSE PASSA POR CIMA*/
         function MudarCor(){
            var nomes = document.getElementById("nomes");
            nomes.style.color = "#1154ab";
        }

        function CorNormal() {
            var nomes = document.getElementById("nomes");
            nomes.style.color = "black";
        }
        
    </script>
    <header><!--menu no topo da pagina-->
        <div class="centro">
           <h2>CINE<span>WEB</span></h2>
            <nav class="menu">
                <a class="link" href="inicial.html">Home</a>
                <a class="link" href="info.html">Informações</a>
                <a class="link" href="filmes.html">Filmes e Séries</a>
                <a class="link" href="cadastre.php">Cadastre-se</a>
            </nav>
        </div>
    </header>
    
    <div class="centro" id="centroTrabalhe">
        <form onsubmit="enviarForm()"> 
            <div class="form-header">
                <div class="titulo">
                    <h1> Adicione sua review: </h1>
                </div><!-- titulo -->
            </div> <!-- form-header -->
        

            <div class="todosInputs">
                <div class="inputBox">
                    <label for="titulo"> Título do filme: </label>
                    <input id="titulo" type="text" name="titulo" placeholder="Digite o título do filme:" required="required"
                        onkeyup="maiuscula(this)"> <!--EVENTO QUE ATIVA A FUNÇÃO PARA DEIXAR O QUE O USUARIO DIGITAR EM MAIUSCULO-->
                </div> <!-- inputBox -->

                <div class="todosInputs">
                    <div class="inputBox">
                    
   <!--     <label id="tituloGenero" for="genero">Nota:</label>
        <div class="inputGenero">
            <input type="radio" id="1" name="nota">
            <label for="1">1</label>
        </div>

        <div class="inputGenero">
            <input type="radio" id="2" name="nota">
            <label for="2">2</label>
        </div>

        <div class="inputGenero">
            <input type="radio" id="3" name="nota">
            <label for="nota">3</label>
        </div>

        <div class="inputGenero">
            <input type="radio" id="4" name="nota">
            <label for="nota">4</label>
        </div>

        <div class="inputGenero">
            <input type="radio" id="5" name="nota">
            <label for="nota">5</label>
        </div>


    </div>-->

    <?php

    echo radio_nota()

    ?>
                      <!--  <label for="classificacao"> Nota: ( 1 a 5) </label>
                        <input id="classificacao" type="number" name="classificacao"  required="required" min="1" max="5">
                    </div> <!-- inputBox 
                <div class="inputBox"> -->
            
                <div class="todosInputs">
                        <div class="inputBox">
                            <label for="titulo"> Título da avaliação: (opcional) </label>
                            <input id="titulo" type="text" name="titulo" placeholder="Digite o título da sua avaliação:" 
                                onkeyup="maiuscula(this)"> <!--EVENTO QUE ATIVA A FUNÇÃO PARA DEIXAR O QUE O USUARIO DIGITAR EM MAIUSCULO-->
                        </div> <!-- inputBox -->

                        <div class="inputBox">
                            <label for="review">Escreva aqui sua review:</label>
                            <textarea id="review" name="review" rows="5" cols="33" required="required"> </textarea> <!--EVENTO QUE ATIVA A FUNÇÃO (quando o usuário sair do campo do formulário).-->
                        </div> <!-- inputBox -->
</textarea>
       
    

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







    
    <div class="footer-bottom">
        <div class="box">
          <a id="nomes" onmouseover="MudarCor()" onmouseout="CorNormal()"> &copy; | Site criado por Isadora Martins</a>
        </div>
      </div>
</body>
</html>